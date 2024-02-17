<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900 selection:bg-amber-300"
		x-data="{ listMenu: false }">

		{{-- Navbar --}}
		<div
			class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-b-gray-700/60 py-3 md:py-4 px-4 md:px-8 z-[51]">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.modules.show', $module) }}"
					class="flex-1 flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold text-base hidden md:block">{{ $module->course->name }} - {{ $module->title }}</p>
				</a>

				<h2 class="hidden md:flex flex-1 justify-center text-xl text-gray-800 dark:text-white font-semibold">
					{{ $currentChapter->title }}
				</h2>

				<div class="flex-1 flex justify-end">
					<button type="button" class="text-gray-800 dark:text-white border p-2 rounded-full shadow-sm"
						@click="listMenu = !listMenu">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-5 h-5 md:w-6 md:h-6">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
						</svg>
					</button>

				</div>
			</div>
		</div>

		<div class="relative min-h-screen flex">

			{{-- Content --}}
			<div class="max-w-6xl mx-auto w-full md:p-4 flex flex-col justify-between">
				<div class="py-6 mb-20 grid grid-cols-1 gap-y-4">
					@if ($currentChapter->material)
						@foreach ($currentChapter->material->embed_links as $link)
							@if ($link)
								<div x-data="{ embed: 1 }" class="bg-white border shadow-sm lg:rounded-lg overflow-hidden">
									<div class="bg-gray-100 flex items-center justify-end p-4 border-b cursor-pointer"
										x-on:click="embed !== 1 ? embed = 1 : embed = null">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
											stroke="currentColor" x-bind:class="embed == 1 ? 'rotate-180' : ''"
											class="w-5 h-5 font-semibold text-gray-800 transition-all duration-500">
											<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
										</svg>
									</div>

									<div x-ref="container" x-bind:style="embed == 1 ? 'max-height:' + $refs.container.scrollHeight + 'px' : ''"
										class="relative overflow-hidden max-h-0 transition-all duration-500">
										<div class="p-6">
											<iframe class="w-full h-[300px] md:h-[600px]" src="{{ $link['link'] }}" frameborder="0"
												allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
										</div>
									</div>
								</div>
							@endif
						@endforeach

						<div x-data="{ content: 1 }" class="bg-white border shadow-sm lg:rounded-lg overflow-hidden">
							<div class="bg-gray-100 flex items-center justify-end p-4 border-b cursor-pointer"
								x-on:click="content !== 1 ? content = 1 : content = null">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" x-bind:class="content == 1 ? 'rotate-180' : ''"
									class="w-5 h-5 font-semibold text-gray-800 transition-all duration-500">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
								</svg>
							</div>

							<div x-ref="container" x-bind:style="content == 1 ? 'max-height:' + $refs.container.scrollHeight + 'px' : ''"
								class="relative overflow-hidden max-h-0 transition-all duration-500 px-6 lg:px-0">
								<article class="prose dark:prose-invert lg:prose-xl py-8 mx-auto">
									{!! $currentChapter->material->content !!}
								</article>
							</div>
						</div>
					@endif

					@if ($currentChapter->assessment && $currentChapter->material)
						<div class="border-t mt-10 mb-1 py-2">
							<span class="text-lg text-gray-700 font-bold italic">
								@switch($currentChapter->assessment->type)
									@case(1)
										Quiz
									@break

									@case(3)
										Tugas
									@break

									@case(4)
										UTS
									@break

									@case(5)
										UAS
									@break

									@default
										-
								@endswitch
							</span>
						</div>
					@endif

					@if ($currentChapter->assessment)
						<div class="min-h-[8rem]">

							@if (session('finished'))
								<x-alert-success>
									{{ session('finished') }}
								</x-alert-success>
							@endif

							@if (session('limitation'))
								<x-alert-danger>
									{{ session('limitation') }}
								</x-alert-danger>
							@endif

							<div class="grid grid-cols-1 gap-y-10">
								<div class="flex flex-col justify-between space-y-12 pb-4">
									@if ($currentChapter->assessment->instruction)
										<article class="prose dark:prose-invert">
											{!! $currentChapter->assessment->instruction !!}
										</article>
									@endif

									<div class="text-center space-x-4">
										@if ($userResponses->count() < 5)
											<a href="{{ route('courses.quiz', [$module, $currentChapter]) }}"
												class="w-full md:w-auto text-center font-semibold px-6 py-2 border rounded-md shadow-sm bg-slate-700 hover:bg-slate-800 text-white">
												Mulai Kerjakan
											</a>

											@if ($currentChapter->assessment->is_previewable)
												<a href="{{ route('courses.quiz.preview', [$module, $currentChapter]) }}"
													class="w-full md:w-auto text-center font-semibold px-6 py-2 border rounded-md shadow-sm bg-white text-gray-600 hover:text-gray-900">
													Lihat Soal
												</a>
											@endif
										@endif
									</div>
								</div>

								@if (!$userResponses->isEmpty())
									<div>
										<div class="flex items-center justify-between px-1">
											<h4 class="text-xl text-gray-800 font-medium">Riwayat</h4>
											<p class="text-gray-700">
												Total: {{ $userResponses->count() }}/{{ $currentChapter->assessment->trial_limits }}
											</p>
										</div>
										<x-table>
											@slot('thead')
												<x-th>No</x-th>
												<x-th>Waktu</x-th>
												<x-th>Skor</x-th>
												<x-th>Status</x-th>
												<th scope="col" class="relative py-3.5 px-4">
													<span class="sr-only">Edit</span>
												</th>
											@endslot

											@slot('tbody')
												@forelse ($userResponses->sortDesc() as $user)
													<tr>
														<x-td>{{ $loop->iteration }}</x-td>
														<x-td class="font-medium">{{ $user->created_at }}</x-td>
														<x-td>{{ $user->score }}</x-td>
														<x-td>
															@if ($user->reviewed)
																<x-badge color="green">Sudah direview</x-badge>
															@else
																<x-badge color="red">Belum direview</x-badge>
															@endif
														</x-td>
														<x-td class="text-end">
															<a href="{{ route('courses.quiz.history', [$module, $currentChapter, $user]) }}"
																class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
																Detail
															</a>
														</x-td>
													</tr>
												@empty
													<tr>
														<x-td colspan="5">
															Tidak ada hasil
														</x-td>
													</tr>
												@endforelse
											@endslot
										</x-table>
									</div>
								@endif

							</div>
						</div>
					@endif

					@if (!$currentChapter->assessment && !$currentChapter->material)
						<div class="py-6 bg-slate-200">
							<p class="text-center md:text-lg text-gray-600 italic">
								Tidak ada materi
							</p>
						</div>
					@endif
				</div>

				{{-- Prev/Next --}}
				<div
					class="bg-white dark:bg-gray-800 py-4 md:py-6 px-4 md:px-10 border dark:border-gray-700/60 shadow-sm rounded-lg">
					<div class="flex items-center justify-between">
						@if ($prevChapter)
							<a href="{{ route('courses.learn', [$module, $prevChapter]) }}"
								class="flex items-center space-x-1 px-6 py-2 text-gray-700 hover:text-richblack font-medium bg-gray-50 border border-gray-300 rounded hover:bg-gray-200">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
								</svg>

								<span class="hidden md:block">Sebelumnya</span>
							</a>
						@else
							<p
								class="flex items-center space-x-1 px-6 py-2 text-gray-400 font-medium bg-gray-50 border border-gray-200 rounded">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
								</svg>

								<span class="hidden md:block">Sebelumnya</span>
							</p>
						@endif

						@if ($nextChapter && $hasTakenAssessment)
							<a href="{{ route('courses.learn', [$module, $nextChapter]) }}"
								class="flex items-center space-x-1 px-6 py-2 text-white hover:text-white font-semibold capitalize bg-amber-500 rounded hover:bg-amber-500/80">
								<span class="hidden md:block">Selanjutnya</span>

								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
								</svg>
							</a>
						@else
							<p
								class="flex items-center space-x-1 px-6 py-2 text-gray-400 font-medium uppcase bg-gray-50 border border-gray-200 rounded">
								<span class="hidden md:block">Selanjutnya</span>

								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="w-6 h-6">
									<path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
								</svg>
							</p>
						@endif
					</div>
				</div>
			</div>

			{{-- List Submodules --}}
			<aside x-cloak :class="listMenu ? 'translate-x-0' : 'translate-x-96'"
				class="fixed right-0 p-4 overflow-y-auto max-h-screen border-l shadow w-80 sm:w-96 pb-52 bg-white dark:bg-slate-700 dark:border-l-gray-700/60 transition duration-300">

				<div class="space-y-2">
					<h3 class="font-semibold uppercase text-xs text-gray-600 dark:text-gray-400">
						Daftar Module
					</h3>
					<p class="font-bold text-xl text-gray-700 dark:text-gray-50">
						{{ $module->title }}
					</p>
				</div>

				<div class="border-t my-6"></div>

				<div class="flex flex-col">
					@foreach ($module->submodules->where('is_visible', 1)->sortBy('list_sort') as $submodule)
						<div x-data="{ collapse: {{ $currentChapter->submodule->id == $submodule->id ? $submodule->id : 'null' }} }">
							<div class="bg-white py-4 border-b flex items-center justify-between cursor-pointer"
								x-on:click="collapse != {{ $submodule->id }} ? collapse = {{ $submodule->id }} : collapse = null">
								<div class="font-semibold text-gray-800 dark:text-gray-50">
									{{ $submodule->title }}
								</div>

								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" x-bind:class="collapse == {{ $submodule->id }} ? 'rotate-180' : ''"
									class="w-3 h-3 text-gray-800 transition-all duration-500">
									<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
								</svg>
							</div>

							<div class="bg-slate-50 max-h-0 transition-all duration-500"
								x-bind:class="collapse == {{ $submodule->id }} ? 'max-h-fit' : ''">
								<div class="pl-4 space-y-4" x-bind:class="collapse == {{ $submodule->id }} ? 'py-4 border-b' : 'invisible'">
									@forelse ($submodule->chapters->sortBy('list_sort') as $chapter)
										<div class="flex items-center">
											@if (in_array($chapter->id, $completedSubmodules))
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
													stroke="currentColor" class="w-4 h-4 text-green-600 mr-2 rtl:ml-2">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
												</svg>
												<x-nav-module href="{{ route('courses.learn', [$module, $chapter]) }}" :active="$chapter->id === $currentChapter->id">
													{{ $chapter->title }}
												</x-nav-module>
											@else
												<div class="w-3 h-3 rounded-full border bg-gray-100 mr-2 rtl:ml-2"></div>
												<p class="text-gray-400 dark:text-gray-500 select-none">{{ $chapter->title }}</p>
											@endif
										</div>
									@empty
										<p class="text-sm text-gray-600 italic">Tidak ada materi</p>
									@endforelse
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</aside>
		</div>

	</section>
</x-app-layout>
