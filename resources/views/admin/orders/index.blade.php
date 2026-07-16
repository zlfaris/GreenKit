<x-admin-layout>
    <x-slot name="header">
        Order Management
    </x-slot>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Order ID..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2" onblur="this.form.submit()">
            </div>
            <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">
                <option value="">Semua Status (All Status)</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Validasi Pembayaran (Pending)</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Pesanan Diproses (Processing)</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Sedang Dikirim (Shipped)</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Selesai / Tiba (Delivered)</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan (Cancelled)</option>
            </select>
        </form>

        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto text-center text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Date</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Order ID</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Customer</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Total</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Payment</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Status</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors" 
                        x-data="{ modalOpen: false }">
                        <td class="px-6 py-4 text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 font-bold text-gray-900">#{{ $order->nomor_pesanan }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            <div>{{ $order->user->name ?? $order->nama_depan }}</div>
                            <div class="text-xs text-gray-400">{{ $order->email_pembeli }}</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($order->total_harga, 0, ',', '.') }} IDR</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-medium whitespace-nowrap
                                {{ $order->status_pembayaran == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ \Illuminate\Support\Str::headline($order->status_pembayaran) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-xs font-medium whitespace-nowrap
                                {{ $order->status_pesanan == 'completed' ? 'bg-green-100 text-green-700' : 
                                  ($order->status_pesanan == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                {{ \Illuminate\Support\Str::headline($order->status_pesanan) }}
                            </span>
                        </td>
                        <td class="w-48 text-center align-middle px-4 py-3">
                            <div class="flex items-center justify-center gap-3 flex-nowrap">
                                <!-- Existing Manage Button -->
                                <button @click="modalOpen = true" class="bg-gray-800 hover:bg-gray-900 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors flex-shrink-0">
                                    Manage
                                </button>

                                <!-- Delete Button -->
                                @if($order->status_pesanan === 'delivered')
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="flex-shrink-0 m-0 p-0" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center text-xs font-semibold px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition-colors cursor-pointer flex-shrink-0" title="Hapus Pesanan">
                                            Delete
                                        </button>
                                    </form>
                                @else
                                    <div class="flex-shrink-0 m-0 p-0">
                                        <button type="button" disabled class="flex items-center justify-center text-xs font-semibold px-3 py-1.5 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed flex-shrink-0" title="Hanya pesanan selesai yang dapat dihapus">
                                            Delete
                                        </button>
                                    </div>
                                @endif
                            </div>

                                <!-- Modal -->
                                <div x-show="modalOpen" class="fixed inset-0 z-[60] overflow-y-auto whitespace-normal" style="display: none;" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-data="{ zoomOpen: false }">
                                    <div class="flex items-center justify-center min-h-screen p-4 sm:p-6 text-center">
                                        <div x-show="modalOpen" x-transition.opacity class="fixed inset-0 bg-gray-900/40 backdrop-blur-md transition-opacity" style="backdrop-filter: blur(12px);" aria-hidden="true" @click="modalOpen = false"></div>
                                        
                                        <div x-show="modalOpen" x-transition 
                                             class="relative bg-white rounded-2xl w-full max-w-4xl p-6 text-left shadow-2xl transform transition-all border border-gray-100 my-auto">
                                            
                                            <!-- Header -->
                                            <div class="bg-white pb-4 mb-4 border-b border-gray-100">
                                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                                    <div>
                                                        <h3 class="text-2xl font-bold text-gray-900" id="modal-title">
                                                            Detail Pesanan: <span class="text-gray-800">#{{ $order->nomor_pesanan }}</span>
                                                        </h3>
                                                        <p class="text-sm text-gray-500 mt-1">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}</p>
                                                    </div>
                                                    
                                                    <!-- Dynamic Badge -->
                                                    @php
                                                        $badgeClass = 'bg-gray-100 text-gray-700 border border-gray-300';
                                                        if(in_array($order->status_pesanan, ['pending_payment', 'pending'])) {
                                                            $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200';
                                                        } elseif(in_array($order->status_pesanan, ['processing', 'proses'])) {
                                                            $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                                                        } elseif($order->status_pesanan == 'shipped') {
                                                            $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200';
                                                        } elseif(in_array($order->status_pesanan, ['delivered', 'selesai'])) {
                                                            $badgeClass = 'bg-gray-100 text-gray-700 border border-gray-300';
                                                        }
                                                    @endphp
                                                    <div class="{{ $badgeClass }} px-3 py-1.5 rounded-full text-xs font-semibold">
                                                        <span class="uppercase tracking-wider">{{ \Illuminate\Support\Str::headline($order->status_pesanan) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Body & Footer (Unified Redesign) -->
                                            <div class="mt-6">
                                                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col md:flex-row">
                                                    
                                                    <!-- Left Column: Order Information -->
                                                    <div class="w-full md:w-1/2 p-6 border-b md:border-b-0 md:border-r border-gray-200 flex flex-col">
                                                        <h3 class="text-lg font-bold text-gray-900 mb-6">Order Information</h3>
                                                        
                                                        <!-- Group Customer Details -->
                                                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 border-b border-gray-100 pb-2">Group Customer Details</h4>
                                                        <div class="space-y-3 mb-6">
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">Name:</span>
                                                                <span class="text-gray-900 font-medium text-sm">{{ $order->nama_depan ?: ($order->user->name ?? 'Belum diisi') }} {{ $order->nama_belakang }}</span>
                                                            </div>
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">Email:</span>
                                                                <span class="text-gray-900 font-medium text-sm">{{ $order->email_pembeli ?: ($order->user->email ?? 'Belum diisi') }}</span>
                                                            </div>
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">Phone:</span>
                                                                <span class="text-gray-900 font-medium text-sm">{{ $order->nomor_telepon ?: 'Belum diisi' }}</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Shipping Details -->
                                                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3 border-b border-gray-100 pb-2">Shipping Details</h4>
                                                        <div class="space-y-3">
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">Address:</span>
                                                                <span class="text-gray-900 font-medium text-sm text-right">{{ $order->alamat_jalan ?: 'Belum diisi' }}</span>
                                                            </div>
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">City & Postal:</span>
                                                                <span class="text-gray-900 font-medium text-sm">{{ $order->kota ?: 'Belum diisi' }} {{ $order->kodepos ? ', ' . $order->kodepos : '' }}</span>
                                                            </div>
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-gray-600 text-sm">Courier:</span>
                                                                <span class="text-gray-900 font-medium text-sm">{{ $order->kurir ? strtoupper($order->kurir) : 'J&T' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Right Column: Payment Documentation -->
                                                    <div class="w-full md:w-1/2 bg-gray-50/50 p-6 flex flex-col relative">
                                                        <h3 class="text-lg font-bold text-gray-900 mb-6">Payment Documentation</h3>
                                                        
                                                        <div class="flex-1 w-full flex flex-col items-center justify-center">
                                                            @if($order->bukti_pembayaran)
                                                                <div class="w-full h-[320px] bg-white rounded-xl border border-gray-200 p-4 flex flex-col justify-between items-center overflow-hidden">
                                                                    <div class="w-full h-[240px] flex items-center justify-center bg-gray-50 rounded-lg overflow-hidden border border-gray-100 relative group cursor-pointer" @click="zoomOpen = true">
                                                                        <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="max-w-full max-h-full object-contain rounded-md transition-transform hover:scale-[1.02]" alt="Payment Documentation">
                                                                        
                                                                        <!-- Magnifying Glass Badge -->
                                                                        <div class="absolute bottom-3 right-3 bg-black/70 text-white p-2 rounded-lg shadow-lg pointer-events-none transition-opacity opacity-0 group-hover:opacity-100 z-10">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                                                                            </svg>
                                                                        </div>
                                                                    </div>
                                                                    <p class="mt-2 text-xs text-gray-500 text-center">Click image to open full detailed viewer.</p>
                                                                </div>
                                                            @else
                                                                <div class="w-full h-full min-h-[200px] flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl bg-gray-50">
                                                                    <p class="text-sm text-gray-400 font-medium">No payment document uploaded</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Action Buttons (Tightly integrated, minimal bottom padding) -->
                                                <div class="flex items-center justify-end gap-3 mt-8 pt-4 border-t border-gray-100">
                                                    <!-- Close Button -->
                                                    <button type="button" @click="modalOpen = false" class="border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-semibold cursor-pointer transition-colors shadow-sm">
                                                        Close
                                                    </button>
                                                    
                                                    <!-- Action Button -->
                                                    @if($order->status_pesanan === 'pending' || $order->status_pesanan === 'pending_payment')
                                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="processing">
                                                            <button type="submit" class="bg-[#3E4E41] hover:bg-[#323f35] text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-sm transition-colors cursor-pointer">
                                                                Verifikasi Pembayaran
                                                            </button>
                                                        </form>
                                                    @elseif($order->status_pesanan === 'processing')
                                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="processed">
                                                            <button type="submit" class="bg-[#3E4E41] hover:bg-[#323f35] text-white font-semibold px-4 py-2 rounded-lg text-sm shadow-sm transition-colors cursor-pointer">
                                                                Pesanan Di Proses
                                                            </button>
                                                        </form>
                                                    @elseif($order->status_pesanan === 'processed')
                                                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="m-0 p-0">
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

                                        <!-- Fullscreen Zoom Modal Overlay (Alpine) -->
                                        <div x-show="zoomOpen" style="display: none;" class="fixed inset-0 z-[100] bg-gray-950/70 backdrop-blur-md overflow-y-auto flex justify-center items-start py-8 px-4" @click.self="zoomOpen = false" x-transition.opacity>
                                            @if($order->bukti_pembayaran)
                                                <div class="relative bg-white p-3 rounded-xl shadow-2xl max-w-2xl w-full my-auto flex flex-col" @click.stop>
                                                    <button @click="zoomOpen = false" type="button" class="absolute top-4 right-4 z-50 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 p-2.5 rounded-full shadow-lg transition-colors cursor-pointer flex items-center justify-center font-bold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                    <img src="{{ asset('storage/' . $order->bukti_pembayaran) }}" class="w-full h-auto object-contain rounded-lg block border border-gray-100">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
