<x-app-layout>
    <!-- Header -->
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-poppins font-bold text-white mb-4">Shop</h1>
        <p class="text-white/80 text-sm md:text-base tracking-wide">Home || Shop</p>
    </div>

    <!-- Product Grid Section -->
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 md:gap-12">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </div>
</x-app-layout>
