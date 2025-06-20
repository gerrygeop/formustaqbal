<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.start', $module) }}" class="flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold">Kembali</p>
				</a>
			</div>
		</div>

		<div class="relative min-h-screen">
			<div class="grid grid-cols-1 lg:grid-cols-4">
				<div class="col-span-1 p-4 md:p-6 lg:p-8 border-b lg:border-r">
					<div class="pb-5 border-b">
						<p class="text-lg">Total soal dijawab</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $questions->count() }}</span>
					</div>
					<div class="py-5">
						<p class="text-gray-600 mb-1">Komentar</p>
						<p class="border py-4 px-4 bg-white">
							{{ $userResponses->feedback }}
						</p>
					</div>
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto">
						<div class="py-8 px-4 lg:px-0 mb-20">

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $chapter->assessment->title }}
							</h2>

							<div class="grid grid-cols-1 divide-y py-6">
								@foreach (json_decode($userResponses->responses) as $response)
									<div class="py-6">

										@if ($questions[$response->question_id]->file_path)
											<div class="mb-4">
												@if (str($questions[$response->question_id]->file_path)->endsWith('.mp3') ||
														str($questions[$response->question_id]->file_path)->endsWith('.ogg'))
													<audio controls class="bg-yellow-400 w-full">
														<source src="{{ asset('storage/' . $questions[$response->question_id]->file_path) }}" type="audio/ogg">
														<source src="{{ asset('storage/' . $questions[$response->question_id]->file_path) }}" type="audio/mpeg">
														Your browser does not support the audio element.
													</audio>
												@else
													<img src="{{ asset('storage/' . $questions[$response->question_id]->file_path) }}" alt="Image"
														class="h-48 w-auto border">
												@endif
											</div>
										@endif

										<div class="font-medium text-lg text-gray-900 mb-4">
											{!! $questions[$response->question_id]->question !!}
										</div>

										@if ($questions[$response->question_id]->type == 1)
											<div class="grid grid-cols-1 gap-4" @if ($questions[$response->question_id]->is_choice_rtl) dir="rtl" @endif>
												@foreach ($questions[$response->question_id]->choices as $choice)
													<div class="text-lg flex items-center gap-x-4">

														@if ($response->answer == $choice->id && $choice->is_correct)
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
																stroke="currentColor" class="w-7 h-7 text-green-600">
																<path stroke-linecap="round" stroke-linejoin="round"
																	d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
															</svg>
														@elseif ($response->answer == $choice->id && !$choice->is_correct)
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
																stroke="currentColor" class="w-7 h-7 text-red-600">
																<path stroke-linecap="round" stroke-linejoin="round"
																	d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
															</svg>
														@else
															<div class="w-5 h-5 mx-1 bg-gray-200 rounded"></div>
														@endif

														@if ($choice->image_path)
															@if (str($choice->image_path)->endsWith('.mp3') || str($choice->image_path)->endsWith('.ogg'))
																<audio controls class="bg-yellow-400 rounded-lg">
																	<source src="{{ asset('storage/' . $choice->image_path) }}" type="audio/ogg">
																	<source src="{{ asset('storage/' . $choice->image_path) }}" type="audio/mpeg">
																	Your browser does not support the audio element.
																</audio>
															@else
																<img src="{{ asset('storage/' . $choice->image_path) }}" alt="choice" class="h-24 w-auto border">
															@endif
														@endif

														<span @class([
															'font-semibold' => $response->answer == $choice->id,
														])>
															{{ $choice->choice }}
														</span>

													</div>
												@endforeach
											</div>
										@elseif ($questions[$response->question_id]->type == 2 || $questions[$response->question_id]->type == 3)
											<div class="bg-gray-50 border rounded p-4">
												<p>{{ $response->answer }}</p>
											</div>
										@elseif ($questions[$response->question_id]->type == 4)
											@if (str($response->answer)->endsWith('.mp3') || str($response->answer)->endsWith('.ogg'))
												<audio controls class="bg-yellow-400 w-full">
													<source src="{{ asset('storage/' . $response->answer) }}" type="audio/ogg">
													<source src="{{ asset('storage/' . $response->answer) }}" type="audio/mpeg">
													Your browser does not support the audio element.
												</audio>
											@else
												<img src="{{ asset('storage/' . $response->answer) }}" alt="Image" class="h-48 w-auto border">
											@endif
										@else
											<div>Terjadi kesalahan saat membuat soal.</div>
										@endif

										<div class="my-8 p-4 border rounded-lg bg-amber-50">
											<x-input-label :value="__('Point')" />
											<div class="mt-1 block w-full font-semibold text-xl"> {{ $response->point ?? '-' }} </div>
										</div>
									</div>
								@endforeach

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
