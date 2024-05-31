<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function accept($id, $user)
    {
        User::find($user)->courses()->updateExistingPivot($id, ['status' => 'accepted']);
        return redirect()->back();
    }

    public function reject($id, $user)
    {
        // User::with('courses')->attach($id, ['status' => 'rejected']);
        User::find($user)->courses()->updateExistingPivot($id, ['status' => 'rejected']);
        return redirect()->back();
    }

    public function prenota($id)
    {
        Auth::user()->courses()->attach($id, ['status' => 'pending']);
        return redirect()->back();
    }

    public function annulla($id)
    {
        Auth::user()->courses()->detach($id);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        // $courses = User::with('courses', 'courses.activity', 'courses.slot')->get();
        // $query = User::where('name', 'like', '%' . $request->query('q', '') . '%')->get();
        $courses = Course::with('users', 'activity', 'slot')
        // ->where('id', 'like', '%' . $request->query('q', '') . '%')
        ->paginate(5);
        // $user = Course::all();
        // dd($user);
        return view('courses.index', ['courses' => $courses]);
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
    public function store(StoreCourseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }
}
