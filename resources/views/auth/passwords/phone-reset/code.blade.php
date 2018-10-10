@extends('redesign.layouts.inner-page')

@section('content')
<div class="restore_block">
    <div class="container">
        <div class="restore_body">
            <div class="section-heading__text">Проверка безопастности</div>
            <div class="panel panel-light" id="code-check-panel">
                <div class="panel-body">
                    <div class="col-md-10 col-md-offset-1">
                        <p class="text-center">Для защиты Вашего аккаунта мы выслали на Ваш мобильный телефон
                            <strong>{{$phone}}</strong> бесплатное сообщение с кодом.</p>
                        <div id="code-check-error-alert">
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4">
                        <form id="code-check-form" class="form" role="form" method="POST"
                              action="{{ route('password.phone.code-confirm') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control bfh-phone" data-format="+7dddddddddd" disabled
                                       id="phone-input" value="{{$phone}}">
                                <a href="{{route('password.phone.request-form')}}">Другой номер?</a>
                            </div>

                            <div class="form-group{{ $errors->has('code') ? ' has-error has-feedback' : '' }}">
                                <input type="text" size="4" required class="form-control" name="code" id="code-input"
                                       placeholder="Код подтверждения">
                                @if ($errors->has('code'))
                                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                @endif
                            </div>
                            <div class="form-group registration-btn-block">
                                <button type="submit" class="btn btn_theme_usual" id="code-submit">
                                    <span class="submit-text">Подтвердить</span>
                                    <span class="idoctor-loader" style="display: none"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection