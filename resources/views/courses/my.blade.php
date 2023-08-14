<x-app-layout>
	<div class="max-w-7xl mx-auto">
		<div class="grid grid-cols-1 gap-y-14">

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">
						Kelas Saya
					</h3>
				</div>

				<div class="grid grid-cols-2 lg:grid-cols-3 gap-4">

					@forelse ($myCourses as $my)
						<a href="{{ route('courses.show', $my) }}"
							class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100">
								<div class="flex items-center space-x-2">
									<h2 class="font-medium text-2xl text-slate-800 dark:text-gray-50">
										{{ $my->name }}
									</h2>
									<img src="{{ asset('storage/' . $my->cover_path) }}" alt="{{ $my->name }}" class="h-8 w-auto">
								</div>

								<span class="text-sm text-blue-500 font-medium">Sedang dikerjakan - Level 2</span>
							</div>
						</a>

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
			</section>

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">
						Bahasa Lainnya
					</h3>
				</div>

				{{-- Bahasa lain --}}
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

					@foreach ($subjects as $subject)
						<a href="{{ route('courses.list', $subject) }}"
							class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm border border-transparent hover:border-green-500 sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100 h-full">

								<div class="flex flex-col justify-between gap-y-4 h-full">
									<div class="flex items-start gap-x-4">
										<img src="{{ asset('storage/' . $subject->cover_path) }}" alt="{{ $subject->name }}" class="h-16 w-auto">
										<div>
											<h2 class="font-medium text-2xl text-gray-800 dark:text-gray-50">
												{{ $subject->name }}
											</h2>

											<div class="text-gray-700 flex items-center gap-x-2 mt-2">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
													stroke="currentColor" class="w-5 h-5">
													<path stroke-linecap="round" stroke-linejoin="round"
														d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
												</svg>
												<span>{{ $subject->courses_count }} Courses</span>
											</div>
										</div>
									</div>

									@if ($subject->description)
										<div class="text-gray-600 line-clamp-2">
											{!! $subject->descriptions !!}
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
