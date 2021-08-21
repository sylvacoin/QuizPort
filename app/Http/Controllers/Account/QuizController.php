<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function store(Request $request, $lessonId)
    {
        try{
            $lesson = Lesson::find($lessonId);
            $optionTypes = ['multichoice', 'subjective', 'boolean'];

            if (!$lesson)
                throw new \Exception('Lesson was not found');


            $quiz = $lesson->quizzes()->create([
                'question' => $request->question,
                'option_type' => $optionTypes[$request->option_type - 1]
            ]);

            if (!$quiz)
                throw new \Exception('An error occurred question was not added');

            if ($request->option_type == 1)
            {
                foreach($request->options as $key => $option)
                {
                    $quiz->quiz_options()->create([
                        'option_key' => $this->toAlpha($key),
                        'option_value' => $option,
                    ]);
                }
            }

            $quiz->answer = $request->answer[$request->option_type];
            $quiz->save();

            return redirect( route('lesson.show', $lessonId) )->with('success', 'Question was added successfully');

        }catch(\Exception $ex)
        {
            Log::error($ex);
            return back()->with('error', $ex->getMessage());
        }

    }

    function toAlpha($num) {
        $alphabet = range('A', 'Z');
        return $alphabet[$num];
    }
}
