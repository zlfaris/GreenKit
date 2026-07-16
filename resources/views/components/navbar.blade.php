<nav class="bg-white w-full z-50 top-0 start-0 border-b border-gray-200" x-data="{ mobileMenuOpen: false }">
  <div class="max-w-[1200px] flex flex-wrap items-center justify-between mx-auto px-4 sm:px-6 lg:px-8 py-2 md:py-3">
  <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse -ml-1 md:-ml-2">
      <span class="self-center text-3xl font-extrabold whitespace-nowrap text-[#445344]">GreenKit</span>
  </a>
  <div class="flex md:order-2 space-x-3 md:space-x-6 rtl:space-x-reverse items-center">
      @guest
          <a href="/login" class="text-[#445344] font-bold text-base hover:text-[#364236] hidden md:block">Login</a>
          <a href="{{ route('register') }}" class="text-white bg-[#445344] hover:bg-[#364236] focus:ring-4 focus:outline-none focus:ring-[#445344]/50 font-bold rounded-lg text-base px-6 py-2.5 text-center">Sign Up</a>
      @endguest
      @auth
          <a href="{{ route('profile.edit') }}" class="text-[#445344] font-bold text-base hover:text-[#364236] hidden md:block">{{ Auth::user()->name }}</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-white bg-[#445344] hover:bg-[#364236] focus:ring-4 focus:outline-none focus:ring-[#445344]/50 font-bold rounded-lg text-base px-6 py-2.5 text-center">Logout</button>
          </form>
      @endauth
      <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
  <div :class="{'hidden': !mobileMenuOpen, 'block': mobileMenuOpen}" class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
    <ul class="flex flex-col p-4 md:p-0 mt-4 font-bold rounded-lg bg-white md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white text-base">
      <li>
        <a href="/" class="block py-2 px-3 text-[#445344] rounded md:bg-transparent md:p-0 hover:text-[#364236]" aria-current="page">Home</a>
      </li>
      <li>
        <a href="/shop" class="block py-2 px-3 text-[#445344] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#364236] md:p-0">Shop</a>
      </li>
      <li>
        <a href="{{ route('cart.index') }}" class="block py-2 px-3 text-[#445344] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#364236] md:p-0">Cart</a>
      </li>
      <li>
        <a href="/about" class="block py-2 px-3 text-[#445344] rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#364236] md:p-0">About Us</a>
      </li>
      @guest
          <li class="md:hidden">
            <a href="/login" class="block py-2 px-3 text-[#445344] rounded hover:bg-gray-100">Login</a>
          </li>
      @endguest
      @auth
          <li class="md:hidden">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left block py-2 px-3 text-[#445344] rounded hover:bg-gray-100">Logout</button>
            </form>
          </li>
      @endauth
    </ul>
  </div>
  </div>
</nav>
