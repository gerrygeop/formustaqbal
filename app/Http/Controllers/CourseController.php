<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Submodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
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
                });
            }])
            ->get();

        $subjects = Subject::withCount(['courses'])->get();

        return view('courses.my', [
            'myCourses' => $myCourses,
            'subjects' => $subjects,
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
     * Display a listing of the resource.
     */
    public function attach(Course $course)
    {
        if (!$course->users->contains(Auth::id())) {
            $course->users()->attach(Auth::id());
        }

        $firstSubmodule = $course->modules->flatMap(function ($module) {
            return $module->submodules;
        })->first();

        return to_route('courses.lesson', [$course, $firstSubmodule]);
    }

    /**
     * Display a listing of the resource.
     */
    public function mulai(Module $module)
    {
        $submodule = $module->submodules->first();

        return to_route('courses.learn', [
            'module' => $module,
            'submodule' => $submodule,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function learn(Module $module, Submodule $submodule)
    {
        $submodules = $module->submodules;

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
        return view('learns.learn', [
            'module' => $module,
            'currentIndex' => $currentIndex,
            'currentSubmodule' => $submodule,
            'prevSubmodule' => $prevSubmodule,
            'nextSubmodule' => $nextSubmodule,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course->load(['modules', 'users'])
        ]);
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
