@props(['active'])

@php
	$classes = $active ?? false ? 'font-semibold' : '';
@endphp

<a {{ $attributes->merge(['class' => 'block text-gray-800 dark:text-gray-50 hover:underline ' . $classes]) }}>
	{{ $slot }}
</a>
