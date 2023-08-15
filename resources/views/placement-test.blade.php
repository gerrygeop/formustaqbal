<x-blank-layout>
	<section class="fixed inset-0 overflow-y-auto z-50">
		<div
			class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

			<div class="w-full z-[55]">
				@livewire('test-questions', ['test' => $test])
			</div>

			{{-- Confetti --}}
			<div class="absolute left-0 z-[52]">
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
				<div class="flex">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
					<img src="{{ asset('shapes/confeti.svg') }}" alt="conffeti" class="h-32 w-auto">
				</div>
			</div>
			<div class="absolute right-0 z-[52]">
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
