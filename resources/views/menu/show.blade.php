@extends('layouts.app')
@section('title', $menu->name)
@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="grid md:grid-cols-3 gap-6 items-start">
    <div class="md:col-span-2">
      <div class="card overflow-hidden">
        <x-image :src="$menu->image" alt="{{ $menu->name }}" class="w-full h-96 object-cover" loading="lazy" />
      </div>
    </div>
    <div>
      <div class="card p-6">
        <h1 class="text-2xl font-bold">{{ $menu->name }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $menu->category->name ?? 'Uncategorized' }}</p>
        <div class="text-orange-500 font-extrabold text-2xl mt-4">Rp {{ number_format($menu->price,0,',','.') }}</div>
        <p class="mt-4 text-gray-700">{{ $menu->description }}</p>

        <div class="mt-6 flex space-x-3">
          <x-button type="primary">Tambah ke Keranjang</x-button>
          <x-button href="{{ route('menu.index') }}" type="outline">Kembali ke Menu</x-button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
