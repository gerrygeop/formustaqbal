<?php

namespace App\Http\Livewire;

use App\Models\AssessmentUser;
use App\Models\UserResponses;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssessmentQuestions extends Component
{
    use WithFileUploads;

    public $chapter;
    public $assessment;

    public $totalQuestions;
    public $question;
    public $questions;
    public $questionNull = false;
    public $currentQuestionIndex = 0;
    public $choiceOrder = [];
    public $answeredQuestions = [];
    public $answers = [];

    public $endTime;

    protected $rules = [
        'answers.*.speaking' => 'file|mimetypes:audio/mpeg,audio/ogg|max:5024',
    ];
    protected $messages = [
        'answers.*.speaking' => 'The Audio file must be a file of type: mpeg, ogg.',
    ];


    public function mount()
    {
        if (session()->has('current_question_index')) {
            $this->currentQuestionIndex = session('current_question_index');
        }

        $this->loadQuestion();

        if ($this->assessment->duration_minutes > 0) {
            if (!session()->has('end_time')) {
                session(['end_time' => now()->addMinutes($this->assessment->duration_minutes)]);
            }

            $this->endTime = session('end_time');
        }
    }

    public function render()
    {
        if ($this->assessment->duration_minutes > 0) {
            $timer = $this->getRemainingTime();
        } else {
            $timer = null;
        }

        return view('livewire.assessment-questions', [
            'currentQuestionIndex' => $this->currentQuestionIndex,
            'remainingTime' => $timer,
        ]);
    }

    public function getRemainingTime()
    {
        $currentTime = now();
        $remainingTime = $this->endTime->diffInSeconds($currentTime);

        if ($remainingTime <= 0 || $this->endTime < now()) {
            if ($this->assessment->duration_minutes > 0) {
                $this->resetSessionData();
                $this->finishAssessment();
            }
        }

        return max($remainingTime, 0); // Pastikan waktu tidak negatif
    }

    public function loadQuestion()
    {
        $this->loadQuestionsFromSession();
        $this->totalQuestions = $this->questions->count();

        $availableQuestions = $this->getAvailableQuestions();

        if ($availableQuestions->isEmpty()) {
            $this->question = null;
        } else {
            $this->loadCurrentQuestion($availableQuestions);
        }
    }

    private function loadQuestionsFromSession()
    {
        if (session()->has('random_questions')) {
            $this->questions = session('random_questions');
        } else {
            $this->loadRandomQuestions();
            session(['random_questions' => $this->questions]);
        }
    }

    private function loadRandomQuestions()
    {
        if ($this->assessment->is_random_questions) {
            $this->questions = $this->assessment
                ->questions()
                ->inRandomOrder()
                ->limit($this->assessment->question_limit)
                ->with('choices')
                ->get();
        } else {
            $this->questions = $this->assessment
                ->questions()
                ->limit($this->assessment->question_limit)
                ->with('choices')
                ->get();
        }
    }

    private function getAvailableQuestions()
    {
        return $this->questions->whereNotIn('id', $this->answeredQuestions);
    }

    private function loadCurrentQuestion($availableQuestions)
    {
        $this->question = $availableQuestions[$this->currentQuestionIndex];

        if ($this->question->type == 1) {
            $this->choiceOrder = $this->randomizeChoiceOrder($this->question->choices);
        }
    }

    private function randomizeChoiceOrder($choices)
    {
        $order = range(0, count($choices) - 1);
        if ($this->assessment->is_random_choices) {
            shuffle($order);
        }
        return $order;
    }

    public function nextQuestion()
    {
        if ($this->validateAnswer()) {
            $this->recordAnsweredQuestionId();
            $this->updateCurrentQuestionIndex();

            if ($this->currentQuestionIndex >= $this->totalQuestions) {
                $this->resetSessionData();
                $this->finishAssessment();
            } else {
                $this->loadQuestion();
            }
        }
    }

    private function recordAnsweredQuestionId()
    {
        if (session()->has('answered_questions')) {
            session()->push('answered_questions', $this->question->id);
            $this->answeredQuestions = session('answered_questions');
        } else {
            session()->put('answered_questions', [$this->question->id]);
            $this->answeredQuestions = [$this->question->id];
        }
    }

    private function updateCurrentQuestionIndex()
    {
        $this->currentQuestionIndex++;
        session(['current_question_index' => $this->currentQuestionIndex]);
    }

    private function resetSessionData()
    {
        session()->forget([
            'current_question_index',
            'random_questions',
            'answered_questions',
            'end_time',
        ]);
    }

    public function validateAnswer()
    {
        if (!isset($this->answers[$this->question->id])) {
            $this->questionNull = true;
            return false;
        } else {
            $this->questionNull = false;
            $response['responses']['question_id'] = $this->question->id;
            $response['responses']['question_type'] = $this->question->type;

            if ($this->question->type == 1) { // Jika question pilihan ganda
                $userChoice = (int) $this->answers[$this->question->id];
                $choice = $this->question->choices->where('id', $userChoice)->first();

                $response['responses']['answer'] = $userChoice;

                if ($choice) {
                    if ($choice->is_correct) {
                        $response['responses']['point'] = $this->question->point;
                    } else {
                        $response['responses']['point'] = 0;
                    }
                }
            } else if ($this->question->type = 4 && isset($this->answers[$this->question->id]['speaking'])) { // Speaking
                $this->validate();

                $audioFile = $this->answers[$this->question->id]['speaking'];
                $audioFileName = $audioFile->store('speaking-question', 'public');
                $response['responses']['answer'] = $audioFileName;
                $response['responses']['point'] = 0;
            } else {
                $answer_text = $this->answers[$this->question->id];
                $response['responses']['answer'] = $answer_text;
                $response['responses']['point'] = 0;
            }

            $this->saveAnswer($response);

            return true;
        }
    }

    public function saveAnswer($response)
    {
        session()->push('responses', $response['responses']);
    }

    public function finishAssessment()
    {
        DB::transaction(function () {
            $userResponses = new UserResponses();
            $userResponses->user_id = auth()->id();
            $userResponses->assessment_id = $this->assessment->id;

            if (session()->has('responses')) {
                $userResponses->responses = json_encode(session('responses'));

                session()->forget('responses');
            }

            $userResponses->save();

            $assUser = AssessmentUser::where('assessment_id', $this->assessment->id)->where('user_id', auth()->id())->first();
            $assUser->update([
                'is_completed' => true
            ]);
        });

        return to_route('courses.learn', [$this->chapter->submodule->module, $this->chapter])->with('finished', 'Terima kasih telah mengerjakan, nilai anda akan keluar setelah direview');
    }
}
