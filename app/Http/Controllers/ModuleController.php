<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    public function show(Module $module)
    {
        if (!$module->is_visible) {
            abort(403);
        }

        $module->load('course', 'submodules');

        $courseUser = DB::table('course_user')
            ->where('module_id', $module->id)
            ->where('course_id', $module->course->id)
            ->where('user_id', auth()->id())
            ->first();

        $completedSubmodules = json_decode($courseUser->completed_submodules);

        return view('modules.show', [
            'module' => $module,
            'completedSubmodules' => $completedSubmodules,
        ]);
    }
}
