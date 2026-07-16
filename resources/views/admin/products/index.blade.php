<x-admin-layout>
    <x-slot name="header">
        Product Management
    </x-slot>

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.products.create') }}" class="bg-[#445344] hover:bg-[#364236] text-white text-sm font-bold py-2 px-4 rounded shadow transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Product
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden" x-data="{ search: '' }">
        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full sm:w-64">
                <input type="text" x-model="search" placeholder="Search Product Name..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">
            </div>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full table-auto text-center text-sm whitespace-nowrap">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Image</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Product Name</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Price</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Stock</th>
                        <th class="px-6 py-3 font-medium text-gray-500 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors" 
                        x-show="'{{ strtolower($product->nama_produk) }}'.includes(search.toLowerCase())">
                        <td class="px-6 py-4 text-center align-middle">
                            @if($product->foto_produk)
                                <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="w-12 h-12 min-w-[3rem] min-h-[3rem] object-cover rounded-lg border border-gray-200 shadow-sm mx-auto" style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-medium text-gray-400 bg-gray-100 rounded-md mx-auto" style="width: 48px; height: 48px;">No Img</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900 text-left">{{ $product->nama_produk }}</td>
                        <td class="px-6 py-4 text-gray-600 text-center">{{ number_format($product->harga, 0, ',', '.') }} IDR</td>
                        <td class="px-6 py-4 text-left">
                            <span class="px-2 py-1 rounded text-xs font-bold 
                                {{ $product->stok < 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $product->stok }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 text-xs font-bold px-3 py-1.5 rounded transition-colors shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center bg-red-50 hover:bg-red-100 text-red-700 border border-red-200 text-xs font-bold px-3 py-1.5 rounded transition-colors shadow-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
