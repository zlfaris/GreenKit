<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenKit - Reusable Lifestyle Kit</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind config for custom colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        greenkit: '#445344',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="w-full overflow-x-hidden bg-gray-50 font-sans antialiased text-[#1b1b18]">
    <!-- PURE LARAVEL BLADE & TAILWIND FULL SCREEN OVERLAY (NO JAVASCRIPT) -->
    @if(session('error') || session('failed') || $errors->any())
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99999] flex items-center justify-center p-4">
            <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-md w-full text-center border border-gray-100 flex flex-col items-center">
                <!-- Large Warning Indicator Icons -->
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4 border border-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                
                <!-- Target Headline -->
                <h3 class="text-xl font-black text-gray-900 mb-2 tracking-tight uppercase">Oops! Sorry</h3>
                
                <!-- Required Specific English Message -->
                <p class="text-gray-600 text-base font-medium mb-6 leading-relaxed">
                    @if(session('error'))
                        {{ session('error') }}
                    @elseif(session('failed'))
                        {{ session('failed') }}
                    @else
                        {{ $errors->first() }}
                    @endif
                </p>
                
                <!-- Standard HTML Reload Link acting as a Close/Back Button -->
                <a href="{{ request()->url() }}" class="w-full py-3 bg-[#3E4E41] hover:bg-[#323f35] text-white font-bold rounded-xl transition-colors shadow-md">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif

    <x-navbar />
    
    <main class="min-h-screen bg-[#F9FAFB]">
        {{ $slot }}
    </main>

    <x-footer />
</body>
</html>
