<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Imports\TeachersImport;
use App\Models\Course;
use App\Models\CourseStudent;
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
//        $students = User::whereHas('courses', function($query) use ($teacherId) {
//            $query->where('owner_id', $teacherId);
//        })->map(function ($el) {
//            return $el->students();
//        });
//            dd($students);
    }

    public function courses()
    {
        $courses = Course::paginate(10);
        return view('student.courses', compact('courses'));
    }

    public function myCourses()
    {
        $ownerId = Auth::user()->id;
        $courses = Course::whereHas("owner", function ($user) use ($ownerId) {
            $user->where('owner_id', $ownerId);
        })->paginate(10);
        return view('student.my-courses', compact('courses'));
        //get all the courses belonging to particular teacher
    }


}
