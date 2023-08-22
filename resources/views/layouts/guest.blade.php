<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
	<div
		class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/public/logo/pattern.svg')] bg-cover dark:bg-gray-900">
		<div
			class="flex w-full sm:max-w-4xl justify-between mt-6 border border-yellow-100 shadow-lg overflow-hidden rounded-2xl">
			<div class="w-full p-10 bg-white dark:bg-gray-800">
				<div class="flex flex-col justify-center items-center space-y-8 mb-8">
					<a href="/">
						<x-app-logo class="w-auto h-20" />
					</a>
					<h4 class="text-4xl font-bold text-gray-700">Masuk</h4>
				</div>

				{{ $slot }}
			</div>
			<div class="w-full bg-yellow-400/20 hidden lg:block p-10 relative">
				<div class="bg-yellow-50 p-10 rounded-xl h-full">
					<h3 class="text-6xl font-bold text-yellow-600 flex items-center justify-center">Selamat Datang</h3>
				</div>
				<img src="{{ asset('logo/maskot-shadow.png') }}" alt="Maskot" class="absolute bottom-0 right-0 w-80 h-auto">
			</div>
		</div>
	</div>
</body>

</html>
