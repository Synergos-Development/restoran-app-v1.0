@props(['src' => null, 'alt' => '', 'class' => '', 'loading' => 'lazy'])
@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$srcUrl = '';

if (! $src) {
    $srcUrl = asset('images/placeholder.png');
} elseif (Str::startsWith($src, ['http://', 'https://'])) {
    $srcUrl = $src;
} elseif (Str::startsWith($src, '/')) {
    // absolute path in public directory
    $srcUrl = asset(ltrim($src, '/'));
} else {
    // try public path first
    if (file_exists(public_path($src))) {
        $srcUrl = asset($src);
    } else {
        // fall back to storage disk URL
        try {
            $srcUrl = Storage::url($src);
        } catch (\Exception $e) {
            $srcUrl = asset('images/placeholder.png');
        }
    }
}
@endphp

<img src="{{ $srcUrl }}" alt="{{ $alt }}" class="{{ $class ?: 'object-cover' }}" loading="{{ $loading }}" decoding="async" onerror="this.onerror=null;this.src='{{ asset('images/placeholder.png') }}';">