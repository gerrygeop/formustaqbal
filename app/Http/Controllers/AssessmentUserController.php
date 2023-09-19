<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\User;
use App\Models\UserResponses;
use Illuminate\Support\Facades\DB;

class AssessmentUserController extends Controller
{
    public function review(Assessment $assessment, User $user)
    {
        if ($assessment->type == 2) {
            $answers = Answer::query()
                ->with(['question' => function ($query) {
                    $query->with('choices');
                }])
                ->where([
                    ['assessment_id', '=', $assessment->id],
                    ['user_id', '=', $user->id],
                ])
                ->get(['choice_id', 'question_id', 'answer_text', 'file_path', 'point']);

            $correctAnswer = 0;
            foreach ($answers as $answer) {
                foreach ($answer->question->choices as $choice) {
                    if ($answer->choice_id === $choice->id && $choice->is_correct) {
                        $correctAnswer++;
                    }
                }
            }

            return view('reviews.review-placement-test', [
                'assessment' => $assessment,
                'user' => $user,
                'answers' => $answers,
                'correctAnswer' => $correctAnswer,
                'incorrectAnswer' => $answers->count() - $correctAnswer,
            ]);
        } else {
            $ur = UserResponses::query()
                ->where([
                    ['assessment_id', '=', $assessment->id],
                    ['user_id', '=', $user->id],
                ])
                ->get()->first();

            $responses = collect(json_decode($ur->responses));
            $questions = Question::whereIn('id', $responses->pluck('question_id'))->with('choices')->get();

            $questions = $questions->mapWithKeys(function ($question, int $key) {
                return [$question->id => $question];
            });

            $answers = $responses->mapWithKeys(function ($res, int $key) {
                return [$res->question_id => $res];
            });

            return view('reviews.review-quiz', [
                'userResponses' => $ur,
                'assessment' => $assessment,
                'user' => $user,
                'answers' => $answers,
                'questions' => $questions,
            ]);
        }
    }

    public function reset(Assessment $assessment, User $user)
    {
        DB::transaction(function () use ($assessment, $user) {
            $score = DB::table('assessment_user')
                ->where('user_id', $user->id)
                ->where('assessment_id', $assessment->id)
                ->value('score');

            $profile = User::find($user->id)->profile;

            $profile->update([
                'point' => $profile->point - $score
            ]);

            DB::table('assessment_user')->where('user_id', $user->id)->delete();
            DB::table('answers')->where('user_id', $user->id)->delete();
        });

        return redirect()->back();
    }

    /**
     *  Ambil semua users yang memiliki user_id pada table siakad.
     **/
    public function espresso($assessment)
    {
        $users_count = DB::table('users as u')
            ->join('siakad as si', 'u.id', '=', 'si.user_id')
            ->leftJoin('faculties as f', 'si.faculty_id', '=', 'f.id')
            ->leftJoin('departments as d', 'si.department_id', '=', 'd.id')
            ->join('assessment_user as au', 'u.id', '=', 'au.user_id')
            ->whereNotNull('si.user_id')
            ->where('au.assessment_id', '=', $assessment)
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department', 'au.assessment_id', 'au.score', 'au.is_completed')
            ->get();

        $usersNoAssessment = DB::table('users as u')
            ->join('siakad as si', 'u.id', '=', 'si.user_id')
            ->leftJoin('faculties as f', 'si.faculty_id', '=', 'f.id')
            ->leftJoin('departments as d', 'si.department_id', '=', 'd.id')
            ->whereNotIn('u.id', function ($query) use ($assessment) {
                $query->select('au.user_id')
                    ->from('assessment_user as au')
                    ->where('au.assessment_id', '=', $assessment);
            })
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department')
            ->count();

        return view('rekap.espresso', [
            'assessment' => $assessment,
            'users_count' => $users_count->count(),
            'users_completed_true' => $users_count->where('is_completed', 1)->count(),
            'users_completed_false' => $users_count->where('is_completed', 0)->count(),
            'total_users' => User::has('siakad')->count(),
            'usersNoAssessment' => $usersNoAssessment,
        ]);
    }

    /**
     *  Ambil semua users yang memiliki siakad tapi tidak memiliki assessment.
     **/
    public function latte($assessment)
    {
        $users_count = DB::table('users as u')
            ->join('siakad as si', 'u.id', '=', 'si.user_id')
            ->leftJoin('faculties as f', 'si.faculty_id', '=', 'f.id')
            ->leftJoin('departments as d', 'si.department_id', '=', 'd.id')
            ->join('assessment_user as au', 'u.id', '=', 'au.user_id')
            ->whereNotNull('si.user_id')
            ->where('au.assessment_id', '=', $assessment)
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department', 'au.assessment_id', 'au.score', 'au.is_completed')
            ->get();

        $users = DB::table('users as u')
            ->join('siakad as si', 'u.id', '=', 'si.user_id')
            ->leftJoin('faculties as f', 'si.faculty_id', '=', 'f.id')
            ->leftJoin('departments as d', 'si.department_id', '=', 'd.id')
            ->whereNotIn('u.id', function ($query) use ($assessment) {
                $query->select('au.user_id')
                    ->from('assessment_user as au')
                    ->where('au.assessment_id', '=', $assessment);
            })
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department')
            ->count();

        return view('rekap.latte', [
            'assessment' => $assessment,
            'users_count' => $users_count->count(),
            'users_completed_true' => $users_count->where('is_completed', 1)->count(),
            'users_completed_false' => $users_count->where('is_completed', 0)->count(),
            'total_users' => User::has('siakad')->count(),
            'users' => $users,
        ]);
    }
}
