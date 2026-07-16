<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function validatePayment(Request $request, Order $order)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:paid,processing,pending_payment',
            'status_pesanan' => 'required|in:pending,proses,selesai',
        ]);

        $order->update([
            'status_pembayaran' => $request->status_pembayaran,
            'status_pesanan' => $request->status_pesanan,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
