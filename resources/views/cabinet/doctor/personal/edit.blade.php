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
                                        <input type="text" name="firstname" placeholder="Введите ваше имя"
                                               value="{{ old('firstname') ? old('firstname'): $doctor->firstname }}">
                                        @if ($errors->has('firstname'))<p class="error"> Поле обязательно для заполнения </p>@endif

                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Фамилия</div>
                                    <div class="account-data-item__val">
                                        <input type="text" name="lastname" placeholder="Введите вашу фамилию"
                                               value="{{ old('lastname') ? old('lastname'): $doctor->lastname   }}">
                                        @if ($errors->has('lastname'))<p class="error"> Поле обязательно для заполнения </p>@endif
                                    </div>
                                </div>
                            </div>
                            <div class="user-personal-data__line">
                                <div class="user-personal-data__item account-data-item">
                                    <div class="account-data-item__name">Отчество</div>
                                    <div class="account-data-item__val">
                                        <input type="text" name="middlename" placeholder="Введите вашу отчество"
                                               value="{{ old('middlename') ? old('middlename'): $doctor->middlename}}">
                                        @if ($errors->has('middlename')) <p class="error">Поле обязательно для заполнения </p>@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-personal-data__line">
                            <div class="user-personal-data__item account-data-item">
                                <div class="account-data-item__name">Дата рождения</div>
                                <div class="account-data-item__val">
                                    <div class="date-text-input">
                                        <input type="text" name="birthday" placeholder="Выберите дату рождения"
                                               data-pmu-date="{{ old('birthday') ? old('birthday'): $user->birthday }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-personal-data__line">
                            <div class="user-personal-data__item account-data-item">
                                <div class="account-data-item__name">E-mail</div>
                                <div class="account-data-item__val">
                                    <input type="email" name="email" placeholder="Введите ваш E-mail"
                                           value="{{ old('email') ? old('email'):$user->email }}">
                                    @if ($errors->has('email'))<p class="error"> Поле обязательно для заполнения </p> @endif
                                </div>
                            </div>
                        </div>
                        <div class="user-personal-data__line">
                            <div class="user-personal-data__item account-data-item">
                                <div class="account-data-item__name">Номер телефона</div>
                                <div class="account-data-item__val">
                                    <input type="tel" name="phone" placeholder="Введите ваш номер телефона"
                                           value="
                                           @if(old('phone'))
                                                   {{ old('phone') }}
                                           @elseif($doctor->phone)
                                           {{ \App\Helpers\FormatHelper::phone($doctor->phone) }}
                                           @else
                                                   {{App\Helpers\FormatHelper::phone($user->phone)}}
                                           @endif"
                                           data-mask="+7 (999) 999-99-99">
                                    @if ($errors->has('phone'))<p class="error"> Поле обязательно для заполнения </p> @endif
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