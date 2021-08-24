<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::paginate(10);
        //get all the classroom
        return view('classroom.index', compact('classrooms'));
    }

    public function myCourses()
    {
        $ownerId = Auth::user()->id;
        $classrooms = Classroom::whereHas("owner", function ($user) use ($ownerId) {
            $user->where('owner_id', $ownerId);
        })->paginate(10);
        return view('classroom.personal', compact('classrooms'));
        //get all the classroom belonging to particular teacher
    }

    public function store(CourseRequest $request)
    {
//        dd($request);
        //saves a newly created classroom
        $request->validated();

        try{
            $owner = Auth::user();
            $classroom = $owner->classrooms()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'room_id' => Str::random(13),
            ]);

            if ($classroom)
                return redirect(route('classroom.personal'))->withSuccess('Classroom was added successfully');

            return back()->with('error', 'Classroom was not created. Please try again');
        }catch (\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred. Please contact administrator');
        }

    }

    public function show()
    {
        //show the create classroom form
    }

    public function update()
    {
        //updates a particular store.
    }

    public function destroy($id)
    {
        try{
            $owner = Auth::user();

            $classroom = Classroom::find($id);

            if (! $classroom)
                return back()->with('error', 'Classroom was not found');

            if ($classroom->owner_id != $owner->id)
                return back()->with('error', 'You dont have right to modify this classroom');

            $classroom->delete();

            return back()->withSuccess('Classroom was deleted successfully');
        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred please contact administrator');
        }
        //deletes a particular classroom.
    }

    public function subscribeToClassroom($classroomId)
    {
        try{
            $user = Auth::user();

            if ($user->getRole() != 'student')
                throw new \Exception('This account is not a student account');

            $classroomFound = ClassroomStudent::where('classroom_id', $classroomId)->where('student_id', $user->id)->count();
            if ($classroomFound > 0)
                throw new \Exception('You already subscribed to this classroom');

            $classroomStudent = ClassroomStudent::create([
                'classroom_id' => $classroomId,
                'student_id' => $user->id
            ]);

            if (!$classroomStudent)
                throw new \Exception('An error occurred. Please contact administrator');

            return back()->with('success', 'Your subscription was successful');
        }catch (\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', $ex->getMessage());
        }
    }

    public function unsubscribeFromClassroom($classroomId)
    {
        try{
            $user = Auth::user();

            if ($user->getRole() != 'student')
                throw new \Exception('This account is not a student account');

            $classroomFound = ClassroomStudent::where('classroom_id', $classroomId)->where('student_id', $user->id)->first();
            if (!$classroomFound)
                throw new \Exception('You have not subscribed to this classroom');

            $classroomFound->delete();

            return back()->with('success', 'Your successfully unsubscribed to '.$classroomFound->classroom->title.' class');
        }catch (\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', $ex->getMessage());
        }
    }
}
