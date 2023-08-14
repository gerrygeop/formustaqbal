<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $myCourses = Auth::user()
            ->courses()
            ->where('is_visible', true)
            ->orWhere('published_at', NULL)
            ->orWhere('published_at', '<=', date('Y-m-d'))
            ->get();

        return view('dashboard', [
            'myCourses' => $myCourses
        ]);
    }
}
