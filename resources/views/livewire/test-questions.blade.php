<div class="max-w-5xl mx-auto w-full">
	<div class="bg-white/80 backdrop-blur border rounded-xl shadow py-8 px-10">

		@if ($questions->isNotEmpty())
			<div class="flex flex-col">
				<div class="flex items-center justify-between mb-2">
					<p class="text-gray-600 font-semibold">
						Question: {{ $questionIndex + 1 }} of {{ $questions->count() }}
					</p>
					<p class="text-gray-600 font-semibold mb-4">
						<x-question-type :type="$question->type" />
					</p>
				</div>

				<div class="my-4">
					@if ($question->file_path)
						<div class="mb-4">
							@if ($question->type == 3)
								<audio controls class="bg-yellow-400" id="player">
									<source src="{{ asset('storage/' . $question->file_path) }}" type="audio/mpeg">
								</audio>
							@else
								<img src="{{ asset('storage/' . $question->file_path) }}" alt="Image">
							@endif
						</div>
					@endif

					<p class="text-xl lg:text-2xl text-gray-700 font-medium">
						{{ $question->question }}
					</p>
				</div>

				<div class="flex flex-col gap-4">
					@if ($question->type == 1)
						@foreach ($question->choices->options as $choice)
							<label class="text-lg font-medium">
								<input type="radio" name="choice_{{ $question->id }}" wire:model="answers.{{ $question->id }}"
									value="{{ $choice['choice'] }}"> {{ $choice['choice'] }}
							</label>
						@endforeach
					@elseif ($question->type == 2 || $question->type == 3)
						<x-textarea name="response_{{ $question->id }}" cols="30" rows="10"
							placeholder="Tuliskan jawaban anda..." wire:model="answers.{{ $question->id }}" />
					@elseif ($question->type == 4)
						<div class="p-4 rounded-lg bg-white shadow">
							<span class="mb-4">Upload Audio</span>
							<input type="file" name="response_{{ $question->id }}" wire:model="answers.{{ $question->id }}.speaking"
								class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" />
						</div>
					@endif

					@if ($questionNull)
						<p class="text-red-500">Pastikan anda jawaban anda telah terisi</p>
					@endif
					@error('answers.*.speaking')
						<span class="text-red-500">{{ $message }}</span>
					@enderror
				</div>
			</div>
		@endif
	</div>

	<div class="flex justify-center mt-8">
		@if ($questionIndex == $questions->count() - 1)
			<button wire:click.prevent="submitAnswers"
				class="max-w-3xl w-full bg-gray-200 py-3 px-4 text-yellow-500 font-bold uppercase border focus:border-yellow-400 rounded-lg shadow">
				Submit
			</button>
		@else
			<button wire:click.prevent="nextQuestion" type="button"
				class="max-w-3xl w-full bg-gray-200 py-3 px-4 text-yellow-500 font-bold uppercase border focus:border-yellow-400 rounded-lg shadow">
				Lanjut
			</button>
		@endif
	</div>
</div>
