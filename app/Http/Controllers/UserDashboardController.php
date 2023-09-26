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
            ->with(['course', 'submodules.chapters'])
            ->get();

        if (!auth()->user()->hasRole('teacher')) {
            $modules->map(function ($module) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                if (!is_null($completedSubmodules)) {
                    $totalCompletedSubmodules = count($completedSubmodules);
                } else {
                    $totalCompletedSubmodules = 0;
                }

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                $module->completion_percentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);

                return $module;
            });
        }

        $rooms = Room::whereRelation('users', 'user_id', auth()->id())->get();

        return view('dashboard', [
            'modules' => $modules,
            'profile' => Auth::user()->profile,
            'rooms' => $rooms
        ]);
    }
}
