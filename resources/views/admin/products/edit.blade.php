<x-admin-layout>
    <x-slot name="header">
        Edit Product: {{ $product->nama_produk }}
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">&larr; Back to Products</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-3xl">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nama_produk" class="block text-sm font-bold text-gray-800 mb-2">Product Name</label>
                <input type="text" name="nama_produk" id="nama_produk" required value="{{ old('nama_produk', $product->nama_produk) }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">
                @error('nama_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="harga" class="block text-sm font-bold text-gray-800 mb-2">Price (IDR)</label>
                    <input type="number" name="harga" id="harga" required value="{{ old('harga', $product->harga) }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">
                    @error('harga') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="stok" class="block text-sm font-bold text-gray-800 mb-2">Stock</label>
                    <input type="number" name="stok" id="stok" required value="{{ old('stok', $product->stok) }}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">
                    @error('stok') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-bold text-gray-800 mb-2">Description</label>
                <textarea name="deskripsi" id="deskripsi" rows="4" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="foto_produk" class="block text-sm font-bold text-gray-800 mb-2">Product Image (Leave blank to keep current)</label>
                
                @if($product->foto_produk)
                <div class="mb-2">
                    <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="h-24 w-24 object-cover rounded shadow-sm border border-gray-200">
                </div>
                @endif

                <input type="file" name="foto_produk" id="foto_produk" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 border border-gray-300 rounded-md cursor-pointer bg-white">
                @error('foto_produk') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#445344] hover:bg-[#364236]">Update Product</button>
            </div>
        </form>
    </div>
</x-admin-layout>
