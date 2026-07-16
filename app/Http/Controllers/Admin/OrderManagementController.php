<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where('nomor_pesanan', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->whereIn('status_pesanan', ['pending', 'pending_payment']);
            } else {
                $query->where('status_pesanan', $request->status);
            }
        }

        $orders = $query->paginate(10)->withQueryString();
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function approvePayment(Request $request, Order $order)
    {
        $order->update([
            'status_pembayaran' => 'paid',
            'status_pesanan' => 'processing'
        ]);

        return back()->with('success', 'Payment approved successfully.');
    }

    public function shipOrder(Request $request, Order $order)
    {
        $order->update([
            'status_pesanan' => 'shipped'
        ]);

        return back()->with('success', 'Order marked as shipped successfully.');
    }

    public function deliverOrder(Request $request, Order $order)
    {
        $order->update([
            'status_pesanan' => 'delivered'
        ]);

        return back()->with('success', 'Order marked as delivered successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $status = $request->input('status');
        if ($status === 'processing') {
            $order->update([
                'status_pembayaran' => 'paid',
                'status_pesanan' => 'processing'
            ]);
        } elseif ($status === 'shipped') {
            $order->update([
                'status_pesanan' => 'shipped'
            ]);
        } else {
            $order->update(['status_pesanan' => $status]);
        }

        return back()->with('success', 'Order status updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Extra security check: only allow deleting if status is delivered
        if ($order->status_pesanan !== 'delivered') {
            return redirect()->back()->with('error', 'Hanya pesanan yang sudah selesai yang dapat dihapus.');
        }
        
        $order->delete();
        return redirect()->back()->with('success', 'Riwayat pesanan berhasil dihapus.');
    }
}
