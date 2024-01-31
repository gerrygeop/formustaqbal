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
                $totalCompletedSubmodules = !is_null($completedSubmodules) ? count($completedSubmodules) : 0;

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                if ($totalSubmodules == 0) {
                    $module->completion_percentage = 0;
                } else {
                    $module->completion_percentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                }

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
