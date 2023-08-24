<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class TestQuestions extends Component
{
    use WithFileUploads;

    public $subject;
    public $assessment;
    public $questions;
    public $questionNull = false;
    public $currentQuestion;
    public $questionIndex = 0;
    public $answers = [];

    protected $messages = [
        'answers.*.speaking' => 'The Audio file must be a file of type: audio/mpeg, audio/ogg.',
    ];

    public function mount(Assessment $assessment, $subject)
    {
        $this->assessment = $assessment;
        $this->subject = $subject;
        $this->loadQuestions();
    }

    public function loadQuestions()
    {
        $this->questions = $this->assessment->questions()
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
            $response['user_id'] = auth()->id();
            $response['assessment_id'] = $this->assessment->id;
            $response['question_id'] = $questionId;

            if ($this->currentQuestion->type == 1) {
                $userChoice = (int) $this->answers[$questionId];
                $choice = $this->currentQuestion->choices->where('id', $userChoice)->first();

                $response['choice_id'] = $userChoice;

                if ($choice) {
                    if ($choice->is_correct) {
                        $response['point'] = $this->currentQuestion->point;
                    } else {
                        $response['point'] = 0;
                    }
                }
            } else if ($this->currentQuestion->type == 4 && isset($this->answers[$questionId]['speaking'])) {
                $this->validate([
                    'answers.*.speaking' => 'file|mimetypes:audio/mpeg,audio/ogg|max:5024', // 5MB Max
                ]);

                $audioFile = $this->answers[$questionId]['speaking'];
                $audioFileName = $audioFile->store('speaking-test', 'public');
                $response['file_path'] = $audioFileName;
                $response['point'] = $this->currentQuestion->point;
            } else {
                $response['answer_text'] = $this->answers[$questionId];
                $response['point'] = $this->currentQuestion->point;
            }

            $this->answers[$questionId] = $response;

            return true;
        }
    }

    public function submitAnswers()
    {
        if ($this->saveAnswer($this->currentQuestion->id)) {
            DB::transaction(function () {
                $authUser = auth()->user();
                $point = [];

                foreach ($this->answers as $answerData) {
                    Answer::create($answerData);
                    $point[] = $answerData['point'];
                }

                $totalPoint = array_sum($point);
                $this->assessment->users()->attach($authUser->id, ['score' => $totalPoint]);

                $authUser->profile()->update([
                    'point' => $totalPoint
                ]);

                $subjectId = $this->assessment->assessmentable_id;

                // Query untuk mendapatkan course berdasarkan ID subject
                $course = Course::where('subject_id', $subjectId)->first();
                if ($course) {
                    // Tambahkan data ke pivot table course_user
                    $module = $course->modules()->where('standard_point', '<=', $totalPoint)
                        ->orderBy('standard_point', 'desc')
                        ->first();

                    if ($module) {
                        $authUser->courses()->attach($course->id, [
                            'module_id' => $module->id
                        ]);
                    }
                }
            });

            return redirect()->to('/dashboard');
        }
    }
}
