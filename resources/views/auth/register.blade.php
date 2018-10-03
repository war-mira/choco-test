@extends('redesign.layouts.inner-page')

@section('content')
<div class="registration-block">
    <div class="container">
        <div class="registration-body">
            <div class="section-heading__text">Регистрация</div>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="search-bar__checkbox-line checkbox-line" for="role-user">
                        <input id="role-user" type="radio" name="role" value="0" required autofocus>
                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span class="checkbox-line__text">Зарегистрироваться как пользователь:</span>
                    </label>
                    <label class="search-bar__checkbox-line checkbox-line" for="role-doctor">
                        <input id="role-doctor" type="radio" name="role" value="20" required autofocus>
                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span class="checkbox-line__text">Зарегистрироваться как доктор:</span>
                    </label>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('role') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text" class="form-control" name="name" placeholder="Имя" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                    <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Фамилия" value="{{ old('lastname') }}" required autofocus>
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input class="styler bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                            pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="phone"
                            title="Телефон в формате +7 (XXX) XXX XX-XX" type="text"
                            placeholder="Телефон" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <select id="city" type="city" class="form-control js-header-location" name="city" value="{{ old('city') }}" required>
                        <option value="8">Город</option>
                        @foreach ($cities as $CityItem)
                            <option value="{{$CityItem->id}}">{{$CityItem->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Пароль" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" placeholder="Повторите пароль" required>
                </div>
                <div class="form-group registration-btn-block">
                    <button type="submit" class="btn btn_theme_usual">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection