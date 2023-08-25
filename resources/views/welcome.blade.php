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

	<!-- Link Swiper's CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="font-sans antialiased">
	<div class="min-h-fit bg-slate-50 overflow-hidden">

		{{-- Navbar --}}
		<div class="bg-white shadow-sm">
			<div class="max-w-[1440px] mx-auto py-1 px-4 sm:px-6">
				<div class="flex items-center justify-between h-16">
					{{-- Logo --}}
					<div class="shrink-0">
						<a href="/" class="flex items-center">
							<x-app-logo class="h-14 w-auto mr-2" />
							<h1 class="text-slate-800 text-xl font-bold tracking-wide hidden md:block">Formustaqbal</h1>
						</a>
					</div>

					{{-- Menu --}}
					<nav class="flex items-center gap-x-4 md:gap-x-10 text-slate-700 font-semibold">
						<a href="#" class="hover:text-slate-900">
							{{ __('Pricing') }}
						</a>

						@guest
							<div class="flex items-center space-x-2 md:space-x-4">
								<a href="{{ route('login') }}"
									class="bg-transparent ring-2 ring-accent ring-inset rounded-full px-4 py-1.5 text-accent">
									{{ __('Login') }}
								</a>
								<a href="{{ route('register') }}" class="bg-accent rounded-full px-4 py-1.5 text-white">
									{{ __('Sign Up') }}
								</a>
							</div>
						@endguest

						@auth
							<!-- Settings Dropdown -->
							<div class="flex items-center">
								<x-dropdown align="right" width="48">
									<x-slot name="trigger">
										<button
											class="inline-flex items-center px-3 py-2 border border-yellow-600/30 rounded-2xl leading-4 font-medium text-sm text-yellow-800 bg-yellow-50 hover:bg-yellow-100/80 focus:outline-none transition ease-in-out duration-150">
											<div>{{ Auth::user()->name }}</div>

											<div class="ml-1">
												<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
													<path fill-rule="evenodd"
														d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
														clip-rule="evenodd" />
												</svg>
											</div>
										</button>
									</x-slot>

									<x-slot name="content">
										<x-dropdown-link :href="route('dashboard')">
											{{ __('Dashboard') }}
										</x-dropdown-link>

										<x-dropdown-link :href="route('profile.edit')">
											{{ __('Setting') }}
										</x-dropdown-link>

										<!-- Authentication -->
										<form method="POST" action="{{ route('logout') }}">
											@csrf

											<x-dropdown-link :href="route('logout')"
												onclick="event.preventDefault();
                                                this.closest('form').submit();">
												{{ __('Log Out') }}
											</x-dropdown-link>
										</form>
									</x-slot>
								</x-dropdown>
							</div>
						@endauth
					</nav>
				</div>
			</div>
		</div>

		{{-- Hero Section --}}
		<div class="min-h-screen md:min-h-fit bg-accent bg-opacity-10 backdrop-blur-[3px]">
			<div class="relative max-w-[1440px] mx-auto pb-16 pt-10 lg:py-24 px-4 sm:px-6">

				<div class="grid grid-cols-1 lg:grid-cols-3 gap-y-8 lg:gap-y-0 mb-12">
					<div class="col-span-1 lg:col-span-2">
						<h1 class="text-7xl lg:text-8xl text-slate-900 font-bold mb-4 lg:mb-8">Ayo! <br /> Belajar Bahasa</h1>
						<p class="text-xl text-slate-700 mb-6 lg:mb-8">
							Pembelajaran tidak didapat dengan kebetulan, ia harus dicari dengan semangat <br /> dan dijalani dengan tekun.
						</p>

						<a href="{{ route('start') }}"
							class="bg-amber-500/100 hover:bg-amber-500/80 text-white text-xl font-semibold rounded-lg px-5 py-2.5">
							Mulai belajar sekarang
						</a>
					</div>

					<div class="relative col-span-1 min-h-[300px]">
						<img src="{{ asset('logo/maskot-shadow.png') }}" alt="Maskot"
							class="z-15 absolute top-0 md:left-[30%] lg:left-0 md:-top-10">
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

				{{-- Language --}}
				<div class="max-w-4xl mx-auto mt-32 bg-white rounded-xl shadow-lg">
					<div class="flex items-center justify-evenly px-2 py-6 md:p-6">
						<div class="flex flex-col md:flex-row items-center space-x-2 md:space-x-4">
							<span class="text-base md:text-2xl text-slate-900 font-bold">Bahasa Arab</span>
							<img src="{{ asset('logo/Arabic.svg') }}" alt="Flag Arabic"
								class="w-14 h-auto md:w-24 order-first md:order-last">
						</div>
						<div class="flex flex-col md:flex-row items-center space-x-2 md:space-x-4">
							<img src="{{ asset('logo/English.svg') }}" alt="Flag English" class="w-14 h-auto md:w-24">
							<span class="text-base md:text-2xl text-slate-900 font-bold">Bahasa Inggris</span>
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
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
					<div
						class="col-span-1 max-w-[36rem] h-fit bg-gray shadow-lg rounded-2xl border border-zinc-500 border-opacity-10 backdrop-blur-lg z-10">
						<div class="grid grid-cols-5 gap-y-4 px-6 py-4 text-lg">
							<span class="col-span-1 text-sm lg:text-base text-gray-800 font-semibold">No</span>
							<span class="col-span-3 text-sm lg:text-base text-gray-800 font-semibold">Nama</span>
							<span class="col-span-1 text-sm lg:text-base text-gray-800 font-semibold">Poin</span>

							<span class="col-span-full border-t"></span>

							@foreach (\App\Models\User::with('profile')->get()->take(10) as $user)
								<span class="col-span-1 text-sm lg:text-base">{{ $loop->iteration }}</span>
								<span class="col-span-3 text-sm lg:text-base">{{ $user->name }}</span>
								<span class="col-span-1 text-sm lg:text-base">{{ $user->profile->point ?? '0' }}</span>
							@endforeach
						</div>
					</div>

					<div class="col-span-1">
						<h2 class="text-amber-500 text-3xl font-semibold mb-2 md:mb-6">Leaderboard</h2>
						<p class="text-slate-700 text-lg">
							Kerjakan soalnya dan dapatkan poin untuk masuk ke dalam leaderboard, setiap soal memiliki poin masing masing dan
							jangan lupa untuk rajin mengerjakan soal agar mendapatkan poin tambahan.
						</p>

						{{-- Chart --}}
						<div class="flex items-end justify-center mt-12">
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-blue.svg') }}" alt="Crown Blue">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-24 md:w-32 h-36 bg-sky-400 rounded-tl-2xl flex items-center justify-center mt-2">
									<span class="text-7xl text-white font-bold">2</span>
								</div>
							</div>
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-yellow.svg') }}" alt="Crown Yellow">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-24 md:w-32 h-52 bg-amber-400 rounded-t-2xl flex items-center justify-center mt-2">
									<span class="text-8xl text-white font-bold">1</span>
								</div>
							</div>
							<div class="flex flex-col items-center">
								<img src="{{ asset('shapes/crown-red.svg') }}" alt="Crown Red">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<div class="w-24 md:w-32 h-24 bg-red-500 rounded-tr-2xl flex items-center justify-center mt-2">
									<span class="text-7xl text-white font-bold">3</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				{{-- Quotes --}}
				<div class="relative flex justify-center py-20 mt-12">
					<span class="absolute top-2 -left-5 md:-left-5 text-[100px] leading-0 rotate-12 italic font-medium">"</span>
					<h2 class="text-3xl md:text-4xl text-slate-800 text-center italic font-bold">
						The more that you read, the more things you will know. The more that you learn, the more places you'll go.
					</h2>
				</div>

				{{-- Statistik --}}
				<div class="relative flex justify-center py-16 md:py-20">
					<div class="bg-gray shadow-lg rounded-3xl border border-zinc-500 border-opacity-10 backdrop-blur z-10">
						<div class="flex flex-col items-center space-y-2 py-14 px-8 md:px-16">
							<h2 class="text-5xl md:text-7xl text-slate-800 text-center font-bold">{{ \App\Models\User::count() }}.000</h2>
							<p class="uppercase text-slate-700 text-xl md:text-3xl font-bold tracking-wide">PENGGUNA</p>
						</div>
					</div>

					<img src="{{ asset('logo/maskot-shadow.png') }}" alt="Maskot"
						class="absolute -bottom-32 left-24 z-20 w-60 md:w-80 lg:w-auto">
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
			<div class="max-w-[1440px] mx-auto py-6 px-4 sm:px-6">
				<div class="swiper mySwiper">
					<div class="flex items-center justify-between">
						<h4 class="text-2xl text-red-500 font-bold">Testimoni Siswa</h4>
						<div>
							<button class="btn-slide-prev bg-white border shadow px-2 py-1">Prev</button>
							<button class="btn-slide-next bg-white border shadow px-2 py-1">Next</button>
						</div>
					</div>

					<div
						class="swiper-wrapper py-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 items-center justify-between">

						<div class="swiper-slide bg-white rounded-2xl shadow-md py-6 px-8">
							<div class="flex items-center space-x-4 mb-3">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<h4 class="font-semibold">Paul Greyrad</h4>
							</div>
							<p>
								Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur amet aliquid explicabo natus. Cum, sit.
								Vitae provident maxime, eos sapiente numquam esse, atque veritatis minus, suscipit velit quo? Culpa, maxime.
							</p>
						</div>
						<div class="swiper-slide bg-white rounded-2xl shadow-md py-6 px-8">
							<div class="flex items-center space-x-4 mb-3">
								<img src="{{ asset('shapes/ava.svg') }}" alt="Avatar">
								<h4 class="font-semibold">John Doe</h4>
							</div>
							<p>
								Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consectetur amet aliquid explicabo natus. Cum, sit.
								Vitae provident maxime, eos sapiente numquam esse, atque veritatis minus, suscipit velit quo? Culpa, maxime.
							</p>
						</div>
						<div class="swiper-slide bg-white rounded-2xl shadow-md py-6 px-8">
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
		</div>

		{{-- Footer section --}}
		<div class="bg-slate-900">
			<div class="max-w-[1440px] mx-auto py-12 px-4 sm:px-6">
				<div class="grid grid-cols-1 md:grid-cols-2 items-center">
					<div class="flex items-center space-x-2 md:space-x-4">
						<img src="{{ asset('logo/logo-ori.png') }}" alt="Formustaqbal" class="h-20 md:h-24 w-auto">
						<h1 class="text-2xl md:text-4xl text-amber-400 font-bold">Formustaqbal</h1>
					</div>

					<div class="grid grid-cols-2 items-start mt-10 md:mt-0 text-white">
						<div class="flex items-start space-x-4 lg:space-x-16">
							<div class="flex flex-col">
								<span class="font-semibold mb-4">Navigasi</span>
								<a href="/">Beranda</a>
								<a href="{{ route('login') }}">Masuk</a>
								<a href="{{ route('register') }}">Daftar</a>
								<a href="#">Pricing</a>
							</div>
							<div class="flex flex-col">
								<span class="font-semibold mb-4">Bahasa</span>
								<a href="#">Bahasa Arab</a>
								<a href="#">Bahasa Inggris</a>
							</div>
						</div>
						<div class="flex flex-col ml-auto">
							<span class="font-semibold mb-4">Kontak</span>
							<a href="#">+6281234567890</a>
							<a href="#">@@formustaqbal</a>
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

	<!-- Swiper JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

	<!-- Initialize Swiper -->
	<script>
		const mediaQuery = window.matchMedia('(max-width: 640px)');
		var totalSlide = 3

		mediaQuery.addListener(handleDeviceChange);

		function handleDeviceChange(e) {
			if (e.matches) totalSlide = 1;
			else totalSlide = 3;
		}

		// Run it initially
		handleDeviceChange(mediaQuery);
		// if (mediaQuery.matches) {
		// 	totalSlide = 1
		// } else {
		// 	totalSlide = 3
		// }

		var swiper = new Swiper(".mySwiper", {
			slidesPerView: totalSlide,
			// spaceBetween: 30,
			navigation: {
				nextEl: ".btn-slide-next",
				prevEl: ".btn-slide-prev",
			},
		});
	</script>
</body>

</html>
