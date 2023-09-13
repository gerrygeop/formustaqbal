<section class="container mx-auto">
	<h2 class="font-medium text-gray-600 dark:text-white">
		<span
			class="inline-flex items-center rounded-md bg-yellow-50 px-3 py-1 text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
			Class:
			<a href="{{ route('rooms.show', $room) }}" class="ml-2 font-semibold hover:underline">
				{{ $room->name }}
			</a>
		</span>
	</h2>

	<div class="flex flex-col mt-3">
		<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
				<div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

					<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
						<thead class="bg-gray-50 dark:bg-gray-800">
							<tr>
								<th scope="col"
									class="px-6 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
									No
								</th>
								<th scope="col"
									class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
									NIM
								</th>
								<th scope="col"
									class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
									Nama
								</th>
								<th scope="col"
									class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
									Progress
								</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

							@foreach ($users as $user)
								<tr>
									<td class="px-6 py-4 text-sm text-gray-800 dark:text-white whitespace-nowrap">
										{{ $loop->iteration }}
									</td>
									<td class="px-4 py-4 text-sm text-gray-800 dark:text-white font-medium whitespace-nowrap">
										{{ $user->username }}
									</td>
									<td class="px-4 py-4 text-sm text-gray-800 dark:text-white font-medium whitespace-nowrap">
										{{ $user->name }}
									</td>
									<td class="px-4 py-4 text-sm whitespace-nowrap">
										<div class="w-48 flex items-center">
											<div class="h-2.5 w-full bg-slate-200 dark:bg-slate-700 rounded overflow-hidden mr-3">
												<div class="h-2.5 bg-green-600 rounded" style="width: {{ $user->completion_percentage }}%">
												</div>
											</div>
											<span class="font-semibold text-gray-700 dark:text-gray-100">{{ $user->completion_percentage }}%</span>
										</div>
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
