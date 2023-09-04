<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * Display a list of courses owned by the current user.
     * This includes courses visible to the user and their associated modules.
     */
    public function my()
    {
        $myCourses = Auth::user()
            ->courses()
            ->where('is_visible', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', date('Y-m-d'));
            })
            ->with(['modules' => function ($query) {
                $query->whereHas('users', function ($userQuery) {
                    $userQuery->where('user_id', Auth::id());
                })->where('is_visible', 1);
            }])
            ->get();

        $courses = Course::withCount(['modules'])->get();

        return view('courses.my', [
            'myCourses' => $myCourses,
            'courses' => $courses,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function courses(Subject $subject)
    {
        $courses = Course::where('subject_id', $subject->id)->withCount(['modules', 'users'])->get();

        return view('courses.courses', [
            'courses' => $courses,
            'subject' => $subject->name,
        ]);
    }

    /**
     * Display a list of levels.
     */
    public function levels(Course $course)
    {
        $course = $course->load('modules.submodules');

        return view('courses.levels', [
            'course' => $course,
        ]);
    }

    /**
     * Display the first submodule within a module to start learning.
     */
    public function start(Module $module)
    {
        if (!$module->users()->where('user_id', auth()->id())->exists()) {
            abort(404);
        }

        $module->load([
            'submodules',
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ]);

        $lastVisit = $module->users->first()->pivot->last_visit;

        if (is_null($lastVisit)) {
            $submodule = $module->submodules->where('list_sort', 1)->first();
        } else {
            $submodule = $module->submodules->where('id', $lastVisit)->first();
        }

        if (is_null($submodule)) {
            return back();
        }

        return to_route('courses.learn', [
            'module' => $module,
            'submodule' => $submodule,
        ]);
    }

    /**
     * Display the learning view for a specific submodule within a module.
     */
    public function learn(Module $module, Submodule $submodule)
    {
        if (!$module->users()->where('user_id', auth()->id())->exists() || !$module->submodules()->where('id', $submodule->id)->exists()) {
            abort(404);
        }

        $module->load([
            'submodules',
            'users' => function ($query) {
                $query->where('user_id', auth()->id());
            },
        ]);

        $submodules = $module->submodules->sortBy('list_sort');

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

            $completedSubmodules = DB::transaction(function () use ($module, $submodule) {
                $module->users()->syncWithoutDetaching([auth()->id() => ['last_visit' => $submodule->id]]);

                $completedSubmodules = json_decode($module->users->first()->pivot->completed_submodules);
                if (is_null($completedSubmodules)) {
                    $completedSubmodules[] = $module->submodules->sortBy('list_sort')->first()->id;
                    $module->users()->updateExistingPivot(auth()->id(), ['completed_submodules' => json_encode($completedSubmodules)]);
                } else {
                    if (!in_array($submodule->id, $completedSubmodules)) {
                        $completedSubmodules[] = $submodule->id;
                        $module->users()->updateExistingPivot(auth()->id(), ['completed_submodules' => json_encode($completedSubmodules)]);
                    }
                }

                return $completedSubmodules;
            });
        } else {
            abort(404);
        }

        return view('learns.learn', [
            'module' => $module,
            'currentIndex' => $currentIndex,
            'currentSubmodule' => $submodule,
            'prevSubmodule' => $prevSubmodule,
            'nextSubmodule' => $nextSubmodule,
            'completedSubmodules' => $completedSubmodules,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
