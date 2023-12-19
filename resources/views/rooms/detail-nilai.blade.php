<x-app-layout>
	<div class="max-w-[90rem] mx-auto">
		<div class="py-8" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'list' }" id="tab_wrapper">

			<div class="grid grid-cols-1 lg:grid-cols-5 gap-y-4 lg:gap-y-0 lg:gap-x-4">

				<div class="col-span-1">
					@include('rooms.partials._navigation')
				</div>

				<section class="col-span-1 lg:col-span-4">
					<div>
						<div class="flex items-center justify-between">
							<div>
								<span class="text-gray-900 font-medium inline-flex items-center">
									Nama: {{ $user->name }} ({{ $user->username }})
								</span>
							</div>
						</div>

						<x-table>
							@slot('thead')
								<x-th>No</x-th>
								<x-th>Kategori</x-th>
								<x-th>Judul</x-th>
								<x-th>Nilai</x-th>
								<x-th>Review</x-th>
								<th scope="col" class="relative py-3.5 px-4">
									<span class="sr-only">Edit</span>
								</th>
							@endslot
							@slot('tbody')
								@forelse ($responses as $response)
									<tr>
										<x-td>{{ $loop->iteration }}</x-td>
										<x-td>
											@switch($response->type_assessment)
												@case(1)
													<x-badge color="gray">Kuis</x-badge>
												@break

												@case(3)
													<x-badge color="gray">Tugas</x-badge>
												@break

												@case(4)
													<x-badge color="gray">UTS</x-badge>
												@break

												@case(5)
													<x-badge color="gray">UAS</x-badge>
												@break

												@default
													-
											@endswitch
										</x-td>
										<x-td>
											{{ $response->title_assessment }}
										</x-td>
										<x-td>
											<div class="font-medium">
												{{ $response->score }}
											</div>
										</x-td>
										<x-td>
											@if ($response->reviewed)
												<x-badge color="green">Sudah direview</x-badge>
											@else
												<x-badge color="red">Belum direview</x-badge>
											@endif
										</x-td>
										<x-td>
											<a href="{{ route('courses.review.show', [$room->module, $response->assessment_id, $user]) }}"
												class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
												Edit
											</a>
										</x-td>
									</tr>
									@empty
										<tr>
											<x-td colspan="6">
												<p class="text-sm text-gray-600 italic text-center">Tidak ada riwayat pengerjaan</p>
											</x-td>
										</tr>
									@endforelse
								@endslot
							</x-table>
						</div>

					</section>

				</div>
			</div>

		</div>
	</x-app-layout>
