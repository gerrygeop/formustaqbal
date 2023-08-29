<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // Choose language
    public function start()
    {
        return view('greeting');
    }

    // Choose language
    public function language()
    {
        $subjects = Subject::whereHas('assessment')->get();

        return view('choose-language', [
            'subjects' => $subjects
        ]);
    }

    // Placement test
    public function test(Subject $subject)
    {
        $user = request()->user();

        $assessment = Assessment::query()
            ->where('is_active', true)
            ->where([
                ['published_at', '<=', Carbon::now()],
            ])
            ->whereHasMorph('assessmentable', Subject::class, function ($query) use ($subject) {
                $query->where('id', $subject->id);
            })
            ->get()
            ->first();

        $assessmentUser = $user->assessments()->where('assessment_id', $assessment->id);

        if (!$assessmentUser->exists()) {
            $assessment->users()->attach($user->id);
        }

        if ($assessmentUser->wherePivot('is_completed', true)->exists()) {
            return view('info');
        } else {
            return view('placement-test', [
                'assessment' => $assessment,
            ]);
        }
    }

    // Finish
    public function finish()
    {
        return view('finish');
    }
}
