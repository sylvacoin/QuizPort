<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index($courseId)
    {
        $lessons = Lesson::where('course_id', $courseId)->orderBy('status', 'desc')->paginate(10);
        $course = Course::find($courseId);
        //get all the courses
        return view('courses.course-detail', compact(['course', 'lessons']));
    }

    public function create($courseId)
    {
        $course = Course::find($courseId);
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, $courseId)
    {

        $course = Course::find($courseId);

        if (!$course)
            return back()->with('error', 'Course does not exist');

        try{
            $lesson = $course->lessons()->create([
                'title' => $request->title,
                'description' => $request->description,
                'note' => $request->note,
                'status' => $request->status,
                'room_url' => Str::random(13),
            ]);

            if ($request->file('attachments'))
            {
                foreach($request->file('attachments') as $file)
                {
                    $filePath = $file->store('lesson/'.$lesson->id.'/');
                    $fileType = $file->getMimeType();

                    $lesson->attachments()->create([
                        'file_path' => $filePath,
                        'file_type' => $fileType
                    ]);
                }
            }

            if ($lesson)
                return redirect(URL::previous())->withSuccess('Lesson was added successfully');

            return back()->with('error', 'Lesson was not created. Please try again');
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

            $lesson = Lesson::find($id);

            if (! $lesson)
                return back()->with('error', 'Course was not found');

            if ($lesson->course->owner_id != $owner->id)
                return back()->with('error', 'You dont have right to modify this course');

            $lesson->delete();

            return back()->withSuccess('Course was deleted successfully');
        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred please contact administrator');
        }
        //deletes a particular course.
    }
}
