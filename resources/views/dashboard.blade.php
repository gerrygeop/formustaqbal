<x-app-layout>
	<div class="max-w-7xl mx-auto">

		<div class="grid grid-cols-2 gap-4">
			<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="flex items-center space-x-2 p-6 text-gray-900 dark:text-gray-100">
					<div class="h-2 w-2 bg-green-500 rounded-full"></div>
					<span>{{ __('Greeting') }},</span>
					<span class="font-semibold">
						{{ auth()->user()->name }}
					</span>
				</div>
			</div>
		</div>

		<div class="py-10">
			<div class="flex mb-3">
				<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">Kemajuan</h3>
			</div>

			{{-- Progress card --}}
			<div class="grid grid-cols-2 gap-4">
				<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<div class="flex items-center space-x-2">
							<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Arab</h2>
							<img src="{{ asset('logo/Arabic.svg') }}" alt="Arabic" class="h-8 w-auto">
						</div>
						<span class="text-sm text-green-400">Level 2</span>

						<div class="flex items-center justify-between mt-4">
							Progress bar
							<button class="px-4 py-1 rounded bg-green-600">Lanjut</button>
						</div>
					</div>
				</div>

				<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<div class="flex items-center space-x-2">
							<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Inggris</h2>
							<img src="{{ asset('logo/English.svg') }}" alt="English" class="h-8 w-auto">
						</div>
						<span class="text-sm text-red-400">Level 4</span>

						<div class="flex items-center justify-between mt-4">
							Progress bar
							<button class="px-4 py-1 rounded bg-red-600">Lanjut</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
