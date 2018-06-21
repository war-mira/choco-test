@extends('admin.app')
@section('content')

    @php
        $positions = [
          \App\Banner::POSITION_MAIN_A,
          \App\Banner::POSITION_MAIN_B,
          \App\Banner::POSITION_EXT_A,
          \App\Banner::POSITION_EXT_B
        ];
         $bannerId = Request::query('banner_id',false);
         $selectedPosition = $bannerId?$banners->find($bannerId)->position:0;
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Баннера
                <small>Статистика</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <form method="get">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="start">Начальная дата</label>
                            <input type="date" class="form-control" id="start" name="start" placeholder=""
                                   value="{{$startdate->format("Y-m-d")}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="end">Дата окончания</label>
                            <input type="date" class="form-control" id="end" name="end" placeholder=""
                                   value="{{$enddate->format("Y-m-d")}}">
                        </div>
                    </div>
                    <div class="col-md-4"><br>
                        <input type="submit" class="btn btn-default" value="ОК"></input>
                        <input class="btn btn-default" type="submit" name="export" value="Экспорт">
                    </div>
                </form>
            </div>
            <ul class="nav nav-tabs nav-justified">
                @foreach($positions as $position)
                    <li class="@if($position['id'] == $selectedPosition) active @endif"><a data-toggle="tab"
                                                                                           href="#position{{$position['id']}}">{{$position['name']}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($positions as $position)
                    <div id="position{{$position['id']}}"
                         class="tab-pane  @if($position['id'] == $selectedPosition) active @else fade @endif ">
                        <h3>{{$position['name']}}</h3>
                        <ul class="list-group">
                            @foreach($banners->where('position','=',$position['id']) as $banner)
                                <li id="banner-container{{$banner->id}}" class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5" style="width: 39%">
                                            <img id="image_desktop{{$banner->id}}"
                                                 class="img-rounded img-responsive center-block"
                                                 src="{{URL::asset($banner->image_file_desktop)}}" alt=""/>

                                        </div>
                                        <div class="col-md-5" style="width: 39%">
                                            <img id="image_mobile{{$banner->id}}"
                                                 class="img-rounded img-responsive center-block"
                                                 src="{{URL::asset($banner->image_file_mobile)}}" alt=""/>

                                        </div>
                                        <div class="col-md-2" style="width:22%;">
                                            <div class="alert alert-danger">
                                                <h2>{{$banner['clicks_count']}} переходов</h2>
                                                <h2>{{$banner['unique_clicks_count']}} уникальных</h2>
                                                <a href="{{$banner->href}}">{{$banner->href}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endforeach
            </div>
@endsection
