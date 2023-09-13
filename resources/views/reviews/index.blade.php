<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ url()->previous() }}" class="flex-1 flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold">Kembali</p>
				</a>
			</div>
		</div>

		<div class="relative min-h-screen">
			<div class="grid grid-cols-1 lg:grid-cols-4 min-h-screen">
				<div class="col-span-1 p-4 md:p-6 lg:p-10 divide-y border-b lg:border-r">
					{{-- <div class="pb-5 font-medium">
						<p class="text-xl">{{ $user->name }}</p>
						<p>{{ $user->username ?? '' }}</p>
						<p>{{ $user->email ?? '' }}</p>
					</div>
					<div class="text-xl py-5">
						<p>Total Soal</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $questions->count() }}</span>
					</div> --}}
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto w-full flex flex-col justify-between">
						<div class="py-8 mb-20">

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $assessment->title }}
							</h2>

							@foreach ($rooms as $room)
							@endforeach
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
														<th scope="col" class="relative py-3.5 px-4">
															<span class="sr-only">Edit</span>
														</th>
													</tr>
												</thead>
												<tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">

													@foreach ($room->users as $user)
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
																<a href="{{ route('rooms.mhs', [$room, $user]) }}"
																	class="px-3 py-1 text-gray-700 border transition-colors duration-200 rounded dark:text-gray-300 hover:bg-gray-100">
																	Review
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

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
