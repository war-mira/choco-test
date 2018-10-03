@extends('app')
@section('content')
        <!-- begin section -->
        <div class="section top-clear">

            <!-- begin container -->
            <div class="container">

                <!-- begin breadcrumbs -->
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a href="#777">Главная</a> </li>
                        <li class="breadcrumbs__item">Каталог лекарств</li>
                    </ul>
                </nav>
                <!-- end breadcrumbs -->

                <h1 class="page-title">Каталог лекарств</h1>

                <!-- begin seo -->
                <div class="seo">
                    <div class="seo__text">

                    </div>
                    <a class="seo__toggle" href="#777">Показать полностью</a>
                </div>
                <!-- end seo -->

                <!-- begin search -->
                <div class="search search--default">
                    <form>
                        <div class="search__row">
                            <div class="search__groups">
                                <select class="styler">
                                    <option value="">Лекарственные препараты</option>
                                </select>
                                <input class="styler" type="search" placeholder="Введите название">
                            </div>
                            <div class="search__button">
                                <input class="button button--gray" type="submit" value="Найти">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end search -->

                <!-- begin sort -->
                <div class="sort">
                    <p class="sort__text">Упорядочить:</p>
                    <ul class="sort__list">
                        <li class="sort__item current"><a href="#777">по цене</a></li>
                        <li class="sort__item"><a href="#777">по названию</a></li>
                    </ul>
                </div>
                <!-- end sort -->

                <!-- begin products -->
                <div class="products">
                  @foreach($Drugs as $item)
                    <div class="products__item item-products">
                        <div class="item-products__inner">
                            <a class="item-products__img" href="{{url('drug/'.$item->id)}}" style="background-image:url({{URL::asset($item->image)}})"></a>
                            <h3 class="item-products__title">
                                <a href="{{url('drug/'.$item->id)}}">{{$item->name}}</a>
                            </h3>
                            <div class="item-products__desc">{{$item->mnn}}</div>
                            <p class="item-products__price">Цена <strong>{{$item->price}} тг</strong></p>
                            <a class="button" href="{{url('drug/'.$item->id)}}">Купить</a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <!-- end pills -->

                <!-- begin pagination -->
                <ul class="pagination">
                    <li class="pagination__item current">
                        <a href="#777">1</a>
                    </li>
                </ul>
                <!-- end pagination -->

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->

        <!-- begin section -->
        <div class="section top-clear bottom-clear hidden-xs hidden-sm">

            <!-- begin container -->
            <div class="container">
                <!-- begin slick-banner -->
                <div class="slick-banner">
                    <div>
                        <img src="images/980x250/banner_pills.jpg" alt="980x250">
                    </div>
                    <div>
                        <img src="{{URL::asset('images/980x250/banner_tourism.jpg')}}" alt="980x250">
                    </div>
                    <div>
                        <img src="images/980x250/banner_pills.jpg" alt="980x250">
                    </div>
                    <div>
                        <img src="{{URL::asset('images/980x250/banner_tourism.jpg')}}" alt="980x250">
                    </div>
                </div>
                <!-- end slick-banner -->
            </div>
            <!-- end container -->

        </div>
        <!-- end section -->
@endsection
