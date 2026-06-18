@extends('layouts.app')
@section('title','Gallery')
@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-semibold">Gallery</h1>
  <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mt-4">
    @foreach($images as $img)
      <div class="rounded overflow-hidden shadow-sm">
        <img src="{{ $img }}" alt="gallery" class="w-full h-40 object-cover" loading="lazy">
      </div>
    @endforeach
  </div>
</div>
@endsection