@extends('layouts.app')
@section('title','Booking')
@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-2xl font-semibold">Booking Meja</h1>

  @if(session('success'))
    <div class="mt-4 text-green-600">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="mt-4 text-red-600">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('booking.store') }}" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
    @csrf
    <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm">Tanggal & Waktu</label>
        <input type="datetime-local" name="booking_date" class="border rounded w-full px-3 py-2" required>
      </div>
      <div>
        <label class="block text-sm">Pilih Meja</label>
        <select name="table_id" class="border rounded w-full px-3 py-2" required>
          @foreach($tables as $table)
            <option value="{{ $table->id }}">{{ $table->name ?? 'Meja '.$table->id }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div>
      <label class="block text-sm">Nama</label>
      <input type="text" name="customer_name" class="border rounded w-full px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm">Telepon</label>
      <input type="text" name="customer_phone" class="border rounded w-full px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm">Jumlah Tamu</label>
      <input type="number" name="guest_count" value="1" min="1" class="border rounded w-full px-3 py-2">
    </div>

    <div class="md:col-span-2">
        <button class="w-full bg-orange-500 text-white px-4 py-2 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Buat Booking</button>
    </div>
  </form>
</div>
@endsection