@extends('layouts.app')
@section('title','Gallery')
@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold">Gallery</h1>
  <p class="text-gray-600 mt-2">A glimpse into our kitchen and dining experience.</p>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-6">
    @foreach($images as $img)
      <div class="rounded overflow-hidden card">
        <x-image :src="$img" alt="gallery" class="w-full h-48 object-cover" loading="lazy" />
      </div>
    @endforeach
  </div>
</div>
@endsection