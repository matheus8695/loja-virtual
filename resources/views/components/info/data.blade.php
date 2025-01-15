@props([
    'title'
])

<div>
    <div class="text-gray-600 text-xs uppercase">{{ $title }}</div>
    <div>{{ $slot }}</div>
</div>