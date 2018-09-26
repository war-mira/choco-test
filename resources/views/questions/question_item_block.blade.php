<div class="container">
    <div class="section section-question__question-header">
        <h3 class="question-item-title">
            <a href="#">{{ $question->text }}</a>
        </h3>
    </div>
    <div class="section section-question__content entity-line">
        <div class="answers-list-block">
            @foreach($question->answers as $answer)
                <div class="question-block">
                    <div class="question-item-doctor">
                        <div class="parent_cont question-main-img">
                            @component('components.prof-img',[
                                'doctor'=>$answer->doctor,
                                'width'=>140,
                                'height'=>200
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
                                    @if(count($answer->doctor['skills']) > 1 && $i!=(count($doctor['skills'])-1))
                                        / @endif  @endforeach
                            </div>
                        </div>
                        <div class="question-item-answer">
                            <p> {{ $answer->text }} </p>
                        </div>
                    </div>
                    <div class="question-item-value">
                        <div class="question-item-value-text">
                            <h3>Ответ был полезен для вас?</h3>
                        </div>
                        <div class="question-item-value-btns">
                            <inp-rate obj="answer" id="{{$answer->id }}" type="likes">
                                <template slot="likes">{{ $answer->likes }}</template>
                                <template slot="dislikes">{{ $answer->dislikes }}</template>
                            </inp-rate>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="article__aside-desktop">
            <div class="entity-content__banner">
                <img src="{{asset('img/banner.jpg')}}" alt="">
            </div>
        </div>
    </div>

</div>

