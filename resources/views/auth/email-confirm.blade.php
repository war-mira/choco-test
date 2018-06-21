@extends('app')

@section('content')
    <div class="col-lg-5 col-md-7 col-sm-7 center-block" style="float: none">
        <div class="panel panel-light">
            <div class="panel-heading text-center"><h3>Подтверждение email</h3></div>
            <div class="panel-body wrap text-center">
                <form class="form-inline" role="form" method="POST" action="{{ route('auth.email.request') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" id="email"
                               value="{{old('email',Auth::user()->email)}}">
                        @if ($errors->has('email'))
                            <span class="glyphicon glyphicon-remove form-control-feedback"></span>
                        @endif
                    </div>
                    <button type="submit" class="btn button button--light">Подтвердить</button>
                    <a class="btn btn-default" href="{{route('profile')}}">Отмена</a>
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
