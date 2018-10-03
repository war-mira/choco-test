<div class="section questions-list">
    <div class="container">
        <div class="questions-header-block">
            <a href="{{url('question/list')}}">
                <h2 class="button">Вопросы и ответы</h2>
            </a>
            <div class="result-control-bar__query-count">
                <p>Задайте вопрос врачу и получите профессиональный ответ. <br>Гарантируем 100%-ую анонимность вопроса</p>
            </div>
            <a href="{{url('question/list')}}">{{ $answered_questions }}+ отвеченных врачами вопросов</a>
        </div>
        <div class="questions-block">
            @foreach($questions as $question)
                <div class="question-item">
                    <div class="question-item-header">
                        <h3 class="question-item-title">
                            <a href="{{url('question/item/'.$question->id)}}">{{ \Illuminate\Support\Str::words($question->text,15) }}</a>
                        </h3>
                    </div>
                    @foreach($question->answers->take(1) as $answer)
                        <div class="question-item-doctor">
                            <div class="parent_cont question-main-img">
                                @component('components.prof-img',['doctor'=>$answer->doctor,
                                    'width'=>100,
                                    'height'=>100
                                ])
                                    @slot('src')
                                        {{$answer->doctor['avatar']}}
                                    @endslot
                                    @slot('alt')
                                        {{$answer->doctor->name}}
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="parent_cont question-doctor-name">
                                <h4>
                                    <a href="{{Route('doctor.item', ['doctor' => $answer->doctor->alias])}}">{{ $answer->doctor->name}}</a>
                                </h4>
                                <div class="entity-line__descr">
                                    @foreach ($answer->doctor['skills'] as $i=>$skill)
                                        <a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                                        @if(count($answer->doctor['skills']) > 1 && $i!=(count($answer->doctor['skills'])-1)) / @endif  @endforeach
                                </div>
                            </div>
                            <div class="question-item-answer">
                                <p>{{ str_limit($answer->text, $limit = 100, $end = '...') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="button-ask-container">
            <a href="#question__modal" rel="modal-link" class="btn btn_theme_usual">Задать вопрос врачу</a>
        </div>
    </div>
    </div>