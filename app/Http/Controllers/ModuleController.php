<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function show(Module $module)
    {
        $module->load('course', 'submodules');

        $user = auth()->user();
        $courseUser = DB::table('course_user')
            ->where('module_id', $module->id)
            ->where('course_id', $module->course->id)
            ->where('user_id', $user->id)
            ->first();

        $completedSubmodules = json_decode($courseUser->completed_submodules);

        return view('modules.show', [
            'module' => $module,
            'course' => $module->course,
            'completedSubmodules' => $completedSubmodules,
        ]);
    }
}
