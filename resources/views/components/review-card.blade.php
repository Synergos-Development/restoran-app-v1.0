<article role="article" aria-label="Review by {{ $review->name }}" class="bg-white p-4 rounded shadow focus-within:ring-2 focus-within:ring-orange-400">
  <div class="flex items-start">
    <div class="mr-3">
      <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center font-semibold">{{ strtoupper(substr($review->name,0,1)) }}</div>
    </div>
    <div>
      <div class="flex items-center justify-between">
        <div class="font-semibold">{{ $review->name }}</div>
        <div class="text-sm text-orange-500" aria-hidden="true">{{ str_repeat('★', max(0, min(5, $review->rating))) }}</div>
      </div>
      <p class="text-gray-600 mt-2">{{ $review->message }}</p>
    </div>
  </div>
</article>
