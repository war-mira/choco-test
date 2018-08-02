@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
    @include('cabinet.components.doctor.aside')
        <div class="account-line__main account-content">
            @include('cabinet.components.doctor.questions-header')
            <div class="account-content__body">
                <div class="reviews-list">
                    @if(count($questions))
                        @foreach($questions as $question)
                            <div class="reviews-list__item reviews-list-item">
                                <div class="reviews-list-item__inner">
                            <div class="reviews-list-item__line">
                                <div class="reviews-list-item__data-wr">
                                    <div class="reviews-list-item__data">
                                        <div class="reviews-list-item__data-item account-data-item">
                                            <div class="account-data-item__name">Текст вопроса</div>
                                            <div class="account-data-item__val">{{ $question->text }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="reviews-list-item__line">
                                <div class="reviews-list-item__data-wr">
                                    <div class="reviews-list-item__data">
                                        <div class="reviews-list-item__data-item account-data-item">
                                            <div class="account-data-item__name">Дата публикации</div>
                                            <div class="account-data-item__val">{{ \App\Helpers\FormatHelper::userShothDate($question->created_at) }}</div>
                                        </div>
                                        <div class="reviews-list-item__data-item account-data-item">
                                            <div class="account-data-item__name">Пол</div>
                                            <div class="account-data-item__val">{{ \App\QuestionUser::GENDERS[$question->user->gender ]}}</div>
                                        </div>
                                        <div class="reviews-list-item__data-item account-data-item">
                                            <div class="account-data-item__name">Дата рождения</div>
                                            <div class="account-data-item__val">{{ $question->user->birthday }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews-list-item__action">
                                    <a href="{{route('cabinet.doctor.questions.view', $question)}}" class="btn btn_theme_usual">Подробнее</a>
                                </div>
                            </div>
                        </div>
                            </div>
                        @endforeach
                    @else
                        <div class="reviews-list__message">
                            <div class="account-data-item__val">Здесь пока нет вопросов =(</div>
                        </div>
                    @endif
                    @if($questions->links() != "")
                        <div class="reviews-list__pagination pagination">
                            {!! $questions->appends(request()->query())->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection