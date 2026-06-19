<nav x-data="{open:false}" role="navigation" aria-label="Main navigation" class="bg-white/60 backdrop-blur sticky top-0 z-50 border-b">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center space-x-4">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Savoria</a>
        <div class="hidden md:flex items-center space-x-1 text-sm text-gray-600">
          <a href="{{ route('home') }}" class="px-3 py-2 hover:text-orange-600">Home</a>
          <a href="{{ route('menu.index') }}" class="px-3 py-2 hover:text-orange-600">Menu</a>
          <a href="{{ route('gallery.index') }}" class="px-3 py-2 hover:text-orange-600">Gallery</a>
          <a href="{{ route('contact.index') }}" class="px-3 py-2 hover:text-orange-600">Contact</a>
        </div>
      </div>

      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-orange-600">Login</a>
          <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-orange-600">Register</a>
        @else
          <a href="{{ route('customer.dashboard') }}" class="text-sm text-gray-700 hover:text-orange-600">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button class="text-sm text-gray-700 hover:text-orange-600">Logout</button></form>
        @endguest

        <a href="{{ auth()->check() ? route('booking.create') : route('login') }}"
   class="ml-3 inline-flex items-center bg-orange-500 text-white px-4 py-2 rounded-md text-sm shadow">
    Reservation
</a>

        <!-- Mobile menu button -->
        <div class="md:hidden">
          <button @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" class="p-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile dropdown -->
    <div x-show="open" x-cloak id="mobile-menu" class="md:hidden mt-2">
      <div class="bg-white shadow-md rounded-lg py-2">
        <a href="{{ route('home') }}" class="block px-4 py-2">Home</a>
        <a href="{{ route('menu.index') }}" class="block px-4 py-2">Menu</a>
        <a href="{{ route('gallery.index') }}" class="block px-4 py-2">Gallery</a>
        <a href="{{ route('contact.index') }}" class="block px-4 py-2">Contact</a>
      </div>
    </div>
  </div>
</nav>
