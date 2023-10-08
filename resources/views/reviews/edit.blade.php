<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.review.show', [$module, $assessment, $userResponses->user]) }}"
					class="flex items-center gap-x-2 text-gray-600 dark:text-gray-50">
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
				<div class="col-span-1 p-4 md:p-6 lg:p-10 divide-y border-b lg:border-r">
					<div class="pb-5">
						<p class="text-lg font-medium">{{ $userResponses->user->name }}</p>
						<p class="text-gray-600">{{ $userResponses->user->username ?? '' }}</p>
						<p class="text-gray-600">{{ $userResponses->user->email ?? '' }}</p>
					</div>
					<div class="py-5">
						<p class="text-lg">Total Soal</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $questions->count() }}</span>
					</div>
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto">
						<div class="py-8 px-4 lg:px-0 mb-20">

							@if (session('submit-success'))
								<div x-data="{ alert: true }" class="mb-6">
									<div x-show="alert"
										class="flex items-center justify-between w-full rounded-md bg-green-100 px-6 py-5 text-base text-green-700"
										role="alert">
										<div class="inline-flex">
											<span class="mr-2">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
													<path fill-rule="evenodd"
														d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
														clip-rule="evenodd" />
												</svg>
											</span>
											Berhasil disimpan
										</div>

										<button x-on:click="alert = false">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
												<path fill-rule="evenodd"
													d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
													clip-rule="evenodd" />
											</svg>
										</button>
									</div>
								</div>
							@endif

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $assessment->title }}
							</h2>

							<form action="{{ route('quiz.review.update', $userResponses) }}" method="POST" class="py-6">
								@csrf
								@method('PUT')

								<div class="grid grid-cols-1 divide-y">
									@foreach (json_decode($userResponses->responses) as $response)
										<div class="py-6">

											@if ($questions[$response->question_id]->file_path)
												<div class="mb-4">
													@if (str($questions[$response->question_id]->file_path)->endsWith('.mp3'))
														<audio controls class="bg-yellow-400 w-full">
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
												<x-input-label for="point" :value="__('Point')" />
												<x-text-input id="point" name="{{ $response->question_id }}" type="number" min="0"
													class="mt-1 block w-full" :value="old('point', $response->point)" required />
											</div>
										</div>
									@endforeach

								</div>

								<div class="py-10 border-t">
									<x-input-label for="feedback" :value="__('Komentar')" />
									<textarea id="feedback" name="feedback" rows="5"
									 class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 rounded shadow-sm">{{ old('feedback', $userResponses->feedback) }}</textarea>

									<x-input-error class="mt-2" :messages="$errors->get('feedback')" />
								</div>

								<div class="py-6">
									<x-primary-button>
										Submit
									</x-primary-button>
								</div>

							</form>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
