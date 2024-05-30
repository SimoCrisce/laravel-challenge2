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
    $courses = User::find(Auth::id())->courses()->paginate(5);
    // $courses = Course::all();
    // if(Auth::user()->role) TODO
    return view('dashboard', ['courses' => $courses]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/courses/prenota/{id}', [CourseController::class, 'prenota'])->name('courses.prenota');
    Route::post('/courses/annulla/{id}', [CourseController::class, 'annulla'])->name('courses.annulla');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Route::resource('courses', CourseController::class);

require __DIR__.'/auth.php';
