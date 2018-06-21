@extends('admin.app')
@section('content')
    <form action="{{route('admin.report.reportForMonth')}}">
        <label for="year">Год</label>
        <select name="year" id="year">
            @for($i=2017;$i<2020;$i++)
                <option value="{{$i}}" @if($i==$year) selected @endif>{{$i}}</option>
            @endfor
        </select>
        <label for="month">Месяц</label>
        <select name="month" id="month">
            @for($i=1;$i<=12;$i++)
                <option value="{{$i}}" @if($i==$month) selected @endif>{{$i}}</option>
            @endfor
        </select>
        <div class="row">

            @foreach(array_chunk(\App\Enums\OrderStatus::$DESCRIPTIONS,6) as $column)
                <div class="col-md-3">
                    <ul>
                        @foreach($column as $key=>$name)
                            <li>
                                <label for="status{{$key}}">
                                    <input type="checkbox" name="status[]" id="status{{$key}}" value="{{$key}}">
                                    {{$name}}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

        </div>
        <input type="submit" name="operatorForMonth" value="По операторам">
        <input type="submit" name="medcenterForMonth" value="По медцентрам">
    </form>
@endsection