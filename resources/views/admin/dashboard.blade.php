<x-admin-layout>
    <x-slot name="header">
        Dashboard Overview
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Revenue Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Revenue</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-gray-900">{{ number_format($totalRevenue, 0, ',', '.') }}</span>
                <span class="text-sm text-gray-500 font-medium">IDR</span>
            </div>
        </div>

        <!-- Active Orders Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Active Orders</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-gray-900">{{ $activeOrders }}</span>
            </div>
        </div>

        <!-- Low Stock Alerts Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wide">Low Stock Alerts</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-red-600">{{ $lowStockProducts->count() }}</span>
                <span class="text-sm text-gray-500 font-medium">Products</span>
            </div>
        </div>
    </div>

    <!-- Sales Analytics Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6 flex flex-col">
        <div class="flex flex-col items-center justify-center mb-6 gap-4 text-center w-full">
            <div class="flex flex-col items-center">
                <h3 class="text-lg font-bold text-gray-900">Sales Analytics</h3>
                <p class="text-sm text-gray-500">Revenue overview based on completed orders</p>
            </div>
            <div class="flex justify-center space-x-2 bg-gray-50 p-1 rounded-lg border border-gray-200 text-sm mt-2">
                <a href="{{ request()->fullUrlWithQuery(['filter' => 'today']) }}" class="px-3 py-1.5 rounded-md transition-colors {{ $filter === 'today' ? 'bg-white shadow-sm font-bold text-emerald-600' : 'text-gray-600 hover:text-gray-900' }}">Today</a>
                <a href="{{ request()->fullUrlWithQuery(['filter' => 'this_week']) }}" class="px-3 py-1.5 rounded-md transition-colors {{ $filter === 'this_week' ? 'bg-white shadow-sm font-bold text-emerald-600' : 'text-gray-600 hover:text-gray-900' }}">This Week</a>
                <a href="{{ request()->fullUrlWithQuery(['filter' => 'this_month']) }}" class="px-3 py-1.5 rounded-md transition-colors {{ $filter === 'this_month' ? 'bg-white shadow-sm font-bold text-emerald-600' : 'text-gray-600 hover:text-gray-900' }}">This Month</a>
                <a href="{{ request()->fullUrlWithQuery(['filter' => 'this_year']) }}" class="px-3 py-1.5 rounded-md transition-colors {{ $filter === 'this_year' ? 'bg-white shadow-sm font-bold text-emerald-600' : 'text-gray-600 hover:text-gray-900' }}">This Year</a>
            </div>
        </div>
        
        <div class="relative w-full h-[320px]">
            <!-- Chart Canvas -->
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Recent Orders & Low Stock List -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Recent Orders -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden lg:col-span-2">
            <div class="bg-[#445344] text-white px-6 py-4">
                <h3 class="font-bold">Recent Orders</h3>
            </div>
            <div class="w-full overflow-x-auto p-0">
                <table class="w-full table-auto text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Order ID</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Customer</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Total</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Status</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-gray-50 transition-colors" x-data="{ modalOpen: false }">
                            <td class="px-6 py-4 font-medium text-gray-900 text-center">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-[#445344] hover:underline">
                                    #{{ $order->nomor_pesanan }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-gray-600 text-center">{{ $order->user->name ?? $order->nama_depan }}</td>
                            <td class="px-6 py-4 text-gray-600 text-center">{{ number_format($order->total_harga, 0, ',', '.') }} IDR</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 rounded text-xs font-medium 
                                    {{ $order->status_pesanan == 'completed' ? 'bg-green-100 text-green-700' : 
                                      ($order->status_pesanan == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                    {{ ucfirst($order->status_pesanan) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center align-middle w-48">
                                <div class="flex items-center justify-center gap-3 flex-nowrap">
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No recent orders.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-[#445344] hover:underline">View All Orders &rarr;</a>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden h-fit">
            <div class="bg-[#445344] text-white px-6 py-4">
                <h3 class="font-bold">Stock Alerts</h3>
            </div>
            <div class="w-full overflow-x-auto p-0">
                @if($lowStockProducts->count() > 0)
                <table class="w-full table-auto text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Product Name</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Stock</th>
                            <th class="px-6 py-3 font-medium text-gray-500 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($lowStockProducts as $product)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-900 text-left">
                                {{ $product->nama_produk }}
                                @if($product->stok == 0)
                                    <div class="text-sm font-normal text-red-600 mt-1">Out of stock, please checkout other products!</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-red-600 text-center">{{ $product->stok }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.products.edit', $product) }}" class="text-sm font-medium text-[#445344] hover:underline">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="p-4">
                    <div class="flex flex-col items-center justify-center py-6 text-center bg-gray-50 rounded-xl border border-dashed border-gray-200 m-2">
                        <span class="text-sm font-semibold text-emerald-750">Semua Stok Aman</span>
                        <span class="text-xs text-gray-400 mt-0.5">Belum ada produk yang menipis.</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('salesChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Sales Revenue (IDR)',
                data: @json($salesData),
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.15)',
                borderWidth: 2,
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) {
                                return (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return (value / 1000).toFixed(0) + 'K';
                            }
                            return value;
                        }
                    }
                }
            }
        }
    });
});
</script>
