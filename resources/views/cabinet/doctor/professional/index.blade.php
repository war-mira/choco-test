@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
            <div class="account-line__main account-content">
                @include('cabinet.components.doctor.profile-header')
                <div class="account-content__body">
                    <div class="doc-prof-data">
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    <div class="doc-prof-data__line-items">
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Специальность</div>
                                            @if($doctor->skills)
                                                @foreach($doctor->skills as $skill)
                                                    <div class="account-data-item__val">{{ $skill->name }}</div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Квалификация</div>
                                            <div class="account-data-item__val">{{$doctor->qualification}}</div>
                                        </div>
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Стаж работы</div>
                                            <div class="account-data-item__val">с {{ $doctor->works_since_year }} ({{$doctor->exp_formatted}})</div>
                                        </div>
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Выезд на дом</div>
                                            <div class="account-data-item__val">{{ $doctor->human_ambulatory }}</div>
                                        </div>
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Детский врач</div>
                                            <div class="account-data-item__val">{{ $doctor->human_child }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">О себе</div>
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    <div class="doc-prof-data__data-text">{!! $doctor->about_text !!}</div>
                                </div>
                            </div>
                        </div>
                        @if(!empty($doctor->exp_text))
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Опыт</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__data-text">{!! $doctor->exp_text !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($doctor->treatment_text))
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Лечение</div>
                                <div class="doc-prof-data__data-lines">
                                    <div class="doc-prof-data__line">
                                        <div class="doc-prof-data__data-text">{!! $doctor->treatment_text !!}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($doctor->grad_text))
                            <div class="doc-prof-data__section">
                                <div class="doc-prof-data__section-heading">Образование и курсы повышения квалификации</div>
                                <div class="doc-prof-data__data-lines">
                                    {!! $doctor->grad_text  !!}
                                </div>
                            </div>
                        @endif

                        <!-- These blocks we will launch later-->
                        {{--<div class="doc-prof-data__section">--}}
                            {{--<div class="doc-prof-data__section-heading">Лечение заболеваний</div>--}}
                            {{--<div class="doc-prof-data__data-lines">--}}
                                {{--<div class="doc-prof-data__line">--}}
                                    {{--<div class="tags-line">--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Аритмия</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Гипертензия</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Гипотония</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Сердечная недостаточность</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Тахикардия</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="doc-prof-data__section">--}}
                            {{--<div class="doc-prof-data__section-heading">Проводимые процедуры</div>--}}
                            {{--<div class="doc-prof-data__data-lines">--}}
                                {{--<div class="doc-prof-data__line">--}}
                                    {{--<div class="tags-line">--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">ЭКГ</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Инвазивная терапия</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Шунтирование</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Стенирование</span>--}}
                                        {{--</div>--}}
                                        {{--<div class="tags-line__item">--}}
                                            {{--<span class="tags-line__item-text">Оперативная терапия</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">Сертификаты и лицензии</div>
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    {!! $doctor->certs_text !!}
                                </div>
                                <div class="doc-prof-data__line">
                                    <div class="certificate-line gallery">
                                        <a href="img/certificates/1350043050_sert.jpg" class="certificate-line__item">
                                            <img src="img/certificates-thumb/1350043050_sert.jpg" alt="">
                                        </a>
                                        <a href="img/certificates/1350043050_sert.jpg" class="certificate-line__item">
                                            <img src="img/certificates-thumb/1350043050_sert.jpg" alt="">
                                        </a>
                                        <a href="img/certificates/1350043050_sert.jpg" class="certificate-line__item">
                                            <img src="img/certificates-thumb/1350043050_sert.jpg" alt="">
                                        </a>
                                        <a href="img/certificates/1350043050_sert.jpg" class="certificate-line__item">
                                            <img src="img/certificates-thumb/1350043050_sert.jpg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doc-prof-data__edit-data">
                            <a href="{{ route('cabinet.doctor.professional.edit') }}" class="btn btn_theme_usual">Редактировать</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection