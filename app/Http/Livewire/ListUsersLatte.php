<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsersLatte extends Component
{
    use WithPagination;

    public $assessment;
    public $search = '';

    protected $queryString = [
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
            ->whereNotIn('u.id', function ($query) {
                $query->select('au.user_id')
                    ->from('assessment_user as au')
                    ->where('au.assessment_id', '=', $this->assessment);
            })
            ->where('u.name', 'like', '%' . $this->search . '%')
            ->select('u.name', 'u.username', 'f.name as faculty', 'd.name as department')
            ->paginate(20);

        return view('livewire.list-users-latte', [
            'users' => $users
        ]);
    }
}
