<?php

namespace App\Http\Controllers;

use App\Models\Room;
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
            if (!is_null($completedSubmodules)) {
                $totalCompletedSubmodules = count($completedSubmodules);
            } else {
                $totalCompletedSubmodules = 0;
            }

            $totalSubmodules = $module->submodules_count;
            $completionPercentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
            $module->completion_percentage = $completionPercentage;

            return $module;
        });

        $rooms = Room::whereRelation('users', 'user_id', auth()->id())->get();

        return view('dashboard', [
            'modules' => $modules,
            'profile' => Auth::user()->profile,
            'rooms' => $rooms
        ]);
    }
}
