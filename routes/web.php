<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Halaman Home (Bebas Akses)
Route::get('/', function () {
    $topProducts = \App\Models\Product::take(3)->get();
    return view('home', compact('topProducts')); 
})->name('home');

// 2. Halaman About Us (Bebas Akses)
Route::get('/about', function () {
    return view('about'); 
})->name('about');

// 3. Halaman Shop (Bebas Akses)
Route::get('/shop', [\App\Http\Controllers\ProductController::class, 'index'])->name('shop');

// 4. Halaman Detail Produk (Bebas Akses)
Route::get('/product/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

use App\Http\Controllers\CartController;

// 5. Halaman Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update')->middleware('auth');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

// 5. Halaman Dashboard bawaan Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 5. Rute Profile (Wajib ada agar navigasi bawaan Breeze tidak error)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/orders/{order}/hide', [ProfileController::class, 'hideOrder'])->name('orders.hide');
    Route::patch('/orders/{order}/confirm-delivered', [ProfileController::class, 'confirmReceived'])->name('user.orders.confirm-delivered');
});

// Memuat rute bawaan Breeze (Login, Register, dll)
require __DIR__.'/auth.php';

Route::get('/checkout', function () {
    $cartItems = collect([]);
    $subtotal = 0;
    if (Illuminate\Support\Facades\Auth::check()) {
        $cartItems = \App\Models\Cart::with('product')->where('user_id', auth()->id())->get();
        foreach ($cartItems as $item) {
            $subtotal += $item->product->harga * $item->kuantitas;
        }
    }
    return view('checkout.index', compact('cartItems', 'subtotal'));
})->middleware(['auth'])->name('checkout.index');

use App\Http\Controllers\CheckoutController;
Route::post('/checkout/direct', [CheckoutController::class, 'directCheckout'])->middleware(['auth'])->name('checkout.direct');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->middleware(['auth'])->name('checkout.process');
Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->middleware(['auth'])->name('checkout.payment');
Route::post('/checkout/payment/{order}', [CheckoutController::class, 'storePayment'])->middleware(['auth'])->name('checkout.payment.store');

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\ProductManagementController;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderManagementController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [OrderManagementController::class, 'approvePayment'])->name('orders.approve');
    Route::post('/orders/{order}/ship', [OrderManagementController::class, 'shipOrder'])->name('orders.ship');
    Route::post('/orders/{order}/deliver', [OrderManagementController::class, 'deliverOrder'])->name('orders.deliver');
    Route::patch('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [OrderManagementController::class, 'destroy'])->name('orders.destroy');
    
    Route::resource('products', ProductManagementController::class);
});

Route::get('/api/shipping/cost', function() {
    // Dummy response for shipping cost based on city_id
    return response()->json(['cost' => 15000]);
});

use App\Http\Controllers\ShippingController;

// Rute untuk mengecek biaya ongkir J&T
Route::post('/shipping/cost', [ShippingController::class, 'checkCost'])->name('shipping.cost');

Route::post('/shipping/calculate', [ShippingController::class, 'calculateShipping'])->name('shipping.calculate');

Route::get('/api/provinces', function() {
    return response()->json(App\Models\Province::orderBy('name', 'asc')->get());
});

Route::get('/api/cities', function() {
    return response()->json(App\Models\City::where('province_id', request('province_id'))->orderBy('name', 'asc')->get());
});
