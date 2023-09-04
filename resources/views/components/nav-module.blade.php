@props(['active'])

@php
	$classes = $active ?? false ? 'font-semibold text-slate-900 dark:text-white' : 'text-gray-800 dark:text-gray-50';
@endphp

<a {{ $attributes->merge(['class' => 'block hover:underline ' . $classes]) }}>
	{{ $slot }}
</a>
