@extends('layouts.app')

@section('title','Savoria - Home')

@section('content')
<div class="container mx-auto px-4 py-12 hero">
  <div class="grid md:grid-cols-2 gap-8 items-center">
    <div class="space-y-6">
      <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">Rasakan Pengalaman Kuliner Terbaik</h1>
      <p class="mt-2 text-gray-600 max-w-xl">Premium restaurant experience. Nikmati menu curated dan suasana nyaman di Savoria.</p>
      <div class="mt-6 flex flex-col sm:flex-row sm:space-x-3 gap-3">
        <x-button href="{{ route('menu.index') }}" type="primary" class="shadow">Lihat Menu</x-button>
        <x-button href="{{ route('booking.create') }}" type="outline">Booking Meja</x-button>
      </div>
    </div>
    <div>
      <div class="rounded-lg overflow-hidden shadow-lg">
        <x-image src="images/hero.png" alt="hero" class="w-full h-64 sm:h-80 md:h-96 object-cover" loading="lazy" />
      </div>
    </div>
  </div>

  <section class="mt-12">
  <h2 class="text-2xl font-semibold type-h2">Featured Menus</h2>
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
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
