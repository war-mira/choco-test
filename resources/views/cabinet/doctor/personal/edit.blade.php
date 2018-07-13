@extends('redesign.layouts.cabinet')
@section('content')
    @include('cabinet.components.doctor.top-line')
    <div class="account-line">
        @include('cabinet.components.doctor.aside')
        <div class="account-line__main account-content">
            @include('cabinet.components.doctor.profile-header')
            <div class="account-content__body">
                <div class="doc-personal-data">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="doc-personal-data__inner">
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Имя</div>
                                    <div class="account-data-item__val">
                                        <input type="text" name="firstname" placeholder="Введите ваше имя" value="{{ $doctor->firstname }}">
                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Фамилия</div>
                                    <div class="account-data-item__val">
                                        <input type="text" name="lastname" placeholder="Введите вашу фамилию" value="{{ $doctor->lastname }}">
                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Дата рождения</div>
                                    <div class="account-data-item__val">
                                        <div class="date-text-input">
                                            <input type="text" name="birthday" placeholder="Выберите дату рождения" data-pmu-date="{{ $user->birthday }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">E-mail</div>
                                    <div class="account-data-item__val">
                                        <input type="email" name="email" placeholder="Введите ваш E-mail" value="{{$user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Номер телефона</div>
                                    <div class="account-data-item__val">
                                        <input type="tel" name="phone" placeholder="Введите ваш номер телефона" value="{{ $doctor->phone ? \App\Helpers\FormatHelper::phone($doctor->phone): \App\Helpers\FormatHelper::phone($user->phone) }}" data-mask="+7 (999) 999-99-99">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="user-personal-data__submit">
                            <button type="submit" class="btn btn_theme_usual">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection