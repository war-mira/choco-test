<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelper;
use App\Question;
use App\QuestionUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $model = Question::class;

    public function add(Request $request)
    {
        $dataQuestion = $request->input('question');
        $dataUser = $request->input('user');
        $user = \Auth::user();

        if ($user) {
            $dataQuestion['user_id'] = $user->id;
        }

        $dataQuestion['text'] = strip_tags($dataQuestion['text'] ?? "");
        $question = $this->model::create($dataQuestion);
        $question->save();

        if (isset($dataUser['birthday'])) {
            $dataUser['birthday'] = Carbon::createFromFormat("Y", $dataUser['birthday']);

        } elseif (isset($dataUser['birthday-mobile'])) {
            $dataUser['birthday'] = Carbon::createFromFormat("Y", $dataUser['birthday-mobile']);
        }

        $dataUser['phone'] = isset($dataUser['phone']) ? FormatHelper::phone($dataUser['phone']) : '';
        $dataUser['question_id'] = $question->id;

        $questionUser = QuestionUser::create($dataUser);
        $questionUser->save();

        return $question;
    }

    public function listQuestions()
    {
        $questions = Question::whereHas('answers')
            ->orderBy('created_at', 'desc')
            ->get();
        $answered_questions = Question::wherehas('answers')->count();
        return view('questions.question')->with(
            compact(
                'answered_questions',
                'questions')
        );
    }

    public function item(Question $question)
    {
        $near_questions = Question::whereHas('answers')
            ->get();
        return view('questions.item', compact(
            'question',
            'near_questions'
        ));
    }


}
