<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    // Choose language
    public function start()
    {
        $subjects = Subject::all();
        return view('choose-language', [
            'subjects' => $subjects
        ]);
    }

    // Placement test
    public function test(Subject $subject)
    {
        $test = Test::query()
            ->where('subject_id', $subject->id)
            ->where('is_active', true)
            ->where('start_at', '<=', Carbon::now())
            ->where('end_at', '>=', Carbon::now())
            ->with(['questions'])
            ->get()
            ->first();

        return view('placement-test', [
            'test' => $test,
        ]);
    }
}
