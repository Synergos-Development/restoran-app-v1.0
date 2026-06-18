@extends('layouts.app')
@section('title','Register')
@section('content')
<div class="container mx-auto px-4 py-12 max-w-md">
  <h1 class="text-2xl font-semibold">Register</h1>

  @if($errors->any())
    <div class="text-red-600 mt-3">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('register.post') }}" class="mt-6 bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-3">
      <label class="block text-sm">Nama</label>
      <input type="text" name="name" value="{{ old('name') }}" class="border rounded w-full px-2 py-1" required>
    </div>
    <div class="mb-3">
      <label class="block text-sm">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="border rounded w-full px-2 py-1" required>
    </div>
    <div class="mb-3">
      <label class="block text-sm">Password</label>
      <input type="password" name="password" class="border rounded w-full px-2 py-1" required>
    </div>
    <div class="mb-3">
      <label class="block text-sm">Confirm Password</label>
      <input type="password" name="password_confirmation" class="border rounded w-full px-2 py-1" required>
    </div>
    <div class="flex items-center justify-between">
      <button class="bg-orange-500 text-white px-4 py-2 rounded">Register</button>
      <a href="{{ route('login') }}" class="text-sm text-gray-600">Sudah punya akun? Login</a>
    </div>
  </form>
</div>
@endsection
