@extends('app')

@section('content')
    <div class="col-lg-5 col-md-7 col-sm-7 center-block" style="float: none">
        <div class="panel panel-light">
            <div class="panel-heading text-center"><h3>Подтверждение мобильного номера</h3></div>
            <div class="panel-body wrap text-center">
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
                        <label for="phone">Телефон:</label>
                        <input type="text" data-format="+7 (ddd) ddd-dddd" required
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}" class="form-control bfh-phone" name="phone"
                               id="phone-input"
                               value="{{old('phone')}}">
                        @if ($errors->has('phone'))
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                            <span class="help-block">{{$errors->first('phone')}}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn button button--light">Получить код</button>
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
