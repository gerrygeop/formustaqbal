<x-app-layout>
	<div class="max-w-[90rem] mx-auto">
		<div class="py-8">

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
								<x-th>Progress</x-th>
								<x-th>Exp</x-th>
								<x-th>Point</x-th>
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
											<div class="w-48 flex items-center">
												<div class="h-2.5 w-full bg-slate-200 dark:bg-slate-700 rounded overflow-hidden mr-3">
													<div class="h-2.5 bg-green-600 rounded" style="width: {{ $user->completion_percentage }}%">
													</div>
												</div>
												<span class="font-semibold text-gray-700 dark:text-gray-100">{{ $user->completion_percentage }}%</span>
											</div>
										</x-td>
										<x-td>{{ $user->profile->xp ?? '0' }}</x-td>
										<x-td>{{ $user->placementTest->score ?? '0' }}</x-td>
										<x-td>
											<a href="{{ route('rooms.mhs', [$room, $user]) }}"
												class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
												Profil
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
