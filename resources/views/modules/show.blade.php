<x-app-layout>
	<div class="max-w-6xl mx-auto">
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-y-6 lg:gap-x-8 mb-16">

			<div class="col-span-1 lg:col-span-3">
				<div class="flex flex-col xl:flex-row items-center xl:items-start">
					<div class="h-auto w-52 mb-4 xl:mb-0 xl:mr-4">
						<img src="{{ asset('storage/' . $module->course->cover_path) }}" alt="{{ $module->course->name }}"
							class="h-auto w-full">
					</div>
					<div class="flex flex-col items-center xl:items-start gap-5">
						<h3 class="font-semibold text-3xl text-gray-800 dark:text-gray-50">
							{{ $module->course->name }}
						</h3>

						<div class="flex items-center justify-evenly xl:justify-start gap-x-6 w-full">
							<div class="font-medium text-gray-700 flex flex-col md:flex-row items-center gap-x-2" title="Modules">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
								</svg>
								<span>{{ $module->submodules->count() }} Modul</span>
							</div>

							<div class="font-medium text-gray-700 flex flex-col md:flex-row items-center gap-x-2" title="Students">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
								</svg>
								<span>{{ $module->users->count() }} Siswa</span>
							</div>

							<div class="font-medium text-gray-700 flex flex-col md:flex-row items-center gap-x-2" title="Level">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-5 h-5">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
								</svg>
								<span class="capitalize">{{ $module->title }}</span>
							</div>
						</div>
					</div>
				</div>

				<div class="xl:hidden flex flex-col items-center justify-center my-6 -mx-4 md:-mx-0">
					<a href="{{ route('courses.start', $module) }}"
						class="bg-slate-800 w-auto hover:bg-slate-900 px-6 py-2 text-white rounded lg:w-full text-center">
						{{ is_null($completedSubmodules) ? 'Mulai Belajar' : 'Lanjut Belajar' }}
					</a>
				</div>

				@if ($module->course->description)
					<div class="mt-4">
						<div class="text-gray-700 dark:text-gray-50">
							{!! $module->course->description !!}
						</div>
					</div>
				@endif
			</div>

			{{-- Action --}}
			<div class="hidden xl:block col-span-1">
				<div class="flex flex-col items-center justify-center bg-white dark:bg-gray-800 p-6 shadow-sm rounded-md">
					<a href="{{ route('courses.start', $module) }}"
						class="bg-slate-800 hover:bg-slate-900 px-6 py-2 text-white rounded w-full text-center">
						{{ is_null($completedSubmodules) ? 'Mulai Belajar' : 'Lanjut Belajar' }}
					</a>
				</div>
			</div>

			{{-- Silabus --}}
			<div class="col-span-1 lg:col-span-3">
				<div class="py-6">
					<div class="max-w-2xl">
						<h3 class="font-medium text-xl text-gray-700 dark:text-gray-200">Silabus - {{ $module->title }}</h3>

						<div class="mt-4 selection:bg-amber-300">
							@foreach ($module->submodules->where('is_visible', 1)->sortBy('list_sort') as $submodule)
								<div class="bg-white border rounded overflow-hidden" x-data="{ collapse: null }">
									<div class="p-4 flex items-center justify-between cursor-pointer"
										x-on:click="collapse !== {{ $submodule->id }} ? collapse = {{ $submodule->id }} : collapse = null">
										<h3 class="font-semibold text-lg text-gray-800">
											{{ $submodule->title }}
										</h3>
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											stroke="currentColor" x-bind:class="collapse == {{ $submodule->id }} ? 'rotate-180' : ''"
											class="w-4 h-4 text-gray-700 transition-all duration-500">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
										</svg>
									</div>

									<div x-ref="container"
										x-bind:style="collapse == {{ $submodule->id }} ? 'max-height:' + $refs.container.scrollHeight + 'px' : ''"
										class="bg-slate-50 relative overflow-hidden max-h-0 transition-all duration-500">
										<div class="p-4 border-t">

											@forelse ($submodule->chapters->where('is_visible', 1)->sortBy('list_sort') as $chapter)
												<div @class(['flex relative', 'pb-6' => !$loop->last])>
													@if (!$loop->last)
														<div class="h-full w-7 absolute inset-0 flex items-center justify-center">
															<div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
														</div>
													@endif

													@if (is_null($completedSubmodules))
														@if ($loop->parent->first && $loop->first)
															<x-item-sub :active="true" :module="$module" :chapter="$chapter" />
														@else
															<x-item-sub :module="$module" :chapter="$chapter" />
														@endif
													@elseif (in_array($chapter->id, $completedSubmodules))
														<x-item-sub :active="true" :module="$module" :chapter="$chapter" />
													@else
														<x-item-sub :module="$module" :chapter="$chapter" />
													@endif
												</div>
											@empty
												<p class="text-sm text-gray-600 italic">Belum ada submodule</p>
											@endforelse

										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
