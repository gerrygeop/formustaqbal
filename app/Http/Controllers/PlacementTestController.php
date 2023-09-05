<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PlacementTestController extends Controller
{
    // Choose language
    public function start()
    {
        return view('placement-test.greeting');
    }

    // Choose language
    public function language()
    {
        $courses = Course::whereHas('assessment')->get();

        return view('placement-test.choose-language', [
            'courses' => $courses
        ]);
    }

    public function reminder(Course $course)
    {
        return view('placement-test.reminder', [
            'course' => $course
        ]);
    }

    // Placement test
    public function test(Course $course)
    {
        $user = request()->user();

        $assessment = Assessment::query()
            ->where('is_active', true)
            ->where([
                ['published_at', '<=', Carbon::now()],
            ])
            ->whereHasMorph('assessmentable', Course::class, function ($query) use ($course) {
                $query->where('id', $course->id);
            })
            ->get()
            ->first();

        $assessmentUser = $user->assessments()->where('assessment_id', $assessment->id);

        if (!$assessmentUser->exists()) {
            $assessment->users()->attach($user->id);
        }


        $created = DB::table('assessment_user')->where([
            ['user_id', $user->id],
            ['assessment_id', $assessment->id],
        ])->get()->first()->created_at;

        $createdTime = new Carbon($created);

        if ($assessmentUser->wherePivot('is_completed', true)->exists() || $createdTime->addMinutes($assessment->duration_minutes) < now()) {
            return view('placement-test.info');
        } else {
            return view('placement-test.placement-test', [
                'assessment' => $assessment,
            ]);
        }
    }

    // Finish
    public function finish()
    {
        return view('placement-test.finish');
    }
}
