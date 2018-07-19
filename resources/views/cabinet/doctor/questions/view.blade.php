@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
    @include('cabinet.components.doctor.aside')
        <div class="account-line__main account-content">
            <div class="account-content__head">
                <div class="account-content__page-name">Вопрос от ананимного пользователя</div>
                <div class="reviews-list-item_single reviews-list-item">
                    <div class="reviews-list-item__inner">
                        <div class="reviews-list-item__line">
                            <div class="reviews-list-item__data-wr">
                                <div class="reviews-list-item__data">
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Текст вопроса</div>
                                        <div class="account-data-item__val">{!! $question->text !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reviews-list-item__line">
                            <div class="reviews-list-item__data-wr">
                                <div class="reviews-list-item__data">
                                    <div class="reviews-list-item__data-item account-data-item">
                                        <div class="account-data-item__name">Дата приема</div>
                                        <div class="account-data-item__val">{{ \App\Helpers\FormatHelper::userShothDate($question->created_at) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-content__page-name">Ответы других докторов</div>
                            @if(count($question->ExceptDoctor($doctor)))
                                @foreach($question->ExceptDoctor($doctor) as $answer)
                                    @include('cabinet.components.doctor.question-answers')
                                @endforeach
                            @else
                            <div class="account-data-item__val">Пока никто из ваших коллег не ответил на этот вопрос. Станьте первым!</div>
                        @endif
                    </div>
                </div>
            </div>
            @if(\App\QuestionAnswer::ByDoctorQuestion($doctor, $question)->count())
                @include('cabinet.components.doctor.question-answer-view')
            @else
                @include('cabinet.components.doctor.question-answer-form')
            @endif
        </div>
    </div>
@endsection