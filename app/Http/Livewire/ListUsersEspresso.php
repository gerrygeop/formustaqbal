<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsersEspresso extends Component
{
    use WithPagination;

    public $assessment;
    public $search = '';
    public $isCompleted = null;

    protected $queryString = [
        'isCompleted' => ['except' => ''],
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($assessment)
    {
        $this->assessment = $assessment;
    }

    public function render()
    {
        $users = DB::table('users as u')
            ->join('siakad as si', 'u.id', '=', 'si.user_id')
            ->leftJoin('faculties as f', 'si.faculty_id', '=', 'f.id')
            ->leftJoin('departments as d', 'si.department_id', '=', 'd.id')
            ->join('assessment_user as au', 'u.id', '=', 'au.user_id')
            ->whereNotNull('si.user_id')
            ->where('au.assessment_id', '=', $this->assessment)
            ->when(
                $this->isCompleted != null,
                fn ($query) => $query->where('au.is_completed', '=', $this->isCompleted)
            )
            ->where('u.name', 'LIKE', '%' . $this->search . '%')
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department', 'au.assessment_id', 'au.score', 'au.is_completed')
            ->paginate(20);

        return view('livewire.list-users-espresso', [
            'users' => $users
        ]);
    }
}
