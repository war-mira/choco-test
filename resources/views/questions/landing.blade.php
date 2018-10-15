@extends('redesign.layouts.inner-page')
@section('content')
    
    <section class="pages--question-landing pages--question__index">
        <div class="container">
            <div class="index-intro__container">
                <div class="index-intro__heading landing-intro__heading">
                    <h1>Задай вопрос врачу<br>прямо сейчас !</h1>
                </div>
                <div class="question_landing_form-block">
                    <div class="landing-info">
                        <p>
                            Задайте свой вопрос квалифицированному врачу и получите бесплатный ответ! Сервис iDoctor.kz гарантирует вашу 100% анонимность.
                        </p>
                    </div>
                    <div class="question--landing_form">
                        @include('forms.public.ask_doctor_form')
                   </div>
                </div>
                <div class="index-intro__heading">
                    <h1>Бесплатный сервис поиска врача</h1>
                    <div>Найти проверенного врача — легко!</div>
                </div>
                <div class="index-intro__stats">
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-1.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Doctor::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Врачей работают с нами</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-2.svg')}}" alt=""></div>
                        {{--<div class="index-intro__stat-val">{{\App\Callback::localPublic()->count()}}</div>--}}
                        <div class="index-intro__stat-val">7015</div>
                        <div class="index-intro__stat-text">Записались через нас</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-3.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Comment::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Реальных отзывов</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-4.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">800+</div>
                        <div class="index-intro__stat-text">Ответов врачей</div>
                    </div>
                </div>
                <div class="footer-contacts__appointment">
                    <a href="#quick-order-modal" rel="modal-link" class="btn">Записаться на прием</a>
                </div>
            </div>
        </div>
    </section>

@endsection

