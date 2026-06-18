@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container px-4 py-8">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <aside class="lg:col-span-1">
      <x-card class="p-6">
        <h2 class="type-h3">Profile</h2>
        <p class="mt-2 font-bold">{{ auth()->user()->name }}</p>
        <p class="type-body text-gray-600">{{ auth()->user()->email }}</p>
        <div class="mt-4">
          <x-button href="{{ route('customer.dashboard') }}" type="outline">Edit Profile</x-button>
        </div>
      </x-card>

      <x-card class="p-6 mt-4">
        <h3 class="type-h3">Summary</h3>
        <p class="type-body text-gray-600 mt-2">Total bookings: <strong>{{ $bookings->count() }}</strong></p>
      </x-card>
    </aside>

    <div class="lg:col-span-3">
      @php
        $upcoming = $bookings->filter(function($b){ return $b->booking_date->isFuture(); });
        $past = $bookings->filter(function($b){ return $b->booking_date->isPast(); });
      @endphp

      <x-card class="p-6 mb-4">
        <h3 class="type-h2">Upcoming Bookings</h3>
        @if($upcoming->isEmpty())
          <x-empty-state title="No upcoming bookings" description="You have no upcoming reservations.">
            <x-button href="{{ route('booking.create') }}" type="primary">Book now</x-button>
          </x-empty-state>
        @else
          <div class="mt-4 space-y-3">
            @foreach($upcoming as $b)
              <div class="p-3 bg-white rounded shadow flex items-center justify-between">
                <div>
                  <div class="text-sm text-gray-600">#{{ $b->id }} • {{ $b->booking_date->format('d M Y H:i') }}</div>
                  <div class="font-semibold">{{ $b->customer_name }}</div>
                  <div class="text-sm text-gray-600">Tamu: {{ $b->guest_count }} • Meja: {{ $b->table->name ?? 'N/A' }}</div>
                </div>
                <div>
                  @if($b->status == 'pending')
                    <span class="px-3 py-1 rounded bg-yellow-100 text-yellow-800 text-sm">Pending</span>
                  @elseif($b->status == 'confirmed')
                    <span class="px-3 py-1 rounded bg-green-100 text-green-800 text-sm">Confirmed</span>
                  @else
                    <span class="px-3 py-1 rounded bg-gray-100 text-gray-800 text-sm">{{ ucfirst($b->status) }}</span>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </x-card>

      <x-card class="p-6">
        <h3 class="type-h2">Booking History</h3>
        @if($past->isEmpty())
          <x-empty-state title="No past bookings" description="You have no previous bookings."></x-empty-state>
        @else
          <div class="mt-4 space-y-3">
            @foreach($past as $b)
              <div class="p-3 bg-white rounded shadow flex items-center justify-between">
                <div>
                  <div class="text-sm text-gray-600">#{{ $b->id }} • {{ $b->booking_date->format('d M Y H:i') }}</div>
                  <div class="font-semibold">{{ $b->customer_name }}</div>
                </div>
                <div>
                  <span class="px-3 py-1 rounded bg_gray_100 text-gray-800 text-sm">{{ ucfirst($b->status) }}</span>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      </x-card>
    </div>
  </div>
</div>
@endsection