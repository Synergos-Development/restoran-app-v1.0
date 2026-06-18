@extends('layouts.app')
@section('title', $menu->name)
@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="grid md:grid-cols-3 gap-6">
    <div class="md:col-span-2">
      <img src="{{ $menu->image ?? '/images/placeholder.png' }}" alt="{{ $menu->name }}" class="w-full h-96 object-cover rounded shadow" loading="lazy">
    </div>
    <div class="bg-white p-6 rounded shadow">
      <h1 class="text-2xl font-semibold">{{ $menu->name }}</h1>
      <p class="text-gray-500 mt-2">{{ $menu->category->name ?? 'Uncategorized' }}</p>
      <div class="text-orange-500 font-bold text-xl mt-4">Rp {{ number_format($menu->price,0,',','.') }}</div>
      <p class="mt-4 text-gray-700">{{ $menu->description }}</p>

      <div class="mt-6">
        <button class="bg-orange-500 text-white px-4 py-2 rounded">Tambah ke Keranjang</button>
      </div>
    </div>
  </div>
</div>
@endsection
