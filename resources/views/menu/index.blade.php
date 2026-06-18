@extends('layouts.app')
@section('title','Menu')
@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row items-center justify-between gap-4">
    <h1 class="text-3xl font-bold">Discover Our Menu</h1>
    <form method="GET" action="{{ route('menu.index') }}" class="flex items-center space-x-2 w-full md:w-auto mt-4 md:mt-0" role="search" aria-label="Search menus">
      <label for="search-q" class="sr-only">Cari menu</label>
      <input id="search-q" type="text" name="q" value="{{ request('q') }}" placeholder="Cari menu..." class="border rounded px-3 py-2 w-full md:w-64 focus:ring-2 focus:ring-orange-200" />
      <label for="category" class="sr-only">Kategori</label>
      <select id="category" name="category" class="border rounded px-3 py-2">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected @endif>{{ $cat->name }}</option>
        @endforeach
      </select>
      <x-button type="primary" class="ml-2">Filter</x-button>
    </form>
  </div>

  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($menus as $menu)
      @include('components.menu-card', ['menu' => $menu])
    @endforeach
  </div>

  <div class="mt-8 flex justify-center">{{ $menus->links() }}</div>
</div>
@endsection