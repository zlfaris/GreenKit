<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function directCheckout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'kuantitas' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        
        $product = \App\Models\Product::findOrFail($request->product_id);
        if ($request->kuantitas > $product->stok) {
            return back()->with('error', 'Out of stock, please checkout other products!');
        }

        
        // Clear existing cart to only checkout this item
        $user->carts()->delete();

        // Add the direct buy item to cart
        $user->carts()->create([
            'product_id' => $request->product_id,
            'kuantitas' => $request->kuantitas,
        ]);

        return redirect()->route('checkout.index');
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();
        $carts = $user->carts()->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->back();
        }

        $subtotal = 0;
        $totalWeight = 0;

        foreach ($carts as $cart) {
            $product = \App\Models\Product::find($cart->product_id);
            if (!$product || $cart->kuantitas > $product->stok) {
                return redirect()->route('cart.index')->with('error', 'Out of stock, please checkout other products!');
            }

            $subtotal += $cart->product->harga * $cart->kuantitas;
            $weight = $cart->product->berat ?? 1000;
            $totalWeight += $weight * $cart->kuantitas;
        }

        // Mock API Integration for Shipping
        $ongkir = 20000; // default mock
        try {
            $response = Http::withHeaders([
                'Authorization' => env('KOMERCE_API_KEY', 'dummy-key')
            ])->post('https://api.komerce.id/v1/shipping/calculate', [
                'destination_province_id' => $request->provinsi_id,
                'destination_city_id' => $request->kota_id,
                'weight' => $totalWeight,
            ]);

            if ($response->successful() && $response->json('data.ongkir')) {
                $ongkir = (int) $response->json('data.ongkir');
            }
        } catch (\Exception $e) {
            // Use mock ongkir if API fails
        }

        $biaya_admin = rand(1, 999);
        $total_harga = $subtotal + $ongkir + $biaya_admin;
        $nomor_pesanan = 'ORD-' . time();

        $order = Order::create([
            'nomor_pesanan' => $nomor_pesanan,
            'user_id' => $user->id,
            'nama_depan' => $request->first_name ?? '',
            'nama_belakang' => $request->last_name ?? '',
            'email_pembeli' => $request->email ?? '',
            'nomor_telepon' => $request->phone ?? '',
            'alamat_jalan' => $request->street_address ?? '',
            'provinsi_id' => $request->province_id ?? '',
            'kota_id' => $request->city_id ?? '',
            'kota' => $request->city_name ?? '',
            'negara' => $request->country ?? 'Indonesia',
            'kodepos' => $request->postcode ?? '',
            'kurir' => $request->courier ?? '',
            'layanan' => $request->courier_service ?? '',
            'subtotal' => $subtotal,
            'ongkir' => $ongkir,
            'biaya_admin' => $biaya_admin,
            'total_harga' => $total_harga,
            'status_pesanan' => 'pending',
            'status_pembayaran' => 'pending_payment',
            'nomor_whatsapp' => $request->phone ?? '',
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'kuantitas' => $cart->kuantitas,
                'harga_beli' => $cart->product->harga,
            ]);
            
            // Deduct stock safely
            $product = \App\Models\Product::find($cart->product_id);
            if ($product) {
                $product->decrement('stok', $cart->kuantitas);
            }
        }
        // Cart clearing deferred to payment upload step


        return redirect()->route('checkout.payment', $order->id);
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.payment', compact('order'));
    }

    public function storePayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('receipts', 'public');

        $order->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'awaiting_validation',
        ]);

        Auth::user()->carts()->delete();

        return redirect()->route('profile.edit')->with('success', 'Payment proof uploaded successfully! Awaiting admin validation.');
    }
}
