<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GreenKit Admin</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="w-full overflow-x-hidden bg-gray-50 text-gray-800 font-sans antialiased" style="display: flex; height: 100vh; margin: 0;">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#445344] text-white hidden md:flex flex-col" style="flex-shrink: 0; height: 100vh; overflow-y: auto;">
        <div class="h-16 flex items-center px-6 font-bold text-xl border-b border-[#556655] font-poppins" style="flex-shrink: 0;">
            GreenKit Admin
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 font-semibold text-white' : 'text-emerald-100 hover:bg-white/5 hover:text-white' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-white/10 font-semibold text-white' : 'text-emerald-100 hover:bg-white/5 hover:text-white' }}">
                Orders
            </a>
            <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-white/10 font-semibold text-white' : 'text-emerald-100 hover:bg-white/5 hover:text-white' }}">
                Products
            </a>
        </nav>
        <div class="p-4 border-t border-[#556655]" style="flex-shrink: 0;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center px-4 py-2.5 text-emerald-100 hover:text-white text-base hover:bg-white/5 rounded-lg transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div style="flex: 1; height: 100vh; overflow-y: auto !important; display: flex; flex-direction: column;">
        <!-- Topbar -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6" style="flex-shrink: 0;">
            <div class="flex items-center">
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h2 class="text-xl font-bold text-gray-800 ml-4 md:ml-0 font-poppins">
                    {{ $header ?? 'Admin Panel' }}
                </h2>
            </div>
            <div class="flex items-center">
                <span class="text-sm font-medium text-gray-600">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <!-- Page Content -->
        <main class="bg-gray-50" style="flex: 1; padding: 24px;">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert" style="flex-shrink: 0;">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            <div class="pb-12">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
