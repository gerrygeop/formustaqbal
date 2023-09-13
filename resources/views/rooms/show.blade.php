<x-app-layout>
	<div class="max-w-7xl mx-auto">
		<div class="py-8">

			<section class="container px-4 mx-auto">
				<h2 class="text-lg font-medium text-gray-800 dark:text-white">
					Class: {{ $room->name }}
				</h2>

				<div class="flex flex-col mt-6">
					<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
						<div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
							<div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">

								<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
									<thead class="bg-gray-50 dark:bg-gray-800">
										<tr>
											<th scope="col"
												class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
												Prodi
											</th>
											<th scope="col"
												class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
												Progress
											</th>
											<th scope="col"
												class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
												Exp
											</th>
											<th scope="col"
												class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
												Point
											</th>
											<th scope="col" class="relative py-3.5 px-4">
												<span class="sr-only">Edit</span>
											</th>
										</tr>
									</thead>
									<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

										@foreach ($users as $user)
											<tr>
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white whitespace-nowrap">
													{{ $loop->iteration }}
												</td>
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white font-medium whitespace-nowrap">
													{{ $user->username }}
												</td>
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white font-medium whitespace-nowrap">
													{{ $user->name }}
												</td>
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white whitespace-nowrap">
													{{ $user->siakad ? $user->siakad->department->name : '-' }}
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
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white whitespace-nowrap">
													{{ $user->profile->xp ?? '0' }}
												</td>
												<td class="px-4 py-4 text-sm text-gray-800 dark:text-white whitespace-nowrap">
													{{ $user->placementTest->score ?? '0' }}
												</td>
												<td class="px-4 py-4 text-sm whitespace-nowrap">
													<a href="{{ route('rooms.mhs', [$room, $user]) }}"
														class="px-3 py-1 text-gray-700 border transition-colors duration-200 rounded dark:text-gray-300 hover:bg-gray-100">
														Lihat
													</a>
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

		</div>
	</div>
</x-app-layout>
