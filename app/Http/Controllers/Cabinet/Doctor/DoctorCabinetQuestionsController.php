<?php

namespace App\Http\Controllers\Cabinet\Doctor;

use App\Question;
use App\QuestionAnswer;
use App\QuestionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DoctorCabinetQuestionsController extends DoctorCabinetController
{
    public function index(Request $request)
    {
        $questions = Question::query();
        if ($request->search) {
            $questions->where('text', 'like', "%$request->search%");
        }
        if($request->answered ){
            if ($request->answered == Question::ANSWERED) {
                $questions = $questions->answeredNotByDoctor($this->doctor);
            } else if ($request->answered == Question::ANSWERED_BY_DOCTOR) {
                $questions = $questions->answeredByDoctor($this->doctor);
            } else {
                $questions = $questions->notAnswered();
            }
        }

        $questions = $questions->orderBy('created_at', 'desc')->paginate(10);

        return view('cabinet.doctor.questions.index', ['doctor' => $this->doctor, 'user' => $this->user, 'questions' => $questions]);
    }

    public function viewQuestion(Question $question)
    {
        return view('cabinet.doctor.questions.view', ['doctor' => $this->doctor, 'user' => $this->user, 'question' => $question]);
    }

    public function sendAnswer(Request $request, Question $question)
    {
        $data = $request->all();
        $answer = new QuestionAnswer();
        $data['question_id'] = $question->id;
        $data['doctor_id'] = $this->doctor->id;
        $answer->fill($data);
        $answer->save();

        if($answer){
            $user = $question->user;
            \SmsService::send([
                'recipient' => $user->phone,
                'text'      => 'Доктор ответил на ваш вопрос на сайте iDoctor. Вы можете посмотреть ответ на вашем электронном ящике.'
            ]);

            $subject = 'Новый ответ на вопрос';

            $this->sendMail($user, $answer, $subject);
        }

        return redirect()->back();
    }

    public function editAnswer($id)
    {
        $answer = QuestionAnswer::find($id);

        return view('cabinet.doctor.questions.answer-edit', ['doctor' => $this->doctor, 'user' => $this->user, 'answer' => $answer]);
    }

    public function updateAnswer(Request $request, $id){
        $validator = \Validator::make($request->all(), [
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $answer = QuestionAnswer::find($id);
            $answer->fill($request->all());
            $answer->save();

            if($answer){
                $user = $answer->question->user;
                \SmsService::send([
                    'recipient' => $user->phone,
                    'text'      => 'Доктор изменил ответ на ваш вопрос на сайте iDoctor. Вы можете посмотреть ответ на вашем электронном ящике.'
                ]);

                $subject = 'Доктор изменил ответ на вопрос';

                $this->sendMail($user, $answer, $subject);
            }

            return redirect()->back();
        }
    }

    public function sendMail(QuestionUser $user, QuestionAnswer $answer, $subject)
    {
        $data = [
            'user' => $user,
            'doctor' => $this->doctor,
            'answer' => $answer
        ];

        Mail::send('mail.question', $data, function ($m) use($user, $subject) {
            $m->to($user->email)->subject($subject);
        });
    }
}