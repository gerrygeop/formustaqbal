<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentUserController extends Controller
{
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
