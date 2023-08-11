@props(['active'])

@php
	$classes = $active ?? false ? 'flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg text-richblack bg-accent hover:bg-accent/80' : 'flex items-center px-3 py-2 transition-colors duration-300 transform rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
