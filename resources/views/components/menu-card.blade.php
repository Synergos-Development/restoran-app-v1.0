<x-card class="overflow-hidden hover:shadow-lg transition transform hover:-translate-y-1">
  <div class="relative">
    <div class="ratio-4-3">
      <x-image :src="$menu->image" alt="{{ $menu->name }}" class="w-full h-full object-cover" loading="lazy" />
      <div class="absolute inset-0 img-gradient"></div>
      <div class="absolute left-4 bottom-4 text-white">
        <div class="text-sm font-semibold bg-black/40 px-2 py-1 rounded">{{ $menu->category->name ?? '' }}</div>
        <h3 class="mt-2 text-lg font-bold">{{ $menu->name }}</h3>
        <div class="text-sm mt-1">Rp {{ number_format($menu->price,0,',','.') }}</div>
      </div>
    </div>
  </div>
  <div class="p-4">
    <p class="text-sm text-gray-600">{{ Str::limit($menu->description, 120) }}</p>
    <div class="mt-4 flex gap-2">
      <x-button href="{{ route('menu.show', $menu) }}" class="flex-1 text-center" type="primary">Lihat Detail</x-button>
      <x-button type="outline">+ Keranjang</x-button>
    </div>
  </div>
</x-card>