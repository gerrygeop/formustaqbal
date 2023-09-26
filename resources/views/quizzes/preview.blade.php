<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">
		<div class="sticky top-0 bg-white dark:bg-gray-800 py-3 md:py-4 px-4 md:px-8 z-[51] shadow">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.learn', [$chapter->submodule->module->id, $chapter]) }}"
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
				<div class="col-span-1 p-4 md:p-6 lg:p-8 border-b lg:border-r">
					<div class="pb-5 border-b">
						<p class="text-lg">Total soal</p>
						<span class="font-semibold text-4xl text-amber-500">{{ $questions->count() }}</span>
					</div>
				</div>

				<div class="col-span-1 lg:col-span-3 bg-white">
					<div class="max-w-5xl mx-auto">
						<div class="py-8 px-4 lg:px-0 mb-20">

							<h2 class="font-semibold text-2xl text-gray-700">
								{{ $chapter->assessment->title }}
							</h2>

							<div class="grid grid-cols-1 divide-y py-6">
								@foreach ($questions as $question)
									<div class="py-6">

										@if ($question->file_path)
											<div class="mb-4">
												@if (str($question->file_path)->endsWith('.mp3'))
													<audio controls class="bg-yellow-400 w-full">
														<source src="{{ asset('storage/' . $question->file_path) }}" type="audio/mpeg">
														Your browser does not support the audio element.
													</audio>
												@else
													<img src="{{ asset('storage/' . $question->file_path) }}" alt="Image" class="h-48 w-auto border">
												@endif
											</div>
										@endif

										<div class="font-medium text-lg text-gray-900 mb-4">
											{!! $question->question !!}
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
