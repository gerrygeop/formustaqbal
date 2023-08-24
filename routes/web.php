<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmoduleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    // placement test
    Route::get('/start', [TestController::class, 'start'])->name('start');
    Route::get('/language', [TestController::class, 'language'])->name('language');
    Route::get('/placement-test/{subject:id}', [TestController::class, 'test'])->name('placement.test');
    Route::get('/finish', [TestController::class, 'finish'])->name('finish');

    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->middleware(['verified'])->name('dashboard');

    // courses
    Route::get('/courses/my', [CourseController::class, 'my'])->name('courses.my');
    Route::get('/courses/{subject}/list', [CourseController::class, 'courses'])->name('courses.list');
    Route::get('/courses/{course}/attach', [CourseController::class, 'attach'])->name('courses.attach');
    Route::get('/courses/{module}/get', [CourseController::class, 'mulai'])->name('courses.mulai');
    Route::get('/courses/{module}/learn/{submodule}', [CourseController::class, 'learn'])->name('courses.learn');

    Route::get('/courses/{course}/lesson/{submodule}', [SubmoduleController::class, 'lesson'])->name('courses.lesson');

    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Leaderboard
    Route::get('/leaderboards', [LeaderboardController::class, 'index'])->name('leader.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/setting', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/informations', [ProfileController::class, 'updateProfiles'])->name('profile.update.information');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
