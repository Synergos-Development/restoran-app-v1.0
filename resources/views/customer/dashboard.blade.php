@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-semibold">My Bookings</h1>

  @if($bookings->isEmpty())
    <p class="mt-4 text-gray-600">Belum ada booking. <a href="{{ route('booking.create') }}" class="text-orange-500">Buat booking</a></p>
  @else
    <div class="mt-4 grid gap-4">
      @foreach($bookings as $b)
        <div class="p-4 bg-white rounded shadow flex items-center justify-between">
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
            @elseif($b->status == 'completed')
              <span class="px-3 py-1 rounded bg-gray-100 text-gray-800 text-sm">Completed</span>
            @else
              <span class="px-3 py-1 rounded bg-red-100 text-red-800 text-sm">Cancelled</span>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection