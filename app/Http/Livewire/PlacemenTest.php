<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PlacemenTest extends Component
{
    public $assessment;
    public $totalQuestions;
    public $question;
    public $questions;
    public $questionNull = false;
    public $choiceOrder = [];
    public $currentQuestionIndex = 0;
    public $answeredQuestions = [];
    public $answers = [];

    public $endTime;

    public function mount()
    {
        if (session()->has('current_question_index')) {
            $this->currentQuestionIndex = session('current_question_index');
        }

        $this->loadQuestion();

        if (!session()->has('end_time')) {
            session(['end_time' => now()->addMinutes($this->assessment->duration_minutes)]);
        }

        $this->endTime = session('end_time');
    }

    public function getRemainingTime()
    {
        $currentTime = now();
        $remainingTime = $this->endTime->diffInSeconds($currentTime);

        if ($remainingTime <= 0 || $this->endTime < now()) {
            $this->resetSessionData();
            $this->finishAssessment();
        }

        return max($remainingTime, 0); // Pastikan waktu tidak negatif
    }

    public function render()
    {
        return view('livewire.placemen-test', [
            'currentQuestionIndex' => $this->currentQuestionIndex,
            'remainingTime' => $this->getRemainingTime(),
        ]);
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
        $this->questions = $this->assessment
            ->questions()
            ->inRandomOrder()
            ->limit($this->assessment->question_limit)
            ->with('choices')
            ->get();
    }

    private function getAvailableQuestions()
    {
        return $this->questions->whereNotIn('id', $this->answeredQuestions);
    }

    private function loadCurrentQuestion($availableQuestions)
    {
        $this->question = $availableQuestions[$this->currentQuestionIndex];
        $this->choiceOrder = $this->randomizeChoiceOrder($this->question->choices);
    }

    private function randomizeChoiceOrder($choices)
    {
        $order = range(0, count($choices) - 1);
        shuffle($order);
        return $order;
    }

    public function nextQuestion()
    {
        if ($this->validateAnswer($this->question->id)) {
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

    public function validateAnswer($questionId)
    {
        if (!isset($this->answers[$questionId])) {
            $this->questionNull = true;
            return false;
        } else {
            $this->questionNull = false;
            $response['user_id'] = auth()->id();
            $response['assessment_id'] = $this->assessment->id;
            $response['question_id'] = $questionId;

            if ($this->question->type == 1) {
                $userChoice = (int) $this->answers[$questionId];
                $choice = $this->question->choices->where('id', $userChoice)->first();

                $response['choice_id'] = $userChoice;

                if ($choice) {
                    if ($choice->is_correct) {
                        $response['point'] = $this->question->point;
                    } else {
                        $response['point'] = 0;
                    }
                }
            }

            $this->saveAnswer($response);

            return true;
        }
    }

    public function saveAnswer($response)
    {
        DB::transaction(function () use ($response) {
            $authUser = auth()->user();
            Answer::create($response);
            $this->savePoint($response['point']);

            $authUser->assessments()->updateExistingPivot($this->assessment->id, ['score' => array_sum(session('score'))]);
            $authUser->profile()->increment('point', $response['point']);
        });
    }

    private function savePoint($point)
    {
        if (session()->has('score')) {
            session()->push('score', $point);
        } else {
            session()->put('score', [$point]);
        }
    }

    public function finishAssessment()
    {
        $scoreUser = array_sum(session('score'));

        $level = DB::transaction(function () {
            $level = $this->updateUserCourseModule();
            auth()->user()->assessments()->updateExistingPivot($this->assessment->id, ['is_completed' => true]);
            session()->forget('score');

            return $level;
        });

        return redirect()->route('finish')->with('messages', ['score' => $scoreUser, 'level' => $level]);
    }

    protected function updateUserCourseModule()
    {
        $user = auth()->user();
        $course = Course::where('subject_id', $this->assessment->assessmentable_id)->first();

        if ($course) {
            $module = $course->modules()
                ->where('standard_point', '<=', array_sum(session('score')))
                ->orderBy('standard_point', 'desc')
                ->first();

            if ($module) {

                $user->courses()->attach($course->id, [
                    'module_id' => $module->id
                ]);

                return $module->title;
            } else {
                return '-';
            }
        } else {
            return '-';
        }
    }
}
