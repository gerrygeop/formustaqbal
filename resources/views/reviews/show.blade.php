<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.review.index', [$module, $assessment]) }}"
					class="flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold">Kembali</p>
				</a>
			</div>
		</div>

		<div class="relative">
			<div class="grid grid-cols-1 lg:grid-cols-4 min-h-screen">

				<div class="col-span-1 p-4 md:p-6 lg:p-10 divide-y border-b lg:border-r">
					<div class="pb-5 font-medium">
						<p class="text-lg">{{ $user->name }}</p>
						<p>{{ $user->username ?? '' }}</p>
						<p>{{ $user->email ?? '' }}</p>
					</div>
					<div class="py-5">
						<p class="text-lg">Jumlah Pengerjaan</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $responses->count() }}</span>
					</div>
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto">
						<div class="py-10 px-4 lg:px-0 mb-20">

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $assessment->title }}
							</h2>

							<x-table>
								@slot('thead')
									<x-th>No</x-th>
									<x-th>Waktu</x-th>
									<x-th>Score</x-th>
									<x-th>Status</x-th>
									<th scope="col" class="relative py-3.5 px-4">
										<span class="sr-only">Edit</span>
									</th>
								@endslot

								@slot('tbody')
									@foreach ($responses as $response)
										<tr>
											<x-td>{{ $loop->iteration }}</x-td>
											<x-td>{{ $response->created_at }}</x-td>
											<x-td>
												{{ $response->score ?? '' }}
											</x-td>
											<x-td>
												@if ($response->reviewed)
													<x-badge color="green">
														Sudah direview
													</x-badge>
												@else
													<x-badge color="red">
														Belum direview
													</x-badge>
												@endif
											</x-td>
											<x-td>
												<a href="{{ route('courses.review.edit', [$module, $assessment, $response]) }}"
													class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
													Review
												</a>
											</x-td>
										</tr>
									@endforeach
								@endslot
							</x-table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
