<x-blank-layout>
	<section class="fixed inset-0 overflow-y-auto z-50">
		<div
			class="relative min-h-screen overflow-hidden flex flex-col sm:justify-center items-center bg-gray-100 dark:bg-gray-900">

			<div class="w-full z-[55] bg-gray backdrop-blur">
				@livewire('placemen-test', ['assessment' => $assessment])
			</div>

			{{-- Confetti --}}
			<div class="absolute bottom-10 md:bottom-auto left-0 z-[52]">
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
			</div>
			<div class="absolute bottom-10 md:bottom-auto right-0 z-[52]">
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
				<img src="{{ asset('logo/maskot-shadow.png') }}" alt="maskot" class="absolute right-32 top-10 z-[53] h-64 w-auto">
			</div>

		</div>
	</section>
</x-blank-layout>
