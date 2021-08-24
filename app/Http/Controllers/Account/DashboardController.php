<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $classroom_count = Classroom::count();
        $teacher_count = User::whereHas('roles', function($q){
            $q->where('name', 'teacher');
        })->count();
        $student_count = User::whereHas('roles', function($q){
            $q->where('name', 'student');
        })->count();
        $lesson_count = Lesson::count();
        return view('admin.dashboard', compact(['classroom_count', 'teacher_count', 'student_count', 'lesson_count']));
    }

    public function teacher()
    {
        return view('teacher.dashboard');
    }

    public function student()
    {
        $studentId = Auth::user()->id;
        $classrooms = Classroom::all();
//        $classrooms = $this->getClasses()->whereHas('classroom_students', function($q) use ($studentId){
//            $q->where('student_id', '!=', $studentId);
//        })->paginate(10);
        return view('student.dashboard', compact('classrooms'));
    }

    private function getClasses()
    {
        return Classroom::with('owner');
    }
}
