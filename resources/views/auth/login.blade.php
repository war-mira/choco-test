@extends('app')

@section('content')
    <div class="col-lg-4 col-md-5 col-sm-5 center-block" style="float: none">
        <div class="panel panel-light">
            <div class="panel-heading text-center"><h2>Вход</h2></div>
            <div class="panel-body wrap">
                <form class="form" role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Логин:</label>


                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"
                               required placeholder="Email или телефон">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Пароль:</label>


                        <input id="password" type="password" class=" form-control" name="password" required
                               placeholder="Введите пароль">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Запомнить
                                меня
                            </label>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <button type="submit" class="button btn-block">
                                Вход
                            </button>
                        </div>
                    </div>


                </form>
            </div>
            <div class="panel-footer text-center">
                <a href="{{ route('password.phone.request-form') }}">
                    Забыли пароль?
                </a>
                |
                <a href="{{ route('register') }}">
                    Регистрация
                </a>
            </div>
        </div>
    </div>
@endsection
