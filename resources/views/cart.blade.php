<x-app-layout>

    <!-- Global Header -->
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-poppins">Cart</h1>
        <p class="text-white text-sm md:text-base tracking-wide font-medium">Shop || Cart</p>
    </div>

@guest
    <!-- STATE 1: GUEST -->
    <div class="w-full bg-white pt-20 pb-48 px-4 flex flex-col items-center">
        <div class="flex flex-col items-center text-center max-w-md mx-auto" style="margin-top: 40px;">
            <svg class="text-[#445344]" style="width: 300px; height: 300px; margin-bottom: -10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            
            <h2 class="text-2xl font-bold text-[#445344]">Wah, keranjang belanjamu masih kosong</h2>
            <p class="text-[#4a5546] mt-2 text-base">Yuk, telusuri koleksi terbaik dari GreenKit!</p>
            
            <div class="w-full max-w-[280px] mx-auto mt-8 flex flex-col gap-3" style="margin-bottom: 60px;">
                <a href="/shop" class="w-full px-8 py-3 bg-[#445344] hover:bg-[#364236] text-white font-medium rounded-md text-center transition-colors">Belanja Sekarang</a>
                <a href="/login" class="w-full px-8 py-3 border border-[#445344] text-[#445344] hover:bg-gray-50 font-medium rounded-md text-center transition-colors">Log in / Daftar</a>
            </div>
        </div>
    </div>
@endguest

