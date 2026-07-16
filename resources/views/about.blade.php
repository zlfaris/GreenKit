<x-app-layout>
    <!-- Header -->
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-poppins font-bold text-white mb-4">About Us</h1>
        <p class="text-white/80 text-sm md:text-base tracking-wide">Home || About Us</p>
    </div>

    <!-- The Story Section -->
    <section class="bg-white py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">
                <div class="md:col-span-4 flex justify-center md:justify-start">
                    <h2 class="text-6xl md:text-7xl font-poppins font-extrabold text-[#445344] tracking-tight drop-shadow-sm">GreenKit</h2>
                </div>
                <div class="md:col-span-8 space-y-6 text-base text-gray-700 leading-relaxed">
                    <p class="text-justify">GreenKit berawal dari kepedulian sederhana terhadap meningkatnya penggunaan produk sekali pakai yang berdampak besar pada lingkungan. Kami percaya bahwa setiap orang sebenarnya mampu memberikan kontribusi positif bagi bumi, hanya saja belum semua memiliki pilihan yang praktis dan mudah diterapkan dalam kehidupan sehari-hari.</p>
                    <p class="text-justify">Dari pemikiran itu, kami menghadirkan GreenKit sebuah rangkaian produk reusable yang dirancang untuk menemani aktivitas harian, sekaligus membantu mengurangi sampah plastik yang terus menumpuk. GreenKit hadir sebagai pengingat bahwa perubahan tidak selalu harus dimulai dari langkah besar, tetapi dari pilihan kecil yang dilakukan secara konsisten.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Kami Section -->
    <section class="bg-white py-12 sm:py-16">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 text-center -mt-12 md:-mt-16">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-5">Visi Kami Untuk Bumi Lebih Baik</h2>
            </div>
            
            <!-- Desktop Layout (Mind Map) -->
            <div class="hidden lg:block relative w-full max-w-[1000px] mx-auto h-[600px]">
                <!-- Center Earth -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30 flex flex-col items-center">
                    <div class="relative w-56 h-56 flex items-center justify-center">
                        <img src="{{ asset('images/greenkit_earth.png') }}" alt="GreenKit Earth" class="w-full h-full object-cover rounded-full drop-shadow-2xl">
                        <h3 class="absolute text-white font-poppins font-extrabold text-4xl drop-shadow-lg tracking-wide z-40">GreenKit</h3>
                    </div>
                </div>

                <!-- Box 1 (Top Left) -->
                <div class="absolute top-[28%] left-0 w-[300px] bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 z-20 text-center hover:scale-105 transition duration-300">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mendorong Gaya Hidup<br>Ramah Lingkungan</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">Kami ingin membantu masyarakat beralih dari penggunaan plastik sekali pakai menuju kebiasaan yang lebih berkelanjutan dengan menyediakan alternatif yang aman dan mudah digunakan.</p>
                </div>
                <!-- Connector 1 (Box 1 bottom -> DOWN -> RIGHT -> UP -> Earth bottom-left) -->
                <!-- Part 1: L-shape DOWN and RIGHT -->
                <div class="absolute top-[48%] left-[300px] w-[88px] h-[3px] bg-[#445344] z-40">
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] !-top-[4.5px] !-left-[6px]"></div>
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] -top-[4.5px] -right-[0px]"></div>
                </div>
                <!-- Box 2 (Top Right) -->
                <div class="absolute top-[12%] right-0 w-[300px] bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 z-20 text-center hover:scale-105 transition duration-300">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mengurangi Jejak<br>Plastik di Indonesia</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">Melalui produk yang dapat dipakai kembali, kami berkomitmen mengurangi jumlah sampah plastik yang mencemari laut, tanah, dan ekosistem di sekitar kita.</p>
                </div>
                <!-- Connector 2 (Box 2 top -> UP -> LEFT -> DOWN -> Earth top-center) -->
                <!-- Part 1: L-shape UP and LEFT -->
                <div class="absolute top-[5%] right-[15%] w-[35%] h-[7%] border-t-[3px] border-r-[3px] border-[#445344] z-40">
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] right-[-1.5px] bottom-0 transform translate-x-1/2 translate-y-1/2"></div>
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] top-[-1.5px] right-[-1.5px] transform translate-x-1/2 -translate-y-1/2"></div>
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] top-[-1.5px] left-0 transform -translate-x-1/2 -translate-y-1/2"></div>
                </div>
                <div class="absolute top-[5%] right-[50%] w-[3px] h-[26%] bg-[#445344] z-40">
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] bottom-0 -left-[4.5px]"></div>
                </div>

                <!-- Box 3 (Bottom Right) -->
                <div class="absolute bottom-[5%] right-0 w-[300px] bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 z-20 text-center hover:scale-105 transition duration-300">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mempermudah Akses<br>Solusi Sustainable</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">GreenKit hadir untuk menjadikan produk ramah lingkungan lebih terjangkau dan mudah ditemukan, sehingga setiap orang dapat ikut berkontribusi menjaga bumi tanpa hambatan.</p>
                </div>
                <!-- Connector 3 (Earth bottom-right -> DOWN -> RIGHT -> Box 3 middle-left) -->
                <div class="absolute bottom-[18%] right-[30%] w-[12%] h-[19%] border-b-[3px] border-l-[3px] border-[#445344] z-40">
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] -top-[-0px] -left-[7px]"></div>
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] bottom-[-1.5px] left-[-1.5px] transform -translate-x-1/2 translate-y-1/2"></div>
                    <div class="absolute w-3 h-3 rounded-full bg-[#445344] bottom-[-1.5px] right-0 transform translate-x-1/2 translate-y-1/2"></div>
                </div>
            </div>
            <!-- Mobile Layout -->
            <div class="lg:hidden flex flex-col items-center space-y-6">
                <div class="relative w-48 h-48 rounded-full bg-white shadow-xl p-2 flex items-center justify-center border border-gray-100">
                    <img src="{{ asset('images/greenkit_earth.png') }}" alt="GreenKit Earth" class="w-full h-full object-cover rounded-full">
                    <h3 class="absolute text-white font-poppins font-extrabold text-2xl drop-shadow-lg tracking-wide z-30">GreenKit</h3>
                </div>
                <div class="w-full max-w-sm bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 text-center">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mendorong Gaya Hidup Ramah Lingkungan</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">Kami ingin membantu masyarakat beralih dari penggunaan plastik sekali pakai menuju kebiasaan yang lebih berkelanjutan dengan menyediakan alternatif yang aman dan mudah digunakan.</p>
                </div>
                <div class="w-full max-w-sm bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 text-center">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mengurangi Jejak Plastik di Indonesia</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">Melalui produk yang dapat dipakai kembali, kami berkomitmen mengurangi jumlah sampah plastik yang mencemari laut, tanah, dan ekosistem di sekitar kita.</p>
                </div>
                <div class="w-full max-w-sm bg-[#e8f0e8] p-6 rounded-xl shadow-md ring-1 ring-[#445344]/10 text-center">
                    <h4 class="font-poppins font-bold text-[#445344] mb-3 text-[15px]">Mempermudah Akses Solusi Sustainable</h4>
                    <p class="text-[13px] text-gray-700 leading-relaxed">GreenKit hadir untuk menjadikan produk ramah lingkungan lebih terjangkau dan mudah ditemukan, sehingga setiap orang dapat ikut berkontribusi menjaga bumi tanpa hambatan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Dampak Bagi Lingkungan Section -->
    <section class="bg-white pt-0 pb-12 sm:pb-16 relative z-10" style="margin-top: -35px !important;">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Left: Image Composition -->
                <div class="relative w-full max-w-lg mx-auto lg:max-w-none">
                    <div class="absolute top-0 left-0 w-[80%] h-[90%] bg-[#445344] rounded-3xl z-0 hidden lg:block"></div>
                    
                    <div class="relative z-10 w-[90%] ml-auto mt-6 lg:mt-10 rounded-3xl overflow-hidden shadow-2xl aspect-[4/3] transition hover:scale-[1.02] duration-500 bg-white">
                        <img src="{{ asset('images/impact_split.png') }}" alt="Dampak Lingkungan" class="w-full h-full object-cover">
                        
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-[#445344] text-white rounded-full flex items-center justify-center shadow-2xl cursor-pointer hover:bg-[#2c362c] hover:scale-110 transition-all duration-300 border-4 border-white/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Right: Text Content -->
                <div class="space-y-6 text-base text-gray-600 leading-relaxed">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight mb-6 text-center lg:text-left">Dampak Bagi Lingkungan</h2>
                    <p class="text-justify">Setiap tahun, penumpukan plastik sekali pakai terus meningkat dan mengancam kelestarian lingkungan. Banyak jenis plastik sulit terurai selama ratusan tahun, sehingga meninggalkan dampak jangka panjang bagi tanah, laut, serta makhluk hidup yang bergantung pada ekosistem tersebut.</p>
                    <p class="text-justify">GreenKit hadir sebagai langkah sederhana namun efektif untuk mengurangi masalah ini. Dengan beralih ke produk yang dapat digunakan kembali, pengguna dapat menekan konsumsi plastik sekali pakai dan membangun kebiasaan yang lebih berkelanjutan. GreenKit bukan sekadar produk, tetapi bagian dari upaya kolektif untuk menciptakan bumi yang lebih bersih dan sehat bagi generasi mendatang.</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
