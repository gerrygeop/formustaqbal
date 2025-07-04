<x-blank-layout>
	<section class="fixed inset-0 overflow-y-auto z-50">

		<div
			class="relative min-h-screen overflow-hidden flex flex-col sm:justify-center items-center pt-16 sm:pt-0 bg-gray-100 dark:bg-gray-900">
			<div class="w-full z-[55]">
				<div class="max-w-5xl mx-auto w-full">
					<div class="bg-white/50 backdrop-blur border border-b-4 rounded-xl shadow py-20">
						<h2 class="text-4xl text-center text-gray-800 dark:text-gray-50 font-semibold">
							Selamat datang di Formustaqbal
						</h2>

						<div class="flex items-center justify-center w-full mt-14 px-6 md:px-0">
							<a href="{{ route('language') }}"
								class="text-xl font-semibold text-center text-white bg-yellow-500 rounded-lg border border-amber-500 w-96 py-3">Lanjutkan</a>
						</div>
					</div>
				</div>
			</div>

			<div class="absolute bottom-10 md:bottom-auto left-0 z-[52]">
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
				</div>
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
				</div>
			</div>
			<div class="absolute bottom-10 md:bottom-auto right-0 z-[52]">
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
				</div>
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="confetti" class="h-32 w-auto">
				</div>
				<img src="{{ asset('logo/maskot-shadow.png') }}" alt="maskot" class="absolute right-32 top-10 z-[53] h-64 w-auto">
			</div>

		</div>

	</section>
</x-blank-layout>
