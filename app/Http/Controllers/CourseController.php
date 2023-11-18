<?php

namespace App\Http\Controllers;

use App\Models\AssessmentUser;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Module;
use App\Models\Subject;
use App\Models\UserResponses;
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
        if (auth()->user()->hasRole('teacher')) {
            $rooms = Auth::user()
                ->rooms()
                ->with(['module' => function ($query) {
                    $query->where('is_visible', 1);
                }])
                ->get();

            $courses = Course::withCount(['modules'])->get();

            return view('courses.teacher.my', [
                'rooms' => $rooms,
                'courses' => $courses,
            ]);
        } else {
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
        $course->load([
            'modules' => function ($query) {
                $query->where('is_visible', true)->with([
                    'submodules' => function ($query) {
                        $query->where('is_visible', true)->with('chapters');
                    }
                ]);
            }
        ]);

        $course->modules->map(function ($module) {
            $module->user_count = $module->users->count();
            $module->submodule_count = $module->submodules->count();
            $module->chapter_count = $module->submodules->sum(function ($submodule) {
                return $submodule->chapters->count();
            });

            return $module;
        });

        if (auth()->user()->hasRole('teacher')) {
            return view('courses.teacher.levels', [
                'course' => $course,
            ]);
        } else {
            return view('courses.levels', [
                'course' => $course,
            ]);
        }
    }

    /**
     * Display the first submodule within a module to start learning.
     */
    public function start(Module $module)
    {
        $userId = auth()->id();

        if (!$module->users()->where('user_id', $userId)->exists()) {
            if (!auth()->user()->hasRole('teacher')) {
                abort(404);
            }
        }

        $module->load([
            'submodules',
            'users' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            },
        ]);

        if (auth()->user()->hasRole('teacher')) {
            $lastVisit = null;
        } else {
            $lastVisit = $module->users->first()->pivot->last_visit;
        }

        if (is_null($lastVisit)) {
            $chapter = $module->getFirstChapterFromFirstSubmodule();
        } else {
            $chapter = Chapter::find($lastVisit);
        }

        if (is_null($chapter)) {
            return back();
        }

        return to_route('courses.learn', [
            'module' => $module,
            'chapter' => $chapter,
        ]);
    }

    /**
     * Display the learning view for a specific submodule within a module.
     */
    public function learn(Module $module, Chapter $chapter)
    {
        if (!$module->isUSerValid() || !$module->isSubmoduleExists($chapter->submodule->id)) {
            if (!auth()->user()->hasRole('teacher')) {
                abort(404);
            }
        }

        $user = auth()->user();

        if ($user->siakad && is_null($user->siakad->local)) {
            return redirect()->route('profile.edit')->with('status', 'fill-local');
        }

        $module->load([
            'submodules',
            'users' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            },
        ]);

        $chapters = $module->getAllChapters();
        // return dd($chapters);

        $currentIndex = $chapters->search(function ($item) use ($chapter) {
            return $item->id == $chapter->id;
        });

        $prevChapter = null;
        $nextChapter = null;

        if ($currentIndex !== false) {
            if ($currentIndex > 0) {
                $prevChapter = $chapters->get($currentIndex - 1);
            }
            if ($currentIndex < $chapters->count() - 1) {
                $nextChapter = $chapters->get($currentIndex + 1);
            }

            $completedSubmodules = [];
            if (!auth()->user()->hasRole('teacher')) {
                $completedSubmodules = DB::transaction(function () use ($module, $chapter, $user) {
                    $module->users()
                        ->syncWithoutDetaching([
                            $user->id => ['last_visit' => $chapter->id]
                        ]);

                    $completedSubmodules = json_decode(
                        $module->users->first()->pivot->completed_submodules
                    );

                    if (is_null($completedSubmodules) || !in_array($chapter->id, $completedSubmodules)) {
                        $completedSubmodules[] = $chapter->id;
                        $module->updateUserCompletedSubmodules($completedSubmodules);
                        $user->profile->increment('xp', 10);
                    } else {
                        $user->profile->increment('xp');
                    }

                    return $completedSubmodules;
                });
            }
        } else {
            abort(404);
        }

        if ($chapter->material && is_null($chapter->material->embed_links)) {
            $chapter->material->embed_links = [];
        }

        $chapter->load(['assessment' => function ($query) {
            $query->where('is_active', true)->where('published_at', '<=', now());
        }]);

        $hasTakenAssessment = true;
        $questionNull = false;

        if ($chapter->assessment && $chapter->assessment->questions->isEmpty()) {
            $questionNull = true;
        }

        if ($chapter->assessment) {
            $au = AssessmentUser::query()
                ->where('user_id', auth()->id())
                ->where('assessment_id', $chapter->assessment->id)
                ->get()
                ->last();

            $userResponses = UserResponses::query()
                ->where('user_id', auth()->id())
                ->where('assessment_id', $chapter->assessment->id)
                ->get();

            $hasTakenAssessment = is_null($au) ? false : true;

            if (!is_null($au) && $au->is_completed == 0 && $au->updated_at->addMinutes($chapter->assessment->duration_minutes) > now()) {
                return to_route('courses.quiz', [$module, $chapter]);
            }
        }

        if (!$nextChapter->material && !$nextChapter->assessment) {
            $nextChapter = null;
        }

        if (auth()->user()->hasRole('teacher')) {
            return view('learns.learn-teacher', [
                'module' => $module,
                'currentChapter' => $chapter,
                'prevChapter' => $prevChapter,
                'nextChapter' => $nextChapter,
                'completedSubmodules' => is_null($completedSubmodules) ? [] : $completedSubmodules,
                'hasTakenAssessment' => $hasTakenAssessment,
                'questionNull' => $questionNull,
            ]);
        } else {
            return view('learns.learn', [
                'module' => $module,
                'currentChapter' => $chapter,
                'prevChapter' => $prevChapter,
                'nextChapter' => $nextChapter,
                'completedSubmodules' => $completedSubmodules,
                'hasTakenAssessment' => $hasTakenAssessment,
                'userResponses' => $userResponses ?? null,
            ]);
        }
    }
}
