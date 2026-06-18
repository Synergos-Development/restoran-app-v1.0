<article role="article" aria-label="{{ $menu->name }}" class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition focus-within:ring-2 focus-within:ring-orange-400">
  <img src="{{ $menu->image ?? '/images/placeholder.png' }}" alt="{{ $menu->name }}" class="w-full h-44 md:h-40 object-cover" loading="lazy">
  <div class="p-4">
    <div class="flex items-start justify-between">
      <div>
        <h3 class="font-semibold text-lg">{{ $menu->name }}</h3>
        <p class="text-xs text-gray-500 mt-1">{{ $menu->category->name ?? '' }}</p>
      </div>
      <div class="text-orange-500 font-semibold">Rp {{ number_format($menu->price,0,',','.') }}</div>
    </div>
    <p class="text-sm text-gray-600 mt-3">{{ Str::limit($menu->description, 100) }}</p>
    <div class="mt-4">
      <a href="{{ route('menu.show', $menu) }}" class="block text-center bg-orange-500 text-white px-3 py-2 rounded-md text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Lihat Detail</a>
    </div>
  </div>
</article>