<x-app-layout>
	<div class="max-w-7xl mx-auto">
		<div class="grid grid-cols-1 gap-y-14">

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">
						Kelas Saya
					</h3>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

					@forelse ($myCourses as $my)
						@foreach ($my->modules as $module)
							<a href="{{ route('courses.modules.show', $module->id) }}"
								class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm border border-transparent hover:border-slate-300 sm:rounded-lg">
								<div class="p-6 text-gray-900 dark:text-gray-100">
									<div class="flex items-center space-x-2">
										<img src="{{ asset('storage/' . $my->cover_path) }}" alt="{{ $my->name }}" class="h-6 w-auto">
										<h2 class="font-medium text-lg text-slate-700 dark:text-gray-50">
											{{ $my->name }}
										</h2>
									</div>

									<div class="flex items-center space-x-2 mt-3 text-gray-800">
										<span class="text-xl font-semibold">{{ $module->title }}</span>
										<div class="w-1 h-1 rounded-full bg-gray-500"></div>
										<span class="text-sm font-medium">Class A</span>
									</div>
								</div>
							</a>
						@endforeach

					@empty
						<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100">
								<div class="flex items-center justify-center space-x-2">
									<p>
										@if (auth()->user()->assessments->isNotEmpty())
											Ayo mulai belajar sekarang! Temukan kelas yang menarik dan daftar sekarang.
										@else
											Silahkan mengambil
											<a href="{{ route('language') }}" class="font-semibold text-amber-600 underline">
												Placement Test
											</a>
											untuk memilih Bahasa dan dapatkan Level anda.
										@endif
									</p>
								</div>
							</div>
						</div>
					@endforelse

				</div>
			</section>

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">
						Daftar Bahasa
					</h3>
				</div>

				{{-- Bahasa lain --}}
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

					@foreach ($courses as $course)
						<a href="{{ route('courses.levels', $course) }}"
							class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm border border-transparent hover:border-slate-300 sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100 h-full">

								<div class="flex flex-col gap-y-5 h-full">
									<div class="flex flex-col sm:flex-row items-start gap-x-4">
										<img src="{{ asset('storage/' . $course->cover_path) }}" alt="{{ $course->name }}" class="h-16 w-auto">
										<div>
											<h2 class="font-medium text-2xl text-gray-800 dark:text-gray-50">
												{{ $course->name }}
											</h2>

											<div class="text-gray-700 flex items-center gap-x-2 mt-2">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
													stroke="currentColor" class="w-5 h-5">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
												</svg>
												<span>{{ $course->modules_count }} Level</span>
											</div>
										</div>
									</div>

									@if ($course->description)
										<div class="text-gray-600 line-clamp-2">
											{!! $course->description !!}
										</div>
									@endif
								</div>

							</div>
						</a>
					@endforeach

				</div>
			</section>

		</div>
	</div>
</x-app-layout>
