<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;

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
        $assessment = Assessment::whereHasMorph('assessmentable', Subject::class, function ($query) use ($subject) {
            $query->where('id', $subject->id);
        })
            ->where('is_active', true)
            ->where([
                ['published_at', '<=', Carbon::now()],
                ['start_time', '<=', Carbon::now()],
                ['end_time', '>=', Carbon::now()]
            ])
            ->orWhere(function ($query) {
                $query->where('published_at', NULL)
                    ->where('start_time', NULL)
                    ->where('end_time', NULL);
            })
            ->get()
            ->first();

        return view('placement-test', [
            'assessment' => $assessment,
        ]);
    }
}
