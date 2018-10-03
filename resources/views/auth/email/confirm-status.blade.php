@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="login" class="panel panel-light">
                    <div class="panel-heading"><h3>Подтверждение email</h3></div>
                    <div class="panel-body wrap text-center">
                        {{$message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
