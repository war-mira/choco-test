@extends('redesign.layouts.inner-page')
@section('content')
    <div class="phone-request-block">
        <div class="container">
            <div class="phone-request-body">
                <div class="section-heading__text">Подтверждение мобильного номера</div>
                    <div class="col-md-10 col-md-offset-1">
                        <p class="text-center">Для восстановления доступа к аккаунту на Ваш мобильный номер телефона будет
                            выслано <strong>бесплатное</strong> смс с кодом подтверждения.</p>
                        <div id="code-check-error-alert">
                        </div>
                    </div>
                    <form class="form-inline" role="form" method="POST"
                          action="{{ route('password.phone.request') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('phone') ? ' has-error has-feedback' : '' }}">
                            <input type="text" data-format="+7 (ddd) ddd-dddd" required
                                   pattern="\+7 \(\d{3}\) \d{3}-\d{4}" class="form-control bfh-phone" name="phone" 
                                   title="Телефон в формате +7 (XXX) XXX XX-XX"
                                   id="phone-input"
                                   value="{{old('phone')}}"
                                   placeholder="Телефон">
                            @if ($errors->has('phone'))
                                <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                                <span class="help-block">{{$errors->first('phone')}}</span>
                            @endif
                        </div>
                        <div class="form-group phone-btn-block">
                            <button type="submit" class="btn btn_theme_usual">Получить код</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    <script>
        $('.form-group.has-error input').focus(
            function () {
                var $feedback = $(this).parent().find('.form-control-feedback');
                $feedback.hide();
            }
        );
    </script>
@endsection
<style>
    .phone-request-block{
        padding: 40px 0;
    }
    .phone-request-body{
        width: 100%;
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background: #fff;
        border-radius: 2px;
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.09);
    }
    .phone-request-block .section-heading__text{
        font-family: "ProximaNova-Regular", sans-serif;
        text-align: center;
    }
    .phone-request-block .text-center{
        font-size: 14px;
        color: #989898;
        margin: 5px;
    }
    .phone-btn-block{
        margin-top: 20px;
        text-align: center;
    }
</style>