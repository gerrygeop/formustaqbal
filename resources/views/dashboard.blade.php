<x-app-layout>
	<div class="max-w-7xl mx-auto">

		<div class="grid grid-cols-2 gap-4">
			@if ($rooms->isEmpty())
				<div class="col-span-1 bg-white dark:bg-gray-800 flex items-center overflow-hidden shadow-sm sm:rounded-lg">
					<div
						class="flex items-center border gap-x-2 px-4 lg:px-6 py-3 lg:py-4 font-semibold lg:text-lg text-gray-900 dark:text-gray-100">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
							class="w-5 h-5 lg:w-6 lg:h-6 text-amber-500">
							<path fill-rule="evenodd"
								d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
								clip-rule="evenodd" />
						</svg>

						<span class="font-semibold">
							{{ auth()->user()->profile->point }}
						</span>
						<span>Point</span>
					</div>
				</div>
			@endif

			@if ($rooms->isNotEmpty())
				<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="px-4 lg:px-6 py-3 lg:py-4">
						<div class="flex items-center gap-x-2 text-gray-900 dark:text-gray-100">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
								class="w-5 h-5 lg:w-6 lg:h-6 text-amber-500">
								<path
									d="M5.566 4.657A4.505 4.505 0 016.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0015.75 3h-7.5a3 3 0 00-2.684 1.657zM2.25 12a3 3 0 013-3h13.5a3 3 0 013 3v6a3 3 0 01-3 3H5.25a3 3 0 01-3-3v-6zM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 016.75 6h10.5a3 3 0 012.683 1.657A4.505 4.505 0 0018.75 7.5H5.25z" />
							</svg>
							<span>Class:</span>
						</div>

						<div class="flex mt-1 space-x-2 lg:text-lg">
							@foreach ($rooms as $room)
								<p class="font-medium">
									{{ $room->name }}
								</p>
							@endforeach
						</div>
					</div>
				</div>

				@cannot('teacher')
					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="px-4 lg:px-6 py-3 lg:py-4">
							<div class="flex items-center gap-x-2 text-gray-900 dark:text-gray-100">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
									class="w-5 h-5 lg:w-6 lg:h-6 text-amber-500">
									<path
										d="M5.566 4.657A4.505 4.505 0 016.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0015.75 3h-7.5a3 3 0 00-2.684 1.657zM2.25 12a3 3 0 013-3h13.5a3 3 0 013 3v6a3 3 0 01-3 3H5.25a3 3 0 01-3-3v-6zM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 016.75 6h10.5a3 3 0 012.683 1.657A4.505 4.505 0 0018.75 7.5H5.25z" />
								</svg>
								<span>Dosen:</span>
							</div>

							<div class="flex mt-1 space-x-2 lg:text-lg">
								@foreach ($rooms as $room)
									@foreach ($room->users()->where('type', 1)->get() as $user)
										<a href="{{ route('profile.detail', $user) }}" class="font-medium hover:underline">
											{{ $user->name }}
										</a>
									@endforeach
								@endforeach
							</div>
						</div>
					</div>
				@endcannot
			@endif
		</div>

		@cannot('teacher')
			<div class="py-10">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">Kemajuan</h3>
				</div>

				{{-- Progress card --}}
				<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
					@forelse ($modules as $module)
						<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100">
								<div class="flex items-center space-x-2">
									<h2 class="font-medium text-2xl text-slate-800 dark:text-gray-50">
										{{ $module->course->name }}
									</h2>
									<img src="{{ asset('storage/' . $module->course->cover_path) }}" alt="{{ $module->course->name }}"
										class="h-8 w-auto">
								</div>

								<span class="text-sm text-emerald-500 font-medium">
									{{ $module->title }}
								</span>

								<div class="flex flex-col md:flex-row items-end md:items-center justify-between gap-6 mt-4">
									<div class="w-full flex items-center">
										<div class="h-2.5 w-full bg-slate-200 dark:bg-slate-700 rounded overflow-hidden mr-3">
											<div class="h-2.5 bg-green-600 rounded" style="width: {{ $module->completion_percentage }}%">
											</div>
										</div>
										<span class="font-semibold text-gray-700 dark:text-gray-100">{{ $module->completion_percentage }}%</span>
									</div>
									<a href="{{ route('courses.start', $module) }}"
										class="px-4 py-2 rounded bg-green-600 text-white text-xs font-semibold uppercase tracking-wider">
										{{ $module->completion_percentage < 1 ? 'Mulai' : 'Lanjut' }}
									</a>
								</div>
							</div>
						</div>

					@empty
						<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-800 dark:text-gray-100">
								<div class="flex items-center justify-center space-x-2">
									<p>
										Silahkan mengambil
										<a href="{{ route('language') }}" class="font-semibold text-amber-600 underline">
											Placement Test
										</a>
										untuk memilih Bahasa dan menentukan Level anda.
									</p>
								</div>
							</div>
						</div>
					@endforelse
				</div>
			</div>
		@endcannot

		{{-- @cannot('teacher')
			<div class="py-10">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">Riwayat Quiz</h3>
				</div>

				<div class="grid grid-cols-2 gap-4">
					<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-800 dark:text-gray-100">
							<div class="flex items-center justify-center space-x-2">
								<p>Belum terdapat riwayat belajar</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endcannot --}}

		@can('teacher')
			<div class="py-10">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">Progress Class</h3>
				</div>

				@foreach ($rooms as $room)
					@livewire('users-progress', ['room' => $room], key($room->id))
				@endforeach
			</div>
		@endcan
	</div>
</x-app-layout>
