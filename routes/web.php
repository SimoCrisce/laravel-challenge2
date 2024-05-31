<?php

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'home'])->name('home');


Route::get('/dashboard', function () {
    // $courses = Course::has('users')->where('id', 3)->get();
    // $courses = Course::all();
    if(Auth::user()->role === "admin") {
        $courses = Course::with('users', 'slot', 'activity')->paginate(5);
    } else {
        $courses = User::find(Auth::id())->courses()->paginate(5);
    }
    return view('dashboard', ['courses' => $courses]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/courses/prenota/{id}', [CourseController::class, 'prenota'])->name('courses.prenota');
    Route::post('/courses/annulla/{id}', [CourseController::class, 'annulla'])->name('courses.annulla');
    Route::post('/courses/reject/{id}/{user}', [CourseController::class, 'reject'])->name('courses.reject');
    Route::post('/courses/accept/{id}/{user}', [CourseController::class, 'accept'])->name('courses.accept');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';
