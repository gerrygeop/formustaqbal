<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentUserController extends Controller
{
    public function reset(User $user)
    {
        DB::transaction(function () use ($user) {
            DB::table('assessment_user')->where('user_id', $user->id)->delete();
            DB::table('answers')->where('user_id', $user->id)->delete();
        });

        return redirect()->back();
    }
}
