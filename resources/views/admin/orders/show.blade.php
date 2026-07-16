<x-admin-layout>
    <x-slot name="header">
        Order Details #{{ $order->nomor_pesanan }}
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">&larr; Back to Orders</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Column: Order Items & Customer Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#445344] text-white px-6 py-4">
                    <h3 class="font-bold">Ordered Items</h3>
                </div>
                <div class="p-0">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 font-medium text-gray-500">Product</th>
                                <th class="px-6 py-3 font-medium text-gray-500 text-center">Qty</th>
                                <th class="px-6 py-3 font-medium text-gray-500 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 text-gray-900">{{ $item->product->nama_produk ?? 'Unknown Product' }}</td>
                                <td class="px-6 py-4 text-center font-medium">{{ $item->kuantitas }}</td>
                                <td class="px-6 py-4 text-right font-medium">{{ number_format($item->harga * $item->kuantitas, 0, ',', '.') }} IDR</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-gray-50 p-6 border-t border-gray-200 space-y-2 text-sm text-right">
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Subtotal:</span>
                        <span class="font-medium text-gray-800">{{ number_format($order->subtotal, 0, ',', '.') }} IDR</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Shipping ({{ $order->kurir }} - {{ $order->layanan }}):</span>
                        <span class="font-medium text-gray-800">{{ number_format($order->ongkir, 0, ',', '.') }} IDR</span>
                    </div>
                    <div class="flex justify-between items-center text-gray-600">
                        <span>Admin Fee:</span>
                        <span class="font-medium text-gray-800">{{ number_format($order->biaya_admin ?? 0, 0, ',', '.') }} IDR</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200 mt-2">
                        <span class="font-bold text-gray-900">Total:</span>
                        <span class="font-bold text-xl text-gray-900">{{ number_format($order->total_harga, 0, ',', '.') }} IDR</span>
                    </div>
                </div>
            </div>
            
            <!-- Customer & Shipping Info -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div>
                    <h3 class="font-bold text-gray-800 mb-3 border-b pb-2">Customer Info</h3>
                    <p class="text-gray-600"><span class="font-medium">Name:</span> {{ $order->nama_depan }} {{ $order->nama_belakang }}</p>
                    <p class="text-gray-600"><span class="font-medium">Email:</span> {{ $order->email_pembeli }}</p>
                    <p class="text-gray-600"><span class="font-medium">Phone:</span> {{ $order->nomor_telepon }}</p>
                    <p class="text-gray-600"><span class="font-medium">WhatsApp:</span> {{ $order->nomor_whatsapp }}</p>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 mb-3 border-b pb-2">Shipping Address</h3>
                    <p class="text-gray-600">{{ $order->alamat_jalan }}</p>
                    <p class="text-gray-600">{{ collect([$order->kota, $order->provinsi, $order->negara, $order->kodepos])->filter()->join(', ') }}</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Order Status & Actions -->
        <div class="space-y-6" x-data="{ proofModalOpen: false }">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-4">
                <h3 class="font-bold text-gray-800 border-b pb-2">Order Status</h3>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-600">Payment Status:</span>
                    <span class="px-2 py-1 rounded text-xs font-bold uppercase
                        {{ $order->status_pembayaran == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $order->status_pembayaran }}
                    </span>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-600">Order Status:</span>
                    <span class="px-2 py-1 rounded text-xs font-bold uppercase
                        {{ $order->status_pesanan == 'completed' ? 'bg-green-100 text-green-700' : 
                          ($order->status_pesanan == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ $order->status_pesanan }}
                    </span>
                </div>
                
                <div class="pt-4 border-t border-gray-100">
                    @if($order->status_pembayaran === 'unpaid' && $order->bukti_pembayaran)
                        <button @click="proofModalOpen = true" class="w-full bg-[#445344] hover:bg-[#364236] text-white text-sm font-bold py-2 px-4 rounded shadow transition-colors mb-2">
                            Review Payment Proof
                        </button>
                    @elseif($order->bukti_pembayaran)
                        <button @click="proofModalOpen = true" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-bold py-2 px-4 rounded shadow transition-colors">
                            View Payment Proof
                        </button>
                    @else
                        <div class="p-3 bg-gray-50 border border-gray-200 rounded text-center text-sm text-gray-500">
                            No payment proof uploaded yet.
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Payment Proof Modal (Alpine.js) -->
            <div x-show="proofModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="proofModalOpen" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="proofModalOpen = false"></div>
                    
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    
                    <div x-show="proofModalOpen" x-transition 
                         class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Payment Proof
                                    </h3>
                                    <div class="mt-4">
                                        @if($order->bukti_pembayaran)
                                            <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" alt="Payment Proof" class="w-full rounded border border-gray-200 shadow-sm">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 justify-end mt-6">
                            <!-- Base Close Button -->
                            <button type="button" @click="proofModalOpen = false" onclick="closeModal()" class="border border-gray-300 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium cursor-pointer hover:bg-gray-50">
                                Close
                            </button>
                            
                            <!-- BUTTON 1: Verifikasi Pembayaran (Active when pending) -->
                            @if($order->status_pesanan === 'pending' || $order->status_pesanan === 'pending_payment')
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="processing">
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm shadow-sm transition cursor-pointer">
                                        Verifikasi Pembayaran
                                    </button>
                                </form>
                        
                            <!-- BUTTON 2: Pesanan Di Proses (Active when processing) -->
                            @elseif($order->status_pesanan === 'processing')
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="processed">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg text-sm shadow-sm transition cursor-pointer">
                                        Pesanan Di Proses
                                    </button>
                                </form>
                        
                            <!-- BUTTON 3: Pesanan Dikirim (Active when processed/ready) - THIS IS THE FINAL ADMIN ACTION -->
                            @elseif($order->status_pesanan === 'processed')
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="shipped">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#3E4E41] hover:bg-[#323f35] text-white text-sm font-semibold rounded-lg shadow-sm transition-colors duration-150 cursor-pointer">
                                        Pesanan Dikirim
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-admin-layout>
