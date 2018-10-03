@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="login" class="panel panel-light">
                    <div class="panel-heading"><h3>Подтверждение email</h3></div>
                    <div class="panel-body wrap text-center">
                        <form class="form-inline" role="form" method="POST" action="{{ route('auth.email.request') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <button type="submit" class="btn btn-default">Подтвердить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
