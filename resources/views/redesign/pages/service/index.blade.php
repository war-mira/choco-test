@extends('redesign.layouts.inner-page')
@section('content')
@include('search.search_box_service')
    <section class="pages--service pages--service__index">
        @include('search.filtr_service')
        <div class="container questions--list">
            <div class="service-list-block">
                <div class="service-list-column">
                    <div class="entity-line__name">
                        <a href="#">Гинекология</a>
                    </div>
                    <div class="entity-line__list">
                        <ul>
                            <li><a href=#>Введение ВМС</a></li>
                            <li><a href=#>Медикаментозное прерывание беременности</a></li>
                            <li><a href=#>Удаление ВМС</a></li>
                            <li><a href=#>Ведение беременности</a></li>
                            <li><a href=#>Предстательная железа</a></li>
                        </ul>
                    </div>
                </div>
                <div class="service-list-column">
                    <div class="entity-line__name">
                        <a href="#">УЗИ-диагностика</a>
                    </div>
                    <div class="entity-line__list">
                        <ul>
                            <li><a href=#>Введение ВМС</a></li>
                            <li><a href=#>Медикаментозное прерывание беременности</a></li>
                            <li><a href=#>Удаление ВМС</a></li>
                            <li><a href=#>Ведение беременности</a></li>
                            <li><a href=#>Предстательная железа</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

