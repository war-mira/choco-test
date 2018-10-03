@extends('app')

@section('content')
    <div class="col-lg-4 col-md-5 col-sm-5 center-block" style="float: none">
        <div class="panel panel-light" id="code-check-panel">
            <div class="panel-heading text-center"><h3>Проверка безопасности</h3></div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <p class="text-center">Придумайте новый пароль для своего аккаунта.</p>
                    <div id="code-check-error-alert">
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <form id="code-check-form" class="form" role="form" method="POST"
                          action="{{ route('password.phone.reset') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="reset_token" value="{{$resetToken}}">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Пароль:</label>
                            <input id="password" type="password" class=" form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Повторите пароль:</label>

                            <input id="password-confirm" type="password" class=" form-control"
                                   name="password_confirmation" required>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="button btn-block">
                                    Сменить пароль
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
