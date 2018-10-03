<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelper;
use App\Http\Requests\Question\QuestionFilters;
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
        //$question->save();

        if (isset($dataUser['birthday'])) {
            $dataUser['birthday'] = Carbon::createFromDate( $dataUser['birthday'],1,1);

        }

        $dataUser['phone'] = isset($dataUser['phone']) ? FormatHelper::phone($dataUser['phone']) : '';
        $dataUser['question_id'] = $question->id;

        QuestionUser::create($dataUser);
        //$questionUser->save();

        return $question;
    }

    public function listQuestions(QuestionFilters $filters)
    {
        $sort = request()->get('sort');
        $order = request()->get('order');
        if(empty(request()->all())){
            $filters->add([
                'default'=>''
            ]);
        }

        $questions = Question::whereHas('answers')
            ->with('answers')
            ->filter($filters)
            ->paginate(20);
        $answered_questions = Question::wherehas('answers')->count();

        return view('questions.list')->with(
            compact(
                'answered_questions',
                'questions')
        );
    }

    public function item(Question $question)
    {
        $near_questions = Question::whereHas('answers')
            ->limit(10)
            ->get();
        return view('questions.item', compact(
            'question',
            'near_questions'
        ));
    }


}
