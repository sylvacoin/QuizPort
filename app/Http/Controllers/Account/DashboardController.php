<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function teacher()
    {
        return view('teacher.dashboard');
    }

    public function student()
    {
        $studentId = Auth::user()->id;
        $classrooms = $this->getClasses()->whereHas('classroom_students', function($q) use ($studentId){
            $q->where('student_id', '!=', $studentId);
        })->paginate(10);
        return view('student.dashboard', compact('classrooms'));
    }

    private function getClasses()
    {
        return Classroom::with('owner');
    }
}
