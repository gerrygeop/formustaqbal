<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function room()
    {
        $users = User::all();
        return view('teachers.room', [
            'users' => $users
        ]);
    }

    public function start()
    {
        return view('testing.test-start');
    }

    public function test()
    {
        $user = request()->user();

        $assessment = Assessment::query()
            ->where('id', 3)
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
            return view('info');
        } else {
            return view('placement-test', [
                'assessment' => $assessment,
            ]);
        }
    }
}
