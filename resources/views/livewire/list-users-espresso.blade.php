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

		<div class="col-span-1 lg:col-span-2 ml-auto">
			<select name="isCompleted" wire:model="isCompleted"
				class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 rounded-md shadow-sm">
				<option value="">-- Is Completed --</option>
				<option value="1">Selesai</option>
				<option value="0">Tidak Selesai</option>
			</select>
		</div>
	</div>

	<section class="mx-auto">
		<div class="flex flex-col mt-4">
			<div class="overflow-x-auto">
				<div class="inline-block min-w-full py-2 align-middle">
					<div class="overflow-hidden shadow border border-gray-200 dark:border-gray-700 md:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
							<thead class="bg-gray-50 dark:bg-gray-800">
								<tr>
									<th scope="col"
										class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										No
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Name
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Username
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Fakultas
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Prodi
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Point
									</th>
									<th scope="col"
										class="px-2 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
										Is completed
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
								@foreach ($users as $user)
									<tr>
										<td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $loop->iteration }}</td>
										<td class="px-2 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
											<h2 class="font-medium text-gray-800 dark:text-white ">
												{{ $user->name }}
											</h2>
										</td>
										<td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $user->username }}</td>
										<td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $user->faculty }}</td>
										<td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $user->department }}</td>
										<td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $user->score }}</td>
										<td class="px-2 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
											@if ($user->is_completed)
												<span
													class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
													Selesai
												</span>
											@else
												<span
													class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
													Tidak Selesai
												</span>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="mt-8">
		{{ $users->links() }}
	</div>
</div>
