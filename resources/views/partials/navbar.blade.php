<nav x-data="{open:false}" role="navigation" aria-label="Main navigation" class="bg-white shadow sticky top-0 z-50">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center">
        <a href="{{ route('home') }}" class="text-2xl font-semibold text-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Savoria</a>
      </div>

      <div class="hidden md:flex space-x-6 items-center" role="menubar">
        <a role="menuitem" href="{{ route('home') }}" class="hover:text-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Home</a>
        <a role="menuitem" href="{{ route('menu.index') }}" class="hover:text-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Menu</a>
        <a role="menuitem" href="{{ route('gallery.index') }}" class="hover:text-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Gallery</a>
        <a role="menuitem" href="{{ route('contact.index') }}" class="hover:text-orange-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Contact</a>
      </div>

      <div class="flex items-center space-x-4">
        @guest
          <a href="{{ route('login') }}" class="text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Login</a>
          <a href="{{ route('register') }}" class="text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Register</a>
        @else
          <a href="{{ route('customer.dashboard') }}" class="text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Dashboard</a>
          <form method="POST" action="{{ route('logout') }}">@csrf<button class="text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Logout</button></form>
        @endguest

        <a href="{{ route('booking.create') }}" class="ml-3 bg-orange-500 text-white px-3 py-2 rounded-md text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Reservation</a>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden">
        <button @click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" class="p-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400" aria-label="Toggle menu">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
        <div x-show="open" x-cloak id="mobile-menu" role="menu" class="absolute inset-x-4 top-16 bg-white rounded shadow-md py-2 w-auto text-right md:hidden" x-transition>
          <a role="menuitem" href="{{ route('home') }}" class="block px-4 py-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Home</a>
          <a role="menuitem" href="{{ route('menu.index') }}" class="block px-4 py-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Menu</a>
          <a role="menuitem" href="{{ route('gallery.index') }}" class="block px-4 py-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Gallery</a>
          <a role="menuitem" href="{{ route('contact.index') }}" class="block px-4 py-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Contact</a>
        </div>
      </div>
    </div>
  </div>
</nav>
