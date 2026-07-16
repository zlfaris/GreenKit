<x-app-layout>
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-poppins">Payment</h1>
        <p class="text-white text-sm md:text-base tracking-wide font-medium">Checkout || Payment</p>
    </div>

    <div class="max-w-2xl mx-auto px-4 py-12">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden text-center p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Order #{{ $order->nomor_pesanan }}</h2>
            <p class="text-lg text-gray-600 mb-6">Grand Total: <strong class="text-xl text-gray-900">{{ number_format($order->total_harga, 0, ',', '.') }} IDR</strong></p>

            <div class="mb-8">
                <p class="text-sm text-gray-500 mb-4">Please scan the QRIS code below to complete your payment.</p>
                <img src="{{ asset('images/qris.jpeg') }}" alt="QRIS Static" class="mx-auto rounded-lg shadow-sm border border-gray-100 max-w-xs h-auto">
            </div>

            <form id="paymentForm" action="{{ route('checkout.payment.store', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="text-left">
                    <label for="payment_proof" class="block text-sm font-bold text-gray-800 mb-2">Upload Payment Receipt</label>
                    <input type="file" id="payment_proof" name="payment_proof" required accept="image/*" class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2 bg-gray-50">
                    @error('payment_proof')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 mt-4">
                    <a href="/checkout" class="block w-full text-center border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 text-sm font-bold px-6 py-3 rounded-lg transition-colors shadow-sm">
                        Cancel
                    </a>
                    <button type="submit" class="w-full bg-[#445344] hover:bg-[#364236] text-white text-sm font-bold px-6 py-3 rounded-lg transition-colors shadow-sm">
                        Submit Payment Proof
                    </button>
                </div>
            </form>
        </div>
        </div>
    </div>
</x-app-layout>
