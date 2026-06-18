@props(['title' => '', 'description' => '', 'icon' => null])
<div class="text-center py-10">
  <div class="mx-auto w-24 h-24 flex items-center justify-center bg-gray-100 rounded-full">
    @if($icon)
      {!! $icon !!}
    @else
      <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M9 7v10m6-10v10" />
      </svg>
    @endif
  </div>
  <h3 class="mt-6 type-h3 text-gray-900">{{ $title }}</h3>
  <p class="mt-2 type-body text-gray-600">{{ $description }}</p>
  <div class="mt-4">
    {{ $slot }}
  </div>
</div>
