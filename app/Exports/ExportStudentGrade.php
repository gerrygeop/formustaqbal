<?php

namespace App\Exports;

use App\Models\Room;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportStudentGrade implements FromView
{
    public $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
    }

    public function view(): View
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) {
                $query->where('room_id', $this->room->id)->where('type', 0);
            })
            ->with('grade')
            ->get()
            ->except(auth()->id());

        return view('rooms.forms.table', [
            'users' => $users
        ]);
    }
}
