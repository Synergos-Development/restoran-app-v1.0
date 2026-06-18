@extends('layouts.app')

@section('title','Savoria - Home')

@section('content')
<div class="container mx-auto px-4 py-12">
  <div class="grid md:grid-cols-2 gap-8 items-center">
    <div class="space-y-4">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">Rasakan Pengalaman Kuliner Terbaik</h1>
      <p class="mt-2 text-gray-600 max-w-xl">Premium restaurant experience. Nikmati menu curated dan suasana nyaman di Savoria.</p>
      <div class="mt-6 flex flex-col sm:flex-row sm:space-x-3 gap-3">
        <a href="{{ route('menu.index') }}" class="inline-block bg-orange-500 text-white px-5 py-3 rounded-md shadow">Lihat Menu</a>
        <a href="{{ route('booking.create') }}" class="inline-block border border-orange-500 text-orange-500 px-5 py-3 rounded-md">Booking Meja</a>
      </div>
    </div>
    <div>
      <div class="rounded-lg overflow-hidden shadow-lg">
        <img src="/images/hero.jpg" alt="hero" class="w-full h-64 sm:h-80 md:h-96 object-cover" loading="lazy">
      </div>
    </div>
  </div>

  <section class="mt-12">
    <h2 class="text-2xl font-semibold">Featured Menus</h2>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
      @foreach($menus as $menu)
        @include('components.menu-card', ['menu' => $menu])
      @endforeach
    </div>
  </section>

  <section class="mt-12">
    <h2 class="text-2xl font-semibold">Customer Reviews</h2>
    <div class="grid md:grid-cols-3 gap-6 mt-4">
      @foreach($reviews as $review)
        @include('components.review-card', ['review' => $review])
      @endforeach
    </div>
  </section>
</div>
@endsection
