<x-app-layout>
	<div class="max-w-4xl mx-auto">
		<div class="grid grid-cols-1 gap-y-14">

			<section class="col-span-1">
				<div class="mb-3">
					<h6 class="uppercase font-semibold text-xs text-gray-500">Level</h6>
					<h3 class="font-semibold text-lg text-slate-800 leading-0 dark:text-slate-100">
						{{ $course->name }}
					</h3>
				</div>

				<div class="grid grid-cols-1 gap-4">

					@forelse ($course->modules as $module)
						@if (auth()->user()->profile &&
								$module->standard_point <= auth()->user()->profile->point &&
								$module->users->contains(auth()->user()->id))
							<a href="{{ route('courses.modules.show', $module) }}"
								class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm border hover:shadow-md hover:-translate-y-1 rounded-md md:rounded-lg transition duration-200">
								<div class="p-4 md:p-6 text-gray-900 dark:text-gray-100 h-full">

									<div class="flex items-center justify-between">
										<div class="flex items-center gap-x-4">
											<div class="w-8 h-8 bg-white border border-green-600/20 flex items-center justify-center rounded-full">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
													class="w-6 h-6 text-green-600">
													<path fill-rule="evenodd"
														d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
														clip-rule="evenodd" />
												</svg>
											</div>
											<h2 class="font-semibold text-lg md:text-2xl text-slate-700 dark:text-gray-50">
												{{ $module->title }}
											</h2>
										</div>
										<div class="text-gray-700">
											<span>{{ $module->submodules->count() }} Materi</span>
										</div>
									</div>

								</div>
							</a>
						@else
							<div class="col-span-1 bg-gray-300 dark:bg-gray-800 overflow-hidden border rounded-md md:rounded-lg select-none">
								<div class="p-4 md:p-6 text-gray-900 dark:text-gray-100 h-full">

									<div class="flex items-center justify-between">
										<div class="flex items-center gap-x-4">
											<div class="w-8 h-8 bg-white border border-green-600/20 flex items-center justify-center rounded-full">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
													stroke="currentColor" class="w-5 h-5 text-gray-400">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
												</svg>
											</div>
											<h2 class="font-medium text-lg md:text-2xl text-slate-400 dark:text-gray-600">
												{{ $module->title }}
											</h2>
										</div>
										<div class="text-gray-400 dark:text-gray-50">
											<span>{{ $module->submodules->count() }} Materi</span>
										</div>
									</div>

								</div>
							</div>
						@endif

					@empty
						<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100">
								<div class="flex items-center justify-center space-x-2">
									<h2 class="text-lg text-slate-600 dark:text-gray-50">
										Belum ada daftar Level yang bisa ditampilkan
									</h2>
								</div>
							</div>
						</div>
					@endforelse

				</div>
			</section>

		</div>
	</div>
</x-app-layout>
