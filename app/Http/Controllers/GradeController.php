<?php

namespace App\Http\Controllers;

use App\Exports\ExportStudentGrade;
use App\Models\Room;
use App\Models\StudentGrade;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GradeController extends Controller
{
    public function index(Room $room)
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) use ($room) {
                $query->where('room_id', $room->id)->where('type', 0);
            })
            ->with('grade')
            ->get()
            ->except(auth()->id());

        return view('rooms.forms.index', [
            'room' => $room,
            'users' => $users,
        ]);
    }

    public function create(Room $room)
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) use ($room) {
                $query->where('room_id', $room->id)->where('type', 0);
            })
            ->with('grade')
            ->get()
            ->except(auth()->id());

        return view('rooms.forms.create', [
            'room' => $room,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'array'],
            'user_id.*' => ['required', 'exists:users,id'],
            'partisipasi' => ['required', 'array'],
            'partisipasi.*' => ['required', 'decimal:2', 'between:0,100'],
            'tugas' => ['required', 'array'],
            'tugas.*' => ['required', 'decimal:2', 'between:0,100'],
            'uts' => ['required', 'array'],
            'uts.*' => ['required', 'decimal:2', 'between:0,100'],
            'uas' => ['required', 'array'],
            'uas.*' => ['required', 'decimal:2', 'between:0,100'],
        ]);

        foreach ($data['user_id'] as $key => $userId) {
            $nilaiData = [
                'user_id' => $userId,
                'author' => auth()->id(),
                'c1' => $data['partisipasi'][$key],
                'c2' => $data['tugas'][$key],
                'c3' => $data['uts'][$key],
                'c4' => $data['uas'][$key],
                'batch' => 1,
            ];

            $nilaiData['result'] = round(($nilaiData['c1'] * 0.20) + ($nilaiData['c2'] * 0.20) + ($nilaiData['c3'] * 0.20) + ($nilaiData['c4'] * 0.40), 2);

            StudentGrade::updateOrCreate(
                ['user_id' => $userId],
                $nilaiData,
            );
        }

        return redirect()->back()->with('status', 'success');
    }

    public function exportExcel(Room $room)
    {
        $name = 'Nilai ' . $room->name;
        $filename = str($name)->lower()->slug();
        return Excel::download(new ExportStudentGrade($room), $filename . '.xlsx');
    }
}
