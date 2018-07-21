@extends('app')

@section('content')

    <!-- begin section -->
    <div class="section profile-bg-client">

        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a></li>
                    <li class="breadcrumbs__item">Ваш профиль</li>
                </ul>
            </nav>
            <!-- end breadcrumbs -->

            <!-- begin middle -->
            <div class="middle mtop-20">

                <div style="display:none" class="sidebar sidebar--left">
                    <img class="profiles__img profiles__img--circle" src="images/temp/250x250/client.jpg" width="250"
                         hegiht="250" alt="Тетя Таня, Хрюша и Степашка">
                </div>

                <div class="column sidebar--left">
                    <h1 class="page-title">{{ Auth::user()->name }}</h1>
                    <ul class="profiles__desc-list">
                        <li><span>Город:</span> {{Auth::user()->city['name'] ?? 'Не указан'}}</li>
                        <li><span>Телефон:</span> {{ Auth::user()->phone }} <a
                                    href="{{route('user.phone.verification.form')}}">Изменить</a></li>
                        <li><span>E-mail:</span> {{ Auth::user()->email }}</li>
                    </ul>

                    <a class="button" data-toggle="modal" href="#profile_edit_modal">Редактировать профиль</a>
                    <a href="{{ url('/logout') }}" class="button"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                    @if(Auth::user()->role == 1)
                        <a class="button" href="{{ url('admin.dashboard') }}">Панель управления</a>
                    @endif
                </div>

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section top-clear bottom-clear hidden-xs hidden-sm">


        <!-- begin container -->
        <div class="container">
            @component('elements.banners-slider',['position'=>\App\Banner::POSITION_MAIN_B['id']])
            @endcomponent
        </div>
        <!-- end container -->

    </div>
    <!-- end section -->



    <div id="profile_edit_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Редактировать профиль</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form class="form" role="form" method="POST" action="{{ route('user.profile.update') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 text-normal">Ваши имя и Фамилия:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="styler text-normal" name="name"
                                           value="{{Auth::user()->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 text-normal">Мобильный телефон:</label>

                                <div class="col-md-6">
                                    <input id="phone" class="styler form-control" type="text"
                                           placeholder="+7 (___) ___-__-__" name="phone" value="{{Auth::user()->phone}}"
                                           required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 text-normal">Город:</label>

                                <div class="col-md-6">
                                    <select id="city" type="city" class="form-control" name="city_id"
                                            value="{{Auth::user()->city_id}}" required>
                                        @foreach (App\City::all() as $CityItem)
                                            <option value="{{$CityItem->id}}"
                                                    @if($CityItem->id == Auth::user()->city_id) selected @endif >
                                                {{$CityItem->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 text-normal">Старый пароль:</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="styler form-control"
                                           name="old_password"
                                           required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 text-normal">Новый пароль:</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="styler form-control"
                                           name="new_password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 text-normal">Повторите пароль:</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="styler form-control"
                                           name="new_password_confirm">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="button">
                                        Сохранить
                                    </button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
