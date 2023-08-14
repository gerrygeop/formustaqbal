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
				@forelse ($myCourses as $my)
					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100">
							<div class="flex items-center space-x-2">
								<h2 class="font-medium text-2xl text-slate-800 dark:text-gray-50">
									{{ $my->name }}
								</h2>
								<img src="{{ asset('storage/' . $my->cover_path) }}" alt="{{ $my->name }}" class="h-8 w-auto">
							</div>

							<span class="text-sm text-emerald-500 font-medium">Level 2</span>

							<div class="flex items-center justify-between gap-x-6 mt-4">
								<div class="h-2.5 w-full bg-slate-200 rounded overflow-hidden">
									<div class="h-2.5 bg-green-500 rounded" style="width: {{ 20 }}%"></div>
								</div>
								<button class="px-4 py-2 rounded-lg bg-green-600 text-white text-xs font-semibold uppercase tracking-wider">
									Lanjut
								</button>
							</div>
						</div>
					</div>

				@empty
					<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100">
							<div class="flex items-center justify-center space-x-2">
								<h2 class="text-lg text-slate-600 dark:text-gray-50">
									Ayo mulai belajar sekarang! Temukan kelas yang menarik dan daftar sekarang.
								</h2>
							</div>
						</div>
					</div>
				@endforelse
			</div>
		</div>

		<div class="py-10">
			<div class="flex mb-3">
				<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">Riwayat</h3>
			</div>

			{{-- Riwayat card --}}
			<div class="grid grid-cols-2 gap-4">
				<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<div class="flex items-center justify-center space-x-2">
							<h2 class="text-lg text-slate-600 dark:text-gray-50">
								Belum terdapat riwayat belajar
							</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
