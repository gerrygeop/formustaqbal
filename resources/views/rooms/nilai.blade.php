<x-app-layout>
	<div class="max-w-[90rem] mx-auto">
		<div class="py-8" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'list' }" id="tab_wrapper">

			<div class="grid grid-cols-1 lg:grid-cols-5 gap-y-4 lg:gap-y-0 lg:gap-x-4">

				<div class="col-span-1">
					@include('rooms.partials._navigation')
				</div>

				<section class="col-span-1 lg:col-span-4">
					<div>
						<x-table>
							@slot('thead')
								<x-th>No</x-th>
								<x-th>NIM</x-th>
								<x-th>Nama</x-th>
								<x-th>Prodi</x-th>
								<x-th>Partisipasi</x-th>
								<x-th>Tugas</x-th>
								<x-th>UTS</x-th>
								<x-th>UAS</x-th>
								<th scope="col" class="relative py-3.5 px-4">
									<span class="sr-only">Edit</span>
								</th>
							@endslot
							@slot('tbody')
								@foreach ($users as $user)
									<tr>
										<x-td>{{ $loop->iteration }}</x-td>
										<x-td>
											<div class="font-medium">
												{{ $user->username }}
											</div>
										</x-td>
										<x-td>
											<div class="font-medium">
												{{ $user->name }}
											</div>
										</x-td>
										<x-td>
											{{ $user->siakad ? $user->siakad->department->name : '-' }}
										</x-td>
										<x-td>
											{{ $grade[$user?->id]['partisipasi'] ?? 0 }}
										</x-td>
										<x-td>
											{{ $grade[$user->id][1] ?? 0 }}
										</x-td>
										<x-td>
											{{ $grade[$user->id][4] ?? 0 }}
										</x-td>
										<x-td>
											{{ $grade[$user->id][5] ?? 0 }}
										</x-td>
										<x-td>
											<a href="{{ route('rooms.nilai.detail', [$room, $user]) }}"
												class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
												Detail
											</a>
										</x-td>
									</tr>
								@endforeach
							@endslot
						</x-table>
					</div>
				</section>

			</div>
		</div>

	</div>
</x-app-layout>
