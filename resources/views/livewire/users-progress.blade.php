<section class="container mx-auto bg-white p-4 lg:p-6 rounded-lg shadow-sm">

	<div class="flex items-center justify-between bg-white rounded-lg">
		<div
			class="inline-flex items-center rounded-md bg-yellow-50 px-3 py-1 text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
			Class:
			<a href="{{ route('rooms.show', $room) }}" class="ml-2 font-semibold hover:underline">
				{{ $room->name }}
			</a>
		</div>

		<a href="{{ route('rooms.show', $room) }}" class="py-1 px-3 border rounded hover:bg-gray-50">
			Detail
		</a>
	</div>

	<div class="flex flex-col mt-4">
		<div class="w-full flex items-center">
			<div class="h-2.5 w-full bg-slate-200 dark:bg-slate-700 rounded overflow-hidden mr-3">
				<div class="h-2.5 bg-green-600 rounded" style="width: {{ $overallProgress }}%">
				</div>
			</div>
			<span class="font-semibold text-gray-700 dark:text-gray-100">{{ $overallProgress }}%</span>
		</div>
	</div>
</section>
