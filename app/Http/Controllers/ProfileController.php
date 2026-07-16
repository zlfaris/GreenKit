<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $activeOrders = $request->user()->orders()->with('items.product')
            ->whereNotIn('status_pesanan', ['completed', 'delivered'])
            ->orderBy('created_at', 'desc')->get();
            
        $historyOrders = $request->user()->orders()->with('items.product')
            ->whereIn('status_pesanan', ['completed', 'delivered', 'selesai'])
            ->where('is_hidden_by_user', false)
            ->orderBy('created_at', 'desc')->get();

        \Illuminate\Support\Facades\Log::info('History Orders count: ' . $historyOrders->count(), $historyOrders->toArray());

        return view('profile.edit', [
            'user' => $request->user(),
            'activeOrders' => $activeOrders,
            'historyOrders' => $historyOrders,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Hide an order from the user's history.
     */
    public function hideOrder(Request $request, \App\Models\Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $order->update(['is_hidden_by_user' => true]);

        return response()->json(['success' => true, 'message' => 'Order hidden successfully']);
    }

    /**
     * User confirms they received the order.
     */
    public function confirmReceived(Request $request, \App\Models\Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            abort(403);
        }

        $order->update(['status_pesanan' => 'delivered']);

        return back()->with('success', 'Pesanan telah dikonfirmasi diterima.');
    }
}
