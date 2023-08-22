<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Test;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $myCourses = Auth::user()
            ->courses()
            ->where('is_visible', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', date('Y-m-d'));
            })
            ->with(['modules' => function ($query) {
                $query->whereHas('users', function ($userQuery) {
                    $userQuery->where('user_id', Auth::id());
                });
            }])
            ->get();

        // Query untuk mengambil data assessment yang memiliki tipe 2 dan relasi dengan Subject
        // $assessments = Answer::select('assessments.*')
        //     ->join('questions', 'answers.question_id', '=', 'questions.id')
        //     ->join('assessments', 'questions.assessment_id', '=', 'assessments.id')
        //     ->join('users', 'answers.user_id', '=', 'users.id')
        //     ->where('users.id', Auth::id())
        //     ->where('assessments.type', 2)
        //     ->whereNotNull('assessments.assessmentable_id')
        //     ->distinct()
        //     ->get();

        // dd($assessments);
        return view('dashboard', [
            'myCourses' => $myCourses,
            'profile' => Auth::user()->profile,
        ]);
    }
}
