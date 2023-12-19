<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm border rounded-md md:rounded-lg">
	<div class="p-4 md:p-6 text-gray-700 dark:text-gray-50 h-full">
		<div class="flex flex-col gap-2">
			<div class="flex items-center space-x-2 mb-3">
				<img src="{{ asset('storage/' . $room->module->course->cover_path) }}" alt="{{ $room->module->course->name }}"
					class="h-6 w-auto">
				<h2 class="font-medium text-base">
					{{ $room->module->course->name }}
				</h2>
			</div>

			<h2 class="font-semibold text-lg lg:text-xl">
				Class {{ $room->name }}
			</h2>
		</div>
	</div>

	<div class="border-t"></div>

	<div class="p-4 md:p-6 h-full">
		<nav class="flex flex-col gap-y-2 divide-y">
			<a href="{{ route('rooms.show', $room) }}" @class([
				'py-2 flex items-center justify-between text-gray-400',
				'text-gray-700' => request()->routeIs('rooms.show'),
			])>
				<span>Daftar Mahasiswa</span>
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-5 h-5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
					</svg>
				</span>
			</a>
			<a href="{{ route('rooms.nilai.list', $room) }}" @class([
				'py-2 flex items-center justify-between text-gray-400',
				'text-gray-700' => request()->routeIs('rooms.nilai.*'),
			])>
				<span>Nilai</span>
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-5 h-5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
					</svg>
				</span>
			</a>
			<a href="{{ route('rooms.form.index', $room) }}" @class([
				'py-2 flex items-center justify-between text-gray-400',
				'text-gray-700' => request()->routeIs('rooms.form.*'),
			])>
				<span>Form Input Nilai</span>
				<span>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-5 h-5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
					</svg>
				</span>
			</a>
		</nav>
	</div>
</div>
