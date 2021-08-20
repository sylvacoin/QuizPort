<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        //get all the courses
        return view('courses.index', compact('courses'));
    }

    public function myCourses()
    {
        $ownerId = Auth::user()->id;
        $courses = Course::whereHas("owner", function ($user) use ($ownerId) {
            $user->where('owner_id', $ownerId);
        })->paginate(10);
        return view('courses.personal', compact('courses'));
        //get all the courses belonging to particular teacher
    }

    public function store(CourseRequest $request)
    {
//        dd($request);
        //saves a newly created course
        $request->validated();

        try{
            $owner = Auth::user();
            $course = $owner->courses()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title)
            ]);

            if ($course)
                return redirect(route('course.personal'))->withSuccess('Course was added successfully');

            return back()->with('error', 'Course was not created. Please try again');
        }catch (\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred. Please contact administrator');
        }

    }

    public function show()
    {
        //show the create course form
    }

    public function update()
    {
        //updates a particular store.
    }

    public function destroy($id)
    {
        try{
            $owner = Auth::user();

            $course = Course::find($id);

            if (! $course)
                return back()->with('error', 'Course was not found');

            if ($course->owner_id != $owner->id)
                return back()->with('error', 'You dont have right to modify this course');

            $course->delete();

            return back()->withSuccess('Course was deleted successfully');
        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred please contact administrator');
        }
        //deletes a particular course.
    }
}
