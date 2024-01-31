<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    /**
     * Menampilkan daftar mahasiswa pada kelas
     */
    public function show(Room $room)
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) use ($room) {
                $query->where('room_id', $room->id)->where('type', 0);
            })
            ->with(['modules', 'responsi'])
            ->get()
            ->except(auth()->id());

        /**
         * Menghitung progress belajar student
         */
        $users->sum(function ($user) {
            $user->completion_percentage = 0;

            $user->modules->map(function ($module) use ($user) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                $totalCompletedSubmodules = !is_null($completedSubmodules) ? count($completedSubmodules) : 0;

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                if ($totalSubmodules == 0) {
                    $user->completion_percentage = 0;
                } else {
                    $user->completion_percentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                }
            });
        });

        return view('rooms.show', [
            'room' => $room,
            'users' => $users
        ]);
    }

    /**
     * Menampilkan daftar mahasiswa dengan nilai
     */
    public function nilai(Room $room)
    {
        $users = User::query()
            ->whereHas('rooms', function ($query) use ($room) {
                $query->where('room_id', $room->id)->where('type', 0);
            })
            ->with(['modules', 'responsi'])
            ->get()
            ->except(auth()->id());

        /**
         * Menghitung progress belajar student
         */
        $users->sum(function ($user) {
            $user->completion_percentage = 0;

            $user->modules->map(function ($module) use ($user) {
                $completedSubmodules = json_decode($module->pivot->completed_submodules);
                $totalCompletedSubmodules = !is_null($completedSubmodules) ? count($completedSubmodules) : 0;

                $totalSubmodules = $module->submodules->sum(function ($submodule) {
                    return $submodule->chapters->count();
                });

                if ($totalSubmodules == 0) {
                    $user->completion_percentage = 0;
                } else {
                    $user->completion_percentage = round(($totalCompletedSubmodules / $totalSubmodules) * 100);
                }
            });
        });

        $usersID = $users->pluck('id')->toArray();
        $responses = DB::select("
            SELECT ur.user_id,
                ur.assessment_id,
                u.name as student_name,
                a.title as title_assessment,
                a.type as type_assessment,
                MAX(ur.score) as score
            FROM user_responses ur
            JOIN users u ON ur.user_id = u.id
            JOIN assessments a ON ur.assessment_id = a.id
            WHERE ur.user_id IN (" . implode(',', $usersID) . ")
            AND ur.id IN (
                SELECT MAX(id)
                FROM user_responses
                WHERE assessment_id = a.id
                AND user_id IN (" . implode(',', $usersID) . ")
                GROUP BY user_id
            )
            GROUP BY ur.user_id, ur.assessment_id, u.name, a.title, a.type
            ORDER BY ur.user_id
            ");

        $averageScores = collect($responses)->groupBy(['user_id'])
            ->map(function ($userResponses) {
                return [
                    'user_id' => $userResponses->first()->user_id,
                    'student_name' => $userResponses->first()->student_name,
                    '1' => $userResponses->where('type_assessment', 1)->sum('score'),
                    // '3' => $userResponses->where('type_assessment', 3)->sum('score'),
                    '4' => $userResponses->where('type_assessment', 4)->sum('score'),
                    '5' => $userResponses->where('type_assessment', 5)->sum('score'),
                ];
            });

        $assessments = $room->module->submodules
            ->where('is_visible', 1)
            ->sortBy('list_sort')
            ->flatMap(function ($submodule) {
                return $submodule->chapters
                    ->filter(fn ($chapter) => $chapter->assessment != null)
                    ->sortBy('list_sort')
                    ->pluck('assessment');
            });

        // Menghitung jumlah asesmen untuk setiap tipe dari $assessments
        $assessmentCounts = $assessments->groupBy('type')->map->count();

        // Menghitung nilai akhir sesuai dengan persentase yang didapatkan dari nilai rata-rata
        $grade = $averageScores->map(function ($user) use ($assessmentCounts, $users) {
            foreach ($user as $type => $score) {
                if ($type != 'user_id' && $type != 'student_name') {
                    if (isset($assessmentCounts[$type])) {
                        $user[$type] = round($score / $assessmentCounts[$type], 2);
                    } else {
                        $user[$type] = 0;
                    }
                }
            }

            foreach ($users as $key => $value) {
                if ($user['user_id'] == $value->id) {
                    $user['partisipasi'] = $value->completion_percentage;
                }
            }

            return $user;
        });

        return view('rooms.nilai', [
            'room' => $room,
            'users' => $users,
            'grade' => $grade
        ]);
    }

    /**
     * Menampilkan detail nilai mahasiswa
     */
    public function detailNilai(Room $room, User $user)
    {
        $responses = DB::select("
            SELECT ur.user_id,
                ur.assessment_id,
                u.name as student_name,
                a.title as title_assessment,
                a.type as type_assessment,
                ur.reviewed,
                MAX(ur.score) as score
            FROM user_responses ur
            JOIN users u ON ur.user_id = u.id
            JOIN assessments a ON ur.assessment_id = a.id
            WHERE ur.user_id = :user_id
            AND ur.id IN (
                SELECT MAX(id)
                FROM user_responses
                WHERE assessment_id = a.id
                GROUP BY user_id
            )
            GROUP BY ur.user_id, ur.assessment_id, ur.reviewed, u.name, a.title, a.type
            ORDER BY ur.user_id
        ", ['user_id' => $user->id]);

        return view('rooms.detail-nilai', [
            'room' => $room,
            'user' => $user,
            'responses' => $responses,
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
