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
			<div class="grid grid-cols-1 lg:grid-cols-4">
				<div class="col-span-1 p-4 md:p-6 lg:p-10 divide-y border-b lg:border-r">
					<div class="pb-5 font-medium">
						<p class="text-xl">{{ $user->name }}</p>
						<p>{{ $user->username ?? '' }}</p>
						<p>{{ $user->email ?? '' }}</p>
					</div>
					<div class="text-xl py-5">
						<p>Total Soal</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $answers->count() }}</span>
					</div>
					<div class="text-xl py-5">
						<p>Jawaban Benar</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $correctAnswer }}</span>
					</div>
					<div class="text-xl py-5">
						<p>Jawaban Salah</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $incorrectAnswer }}</span>
					</div>
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto w-full flex flex-col justify-between">
						<div class="py-8 mb-20">

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $assessment->title }}
							</h2>

							<div class="p-10">
								<div class="grid grid-cols-1 divide-y">
									@foreach ($answers as $answer)
										<div class="py-10">

											@if ($answer->question->file_path)
												<div class="mb-4">
													@if (str($answer->question->file_path)->endsWith('.mp3'))
														<audio controls class="bg-yellow-400 w-full">
															<source src="{{ asset('storage/' . $answer->question->file_path) }}" type="audio/mpeg">
															Your browser does not support the audio element.
														</audio>
													@else
														<img src="{{ asset('storage/' . $answer->question->file_path) }}" alt="Image"
															class="h-48 w-auto border">
													@endif
												</div>
											@endif

											<div class="font-semibold text-lg text-gray-800 mb-4">
												{!! $answer->question->question !!}
											</div>

											@if ($answer->question->type == 1)
												<div class="grid grid-cols-1 gap-4" @if ($answer->question->is_choice_rtl) dir="rtl" @endif>
													@foreach ($answer->question->choices as $choice)
														<div class="text-lg flex items-center gap-x-4">

															@if ($answer->choice_id == $choice->id && $choice->is_correct)
																<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
																	stroke="currentColor" class="w-7 h-7 text-green-600">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
																</svg>
															@elseif ($answer->choice_id == $choice->id && !$choice->is_correct)
																<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
																	stroke="currentColor" class="w-7 h-7 text-red-600">
																	<path stroke-linecap="round" stroke-linejoin="round"
																		d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
																</svg>
															@else
																<div class="w-5 h-5 mx-1 bg-gray-200 rounded"></div>
															@endif

															@if ($choice->image_path)
																<img src="{{ asset('storage/' . $choice->image_path) }}" alt="choice" class="h-24 w-auto border">
															@endif

															<span @class(['font-semibold' => $answer->choice_id == $choice->id])>
																{{ $choice->choice }}
															</span>
														</div>
													@endforeach
												</div>
											@elseif ($answer->question->type == 2 || $answer->question->type == 3)
												<p>{{ $answer_text }}</p>
											@elseif ($answer->question->type == 4)
												@if (str($answer->question->file_path)->endsWith('.mp3'))
													<audio controls class="bg-yellow-400 w-full">
														<source src="{{ asset('storage/' . $answer->question->file_path) }}" type="audio/mpeg">
														Your browser does not support the audio element.
													</audio>
												@else
													<img src="{{ asset('storage/' . $answer->question->file_path) }}" alt="Image"
														class="h-48 w-auto border">
												@endif
											@else
												<div>Terjadi kesalahan saat membuat soal.</div>
											@endif
										</div>
									@endforeach
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</x-app-layout>
