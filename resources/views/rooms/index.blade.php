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
									<div class="p-0.5 w-fit bg-white border border-green-600/20 rounded-full">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
											<path fill-rule="evenodd"
												d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
												clip-rule="evenodd" />
										</svg>
									</div>
									<p class="text-xl text-gray-600 font-medium">
										Class
									</p>
								</div>
								<h2
									class="font-semibold text-lg md:text-2xl text-slate-700 dark:text-gray-50 group-hover:underline decoration-2 group-hover:underline-offset-2">
									{{ $room->name }}
								</h2>
							</div>

							<div class="flex items-center space-x-2 mt-6 text-sm text-gray-700">
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
