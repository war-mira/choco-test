<section class="questions-slider questions-slider_bg-white">
    <div class="container">
        <div class="question-slider_heading">Другие вопросы</div>
        <div class=" question-slider__slider question-slider">
            @foreach($near_questions as $near_question)
                <div class="question-slider__item">
                    <div class="question__question-header">
                        <h3 class="question-item-title">
                            <a href="{{url('question_item/'.$near_question->id)}}">{{ $near_question->text }}</a>
                        </h3>
                    </div>
                    @foreach($near_question->answers->take(1) as $near_answer) 
                        <div class="question-slider-item-doctor">
                            <div class="parent_cont question-main-img">
                                @component('components.prof-img',['doctor'=>$near_answer->doctor])
                                    @slot('src')
                                        {{$near_answer->doctor['avatar']}}
                                    @endslot
                                    @slot('width')
                                        100px
                                    @endslot
                                    @slot('alt')
                                        {{$near_answer->doctor->name}}
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="question-doctor-name">
                                <h4>
                                    <a href="{{Route('doctor.item', ['doctor' => $near_answer->doctor->alias])}}">{{ $near_answer->doctor->name}}</a>
                                </h4>
                                <div class="entity-line__descr">
                                    @foreach ($near_answer->doctor['skills'] as $i=>$skill)
                                        <a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                                    @if(count($near_answer->doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1)) / @endif  @endforeach
                                </div>
                            </div>
                            <div class="question-item-answer">
                                <p>{{ $near_answer->text }} </p>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
            @endforeach
        </div>
    </div>
</section>