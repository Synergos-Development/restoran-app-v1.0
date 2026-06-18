@extends('layouts.app')
@section('title','Contact')
@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
  <h1 class="text-3xl font-bold">Contact Us</h1>
  <p class="text-gray-600 mt-1">Questions or catering requests? Send us a message.</p>

  <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-6 rounded card">
      <h3 class="font-semibold mb-2">Restaurant</h3>
      <p class="mb-1">Address: Jalan Contoh No.1</p>
      <p class="mb-1">Phone: +62 812-3456-7890</p>
      <p class="mb-1">Email: info@savoria.example</p>
    </div>

    <form method="POST" action="{{ route('contact.send') }}" class="bg-white p-6 rounded card" aria-label="Contact form">
      @csrf
      <div class="mb-3"><label class="sr-only" for="contact-name">Nama</label><input id="contact-name" name="name" placeholder="Nama" class="border rounded w-full px-3 py-2" required></div>
      <div class="mb-3"><label class="sr-only" for="contact-email">Email</label><input id="contact-email" name="email" placeholder="Email" class="border rounded w-full px-3 py-2" required></div>
      <div class="mb-3"><label class="sr-only" for="contact-message">Pesan</label><textarea id="contact-message" name="message" placeholder="Pesan" class="border rounded w-full px-3 py-2" required></textarea></div>
      <button class="bg-orange-500 text-white px-4 py-2 rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-400">Kirim</button>
    </form>
  </div>

  <div class="mt-6">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
</div>
@endsection