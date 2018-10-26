@extends('app')
@section('content')
    <section class="section error--section__container">
        <div class="container">
            <div class="errors_block">
                <h2 class="intro__title">
                    <strong>404</strong>
                </h2>
                <p>Страница не найдена</p>
                <div class="error--image__container">
                    <div class="error--image__btn_container">
                        <a href="/" class="btn btn_theme_usual">На главную</a>
                    </div>
                    <div class="error--image__img_container">
                        <img src="/img/ambulance.png" alt="Такой страницы нет.">
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection