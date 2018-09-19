<div class="container">
    <div class="section section-question__question-header">
        <h3 class="question-item-title">
            <a href="#">{{ $question->text }}</a>
        </h3>
    </div>
    <div class="section section-question__content entity-line">
        @foreach($question->answers as $answer) 
            <div class="question-block">
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
                        <p> {{ $answer->text }} </p>
                    </div>
                </div>
                <div class="question-item-value">
                    <div class="question-item-value-text">
                        <h3>Ответ был полезен для вас?</h3>
                    </div>
                    <div class="question-item-value-btns">
                        <div class="question-item-help">
                            <a class="btn btn_theme_usual button button--light">Да</a>
                        </div>
                        <div class="question-item-unhelp">
                            <a class="btn btn_theme_usual button button--light">Нет</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="question__aside-desktop">
        <div class="entity-content__banner">
            @component('components.comform',['comments'=>[],'owner'=>['type'=>'Doctor','id'=>1]])
                @slot('title') @endslot
                @slot('visible',5)
                @slot('url','1')
            @endcomponent
        </div>
    </div>
    </div>
    
</div>

