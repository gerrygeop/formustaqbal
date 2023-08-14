<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Submodule;
use Illuminate\Http\Request;

class SubmoduleController extends Controller
{
    public function lesson(Course $course, Submodule $submodule)
    {
        $submodules = $course->modules->flatMap(function ($module) {
            return $module->submodules;
        });

        $currentIndex = $submodules->search(function ($item) use ($submodule) {
            return $item->id === $submodule->id;
        });

        $prevSubmodule = null;
        $nextSubmodule = null;

        if ($currentIndex !== false) {
            if ($currentIndex > 0) {
                $prevSubmodule = $submodules->get($currentIndex - 1);
            }
            if ($currentIndex < $submodules->count() - 1) {
                $nextSubmodule = $submodules->get($currentIndex + 1);
            }
        }

        return view('courses.lesson', [
            'course' => $course,
            'currentIndex' => $currentIndex,
            'currentSubmodule' => $submodule,
            'prevSubmodule' => $prevSubmodule,
            'nextSubmodule' => $nextSubmodule,
        ]);
    }
}
