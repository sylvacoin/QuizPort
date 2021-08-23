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
        Route::get('', [ClassroomController::class, 'index'])->name('classroom.index');
        Route::get('my-classroom', [ClassroomController::class, 'myCourses'])->name('classroom.personal');
        Route::get('create', [ClassroomController::class, 'show'])->name('classroom.create');

        Route::post('create', [ClassroomController::class, 'store'])->name('classroom.save');
        Route::post('delete/{id}', [ClassroomController::class, 'destroy'])->name('classroom.destroy');
        Route::get('{classroomId}/detail', [LessonController::class, 'index'])->name('classroom.show');
        Route::get('{classroomId}/create', [LessonController::class, 'create'])->name('lesson.create');
        Route::post('{classroomId}/create', [LessonController::class, 'store'])->name('lesson.save');
        Route::get('{classroomId}/subscribe', [ClassroomController::class, 'subscribeToCourse'])->name('classroom.subscribe');
    });

    Route::group(['prefix' => 'lessons'], function(){
        Route::post('delete/{id}', [LessonController::class, 'destroy'])->name('lesson.destroy');
        Route::get('{id}/detail', [LessonController::class, 'show'])->name('lesson.show');
        Route::get('{lessonId}/quiz', [QuizController::class, 'index'])->name('quiz.index');
        Route::get('{lessonId}/create', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('{lessonId}/create', [QuizController::class, 'store'])->name('quiz.save');
    });

    Route::group(['prefix' => 'quiz'], function(){
        Route::post('delete/{quizId}', [QuizController::class, 'destroy'])->name('quiz.destroy');
    });

    Route::group(['prefix' => 'students'], function(){
        Route::get('my-classroom', [StudentController::class, 'myClassrooms'])->name('student.my-classroom');
    });
});

require __DIR__.'/auth.php';
