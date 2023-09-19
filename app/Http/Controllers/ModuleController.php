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

        $module->load('course', 'submodules.chapters.assessment');

        $courseUser = DB::table('course_user')
            ->where('module_id', $module->id)
            ->where('course_id', $module->course->id)
            ->where('user_id', auth()->id())
            ->first();

        $completedSubmodules = is_null($courseUser) ? null : json_decode($courseUser->completed_submodules);

        if (auth()->user()->hasRole('teacher')) {
            $chapters = $module->submodules
                ->where('is_visible', 1)
                ->sortBy('list_sort')
                ->flatMap(function ($submodule) {
                    return $submodule->chapters->filter(function ($chapter) {
                        return $chapter->assessment !== null;
                    });
                });

            return view('modules.show-teacher', [
                'module' => $module,
                'chapters' => $chapters,
                'completedSubmodules' => is_null($completedSubmodules) ? [] : $completedSubmodules,
            ]);
        } else {
            return view('modules.show', [
                'module' => $module,
                'completedSubmodules' => $completedSubmodules,
            ]);
        }
    }
}
