@props(['active'])

@php
	$classes = $active ?? false ? 'flex items-center w-full pl-3 pr-4 py-2 border-l-4 border-yellow-400 dark:border-yellow-600 text-left text-base font-medium text-yellow-700 dark:text-yellow-300 bg-yellow-50 dark:bg-yellow-900/50 focus:outline-none focus:text-yellow-800 dark:focus:text-yellow-200 focus:bg-yellow-100 dark:focus:bg-yellow-900 focus:border-yellow-700 dark:focus:border-yellow-300 transition duration-150 ease-in-out' : 'flex items-center w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
	{{ $slot }}
</a>
