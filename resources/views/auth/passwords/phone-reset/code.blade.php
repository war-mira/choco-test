@extends('app')

@section('content')
    <div class="col-lg-5 col-md-7 col-sm-7 center-block" style="float: none">
        <div class="panel panel-light" id="code-check-panel">
            <div class="panel-heading text-center"><h3>Проверка безопасности</h3></div>
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
                            <label for="code-input">Мобильный телефон</label>
                            <input type="text" class="form-control bfh-phone" data-format="+7dddddddddd" disabled
                                   id="phone-input" value="{{$phone}}">
                            <a href="{{route('password.phone.request-form')}}">Другой номер?</a>
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-error has-feedback' : '' }}">
                            <label for="code-input">Код подтверждения</label>
                            <input type="text" size="4" required class="form-control" name="code" id="code-input"
                                   placeholder="Введите код сюда">
                            @if ($errors->has('code'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-block button button--light" id="code-submit">
                            <span class="submit-text">Подтвердить</span>
                            <span class="idoctor-loader" style="display: none"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
