<x-app-layout>
    <!-- Hero Banner -->
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-poppins font-bold text-white mb-4">Detail Product</h1>
        <p class="text-white/80 text-sm md:text-base tracking-wide">Shop || Detail Product</p>
    </div>

    <!-- Main Content Wrapper -->
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8" style="padding-top: 72px; padding-bottom: 72px;">
        <!-- Product Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            
            <!-- Left Column: Images -->
            <div class="flex flex-col">
                <!-- Main Image -->
                <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="{{ $product->nama_produk }}" class="w-full aspect-[4/3] object-cover rounded-2xl shadow-sm">
                
                <!-- Thumbnails -->
                <div class="flex gap-4 mt-6 items-center">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-xl overflow-hidden cursor-pointer opacity-100 ring-2 ring-[#445344] transition shadow-sm">
                        <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="Thumb 1" class="w-full h-full object-cover">
                    </div>
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-xl overflow-hidden cursor-pointer opacity-70 hover:opacity-100 transition shadow-sm">
                        <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="Thumb 2" class="w-full h-full object-cover">
                    </div>
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-xl overflow-hidden cursor-pointer opacity-70 hover:opacity-100 transition shadow-sm">
                        <img src="{{ Str::startsWith($product->foto_produk, 'products/') ? asset('storage/' . $product->foto_produk) : asset($product->foto_produk) }}" alt="Thumb 3" class="w-full h-full object-cover">
                    </div>
                    <!-- Next Arrow -->
                    <button class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-500 hover:text-[#445344] hover:border-[#445344] transition flex-shrink-0 ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="flex flex-col">
                <h2 class="text-3xl font-bold text-gray-900">{{ $product->nama_produk }}</h2>
                
                <!-- Rating Row -->
                <div class="flex items-center mt-3 space-x-3 text-sm text-gray-600">
                    <div class="flex items-center space-x-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <span>{{ $product->jumlah_ulasan }} reviews</span>
                    <span class="text-gray-300">|</span>
                    <span class="font-medium text-gray-800">White</span>
                </div>

                <!-- Price -->
                <div class="text-2xl font-bold text-gray-900 mt-4">{{ number_format($product->harga, 0, ',', '.') }} IDR</div>

                <hr class="border-gray-200 my-5">

                <!-- Description -->
                <p class="text-gray-600 leading-relaxed mt-4">
                    {{ $product->deskripsi }}
                </p>

                <!-- Selectors & Add to Cart -->
                <form method="POST" action="{{ route('cart.store') }}" class="flex flex-wrap items-center gap-3 mt-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="border border-gray-300 rounded-full px-5 py-2 text-sm font-medium">
                        White
                    </div>
                    <div class="bg-gray-100 rounded-full px-5 py-2 text-sm font-medium flex items-center gap-4">
                        <input type="hidden" name="kuantitas" id="quantity-input" value="1">
                        <button type="button" onclick="decrementQuantity()" class="hover:text-[#445344]">-</button>
                        <span id="quantity-display">1</span>
                        <button type="button" onclick="incrementQuantity()" class="hover:text-[#445344]">+</button>
                    </div>
                    <button type="submit" class="bg-[#445344] text-white rounded-full px-6 py-2.5 font-semibold flex-1 text-center hover:bg-[#364236] transition">
                        Add to cart
                    </button>
                    <button type="submit" formaction="{{ route('checkout.direct') }}" class="w-full block text-center bg-white text-[#445344] border border-[#445344] rounded-full py-2.5 mt-3 font-semibold hover:bg-gray-50 transition">
                        Checkout Now
                    </button>
                    <!-- PLACE THIS DIRECTLY BELOW THE CHECKOUT NOW BUTTON CONTAINER -->
                    @if(session('error') || session('failed'))
                        <div class="mt-3 w-full text-sm font-normal text-red-600 tracking-wide text-center">
                            {{ session('error') ?? session('failed') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Similar Product Section -->
        <div style="margin-top: 50px;">
            <h3 class="text-3xl font-bold text-gray-900" style="margin-bottom: 37px;">Similar Product</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 md:gap-12">
                @foreach($similarProducts as $simProduct)
                    <x-product-card :product="$simProduct" />
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function incrementQuantity() {
            const qtyInput = document.getElementById('quantity-input');
            const qtyDisplay = document.getElementById('quantity-display');
            let currentVal = parseInt(qtyInput.value, 10) || 1;
            
            currentVal += 1;
            
            qtyInput.value = currentVal;
            qtyDisplay.innerText = currentVal;
        }

        function decrementQuantity() {
            const qtyInput = document.getElementById('quantity-input');
            const qtyDisplay = document.getElementById('quantity-display');
            let currentVal = parseInt(qtyInput.value, 10) || 1;
            
            if (currentVal > 1) {
                currentVal -= 1;
                qtyInput.value = currentVal;
                qtyDisplay.innerText = currentVal;
            }
        }
    </script>
</x-app-layout>
