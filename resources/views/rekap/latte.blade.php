<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ route('filament.resources.assessments.edit', $assessment) }}"
					class="flex-1 flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold text-base">Kembali</p>
				</a>
			</div>
		</div>

		<div class="relative min-h-screen flex">
			<div class="max-w-7xl mx-auto w-full flex flex-col justify-between">
				<div class="py-6 mb-20">

					<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
						<div class="bg-white rounded-lg shadow p-6">
							<h3 class="text-2xl text-yellow-600 font-semibold">{{ $users_count }} / {{ $total_users }}</h3>
							<p class="text-sm text-slate-700">Telah mengambil Placement Test</p>
							<a href="{{ route('dapur.espresso', $assessment) }}"
								class="mt-2 text-sm text-blue-500 hover:underline flex items-center gap-x-1">
								<span>Detail</span>
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-4 h-4">
									<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
								</svg>
							</a>
						</div>
						<div class="bg-white rounded-lg shadow p-6">
							<h3 class="text-2xl text-yellow-600 font-semibold">{{ $users_completed_true }} / {{ $total_users }}</h3>
							<p class="text-sm text-slate-700">Telah menyelesaikan Placement Test</p>
						</div>
						<div class="bg-white rounded-lg shadow p-6">
							<h3 class="text-2xl text-yellow-600 font-semibold">{{ $users_completed_false }} / {{ $total_users }}</h3>
							<p class="text-sm text-slate-700">Tidak menyelesaikan Placement Test</p>
						</div>
						<div class="bg-white rounded-lg shadow p-6">
							<h3 class="text-2xl text-yellow-600 font-semibold">{{ $users }} / {{ $total_users }}</h3>
							<p class="text-sm text-slate-700">Tidak mengambil Placement Test</p>
						</div>
					</div>

					@livewire('list-users-latte', ['assessment' => $assessment])

				</div>
			</div>
		</div>
	</section>
</x-app-layout>
