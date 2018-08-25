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
        if(isset($dataUser['birthday'])){
            $dataUser['birthday'] = Carbon::createFromFormat("Y-m-d", $dataUser['birthday']);

        }elseif (isset($dataUser['birthday-mobile'])){
            $dataUser['birthday'] = Carbon::createFromFormat("Y-m-d\TH:i", $dataUser['birthday-mobile']);
        }
        $dataUser['phone'] = isset($dataUser['phone']) ? FormatHelper::phone($dataUser['phone']):'';
        $dataUser['question_id'] = $question->id;
        $questionUser = QuestionUser::create($dataUser);
        $questionUser->save();

        return $question;
    }

}
