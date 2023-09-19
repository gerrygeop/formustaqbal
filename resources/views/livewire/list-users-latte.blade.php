<div class="mt-10">
	<div class="grid grid-cols-1 lg:grid-cols-4">
		<div class="col-span-1 lg:col-span-2 order-first flex rounded-md">
			<span
				class="inline-flex items-center px-2 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
				</svg>
			</span>

			<x-text-input type="search" wire:model="search" class="w-full border-l-0 rounded-none rounded-r-md"
				placeholder="Cari Nama" />
		</div>
	</div>

	<section class="mx-auto">
		<div class="mt-6">

			<x-table>
				@slot('thead')
					<x-th>No</x-th>
					<x-th>Name</x-th>
					<x-th>Userame</x-th>
					<x-th>Fakultas</x-th>
					<x-th>Prodi</x-th>
				@endslot
				@slot('tbody')
					@foreach ($users as $user)
						<tr>
							<x-td>{{ $loop->iteration }}</x-td>
							<x-td>
								<h2 class="font-medium text-gray-800 dark:text-white ">
									{{ $user->name }}
								</h2>
							</x-td>
							<x-td>{{ $user->username }}</x-td>
							<x-td>{{ $user->faculty }}</x-td>
							<x-td>{{ $user->department }}</x-td>
						</tr>
					@endforeach
				@endslot
			</x-table>

		</div>
	</section>

	<div class="mt-8">
		{{ $users->links() }}
	</div>
</div>
