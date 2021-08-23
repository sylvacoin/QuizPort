<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\TeacherController;
use App\Http\Controllers\Account\ClassroomController;
use App\Http\Controllers\Account\LessonController;
use App\Http\Controllers\Account\QuizController;
use App\Http\Controllers\Account\StudentController;
use App\Http\Controllers\Account\DashboardController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', function () {
        $role = Auth::user()->getRole();

        if ( $role == 'teacher')
            return redirect(\route('teacher.dashboard'));
        else if ($role == 'student')
            return redirect(\route('student.dashboard'));
        else if ($role == 'administrator')
            return redirect(\route('admin.dashboard'));
    })->name('dashboard');

    Route::get('t/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('s/dashboard', [DashboardController::class, 'student'])->name('student.dashboard');
    Route::get('a/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::group(['prefix' => 'teachers'], function (){
        Route::get('', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('create-teachers', [TeacherController::class, 'bulk_create'])->name('teachers.create');
        Route::post('create-teachers', [TeacherController::class, 'store'])->name('teachers.save');
    });
    Route::group(['prefix' => 'classroom'], function (){
        Route::get('', [ClassroomController::class, 'index'])->name('course.index');
        Route::get('my-classroom', [ClassroomController::class, 'myCourses'])->name('course.personal');
        Route::get('create', [ClassroomController::class, 'show'])->name('course.create');

        Route::post('create', [ClassroomController::class, 'store'])->name('course.save');
        Route::post('delete/{id}', [ClassroomController::class, 'destroy'])->name('course.destroy');
        Route::get('{courseId}/detail', [LessonController::class, 'index'])->name('course.show');
        Route::get('{courseId}/create', [LessonController::class, 'create'])->name('lesson.create');
        Route::post('{courseId}/create', [LessonController::class, 'store'])->name('lesson.save');
        Route::get('{courseId}/subscribe', [ClassroomController::class, 'subscribeToCourse'])->name('course.subscribe');
    });

    Route::group(['prefix' => 'lessons'], function(){
        Route::post('delete/{id}', [LessonController::class, 'destroy'])->name('lesson.destroy');
        Route::get('{lessonId}/detail', [QuizController::class, 'index'])->name('lesson.show');
        Route::get('{lessonId}/create', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('{lessonId}/create', [QuizController::class, 'store'])->name('quiz.save');
    });

    Route::group(['prefix' => 'quiz'], function(){
        Route::post('delete/{quizId}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    });

    Route::group(['prefix' => 'students'], function(){
        Route::get('my-classroom', [StudentController::class, 'myCourses'])->name('student.my-classroom');
    });
});

require __DIR__.'/auth.php';
