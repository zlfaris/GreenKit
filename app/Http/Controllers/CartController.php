<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = collect([]);
        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        }
        return view('cart', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'kuantitas' => 'integer|min:1',
        ]);

        $kuantitas = $request->input('kuantitas', 1);
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->first();

        $existing_kuantitas = $cart ? $cart->kuantitas : 0;
        $total_requested = $existing_kuantitas + $kuantitas;

        if ($total_requested > $product->stok) {
            return back()->with([
                'error' => 'Out of stock, please checkout other products!',
                'error_product_id' => $product->id
            ]);
        }

        if ($cart) {
            $cart->kuantitas += $kuantitas;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'kuantitas' => $kuantitas,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully!');
    }

    public function destroy($id)
    {
        $item = Cart::where('user_id', auth()->id())->where('id', $id)->first() ?? Cart::where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($item) {
            $item->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Cart item not found. Debug ID sent: ' . $id], 404);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'kuantitas' => 'required|integer|min:1'
        ]);

        $cart = Cart::with('product')->where('user_id', Auth::id())->where('id', $request->cart_id)->first();
        if ($cart) {
            if ($request->kuantitas > $cart->product->stok) {
                return response()->json([
                    'success' => false,
                    'message' => "Stock limit reached. Max available: {$cart->product->stok}"
                ], 422);
            }

            $cart->kuantitas = $request->kuantitas;
            $cart->save();
            
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            $grandTotal = 0;
            foreach ($cartItems as $item) {
                $grandTotal += $item->product->harga * $item->kuantitas;
            }
            $rowTotal = $cart->product->harga * $cart->kuantitas;

            return response()->json([
                'success' => true,
                'row_total' => $rowTotal,
                'grand_total' => $grandTotal
            ]);
        }

        return response()->json(['success' => false], 404);
    }
}
