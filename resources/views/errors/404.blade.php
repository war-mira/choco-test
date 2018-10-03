@extends('app')
@section('content')
    <div class="section intro">

        <div class="intro__text">
            <h2 class="intro__title"><strong>Ошибка 404 -</strong> cтраница не найдена</h2>
            <p></p>
        </div>

        <div class="container-fluid">
            <div class="col-md-4 col-md-offset-4">
                @include('search.livesearch')
            </div>
        </div>

        <!-- begin statistics -->
        <div class="statistics">
            <a class="statistics__item" href="{{route('doctors.list')}}"
               style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="/images/icons/icon_expert.png" width="47" height="55"
                             alt="квалифицированных специалистов в вашем городе"
                             title="квалифицированных специалистов в вашем городе">
                    </span>
                <strong class="statistics__num">{{\App\Doctor::whereStatus(1)->where('city_id',session('cityid',6))->count()}}</strong>
                <span class="statistics__text">квалифицированных специалистов в вашем городе</span>
            </a>
            <a class="statistics__item" href="{{route('medcenters.list')}}" style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="/images/icons/icon_catalog.png" width="61" height="50"
                             alt="частных и государственных клиник в каталоге"
                             title="частных и государственных клиник в каталоге">
                    </span>
                <strong class="statistics__num">{{\App\Medcenter::whereStatus(1)->count()}}</strong>
                <span class="statistics__text">частных и государственных клиник в каталоге</span>
            </a>
            <a class="statistics__item" href="#comments" style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="/images/icons/icon_heart.png" width="57" height="49"
                             alt="довольных пользователя нашего сервиса" title="довольных пользователя нашего сервиса">
                    </span>
                <strong class="statistics__num">{{\App\Comment::count()}}</strong>
                <span class="statistics__text">отзывов реальных пациентов</span>
            </a>
        </div>
        <!-- end statistics -->
    </div>
@endsection
