<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Formustaqbal') }}</title>

	{{-- Fonts --}}
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

	{{-- Scripts --}}
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@livewireStyles

	<style>
		[x-cloak] {
			display: none !important;
		}
	</style>

</head>

<body class="font-sans antialiased">

	<div class="min-h-screen bg-gray-100 dark:bg-richblack">
		<div class="flex">
			@include('layouts.sidebar')

			<div class="lg:ml-80 w-full">
				@include('layouts.navigation')

				<main class="p-4 sm:p-6 lg:p-12">
					{{ $slot }}
				</main>
			</div>
		</div>
	</div>

	@livewireScripts
</body>

</html>
