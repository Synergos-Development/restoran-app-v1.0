@props(['class' => ''])
<div {{ $attributes->merge(['class' => 'card p-4 '.$class]) }}>
  {{ $slot }}
</div>
