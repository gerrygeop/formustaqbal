<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = auth()->user()
            ->rooms()
            ->withCount(['users' => function ($query) {
                $query->where('user_id', '!=', auth()->id());
            }])
            ->get();

        return view('rooms.index', [
            'rooms' => $rooms
        ]);
    }

    public function show(Room $room)
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) use ($room) {
                $query->where('room_id', $room->id)->where('type', 0);
            })
            ->with('modules')
            ->get()
            ->except(auth()->id());

        $users->sum(function ($user) {
            $user->completion_percentage = 0;

            $user->modules->map(function ($module) use ($user) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                if (!is_null($completedSubmodules)) {
                    $totalCompletedSubmodules = count($completedSubmodules);
                } else {
                    $totalCompletedSubmodules = 0;
                }

                $totalSubmodules = $module->submodules->count();

                if ($totalSubmodules == 0) {
                    $completionPercentage = 0;
                } else {
                    $completionPercentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                }
                $user->completion_percentage = $completionPercentage;
            });
        });

        return view('rooms.show', [
            'room' => $room,
            'users' => $users
        ]);
    }

    /**
     * Display the user's profile.
     */
    public function mhs(Room $room, User $user): View
    {
        if (!$user->rooms()->where('room_id', $room->id)->exists()) {
            return back();
        }

        return view('profile.show', [
            'user' => $user,
        ]);
    }
}
