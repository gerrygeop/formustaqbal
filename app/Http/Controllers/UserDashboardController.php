<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $modules = Auth::user()
            ->modules()
            ->where('is_visible', true)
            ->with('course')
            ->withCount('submodules')
            ->get();

        $modules->map(function ($module) {
            $completedSubmodules = json_decode($module->pivot->completed_submodules);
            $totalCompletedSubmodules = count($completedSubmodules);

            $totalSubmodules = $module->submodules_count;
            $completionPercentage = ($totalCompletedSubmodules / $totalSubmodules) * 100;
            $module->completion_percentage = $completionPercentage;

            return $module;
        });

        return view('dashboard', [
            'modules' => $modules,
            'profile' => Auth::user()->profile,
        ]);
    }
}
