<x-app-layout>
	<div class="max-w-6xl mx-auto">
		<div class="mb-6">
			<a href="{{ route('courses.modules.show', $module) }}"
				class="w-fit flex items-center px-4 py-2 text-sm bg-gray-50 hover:bg-white rounded-lg hover:shadow transition-all duration-150">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="w-5 h-5 mr-2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
				</svg>
				<span>Kembali</span>
			</a>
		</div>

		<div class="grid grid-cols-1 lg:grid-cols-4 gap-y-6 lg:gap-y-10 lg:gap-x-6 mb-16 divide-y">
			<div class="col-span-1 lg:col-span-3 bg-white rounded-lg shadow p-6">
				<div>
					<p class="text-sm text-gray-600 mb-2">
						@switch($assessment->type)
							@case(1)
								Quiz
							@break

							@case(3)
								Exam
							@break

							@case(4)
								UTS
							@break

							@case(5)
								Ujian Akhir
							@break

							@default
								-
						@endswitch
					</p>
					<h3 class="font-medium text-gray-800 text-lg">
						{{ $assessment->assessmentable->submodule->title }}
					</h3>
					<h3 class="font-medium text-gray-800 text-lg">
						{{ $assessment->assessmentable->title }} - {{ $assessment->title }}
					</h3>
				</div>

				@if ($assessment->instruction)
					<div class="mt-8">
						<p class="text-sm text-gray-600 mb-2">Instruksi:</p>

						<div class="prose">
							{!! $assessment->instruction !!}
						</div>
					</div>
				@endif
			</div>

			<div class="col-span-1 bg-white rounded-lg shadow p-6">
				<div class="flex flex-col items-center justify-center text-center">
					<h5 class="text-xl text-gray-600 font-medium mb-1">Total Pertanyaan</h5>
					<h2 class="text-4xl text-gray-800 font-semibold">
						{{ $assessment->question_limit ?? $assessment->questions->count() }}
					</h2>
				</div>
			</div>

			<div class="col-span-full">
				<div class="py-8 mb-20" x-data="{ currentTab: {{ $rooms[0]->id }}, activeTab: 'text-amber-600 bg-white shadow', inactiveTab: 'text-gray-600' }">

					<div class="flex items-center justify-center">
						<div class="bg-gray-200 p-1 rounded-lg">
							@foreach ($rooms as $room)
								<button class="px-4 py-2 font-medium text-sm rounded-lg" @click="currentTab = {{ $room->id }}"
									:class="currentTab == {{ $room->id }} ? activeTab : inactiveTab">
									{{ $room->name }}
								</button>
							@endforeach
						</div>
					</div>

					@foreach ($rooms as $room)
						<div x-show="currentTab == {{ $room->id }}">
							<div class="mt-3">

								<x-table>
									@slot('thead')
										<x-th>No</x-th>
										<x-th>NIM</x-th>
										<x-th>Nama</x-th>
										<x-th>Prodi</x-th>
										<th scope="col" class="relative py-3.5 px-4">
											<span class="sr-only">Edit</span>
										</th>
									@endslot

									@slot('tbody')
										@foreach ($room->users->sortDesc() as $user)
											@if ($user->pivot->type == 0)
												<tr>
													<x-td>{{ $loop->iteration }}</x-td>
													<x-td>
														<div class="font-medium">
															{{ $user->username }}
														</div>
													</x-td>
													<x-td>{{ $user->name }}</x-td>
													<x-td>
														{{ $user->siakad ? $user->siakad->department->name : '-' }}
													</x-td>
													<x-td>
														<a href="{{ route('courses.review.show', [$module, $assessment, $user]) }}"
															class="px-3 py-1 text-amber-600 dark:text-gray-300 hover:underline transition-all duration-200">
															Lihat
														</a>
													</x-td>
												</tr>
											@endif
										@endforeach
									@endslot
								</x-table>
							</div>
						</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</x-app-layout>
