    <div class="section questions-list">
        <div class="container">
            <div class="questions-header-block">
                <h1 class="button">Вопросы и ответы</h1>
                <a href="{{url('question_list')}}">{{ $answered_questions }}+ отвеченных врачами вопросов</a>
            </div>
            <div class="questions-block">
                @foreach($questions as $question)
                    <div class="question-item">
                        <div class="question-item-header">
                            <h3 class="question-item-title">
                                <a href="{{url('question_item/'.$question->id)}}">{{ $question->text }}</a>
                            </h3>
                        </div>
                        @foreach($question->answers as $answer) 
                            <div class="question-item-doctor">
                                <div class="parent_cont question-main-img">
                                    <img src="{{ url($answer->doctor->avatar) }}" alt="{{ $answer->doctor->name }}">
                                </div>
                                <div class="parent_cont question-doctor-name">
                                    <h4>
                                        <a href="{{Route('doctor.item', ['doctor' => $answer->doctor->alias])}}">{{ $answer->doctor->name}}</a>
                                    </h4>
                                    <div class="entity-line__descr">
                                        @foreach ($answer->doctor['skills'] as $i=>$skill)
                                            <a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                                        @if(count($answer->doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1)) / @endif  @endforeach
                                    </div>
                                </div>
                                <div class="question-item-answer">
                                    <p>{{ $answer->text }} </p>
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