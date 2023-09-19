<x-app-layout>
	<div class="max-w-7xl mx-auto">
		<div class="py-8">

			<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

				@foreach ($rooms as $room)
					<a href="{{ route('rooms.show', $room) }}"
						class="col-span-1 group bg-white dark:bg-gray-800 overflow-hidden shadow-sm border hover:shadow hover:-translate-y-0.5 rounded-md md:rounded-lg transition duration-200">
						<div class="p-4 md:p-6 text-gray-900 dark:text-gray-100 h-full">

							<div class="flex flex-col gap-2">
								<div class="flex items-center space-x-2">
									<img src="{{ asset('storage/' . $room->module->course->cover_path) }}" alt="{{ $room->module->course->name }}"
										class="h-6 w-auto">
									<h2 class="font-medium text-lg text-slate-700 dark:text-gray-50">
										{{ $room->module->course->name }}
									</h2>
								</div>
								<h2
									class="font-semibold text-lg md:text-2xl text-slate-700 dark:text-gray-50 group-hover:underline decoration-2 group-hover:underline-offset-2">
									{{ $room->name }}
								</h2>
							</div>

							<div class="flex items-center space-x-2 mt-3 text-sm text-gray-700">
								<div class="border rounded-md px-2 py-1">
									<span>{{ $room->users_count }} Mahasiswa</span>
								</div>
							</div>
						</div>
					</a>
				@endforeach

			</div>

		</div>
	</div>
</x-app-layout>
