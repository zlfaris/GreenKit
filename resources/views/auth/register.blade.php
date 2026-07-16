<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-lg flex flex-col md:flex-row">
            
            <!-- Left Column (Form Area) -->
            <div class="w-full md:w-1/2 p-8 md:p-14">
                <h2 class="text-3xl font-bold text-black mb-2">Signup</h2>
                <p class="text-gray-500">
                    Already Have An Account, 
                    <a href="{{ route('login') }}" class="text-black underline">Login</a>.
                </p>

                <form method="POST" action="{{ route('register') }}" class="mt-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs text-black mb-1">Full Name</label>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Masukkan Nama Lengkap" 
                                class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344]">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs text-black mb-1">E-mail</label>
                            <input id="email" type="email" name="email" :value="old('email')" required placeholder="Masukkan E-mail" 
                                class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344]">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label for="jenis_kelamin" class="block text-xs text-black mb-1">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required 
                                class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344] bg-white">
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Pria">Laki-Laki</option>
                                <option value="Wanita">Perempuan</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-xs text-black mb-1">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required 
                                class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344]">
                            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs text-black mb-1">Password</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Masukkan Password" 
                                    class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344] pr-10">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs text-black mb-1">Confirm Password</label>
                            <div class="relative">
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password" 
                                    class="block w-full rounded-full border-gray-300 focus:ring-[#445344] focus:border-[#445344] pr-10">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Bottom Form Area -->
                    <div class="mt-6 flex items-center">
                        <input id="terms" name="terms" type="checkbox" required class="rounded border-gray-300 text-[#445344] focus:ring-[#445344]">
                        <label for="terms" class="ml-2 text-sm text-gray-500">I have read and agreed to the Terms of Service and Privacy Policy</label>
                    </div>

                    <button type="submit" class="mt-6 w-full py-3 rounded-full bg-[#445344] hover:bg-[#2c362c] text-white font-semibold transition">
                        Create Account
                    </button>

                </form>
            </div>

            <!-- Right Column (Banner Area) -->
            <div class="hidden md:flex md:w-1/2 bg-[#445344] items-center justify-center">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white tracking-wide">GreenKit</h1>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleVisibility = (inputId) => {
                const input = document.getElementById(inputId);
                const iconWrapper = input ? input.nextElementSibling : null;
                
                if (iconWrapper) {
                    // Enable clicks on the icon wrapper
                    iconWrapper.classList.remove('pointer-events-none');
                    iconWrapper.classList.add('cursor-pointer');
                    
                    iconWrapper.addEventListener('click', () => {
                        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                        input.setAttribute('type', type);
                    });
                }
            };

            toggleVisibility('password');
            toggleVisibility('password_confirmation');
        });
    </script>
</x-app-layout>
