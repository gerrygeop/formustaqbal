<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Formustaqbal</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

	<!-- Styles -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
	<div class="min-h-fit bg-slate-50">

		{{-- Navbar --}}
		<div class="bg-white shadow-sm">
			<div class="max-w-[1440px] mx-auto py-1 px-4 sm:px-6">
				<div class="flex items-center justify-between h-16">
					{{-- Logo --}}
					<div class="shrink-0">
						<a href="/" class="flex items-center">
							<x-app-logo class="h-14 w-auto mr-2" />
							<h1 class="text-slate-800 text-xl font-bold tracking-wide">Formustaqbal</h1>
						</a>
					</div>

					{{-- Menu --}}
					<nav class="flex items-center space-x-10 text-slate-700 font-semibold">
						<a href="#" class="hover:text-slate-900">
							{{ __('Pricing') }}
						</a>

						<div class="flex items-center space-x-4">
							<a href="{{ route('login') }}"
								class="bg-transparent ring-2 ring-accent ring-inset rounded-full px-4 py-1.5 text-accent">
								{{ __('Login') }}
							</a>
							<a href="{{ route('register') }}" class="bg-accent rounded-full px-4 py-1.5 text-white">
								{{ __('Sign Up') }}
							</a>
						</div>
					</nav>
				</div>
			</div>
		</div>

		{{-- Hero Section --}}
		<div class="min-h-screen md:min-h-fit bg-accent bg-opacity-10 backdrop-blur-[3px]">
			<div class="relative max-w-[1440px] mx-auto py-24 px-4 sm:px-6">

				<div class="grid grid-cols-1 lg:grid-cols-3 mb-12">
					<div class="col-span-1 lg:col-span-2">
						<h1 class="text-8xl text-slate-900 font-bold mb-8">Ayo! <br /> Belajar Bahasa</h1>
						<p class="text-xl text-slate-700 mb-8">
							Pembelajaran tidak didapat dengan kebetulan, ia harus dicari dengan semangat <br /> dan dijalani dengan tekun.
						</p>

						<a href="{{ route('start') }}"
							class="bg-amber-500/100 hover:bg-amber-500/80 text-white text-xl font-semibold rounded-lg px-5 py-2.5">
							Mulai belajar sekarang
						</a>
					</div>

					<div class="relative col-span-1">
						<img src="{{ asset('logo/maskot-shadow.png') }}" alt="Maskot" class="z-15 absolute -top-10">
						<img src="{{ asset('shapes/Skill.svg') }}" alt="Skill" class="z-20 absolute -bottom-14 right-10 h-24 w-auto">

						<div
							class="absolute -z-10 top-8 left-8 w-[360px] h-[360px] bg-gray rounded-full border border-zinc-500 border-opacity-10 backdrop-blur">
						</div>
						<div class="absolute -z-[11] top-10 left-14 w-20 h-20 bg-green-600"></div>
						<div class="absolute -z-[11] bottom-6 left-2 w-32 h-32 bg-amber-500 rounded-full"></div>
						<div class="absolute -z-[11] -bottom-0 left-[30%] w-16 h-16 bg-sky-500 rounded-full"></div>
						<div class="absolute -z-[11] bottom-20 right-16 w-20 h-20 bg-blue-500"></div>
						<div
							class="absolute -z-[11] top-16 right-28 w-0 h-0 border-l-[40px] border-l-transparent border-b-[60px] border-b-red-500 border-r-[40px] border-r-transparent">
						</div>
					</div>

				</div>

				<div class="max-w-4xl mx-auto mt-32 bg-white rounded-xl shadow-lg">
					<div class="flex items-center justify-evenly p-6">
						<div class="flex items-center space-x-4">
							<span class="text-2xl text-slate-900 font-bold">Bahasa Arab</span>
							<img src="{{ asset('logo/Arabic.svg') }}" alt="Flag Arabic">
						</div>
						<div class="flex items-center space-x-4">
							<img src="{{ asset('logo/English.svg') }}" alt="Flag English">
							<span class="text-2xl text-slate-900 font-bold">Bahasa Inggris</span>
						</div>
					</div>
				</div>

				{{-- green dot --}}
				<div class="absolute -z-[5] top-6 left-[360px] w-28 h-28 rounded-full bg-wite backdrop-blur">
				</div>
				<div class="absolute -z-[11] top-10 left-96 w-16 h-16 bg-emerald-500 rounded-full"></div>

				{{-- red rectangle --}}
				<div class="absolute -z-[5] bottom-[220px] right-[650px] w-28 h-28 bg-wite backdrop-blur">
				</div>
				<div class="absolute -z-[11] bottom-60 right-[680px] w-16 h-16 bg-red-500"></div>
			</div>
		</div>

		{{-- Leaderboard Section --}}
		<div class="min-h-fit pb-20">
			<div class="relative max-w-[1440px] mx-auto py-20 px-4 sm:px-6">
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-4">
					<div
						class="w-[36rem] h-[360px] bg-gray shadow-lg rounded-2xl border border-zinc-500 border-opacity-10 backdrop-blur z-10">
						<div class="grid grid-cols-5 gap-y-4 px-6 py-4 text-lg">
							<span class="col-span-1">No</span>
							<span class="col-span-3">Nama</span>
							<span class="col-span-1">Poin</span>

							<span class="col-span-1">1</span>
							<span class="col-span-3">Muhammad Ronald Simatupang</span>
							<span class="col-span-1">1560</span>

							<span class="col-span-1">2</span>
							<span class="col-span-3">John Doe</span>
							<span class="col-span-1">1460</span>

							<span class="col-span-1">3</span>
							<span class="col-span-3">Alex Doe</span>
							<span class="col-span-1">1260</span>
							<span class="col-span-1">3</span>
							<span class="col-span-3">Alex Doe</span>
							<span class="col-span-1">1260</span>
							<span class="col-span-1">3</span>
							<span class="col-span-3">Alex Doe</span>
							<span class="col-span-1">1260</span>
							<span class="col-span-1">3</span>
							<span class="col-span-3">Alex Doe</span>
							<span class="col-span-1">1260</span>
						</div>

					</div>
					<div>
						<h2 class="text-amber-500 text-3xl font-semibold mb-6">Leaderboard</h2>
						<p class="text-slate-700 text-lg">
							Kerjakan soalnya dan dapatkan poin untuk masuk ke dalam leaderboard, setiap soal memiliki poin masing masing dan
							jangan lupa untuk rajin mengerjakan soal agar mendapatkan poin tambahan.
						</p>

						<div class="flex items-end justify-center mt-12">
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-blue.svg') }}" alt="Crown Blue">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-32 h-36 bg-sky-400 rounded-tl-2xl flex items-center justify-center mt-2">
									<span class="text-7xl text-white font-bold">2</span>
								</div>
							</div>
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-yellow.svg') }}" alt="Crown Yellow">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-32 h-52 bg-amber-400 rounded-t-2xl flex items-center justify-center mt-2">
									<span class="text-8xl text-white font-bold">1</span>
								</div>
							</div>
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-red.svg') }}" alt="Crown Red">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-32 h-24 bg-red-500 rounded-tr-2xl flex items-center justify-center mt-2">
									<span class="text-7xl text-white font-bold">3</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Quotes --}}
				<div class="relative flex justify-center py-20 mt-12">
					<span class="absolute -top-4 left-0 text-[120px] leading-0 rotate-12 italic font-semibold">"</span>
					<h2 class="text-5xl text-slate-800 text-center italic font-bold">
						The more that you read, the more things you will know. The more that you learn, the more places you'll go.
					</h2>
				</div>

				{{-- Statistik --}}
				<div class="relative flex justify-center py-20">
					<div
						class="py-14 px-16 bg-gray shadow-lg rounded-3xl border border-zinc-500 border-opacity-10 backdrop-blur z-10 flex flex-col items-center">
						<h2 class="text-8xl text-slate-800 text-center font-bold">123.000.000</h2>
						<span class="uppercase text-slate-800 text-4xl font-bold">PENGGUNA</span>
					</div>

					<img src="{{ asset('logo/maskot-shadow.png') }}" alt="Maskot" class="absolute -bottom-32 left-24 z-20">
				</div>

				{{-- Shapes --}}
				<div class="absolute top-5 right-12 w-28 h-28 bg-gray backdrop-blur z-[1]"></div>
				<div class="absolute z-0 top-10 right-16 w-16 h-16 bg-blue-500"></div>

				<div class="absolute z-0 top-8 left-0 h-16 w-16 bg-green-600"></div>
				<div class="absolute z-0 top-[390px] left-16 w-16 h-16 bg-sky-500 rounded-full"></div>
				<div class="absolute top-80 left-96 h-32 w-32 bg-amber-500 rounded-full"></div>

				<div class="absolute z-0 bottom-10 left-16 w-16 h-16 bg-sky-500 rounded-full"></div>
				<div class="absolute bottom-20 right-80 h-32 w-32 bg-amber-500 rounded-full"></div>
				<div
					class="absolute z-0 top-14 left-[30%] w-0 h-0 border-l-[40px] border-l-transparent border-b-[60px] border-b-red-500 border-r-[40px] border-r-transparent">
				</div>
			</div>
		</div>

		{{-- Testimoni Section --}}
		<div class="bg-accent bg-opacity-10">
			<div class="max-w-[1440px] mx-auto py-12 px-4 sm:px-6">
				<div class="flex items-center justify-between pb-8">
					<h4 class="text-2xl text-red-500 font-bold">Testimoni Siswa</h4>
					<div>
						<button class="bg-white border shadow px-2 py-1">Next</button>
						<button class="bg-white border shadow px-2 py-1">Prev</button>
					</div>
				</div>
				<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 items-center justify-between">

					<div class="bg-white rounded-2xl shadow-lg py-6 px-8">
						<div class="flex items-center space-x-4 mb-3">
							<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
							<h4 class="font-semibold">Junaedi Ruslia</h4>
						</div>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur amet aliquid explicabo natus. Cum, sit.
							Vitae provident maxime, eos sapiente numquam esse, atque veritatis minus, suscipit velit quo? Culpa, maxime.
						</p>
					</div>
					<div class="bg-white rounded-2xl shadow-lg py-6 px-8">
						<div class="flex items-center space-x-4 mb-3">
							<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
							<h4 class="font-semibold">Junaedi Ruslia</h4>
						</div>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur amet aliquid explicabo natus. Cum, sit.
							Vitae provident maxime, eos sapiente numquam esse, atque veritatis minus, suscipit velit quo? Culpa, maxime.
						</p>
					</div>
					<div class="bg-white rounded-2xl shadow-lg py-6 px-8">
						<div class="flex items-center space-x-4 mb-3">
							<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
							<h4 class="font-semibold">Junaedi Ruslia</h4>
						</div>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur amet aliquid explicabo natus. Cum, sit.
							Vitae provident maxime, eos sapiente numquam esse, atque veritatis minus, suscipit velit quo? Culpa, maxime.
						</p>
					</div>

				</div>
			</div>
		</div>

		{{-- Footer section --}}
		<div class="bg-slate-900">
			<div class="max-w-[1440px] mx-auto py-12 px-4 sm:px-6">
				<div class="grid grid-cols-1 lg:grid-cols-2 items-center">
					<div class="flex items-center space-x-4">
						<img src="{{ asset('logo/logo-ori.png') }}" alt="Formustaqbal" class="h-24 w-auto">
						<h1 class="text-4xl text-amber-400 font-bold">Formustaqbal</h1>
					</div>

					<div class="grid grid-cols-1 lg:grid-cols-2 items-start">
						<div class="flex items-start space-x-16">
							<div class="flex flex-col">
								<span class="font-semibold text-white mb-4">Navigasi</span>
								<a href="/" class="text-white">Beranda</a>
								<a href="{{ route('login') }}" class="text-white">Masuk</a>
								<a href="{{ route('register') }}" class="text-white">Daftar</a>
								<a href="#" class="text-white">Pricing</a>
							</div>
							<div class="flex flex-col">
								<span class="font-semibold text-white mb-4">Bahasa</span>
								<a href="#" class="text-white">Bahasa Arab</a>
								<a href="#" class="text-white">Bahasa Inggris</a>
							</div>
						</div>
						<div class="flex flex-col ml-auto">
							<span class="font-semibold text-white mb-4">Kontak</span>
							<a href="#" class="text-white">+6281234567890</a>
							<a href="#" class="text-white">@@formustaqbal</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- Credit --}}
		<div class="bg-white">
			<div class="max-w-[1440px] mx-auto py-4 px-4 sm:px-6">
				<div class="flex items-center justify-end">
					<h6>Copyrights &copy; {{ date('Y') }} | Supported by <a href="https://wanagroup.tech/" target="_blank"
							rel="noopener noreferrer" class="text-indigo-600 font-semibold">Wana Group</a></h6>
				</div>
			</div>
		</div>

	</div>
</body>

</html>
