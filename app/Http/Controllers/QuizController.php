<?php

namespace App\Http\Controllers;

use App\Models\AssessmentUser;
use App\Models\Chapter;
use App\Models\Module;
use App\Models\Question;
use App\Models\UserResponses;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function quiz(Module $module, Chapter $chapter)
    {
        $module->load([
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ]);

        if (!auth()->user()->hasRole('teacher')) {
            $completeSubmodule = json_decode($module->users->first()->pivot->completed_submodules);
            if (!in_array($chapter->id, $completeSubmodule)) {
                abort(403);
            }
        }

        $chapter->load(['assessment' => function ($query) {
            $query->where('is_active', true)
                ->where([
                    ['published_at', '<=', Carbon::now()],
                ])
                ->with(['users' => function ($query) {
                    $query->where('user_id', auth()->id());
                }]);
        }]);

        $assessment = $chapter->assessment;

        if ($assessment->users->count() == 0) {
            $au = AssessmentUser::create([
                'user_id' => auth()->id(),
                'assessment_id' => $assessment->id,
            ]);
        } else {
            $au = $assessment->users->first()->pivot;
        }

        $userResponses = UserResponses::where([
            ['user_id', '=', auth()->id()],
            ['assessment_id', '=', $assessment->id],
        ])->get();

        if ($userResponses->count() == $assessment->trial_limits) {
            return to_route('courses.learn', [$chapter->submodule->module->id, $chapter])->with('limitation', 'Anda telah mencapai batas untuk mengambil Quiz');
        }

        if ($au->is_completed == 1 && $au->created_at->addMinutes($assessment->duration_minutes) < now()) {
            $au->update([
                'is_completed' => false
            ]);
        }

        return view('quizzes.assessment-layout', [
            'chapter' => $chapter,
            'assessment' => $assessment,
        ]);
    }

    public function preview(Module $module, Chapter $chapter)
    {
        $module->load([
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ]);

        if (!auth()->user()->hasRole('teacher')) {
            $completeSubmodule = json_decode($module->users->first()->pivot->completed_submodules);
            if (!in_array($chapter->id, $completeSubmodule)) {
                abort(403);
            }
        }

        $chapter->load(['assessment' => function ($query) {
            $query->where('is_active', true)
                ->where([
                    ['published_at', '<=', Carbon::now()],
                ]);
        }]);

        $assessment = $chapter->assessment;

        $questions = $assessment
            ->questions()
            ->limit($assessment->question_limit)
            ->with('choices')
            ->get();

        return view('quizzes.preview', [
            'chapter' => $chapter,
            'questions' => $questions,
        ]);
    }

    public function history(Module $module, Chapter $chapter, UserResponses $userresponses)
    {
        $responses = collect(json_decode($userresponses->responses));
        $questions = Question::whereIn('id', $responses->pluck('question_id'))->with('choices')->get();

        $questions = $questions->mapWithKeys(function ($question, int $key) {
            return [$question->id => $question];
        });

        return view('quizzes.history', [
            'module' => $module,
            'chapter' => $chapter,
            'userResponses' => $userresponses,
            'questions' => $questions,
        ]);
    }
}
