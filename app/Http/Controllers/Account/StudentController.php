<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Imports\TeachersImport;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $users = User::whereHas("roles", function ($q){
            $q->where('name', 'student');
        });

        $teachers = $users->paginate(4);

        return view('student.index', compact('student'));
    }

    public function myStudents()
    {
//        $teacherId = Auth::user()->id;
//        $students = User::whereHas('classroom', function($query) use ($teacherId) {
//            $query->where('owner_id', $teacherId);
//        })->map(function ($el) {
//            return $el->students();
//        });
//            dd($students);
    }

    public function courses()
    {
        $courses = Classroom::paginate(10);
        return view('student.classroom', compact('courses'));
    }

    public function myCourses()
    {
        $studentId = Auth::user()->id;

        $courses = Classroom::with('owner')->whereHas('course_students', function($q) use ($studentId){
            $q->where('student_id', $studentId);
        })->paginate(10);
        return view('student.my-classroom', compact('courses'));
    }


}
