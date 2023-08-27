<div class="max-w-5xl mx-auto w-full h-screen md:h-auto flex flex-col justify-between pb-10">
	<div class="bg-white/80 h-full md:h-auto backdrop-blur border rounded-xl shadow py-8 px-10">
		<div class="flex flex-col">
			<div class="flex items-center justify-between">
				<p class="text-gray-600">
					Question: {{ $currentQuestionIndex + 1 }} / {{ $totalQuestions }}
				</p>
				<p class="text-gray-600 mb-4">
					Time left: 00:00
				</p>
			</div>

			<div class="my-6">
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

				<div class="lg:text-lg text-gray-900">
					{!! $question->question !!}
				</div>
			</div>

			<div class="flex flex-col gap-4 mt-2">
				@if ($question->type == 1)
					<div class="grid grid-cols-1 gap-4" @if ($question->is_choice_rtl) dir="rtl" @endif>
						@foreach ($choiceOrder as $index)
							<label class="text-lg flex items-center gap-x-4">
								@if ($question->choices[$index]->image_path)
									<img src="{{ asset('storage/' . $question->choices[$index]->image_path) }}" alt="choice"
										class="h-24 w-auto border">
								@endif
								<input type="radio" name="question_{{ $question->id }}" wire:model="answers.{{ $question->id }}"
									value="{{ old('choice_id', $question->choices[$index]->id) }}">
								{{ $question->choices[$index]->choice }}
							</label>
						@endforeach
					</div>

					@if ($questionNull)
						<p class="text-red-500">Pastikan jawaban anda telah terisi</p>
					@endif
				@else
					<div>Soal bukan pilihan ganda. Silahkan menuju soal selanjutnya</div>
				@endif
			</div>
		</div>
	</div>

	<div class="flex justify-center px-4 md:px-0 mt-8">
		<button wire:click="nextQuestion"
			class="max-w-3xl w-full bg-white py-3 px-4 text-center text-yellow-500 font-bold uppercase border focus:border-yellow-400 rounded-lg shadow">
			{{ $currentQuestionIndex < $totalQuestions - 1 ? 'Lanjut' : 'Submit' }}
		</button>
	</div>
</div>
