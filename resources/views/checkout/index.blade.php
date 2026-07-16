<x-app-layout>
    
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-poppins">Checkout</h1>
        <p class="text-white text-sm md:text-base tracking-wide font-medium">Home || Checkout</p>
    </div>

    <!-- Spacer -->
    <div style="height: 57px; width: 100%; display: block;"></div>

    <!-- 2. EXACT 1200PX CONTENT CONTAINER -->
    <div class="max-w-[1200px] mx-auto px-4 w-full">
        
        <!-- 3. TAILWIND GRID CONTAINER -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- Left Column: Form -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col lg:col-span-2">
                <div class="bg-[#445344] text-white font-bold py-4 px-6">
                    Checkout
                </div>
                <div class="p-6">
                    <form id="checkout-form" action="#" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-bold text-gray-800 mb-2">First Name*</label>
                                <input type="text" id="first_name" name="first_name" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-bold text-gray-800 mb-2">Last Name*</label>
                                <input type="text" id="last_name" name="last_name" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-800 mb-2">Email Address*</label>
                                <input type="email" id="email" name="email" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-bold text-gray-800 mb-2">Phone Number*</label>
                                <input type="tel" id="phone" name="phone" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                            </div>
                        </div>

                        <div>
                            <label for="province_select" class="block text-sm font-bold text-gray-800 mb-2">Province*</label>
                            <select id="province_select" name="province_id" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors bg-white">
                                <option value="">Select a province</option>
                            </select>
                            <input type="hidden" id="province_name" name="province_name">
                        </div>

                        <div>
                            <label for="city_select" class="block text-sm font-bold text-gray-800 mb-2">Town / City*</label>
                            <select id="city_select" name="city_id" required disabled class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors bg-gray-50 disabled:opacity-60 cursor-not-allowed">
                                <option value="">Select a city</option>
                            </select>
                            <input type="hidden" id="city_name" name="city_name">
                        </div>

                        <div>
                            <label for="street_address" class="block text-sm font-bold text-gray-800 mb-2">Street Address*</label>
                            <input type="text" id="street_address" name="street_address" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                        </div>

                        <div>
                            <label for="postcode" class="block text-sm font-bold text-gray-800 mb-2">Postcode / Zip*</label>
                            <input type="text" id="postcode" name="postcode" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-[#455546] focus:border-[#455546] sm:text-sm px-4 py-2.5 transition-colors">
                        </div>
                        
                        <div class="pt-2">
                            <label class="block text-sm font-bold text-gray-800 mb-2">Payment Method</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <label class="border border-gray-300 rounded-lg p-4 flex items-center justify-between bg-white cursor-pointer hover:border-[#455546] transition-colors">
                                    <div class="flex items-center space-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                        </svg>
                                        <span class="font-medium text-gray-900">QRIS</span>
                                    </div>
                                    <input type="checkbox" name="payment_method" value="qris" required class="h-4 w-4 rounded-full text-green-600 focus:ring-green-500 focus:border-green-500 border-gray-300 cursor-pointer outline-none focus:outline-none focus:ring-offset-0">
                                </label>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="bg-[#445344] hover:bg-[#364236] text-white font-bold text-sm px-6 py-2.5 rounded transition-colors shadow-sm">
                                Checkout
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="flex flex-col w-full">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm flex flex-col overflow-hidden">
                    <div class="bg-[#445344] text-white font-bold py-4 px-6">
                    Checkout Details
                </div>
                <div class="flex flex-col p-5">
                    <table class="w-full text-left border-collapse table-fixed">
                        <thead>
                            <tr class="text-xs font-bold text-gray-700 uppercase border-b border-dashed border-gray-200">
                                <th class="py-2 text-left" style="width: 49%;">PRODUCT</th>
                                <th class="py-2 text-center" style="width: 26%;">QUANTITY</th>
                                <th class="py-2 text-right" style="width: 25%;">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr class="text-sm text-gray-800 border-b border-gray-100 last:border-b-0">
                                <td class="py-4 pr-2 whitespace-normal break-words text-left align-top">
                                    {{ $item->product->nama_produk }}
                                </td>
                                <td class="py-4 text-center font-medium" style="vertical-align: top;">
                                    {{ $item->kuantitas }}
                                </td>
                                <td class="py-4 text-right font-medium" style="vertical-align: top;">
                                    {{ number_format($item->product->harga * $item->kuantitas, 0, ',', '.') }} IDR
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center text-gray-600">
                            <span>SUBTOTAL</span>
                            <span id="summary-subtotal" data-value="{{ $subtotal ?? 0 }}" class="font-medium text-gray-800">{{ number_format($subtotal ?? 0, 0, ',', '.') }} IDR</span>
                        </div>
                        <div class="flex justify-between items-center text-gray-600 pb-6 border-b border-dashed border-gray-200">
                            <span>SHIPPING</span>
                            <span id="summary-shipping" data-value="0" class="font-medium text-gray-800">0 IDR</span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-bold text-gray-900">TOTAL</span>
                            <span id="summary-total" data-value="{{ $subtotal ?? 0 }}" class="font-bold text-gray-900 text-base">{{ number_format($subtotal ?? 0, 0, ',', '.') }} IDR</span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Spacer -->
    <div style="height: 57px; width: 100%; display: block;"></div>
    
    <!-- JS Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const provinceSelect = document.getElementById('province_select');
            const citySelect = document.getElementById('city_select');
            
            if(provinceSelect && citySelect) {
                // 1. Fetch provinces on page load
                try {
                    const response = await fetch('/api/provinces');
                    if (!response.ok) throw new Error('Failed to fetch provinces');
                    
                    const data = await response.json();
                    
                    provinceSelect.innerHTML = '<option value="">Select a province</option>';
                    
                    if (Array.isArray(data)) {
                        data.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = province.province_name || province.name;
                            provinceSelect.appendChild(option);
                        });
                    }
                } catch (error) {
                    console.error('Error fetching provinces:', error);
                    provinceSelect.innerHTML = '<option value="">Error loading provinces</option>';
                }

                // 2. Handle province change to load cities
                provinceSelect.addEventListener('change', async function() {
                    const provinceId = this.value;
                    const provinceNameInput = document.getElementById('province_name');
                    if (provinceNameInput && this.options[this.selectedIndex]) {
                        provinceNameInput.value = this.options[this.selectedIndex].text;
                    }
                    
                    citySelect.innerHTML = '<option value="">Select a city</option>';
                    citySelect.dispatchEvent(new Event('change'));
                    
                    if (!provinceId) {
                        citySelect.disabled = true;
                        citySelect.classList.add('bg-gray-50', 'cursor-not-allowed', 'disabled:opacity-60');
                        return;
                    }
                    
                    citySelect.disabled = true;
                    citySelect.innerHTML = '<option value="">Loading...</option>';
                    
                    try {
                        const response = await fetch(`/api/cities?province_id=${provinceId}`);
                        
                        if (!response.ok) {
                            throw new Error('Failed to fetch cities');
                        }
                        
                        const data = await response.json();
                        
                        citySelect.innerHTML = '<option value="">Select a city</option>';
                        
                        if (Array.isArray(data)) {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                // Use city_name if available, otherwise name (depends on model)
                                option.textContent = city.city_name || city.name;
                                citySelect.appendChild(option);
                            });
                        }
                        
                        citySelect.disabled = false;
                        citySelect.classList.remove('bg-gray-50', 'cursor-not-allowed', 'disabled:opacity-60');
                        
                    } catch (error) {
                        console.error('Error fetching cities:', error);
                        citySelect.innerHTML = '<option value="">Error loading cities</option>';
                    }
                });

                // 3. Handle city change to calculate shipping cost
                citySelect.addEventListener('change', async function() {
                    const cityId = this.value;
                    const cityNameInput = document.getElementById('city_name');
                    if (cityNameInput && this.options[this.selectedIndex]) {
                        cityNameInput.value = this.options[this.selectedIndex].text;
                    }
                    
                    const summaryShipping = document.getElementById('summary-shipping');
                    const summaryTotal = document.getElementById('summary-total');
                    const summarySubtotal = document.getElementById('summary-subtotal');
                    
                    const rawSubtotal = parseInt(summarySubtotal.getAttribute('data-value'), 10) || 0;
                    
                    if (!cityId) {
                        summaryShipping.innerHTML = '0 IDR';
                        summaryShipping.setAttribute('data-value', '0');
                        summaryTotal.innerHTML = new Intl.NumberFormat('id-ID').format(rawSubtotal).replace(/,/g, '.') + ' IDR';
                        summaryTotal.setAttribute('data-value', rawSubtotal);
                        return;
                    }

                    summaryShipping.innerHTML = 'Calculating...';

                    try {
                        const response = await fetch('{{ route('shipping.calculate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ destination: cityId })
                        });
                        
                        if (!response.ok) {
                            throw new Error(`HTTP Error: ${response.status}`);
                        }

                        const data = await response.json();
                        const cost = data.data[0].cost;
                        
                        summaryShipping.setAttribute('data-value', cost);
                        summaryShipping.innerHTML = new Intl.NumberFormat('id-ID').format(cost).replace(/,/g, '.') + ' IDR';

                        const newTotal = rawSubtotal + cost;
                        summaryTotal.setAttribute('data-value', newTotal);
                        summaryTotal.innerHTML = new Intl.NumberFormat('id-ID').format(newTotal).replace(/,/g, '.') + ' IDR';

                    } catch (error) {
                        console.error('SHIPPING API ERROR:', error);
                        summaryShipping.innerHTML = 'Calculation Failed';
                    }
                });
            }
        });
    </script>
</x-app-layout>
