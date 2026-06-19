@extends('layouts.app')
@section('title','Booking')
@section('content')
<div class="container px-4 py-8">
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
      <x-card>
        <h1 class="type-h2">Booking Meja</h1>

        @if(session('success'))
          <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="mt-4 text-red-600">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}" class="mt-6 grid grid-cols-1 gap-4">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm text-gray-700">Tanggal & Waktu</label>
              <input type="datetime-local" name="booking_date" class="border rounded w-full px-3 py-2 focus:ring-2 focus:ring-orange-200" required>
            </div>
            <div>
              <label class="block text-sm text-gray-700">Pilih Meja</label>
              <select name="table_id" class="border rounded w-full px-3 py-2" required>
                @foreach($tables as $table)
                  <option value="{{ $table->id }}"> {{ $table->table_number ?? 'Meja '.$table->id }} </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm text-gray-700">Nama</label>
              <input type="text" value="{{ auth()->user()->name }}" readonly class="border rounded w-full px-3 py-2 bg-gray-100">
            </div>

            <div>
              <label class="block text-sm text-gray-700">Telepon</label>
              <input type="text" name="customer_phone" class="border rounded w-full px-3 py-2" required>
            </div>
          </div>

          <div>
            <label class="block text-sm text-gray-700">Jumlah Tamu</label>
            <input type="number" name="guest_count" value="1" min="1" class="border rounded w-full px-3 py-2">
          </div>

          <div>
            <x-button type="primary" class="w-full">Buat Booking</x-button>
          </div>

          <p class="text-sm text-gray-500 mt-2">Tip: Untuk grup besar, silakan hubungi kami langsung di nomor pada halaman kontak.</p>
        </form>
      </x-card>
    </div>

    <aside>
      <x-card class="p-4">
        <h3 class="type-h3">Reservation Tips</h3>
        <p class="type-body text-gray-600 mt-2">Arrive 10 minutes early. Please inform us of allergies in the booking notes.</p>
      </x-card>
    </aside>
  </div>
</div>
@endsection