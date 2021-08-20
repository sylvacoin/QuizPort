<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($lessonId)
    {
        $quizes = Quiz::where('lesson_id', $lessonId)->paginate(10);
        $lesson = Lesson::find($lessonId);
        return view('quiz.index', compact(['quizes','lesson']));
    }

    public function create($lessonId)
    {
        $lesson = Lesson::find($lessonId);
        return view('quiz.create', compact('lesson'));
    }
}
