<x-blank-layout>
	<section class="fixed inset-0 overflow-y-auto z-50">

		<div
			class="relative min-h-screen overflow-hidden flex flex-col sm:justify-center items-center pt-16 sm:pt-0 bg-gray-100 dark:bg-gray-900">
			<div class="w-full z-[55]">
				<div class="max-w-5xl mx-auto w-full">
					<div class="bg-white/50 backdrop-blur border border-b-4 rounded-xl shadow py-20">
						<h2 class="text-4xl text-center text-gray-800 dark:text-gray-50 font-semibold">
							Pilih Bahasa yang ingin dipelajari
						</h2>

						<div class="flex flex-col md:flex-row items-center justify-center md:justify-evenly w-full mt-10">
							@foreach ($courses as $course)
								<a href="{{ route('reminder', $course) }}"
									class="flex flex-col items-center gap-y-4 bg-white border hover:border-yellow-200 rounded-lg p-6 shadow">
									<img src="{{ asset('storage/' . $course->cover_path) }}" alt="{{ $course->name }}" class="w-30 h-auto">
									<h4 class="text-xl text-gray-800 dark:text-gray-50 font-semibold">
										{{ $course->name }}
									</h4>
								</a>
							@endforeach
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
				<img src="{{ asset('logo/maskot-shadow.png') }}" alt="maskot"
					class="absolute right-32 top-10 z-[53] h-64 w-auto">
			</div>

		</div>

	</section>
</x-blank-layout>
