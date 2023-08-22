<x-app-layout>
	<div class="max-w-6xl mx-auto">
		<div class="grid grid-cols-1 lg:grid-cols-4 gap-y-8 lg:gap-y-8 lg:gap-x-8 mb-16">

			<div class="col-span-1">
				<img src="{{ asset('storage/' . $course->cover_path) }}" alt="{{ $course->name }}" class="h-auto w-full">
			</div>

			<div class="col-span-1 lg:col-span-2">
				<div class="flex flex-col items-start gap-4">
					<h3 class="font-semibold text-3xl text-gray-800 dark:text-gray-50">
						{{ $course->name }}
					</h3>

					<div class="flex items-center gap-x-6">
						<div class="text-gray-700 flex flex-col md:flex-row items-center gap-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
							</svg>
							<span>{{ $course->modules->count() }} Modul</span>
						</div>

						<div class="text-gray-700 flex flex-col md:flex-row items-center gap-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
							</svg>
							<span>{{ $course->users->count() }} Siswa terdaftar</span>
						</div>

						<div class="text-gray-700 flex flex-col md:flex-row items-center gap-x-2">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
								stroke="currentColor" class="w-5 h-5">
								<path stroke-linecap="round" stroke-linejoin="round"
									d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
							</svg>
							<span class="capitalize">{{ $course->level }}</span>
						</div>
					</div>
				</div>

				@if ($course->descriptions)
					<div class="mt-10">
						<div class="text-gray-700 dark:text-gray-50">
							{!! $course->descriptions !!}
						</div>
					</div>
				@endif
			</div>

			<div class="col-span-1">
				<div class="flex flex-col items-center justify-center gap-y-4 bg-white dark:bg-gray-800 p-6 shadow-sm rounded-md">

					{{-- @if (auth()->user()->profile->point)
						<a href="{{ route('courses.attach', $course) }}"
							class="bg-accent/100 hover:bg-accent/90 px-6 py-2 text-richblack rounded w-full text-center">
							Belajar sekarang
						</a>
					@endif --}}

					<a href="#"
						class="bg-gray-100 hover:bg-gray-200 px-6 py-2 text-richblack border border-gray-300 rounded w-full text-center">
						Testimoni
					</a>
				</div>
			</div>

			<div class="col-span-full">
				<div class="bg-white dark:bg-gray-800 p-6 lg:px-12 shadow-sm rounded-md border">
					<h3 class="font-medium text-2xl text-gray-700 dark:text-gray-50">Level</h3>

					<div class="grid grid-cols-1 gap-y-4 mt-4">
						@foreach ($course->modules as $module)
							@if ($module->standard_point <= auth()->user()->profile->point && $module->users->contains(auth()->user()->id))
								<a href="{{ route('courses.mulai', $module) }}"
									class="inline-flex items-center rounded-md bg-yellow-200 hover:bg-yellow-300 ring-1 ring-inset ring-yellow-600/20 hover:ring-yellow-600/70 transition-all duration-150 px-4 py-2">
									<span class="font-medium text-lg text-yellow-800">{{ $module->title }}</span>
								</a>
							@else
								<div class="border rounded px-4 py-2 flex items-center space-x-2">
									<h4 class="font-medium text-lg text-gray-400 dark:text-gray-300">{{ $module->title }}</h4>
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
										stroke="currentColor" class="w-5 h-5 text-gray-400">
										<path stroke-linecap="round" stroke-linejoin="round"
											d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
									</svg>

								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>

		</div>
	</div>
</x-app-layout>
