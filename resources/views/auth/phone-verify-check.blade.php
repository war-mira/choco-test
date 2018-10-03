@extends('app')

@section('content')
    <div class="col-lg-5 col-md-7 col-sm-7 center-block" style="float: none">
        <div class="panel panel-light" id="code-check-panel">
            <div class="panel-heading text-center"><h3>Проверка безопасности</h3></div>
            <div class="panel-body">
                <div class="col-md-10 col-md-offset-1">
                    <p class="text-center">Для защиты Вашего аккаунта мы выслали на Ваш мобильный телефон
                        <strong>{{auth()->user()->phone}}</strong> бесплатное сообщение с кодом.</p>
                    <div id="code-check-error-alert">
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <form id="code-check-form" class="form" role="form" method="POST"
                          action="{{ route('user.phone.verification.check') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="code-input">Мобильный телефон</label>
                            <input type="text" class="form-control bfh-phone" data-format="+7dddddddddd" disabled
                                   id="phone-input" value="{{auth()->user()->phone}}">
                            <a href="{{route('user.phone.verification.form')}}">Другой номер?</a>
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
    <style>
        @keyframes play {
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        .idoctor-loader {
            margin-bottom: -3px;
            display: inline-block;
            height: 20px;
            width: 20px;
            position: relative;
            pointer-events: none;
        }

        .idoctor-loader:before, .idoctor-loader:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            top: 0;
            z-index: 2;
            pointer-events: none;
        }

        .idoctor-loader:before {
            width: 100%;
            height: 100%;
            background-image: url('/img/cross_icon.png');
            background-position: left center;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            pointer-events: none;
        }

        .idoctor-loader::after {
            margin-left: 10%;
            margin-top: 10%;
            width: 80%;
            height: 80%;
            background: url('/img/heart_icon.png') center no-repeat;
            background-size: contain;
            animation: play 1s infinite;
        }

    </style>
    <script>
        var panel = $('#code-check-panel');

        function initAlert($element, type, title, text) {
            var $alert = $('<div/>', {
                "class": "alert alert-" + type
            }).html('<strong>' + title + '</strong> ' + text);
            $element.html($alert);
        }

        $('#code-check-form').on('submit', function (e) {
            $("#code-input").prop("readonly", true);
            $('#code-submit').find('.idoctor-loader').show();
            $('#code-submit').find('.submit-text').text('Проверка кода...');
            e.preventDefault(); // prevent native submit
            $(this).ajaxSubmit({
                success: function (data) {
                    var response = data.success;
                    $('#code-input').parent().removeClass('has-error').addClass('has-success');
                    initAlert($('#code-check-error-alert'), 'success', 'Превосходно!', response.message);
                    $('#code-submit').find('.idoctor-loader').hide();
                    $('#code-submit').find('.submit-text').text('Код подтвержден');

                    setTimeout(function () {
                        window.location.assign(response.redirect);
                    }, 2000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var response = xhr.responseJSON.error;
                    $('#code-input').parent().addClass('has-error');
                    initAlert($('#code-check-error-alert'), 'danger', 'Ошибка!', response.message);
                    $('#code-submit').find('.submit-text').text('Подтвердить');
                    $('#code-submit').find('.idoctor-loader').hide();
                    $("#code-input").prop("readonly", false);
                }
            })
        });

        $('.form-group.has-error input').focus(
            function () {
                var $feedback = $(this).parent().find('.form-control-feedback');
                $feedback.hide();
            }
        );
    </script>
@endsection