@auth
    @if(empty($cartItems) || $cartItems->count() == 0)
        <!-- STATE 2: LOGGED IN, EMPTY CART -->
        <div class="w-full bg-white pt-20 pb-48 px-4 flex flex-col items-center">
            <div class="flex flex-col items-center text-center max-w-md mx-auto" style="margin-top: 40px;">
                <svg class="text-[#445344]" style="width: 300px; height: 300px; margin-bottom: -10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                
                <h2 class="text-2xl font-bold text-[#445344]">Wah, keranjang belanjamu masih kosong</h2>
                <p class="text-[#4a5546] mt-2 text-base">Yuk, telusuri koleksi terbaik dari GreenKit!</p>
                
                <div class="w-full max-w-[280px] mx-auto mt-8 flex flex-col gap-3" style="margin-bottom: 60px;">
                    <a href="/shop" class="w-full px-8 py-3 bg-[#445344] hover:bg-[#364236] text-white font-medium rounded-md text-center transition-colors">Belanja Sekarang</a>
                </div>
            </div>
        </div>
    @else
        <!-- STATE 3: LOGGED IN, WITH ITEMS -->
        <div style="height: 57px; width: 100%; display: block;"></div>
        <div class="max-w-[1200px] mx-auto px-4" x-data="cartApp()">
            
            <div style="display: grid; grid-template-columns: 1fr 350px; gap: 32px; align-items: start;">
                
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto w-full">
                        <table class="w-full text-left border-collapse min-w-[550px]">
                            <thead class="bg-[#445344] text-white">
                                <tr>
                                    <th class="py-4 px-5 font-bold whitespace-nowrap">Product</th>
                                    <th class="py-4 px-3 font-bold text-center whitespace-nowrap">Price</th>
                                    <th class="py-4 px-3 font-bold text-center whitespace-nowrap">Quantity</th>
                                    <th class="py-4 px-5 font-bold text-right whitespace-nowrap">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $index => $item)
                                <tr class="border-b border-gray-200 last:border-b-0" x-data="{ kuantitas: {{ $item->kuantitas }}, price: {{ $item->product->harga }} }" data-price="{{ $item->product->harga }}">
                                    
                                    <td class="py-3 px-5 align-middle">
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="removeItem({{ $item->id }}, $el)" class="w-6 h-6 rounded-full bg-[#445344] text-white flex items-center justify-center flex-shrink-0 hover:bg-red-600 transition-colors shadow-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                            <img src="{{ Str::startsWith($item->product->foto_produk, 'products/') ? asset('storage/' . $item->product->foto_produk) : asset($item->product->foto_produk) }}" class="w-14 h-14 object-cover rounded-md flex-shrink-0 border border-gray-100 shadow-sm">
                                            <h3 class="font-bold text-gray-800 text-sm m-0 leading-tight">{{ $item->product->nama_produk }}</h3>
                                        </div>
                                    </td>
                                    
                                    <td class="py-5 px-3 text-center align-middle text-sm font-bold text-gray-800 whitespace-nowrap">
                                        {{ number_format($item->product->harga, 0, ',', '.') }} IDR
                                    </td>
                                    
                                    <td class="py-5 px-3 align-middle">
                                        <div class="flex justify-center">
                                            <div class="bg-gray-100 rounded-full px-3 py-1.5 text-sm font-medium flex items-center gap-2 w-fit">
                                                <button type="button" @click="if(kuantitas > 1) updateQuantityOnServer({{ $item->id }}, kuantitas - 1, $data)" class="hover:text-[#445344] font-bold focus:outline-none transition-colors text-lg">&minus;</button>
                                                <span x-text="kuantitas" class="w-6 text-center font-bold text-gray-800">{{ $item->kuantitas }}</span>
                                                <button type="button" @click="updateQuantityOnServer({{ $item->id }}, kuantitas + 1, $data)" class="hover:text-[#445344] font-bold focus:outline-none transition-colors text-lg">&plus;</button>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="py-5 px-5 text-right align-middle text-sm font-bold text-gray-800 whitespace-nowrap row-total" x-text="(kuantitas * price).toLocaleString('id-ID') + ' IDR'" :data-row-total="kuantitas * price">
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg shadow-sm sticky top-8 flex flex-col">
                    <div class="bg-[#445344] text-white font-bold py-4 px-6 rounded-t-lg">
                        Total Cart
                    </div>
                    <div class="flex flex-col">
                        <div class="flex justify-between items-center p-5 border-b border-gray-200">
                            <span class="font-bold text-gray-800 text-sm">Subtotal</span>
                            <span class="font-bold text-gray-800 text-sm" x-text="subtotal.toLocaleString('id-ID') + ' IDR'"></span>
                        </div>
                        <div class="flex justify-between items-center p-5 border-b border-gray-200">
                            <span class="font-bold text-gray-800 text-sm">Discount</span>
                            <span class="font-bold text-gray-800 text-sm">0 IDR</span>
                        </div>
                        <div class="flex justify-between items-center p-5 bg-white">
                            <span class="font-bold text-gray-800 text-sm">Total</span>
                            <span class="font-bold text-gray-800 text-sm" x-text="subtotal.toLocaleString('id-ID') + ' IDR'"></span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="w-full block text-center bg-[#445344] hover:bg-[#364236] text-white font-medium py-4 text-sm transition-colors mt-auto rounded-b-lg">
                        Proceed To Checkout
                    </a>
                </div>
                
            </div>

            <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('cartApp', () => ({
                        subtotal: {{ $cartItems->sum(function($item) { return $item->product->harga * $item->kuantitas; }) }},
                        async updateQuantityOnServer(cartId, newKuantitas, rowScope) {
                            try {
                                const response = await fetch('/cart/update', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({ cart_id: cartId, kuantitas: newKuantitas })
                                });
                                const data = await response.json();
                                if (data.success) {
                                    rowScope.kuantitas = newKuantitas;
                                    this.subtotal = data.grand_total;
                                } else {
                                    alert('Failed to update quantity');
                                }
                            } catch (error) {
                                console.error('Error:', error);
                                alert('Error updating quantity');
                            }
                        },
                        removeItem(itemId, buttonEl) {
                            if (confirm('Are you sure you want to remove this item?')) {
                                fetch('/cart/' + itemId, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        buttonEl.closest('tr').remove();
                                        if (document.querySelectorAll('tbody tr').length === 0) {
                                            window.location.reload();
                                        } else {
                                            // Recalculate subtotal manually or reload
                                            window.location.reload();
                                        }
                                    } else {
                                        alert(data.message || 'Error deleting item');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('An error occurred.');
                                });
                            }
                        }
                    }))
                })
            </script>
        </div>
        <div style="height: 57px; width: 100%; display: block;"></div>
    @endif
@endauth

</x-app-layout>
