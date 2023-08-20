<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Test;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestQuestions extends Component
{
    use WithFileUploads;

    public $test;
    public $questions;
    public $questionNull = false;
    public $currentQuestion;
    public $questionIndex = 0;
    public $answers = [];

    protected $messages = [
        'answers.*.speaking' => 'The Audio file must be a file of type: audio/mpeg, audio/ogg.',
    ];

    public function mount(Test $test)
    {
        $this->test = $test;
        $this->loadQuestions();
    }

    public function loadQuestions()
    {
        $this->questions = $this->test->questions()
            ->with('choices')
            ->get();

        if ($this->questions->isNotEmpty()) {
            $this->currentQuestion = $this->questions[0];
        }
    }

    public function render()
    {
        return view('livewire.test-questions', [
            'question' => $this->currentQuestion
        ]);
    }

    public function nextQuestion()
    {
        if ($this->saveAnswer($this->currentQuestion->id)) {
            $currentIndex = $this->questions->search(function ($question) {
                return $question->id === $this->currentQuestion->id;
            });

            if ($currentIndex !== false && $currentIndex < $this->questions->count() - 1) {
                $this->questionIndex = $currentIndex + 1;
                $this->currentQuestion = $this->questions[$currentIndex + 1];
            }
        }
    }

    public function saveAnswer($questionId)
    {
        if (!isset($this->answers[$questionId])) {
            $this->questionNull = true;
            return false;
        } else {
            $this->questionNull = false;
            $response = [
                'question_id' => $questionId,
                'question_type' => $this->currentQuestion->type,
                'point' => $this->currentQuestion->point,
            ];


            if ($this->currentQuestion->type == 4 && isset($this->answers[$questionId]['speaking'])) {

                $this->validate([
                    'answers.*.speaking' => 'file|mimetypes:audio/mpeg,audio/ogg|max:5024', // 5MB Max
                ]);

                $audioFile = $this->answers[$questionId]['speaking'];
                $audioFileName = $audioFile->store('speaking-test', 'public');
                $response['response'] = '-';
                $response['file_path'] = $audioFileName;
            } else {
                $response['response'] = $this->answers[$questionId];
                $response['file_path'] = '-';
            }

            $this->answers[$questionId] = $response;

            return true;
        }
    }

    public function submitAnswers()
    {
        if ($this->saveAnswer($this->currentQuestion->id)) {
            DB::transaction(function () {

                $answerData = [];
                foreach ($this->answers as $value) {
                    $answerData[] = $value;
                }
                $answerData = collect($answerData)->toArray();

                $answer = new Answer();
                $answer->user_id = auth()->user()->id;
                $answer->answer = $answerData;

                $this->test->answers()->save($answer);
            });

            return redirect()->to('/dashboard');
        }
    }
}
