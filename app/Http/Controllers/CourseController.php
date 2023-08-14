<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
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
                $query->where('published_at', NULL)
                    ->orWhere('published_at', '<=', date('Y-m-d'));
            })
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
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', [
            'course' => $course->load(['modules', 'users'])
        ]);
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
