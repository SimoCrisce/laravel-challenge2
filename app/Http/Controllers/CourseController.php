<?php

namespace App\Http\Controllers;

use App\Models\Slot;
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
        // ->where('id', 'like', '%' . $request->query('q', '') . '%')

        $courses = Course::with('users', 'activity', 'slot')->paginate(5);
        // $courses = User::find(Auth::id())->courses()->wherePivot('status', 'accepted')->paginate(5);

        // $user = Course::all();
        // dd($user);
        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = Activity::all();
        $slots = Slot::all();
        return view('courses.create', 
        ['activities' => $activities, 'slots' => $slots]
    );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // dd($data);

        $new_course = new Course();
        $new_course->activity_id = $data['activity_id'];
        $new_course->slot_id = $data['slot_id'];
        $new_course->location = $data['location'];
        $new_course->save();

        return redirect()->route('courses.show', ['id' => $new_course->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($course)
    {
        $course = Course::find($course);
        return view('courses.show', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course_id = Course::findOrFail($id);
        $activities = Activity::all();
        $slots = Slot::all();
        return view('courses.edit', ['id' => $course_id, 'activities' => $activities, 'slots' => $slots]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $course = Course::findOrFail($id);

        $course->activity_id = $data['activity_id'];
        $course->slot_id = $data['slot_id'];
        $course->location = $data['location'];
        $course->update();

        return redirect()->route('courses.show', ['id' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
    }
}
