<?php

use App\Http\Controllers\AssessmentUserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlacementTestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // PLACEMENT TEST
    Route::get('/start', [PlacementTestController::class, 'start'])->name('start');
    Route::get('/language', [PlacementTestController::class, 'language'])->name('language');
    Route::get('/reminder/{course}', [PlacementTestController::class, 'reminder'])->name('reminder');
    Route::get('/placement-test/{course}', [PlacementTestController::class, 'test'])->name('placement.test');
    Route::get('/finish', [PlacementTestController::class, 'finish'])->name('finish');

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');

    // COURSES
    Route::get('/courses/my', [CourseController::class, 'my'])->name('courses.my');
    Route::get('{subject}/courses', [CourseController::class, 'courses'])->name('courses.list');
    Route::get('/courses/{course}/levels', [CourseController::class, 'levels'])->name('courses.levels');
    Route::get('/courses/{module}/learn', [CourseController::class, 'start'])->name('courses.start');
    Route::get('/courses/{module}/learn/{chapter}', [CourseController::class, 'learn'])->name('courses.learn');

    // QUIZ
    Route::get('/courses/{module}/quiz/{chapter}', [QuizController::class, 'quiz'])->name('courses.quiz');

    // LEVEL / MODULE
    Route::get('/level/{module}', [ModuleController::class, 'show'])->name('courses.modules.show');

    // LEADERBOARD
    Route::get('/leaderboards', [LeaderboardController::class, 'index'])->name('leader.index');

    Route::middleware('can:teacher')->group(function () {
        // Room/Class
        Route::get('/class', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/class/{room}', [RoomController::class, 'show'])->name('rooms.show');
        Route::get('/class/{room}/{user}', [RoomController::class, 'mhs'])->name('rooms.mhs');

        // Review
        Route::get('/level/{module}/review/{assessment}', [ReviewController::class, 'index'])->name('courses.review.index');
        Route::get('/level/{module}/review/{assessment}/{user}', [ReviewController::class, 'show'])->name('courses.review.show');
        Route::get('/level/{module}/review/{assessment}/responses/{userresponses}', [ReviewController::class, 'edit'])->name('courses.review.edit');
        Route::put('/review/{user}/submit', [ReviewController::class, 'update'])->name('quiz.review.update');

        // Teacher testing placement-test
        Route::get('/testing/start', [TeacherController::class, 'start'])->name('testing.start');
        Route::get('/testing/placement-test', [TeacherController::class, 'test'])->name('testing.placement-test');
    });


    // Assessment user
    Route::middleware('can:superadmin')->group(function () {
        Route::get('/review/{assessment}/{user}', [AssessmentUserController::class, 'review'])->name('review.assessment');

        Route::get('/reset/{assessment}/{user}', [AssessmentUserController::class, 'reset'])->name('reset.assessment');

        // Get all users who have siakad
        Route::get('/dapur/espresso/{assessment}', [AssessmentUserController::class, 'espresso'])->name('dapur.espresso');
        Route::get('/dapur/latte/{assessment}', [AssessmentUserController::class, 'latte'])->name('dapur.latte');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user}/l', [ProfileController::class, 'detail'])->name('profile.detail');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/setting', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/informations', [ProfileController::class, 'updateProfiles'])->name('profile.update.information');
    Route::patch('/profile/local', [ProfileController::class, 'updateLocal'])->name('profile.update.local');
});

require __DIR__ . '/auth.php';
