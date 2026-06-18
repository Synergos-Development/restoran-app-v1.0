@props(['type' => 'primary', 'href' => null, 'class' => '', 'form' => null])
@php
$base = 'inline-flex items-center justify-center rounded-md font-semibold transition focus:outline-none focus:ring-2 focus:ring-offset-2';
if ($type === 'primary') {
    $variant = 'bg-orange-500 text-white hover:bg-orange-600 focus:ring-orange-300 px-4 py-2';
} elseif ($type === 'secondary') {
    $variant = 'bg-gray-100 text-gray-800 hover:bg-gray-200 px-3 py-2';
} elseif ($type === 'outline') {
    $variant = 'border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 px-3 py-2';
} else {
    $variant = 'bg-gray-100 text-gray-800 px-3 py-2';
}
$classes = trim($base.' '.$variant.' '.$class);
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
<button {{ $attributes->merge(['class' => $classes, 'form' => $form]) }}>{{ $slot }}</button>
@endif
