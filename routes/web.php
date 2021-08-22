<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\TeacherController;
use App\Http\Controllers\Account\CourseController;
use App\Http\Controllers\Account\LessonController;
use App\Http\Controllers\Account\QuizController;
use App\Http\Controllers\Account\StudentController;


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
        return view('dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'teachers'], function (){
        Route::get('', [TeacherController::class, 'index'])->name('teachers.index');
        Route::get('create-teachers', [TeacherController::class, 'bulk_create'])->name('teachers.create');
        Route::post('create-teachers', [TeacherController::class, 'store'])->name('teachers.save');
    });
    Route::group(['prefix' => 'courses'], function (){
        Route::get('', [CourseController::class, 'index'])->name('course.index');
        Route::get('my-courses', [CourseController::class, 'myCourses'])->name('course.personal');
        Route::get('create', [CourseController::class, 'show'])->name('course.create');
        Route::post('create', [CourseController::class, 'store'])->name('course.save');
        Route::post('delete/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
        Route::get('{courseId}/detail', [LessonController::class, 'index'])->name('course.show');
        Route::get('{courseId}/create', [LessonController::class, 'create'])->name('lesson.create');
        Route::post('{courseId}/create', [LessonController::class, 'store'])->name('lesson.save');
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
        Route::get('my-courses', [StudentController::class, 'myCourses'])->name('student.my-courses');
    });
});

require __DIR__.'/auth.php';
