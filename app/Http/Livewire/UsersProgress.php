<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersProgress extends Component
{
    public $room;
    public $users;

    public function mount($room)
    {
        $this->room = $room;
        $this->getAllUsers();
    }

    public function getAllUsers()
    {
        $this->users = User::query()
            ->whereHas('rooms', function ($query) {
                $query->where('room_id', $this->room->id)->where('type', 0);
            })
            ->with('modules')
            ->get()
            ->except(auth()->id());

        $this->countProgress();
    }

    public function countProgress()
    {
        $this->users->sum(function ($user) {
            $user->completion_percentage = 0;

            $user->modules->map(function ($module) use ($user) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                if (!is_null($completedSubmodules)) {
                    $totalCompletedSubmodules = count($completedSubmodules);
                } else {
                    $totalCompletedSubmodules = 0;
                }

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                if ($totalSubmodules == 0) {
                    $completionPercentage = 0;
                } else {
                    $completionPercentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                }
                $user->completion_percentage = $completionPercentage;
            });
        });
    }

    public function render()
    {
        return view('livewire.users-progress');
    }
}
