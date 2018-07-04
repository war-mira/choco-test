@extends('app')

@section('content')
    <div class="col-lg-5 col-md-7 col-sm-8 center-block" style="float: none">
        <div class="panel panel-light">
            <div class="panel-heading text-center"><h2>Регистрация</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="row radio-group">
                                <label for="role-user" class="control-label col-sm-8">Зарегистрироваться как пользователь:</label>
                                <div class="col-sm-4">
                                    <input id="role-user" type="radio" name="role" value="0" required autofocus>
                                </div>
                            </div>
                            <div class="row radio-group">
                                <label for="role-doctor" class="control-label col-sm-8">Зарегистрироваться как доктор:</label>
                                <div class="col-sm-4">
                                    <input id="role-doctor" type="radio" name="role" value="20" required autofocus>
                                </div>
                            </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label col-sm-4">Имя и Фамилия:</label>

                            <div class="col-sm-8">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label col-sm-4">Email:</label>

                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label col-sm-4">Телефон</label>
                            <div class="col-sm-8">
                                <input class="styler bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                                       pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="phone"
                                       title="Телефон в формате +7 (XXX) XXX XX-XX" type="text"
                                       value="{{ old('phone') }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="email" class="control-label col-sm-4">Город:</label>

                            <div class="col-sm-8">
                                <select id="city" type="city" class="form-control" name="city" value="{{ old('city') }}"
                                        required>
                                    @foreach ($cities as $CityItem)
                                  <option value="{{$CityItem->id}}">
                                    {{$CityItem->name}}
                                  </option>
                                  @endforeach
                                </select>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label col-sm-4">Пароль:</label>

                            <div class="col-sm-8">
                                <input id="password" type="password" class=" form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="control-label col-sm-4">Повторите пароль:</label>

                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class=" form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-3">
                                <button type="submit" class="button btn-block">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
