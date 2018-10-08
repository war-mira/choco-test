@extends('redesign.layouts.inner-page')

@section('content')
<div class="restore_block">
    <div class="container">
        <div class="restore_body">
            <div class="section-heading__text">Проверка безопасности</div>
            <div class="panel panel-light" id="code-check-panel">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <div id="code-check-error-alert"></div>
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
                                <div class="form-group registration-btn-block">
                                    <button type="submit" class="btn btn_theme_usual">Сменить пароль</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
