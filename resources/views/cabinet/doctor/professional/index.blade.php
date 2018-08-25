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
                                            @if(count($doctor->skills))
                                                @foreach($doctor->skills as $skill)
                                                    <div class="account-data-item__val">{{ $skill->name }}</div>
                                                @endforeach
                                            @else
                                                <div class="account-data-item__val">Не заполнено</div>
                                            @endif
                                        </div>
                                        <div class="doc-prof-data__data-item account-data-item">
                                            <div class="account-data-item__name">Квалификация</div>
                                            @if(count($doctor->qualifications))
                                                @foreach($doctor->qualifications as $qualification )
                                                    <div class="account-data-item__val">{{ $qualification->name }}</div>
                                                @endforeach
                                            @else
                                                <div class="account-data-item__val">{{$doctor->qualification ? $doctor->qualification: 'Не заполнено'}}</div>
                                            @endif
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
                                    @if(!empty($doctor->about_text))
                                    <div class="doc-prof-data__data-text">{!! $doctor->about_text !!}</div>
                                    @else
                                        <div class="account-data-item__val">Не заполнено, нажмите на кнопку редактировать, и внесите свои профессиональные данные</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">Опыт</div>
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    @if(!empty($doctor->exp_text))
                                    <div class="doc-prof-data__data-text">{!! $doctor->exp_text !!}</div>
                                    @elseНе заполнено, нажмите на кнопку редактировать, и внесите свои профессиональные
                                    данные
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">Лечение</div>
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    @if(!empty($doctor->treatment_text))
                                    <div class="doc-prof-data__data-text">{!! $doctor->treatment_text !!}</div>
                                    @elseНе заполнено, нажмите на кнопку редактировать, и внесите свои профессиональные
                                    данные
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">Образование и курсы повышения квалификации</div>
                            <div class="doc-prof-data__data-lines">
                                @if(!empty($doctor->grad_text))
                                    {!! $doctor->grad_text  !!}
                                @elseНе заполнено, нажмите на кнопку редактировать, и внесите свои профессиональные
                                данные
                                @endif
                            </div>
                        </div>
                        <div class="doc-prof-data__section">
                            <div class="doc-prof-data__section-heading">Сертификаты и лицензии</div>
                            <div class="doc-prof-data__data-lines">
                                <div class="doc-prof-data__line">
                                    @if(!empty($doctor->certs_text))
                                        {!! $doctor->certs_text !!}
                                    @elseНе заполнено, нажмите на кнопку редактировать, и внесите свои профессиональные данные
                                    @endif
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