@extends('redesign.layouts.inner-page')
@section('content')
    <section class="section error--section__container_bad">
        <div class="container">
            <div class="errors_block">
                <div class="error--image__img_container">
                    <img src="/img/plaster.png" alt="Кажется, что-то пошло не так ...">
                </div>
                <h2 class="intro__title">
                    <strong>500</strong>
                </h2>
                <p>Кажется, что-то пошло не так ...</p>
                <div class="error--image__btn_container">
                    <a href="/" class="btn btn_theme_usual">На главную</a>
                </div>
            </div>
            
        </div>
    </section>
@endsection

