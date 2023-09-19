<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersProgress extends Component
{
    public $room;
    public $users;
    public $overallProgress = 0;

    public function mount($room)
    {
        $this->room = $room;
        $this->getAllUsers();
        $this->overallProgress = $this->calculateAverageCompletion();
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
        $this->users->each(function ($user) {
            $user->completion_percentage = 0;

            $user->modules->each(function ($module) use ($user) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                $totalCompletedSubmodules = is_null($completedSubmodules) ? 0 : count($completedSubmodules);

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                $completionPercentage = ($totalSubmodules == 0) ? 0 : round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                $user->completion_percentage = $completionPercentage;
            });
        });
    }

    public function calculateAverageCompletion()
    {
        $totalUsers = $this->users->count();

        if ($totalUsers > 0) {
            $totalCompletion = $this->users->sum('completion_percentage');
            $averageCompletion = round($totalCompletion / $totalUsers);
        } else {
            $averageCompletion = 0;
        }

        return $averageCompletion;
    }

    public function render()
    {
        return view('livewire.users-progress');
    }
}
