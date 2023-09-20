<?php

namespace App\Http\Controllers;

use App\Models\AssessmentUser;
use App\Models\Chapter;
use App\Models\Module;
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

        if ($au->is_completed == 1) {
            if ($assessment->duration_minutes > 0 && $au->created_at->addMinutes($assessment->duration_minutes) < now()) {
                return to_route('courses.learn', [$chapter->submodule->module->id, $chapter]);
            }
        } else {
            return view('quizzes.assessment-layout', [
                'chapter' => $chapter,
                'assessment' => $assessment,
            ]);
        }
    }
}
