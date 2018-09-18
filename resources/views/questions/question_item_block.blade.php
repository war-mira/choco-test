<div class="container">
    <div class="section section-question__question-header">
        <h3 class="question-item-title">
            <a href="{{url('question_item')}}">Появилась странная синяя сыпь на лысине</a>
        </h3>
    </div>
    <div class="section section-question__content entity-line">
        <div class="question-block">
            <div class="question-item-doctor">
                <div class="parent_cont question-main-img">
                    <img src="/images/80DcC94fXGtSV5ltBHweiv9PAiEVnmIGHYShfVek.jpeg" alt="Попова Людмила Владимировна">
                </div>
                <div class="parent_cont question-doctor-name">
                    <h4>
                        <a href="#">Попова Людмила Владимировна</a>
                    </h4>
                    <div class="entity-line__descr">
                        <a href="#">
                            Дерматолог/Косметолог
                        </a>
                    </div>
                </div>
                <div class="question-item-answer">
                    <p>Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. При создании генератора мы использовали небезизвестный универсальный код речей. </p>
                </div>
            </div>
            <div class="question-item-value">
                <div class="question-item-value-text">
                    <h3>Отзыв был полезен для вас?</h3>
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

