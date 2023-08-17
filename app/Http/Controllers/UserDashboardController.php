<?php

namespace App\Http\Controllers;

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
                $query->where('published_at', NULL)
                    ->orWhere('published_at', '<=', date('Y-m-d'));
            })
            ->get();

        $test = Auth::user()
            ->answers()
            ->whereHasMorph('answerable', Test::class, function (Builder $query) {
                $query->where('is_active', true);
            })
            ->get();

        return view('dashboard', [
            'myCourses' => $myCourses,
            'test' => $test->last(),
            'profile' => Auth::user()->profile,
        ]);
    }
}
