<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\LessonRequest;
use App\Models\Classroom;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    public function index($classroomId)
    {
        $lessons = Lesson::where('classroom_id', $classroomId)->orderBy('status', 'desc')->paginate(10);
        $classroom = Classroom::find($classroomId);
        //get all the classroom
        return view('classroom.classroom-detail', compact(['classroom', 'lessons']));
    }

    public function create($classroomId)
    {
        $classroom = Classroom::find($classroomId);
        return view('lessons.create', compact('classroom'));
    }

    public function store(Request $request, $classroomId)
    {

        $classroom = Classroom::find($classroomId);

        if (!$classroom)
            return back()->with('error', 'Classroom does not exist');

        try{
            $lesson = $classroom->lessons()->create([
                'title' => $request->title,
                'description' => $request->description,
                'note' => $request->note,
                'status' => $request->status
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

    public function show($lessonId)
    {
        try{
            $lesson=Lesson::find($lessonId);
            if (!$lesson)
                throw new \Exception('Lesson was not found');
            return view('lessons.details', compact('lesson'));
        }catch (\Exception $ex)
        {
            return back()->with('error', $ex->getMessage());
        }
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
                return back()->with('error', 'Classroom was not found');

            if ($lesson->classroom->owner_id != $owner->id)
                return back()->with('error', 'You dont have right to modify this classroom');

            $lesson->delete();

            return back()->withSuccess('Classroom was deleted successfully');
        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', 'An error occurred please contact administrator');
        }
        //deletes a particular classroom.
    }
}
