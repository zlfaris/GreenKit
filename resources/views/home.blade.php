<x-app-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[600px] flex items-center">
        <img src="{{asset('images/hero-bg.png') }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 w-full max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl">
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 leading-none -ml-1 md:-ml-2">Reusable<br>Lifestyle Kit</h1>
                <p class="text-base text-white font-normal -ml-[2px] md:-ml-[4px]">Aksi kecilmu hari ini, bisa jadi dampak besar di kemudian hari.</p>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="bg-[#445344] py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="w-full">
                <h2 class="text-3xl font-bold text-white mb-6">About Us</h2>
                
                <div class="text-white space-y-6 text-base leading-relaxed text-justify">
                    <p>
                        GreenKit hadir sebagai solusi praktis bagi siapa pun yang ingin memulai gaya hidup ramah lingkungan. Kami percaya bahwa perubahan besar tidak selalu dimulai dari langkah besar tetapi dari pilihan kecil yang kita buat setiap hari.
                    </p>
                    <p>
                        Karena itu, GreenKit menghadirkan rangkaian produk reusable yang fungsional dan modern, mulai dari alat makan, sedotan, pouch organizer, hingga totebag. Semua dirancang untuk membantu mengurangi ketergantungan terhadap barang sekali pakai dan menciptakan kebiasaan baru yang lebih baik bagi bumi.
                    </p>
                    <p class="text-left">
                        Mulai perjalanan gaya hidup ramah lingkunganmu bersama GreenKit.
                    </p>
                </div>

                <div class="mt-8">
                    <a href="/about" class="bg-white text-[#445344] px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-block shadow-sm">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Selling Section -->
    <section class="bg-white py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-5">Top Selling</h2>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 md:gap-12">
                @foreach($topProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-14 flex justify-center">
                <a href="/shop" class="bg-[#445344] text-white px-8 py-3 rounded-lg font-medium hover:bg-[#364236] transition-colors shadow-sm inline-flex items-center justify-center">
                    Shop More
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="bg-[#445344] py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Left Content -->
                <div class="md:w-[45%] mb-12 md:mb-0">
                    <h2 class="text-4xl md:text-5xl font-bold leading-[48px] md:leading-[64px] text-white">Kenapa Memilih<br>GreenKit?</h2>
                </div>
                
                <!-- Right Content -->
                <div class="md:w-[50%] w-full space-y-4 md:space-y-5">
                    <!-- Card 1 -->
                    <div class="bg-white px-6 py-7 md:px-8 rounded-xl shadow-sm flex items-center">
                        <div class="w-16 md:w-20 flex-shrink-0">
                            <span class="text-4xl md:text-[40px] font-bold text-[#445344]">01</span>
                        </div>
                        <div class="w-[35%] md:w-[35%] pr-4 flex-shrink-0">
                            <h4 class="font-bold text-gray-900 text-[13px] md:text-[14px] leading-tight">Reusable &<br>Tahan Lama</h4>
                        </div>
                        <div class="flex-1">
                            <p class="text-[11px] md:text-[12px] text-gray-500 font-medium leading-relaxed">Dipakai Berulang Kali Sehingga<br>Lebih Hemat Dan Minim Sampah.</p>
                        </div>
                    </div>
                    
                    <!-- Card 2 -->
                    <div class="bg-white px-6 py-7 md:px-8 rounded-xl shadow-sm flex items-center">
                        <div class="w-16 md:w-20 flex-shrink-0">
                            <span class="text-4xl md:text-[40px] font-bold text-[#445344]">02</span>
                        </div>
                        <div class="w-[35%] md:w-[35%] pr-4 flex-shrink-0">
                            <h4 class="font-bold text-gray-900 text-[13px] md:text-[14px] leading-tight">Aman & Ramah<br>Lingkungan</h4>
                        </div>
                        <div class="flex-1">
                            <p class="text-[11px] md:text-[12px] text-gray-500 font-medium leading-relaxed">Menggunakan Material Yang Aman<br>Dan Mendukung Pengurangan<br>Limbah.</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white px-6 py-7 md:px-8 rounded-xl shadow-sm flex items-center">
                        <div class="w-16 md:w-20 flex-shrink-0">
                            <span class="text-4xl md:text-[40px] font-bold text-[#445344]">03</span>
                        </div>
                        <div class="w-[35%] md:w-[35%] pr-4 flex-shrink-0">
                            <h4 class="font-bold text-gray-900 text-[13px] md:text-[14px] leading-tight">Praktis Dibawa<br>Ke Mana Saja</h4>
                        </div>
                        <div class="flex-1">
                            <p class="text-[11px] md:text-[12px] text-gray-500 font-medium leading-relaxed">Ringkas, Serbaguna, Dan Cocok<br>Untuk Aktivitas Harian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Review Section -->
    <section class="bg-white py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Customer Review</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10 lg:gap-12">
                <x-review-card 
                    text="WOI TOLONG INI APA?! Definisi racun duniawi yang membawa berkah surgawi! Jujurly, sejak pake satu set dari Greenkit ini, level ke-estetik-an hidup gue naik drastis 1000%."
                    avatar="{{ asset('images/avatar-nabila.jpg') }}"
                    name="Nabila"
                    rating="5"
                />
                <x-review-card 
                    text="Awalnya coba-coba, sekarang gak bisa lepas, GreenKit bikin aku ngerasa jadi pahlawan lingkungan tiap hari tanpa sadar."
                    avatar="{{ asset('images/avatar-denada.jpg') }}"
                    name="Denada"
                    rating="5"
                />
                <x-review-card 
                    text="Jujurly, aku syok berat pas unboxing. Ini keren banget woi, vibes penyelamat buminya dapet parah, fungsinya kepake banget. Hidup gue berasa lebih tertata, plastik auto ilang. Kalian harus punya! #GoGreenTapiTetepKece"
                    avatar="{{ asset('images/avatar-aqilah.jpg') }}"
                    name="Aqilah"
                    rating="5"
                />
            </div>
        </div>
    </section>
</x-app-layout>
