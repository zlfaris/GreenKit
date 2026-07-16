@props(['product'])

<div class="relative group overflow-hidden rounded-xl shadow-md bg-white h-full">
    <a href="{{ route('product.show', $product->slug) }}" class="flex flex-col h-full after:absolute after:inset-0 focus:outline-none">
        <!-- Image Area -->
        <div class="bg-gray-100 w-full aspect-square relative flex justify-center items-center overflow-hidden">
            <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="object-contain w-full h-full p-6 mix-blend-multiply transition-transform duration-500 group-hover:scale-105" />
        </div>
        
        <!-- Content Area -->
        <div class="bg-[#445344] p-5 text-white flex flex-col flex-grow relative">
            <h3 class="font-bold text-[15px] leading-snug text-white">{{ $product->nama_produk }}</h3>
        <p class="text-[14px] font-medium text-white mt-1">{{ number_format($product->harga, 0, ',', '.') }} IDR</p>
        
        <div class="flex items-center text-yellow-400 text-sm mt-3">
            @for ($i = 0; $i < 5; $i++)
                @if ($i < floor($product->rating))
                    <svg class="w-[15px] h-[15px] fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @elseif ($i < ceil($product->rating))
                    <svg class="w-[15px] h-[15px]" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="halfStar-{{ md5($product->nama_produk . $i) }}">
                                <stop offset="50%" stop-color="currentColor" />
                                <stop offset="50%" stop-color="#6b7280" />
                            </linearGradient>
                        </defs>
                        <path fill="url(#halfStar-{{ md5($product->nama_produk . $i) }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @else
                    <svg class="w-[15px] h-[15px] text-gray-500 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endif
            @endfor
            <span class="ml-2 text-[13px] font-medium text-white">{{ $product->rating }}</span>
        </div>
        <!-- PLACE THIS INSIDE THE CARD'S DARK INFO SECTION, RIGHT BELOW THE RATINGS/PRICE -->
        @if(session('error') && session('error_product_id') == $product->id)
            <div class="mt-2 text-xs font-normal text-red-300 tracking-wide">
                {{ session('error') }}
            </div>
        @endif
    </div>
    </a>

    <!-- Floating '+' Button -->
    <form method="POST" action="{{ route('cart.store') }}" class="absolute bottom-4 right-4 z-10">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="kuantitas" value="1">
        <button type="submit" class="bg-white text-[#445344] rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-gray-100 transition-colors focus:outline-none text-xl font-medium leading-none pb-0.5">
            +
        </button>
    </form>
</div>
