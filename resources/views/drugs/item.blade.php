@extends('app')
@section('content')
<div class="container">
                <!-- begin breadcrumbs -->
                <nav class="breadcrumbs">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a> </li>
                        <li class="breadcrumbs__item"><a href="{{url('drugs')}}">Каталог лекарств</a></li>
                        <li class="breadcrumbs__item">{{$item->name}}</li>
                    </ul>
                </nav>
                <!-- end breadcrumbs -->

                <!-- begin middle -->
                <div class="middle mtop-20">
                    <div class="sidebar sidebar--left">
                        <div class="sidebar__section">
                            <div class="product">
                                <p href="#777" class="product__img" style="background-image:url({{URL::asset($item->image)}})"></p>
                                <p class="product__price">Цена <strong>{{$item->price}} тг</strong></p>
                                <div class="product__desc">
                                    <p>{{$item->mnn}}</p>
                                </div>
                                <a class="button" href="#777">Купить</a>
                            </div>
                        </div>
                    </div>
                    <div class="column column--right">
                         <h1 class="page-title">{{$item->name}}</h1>
                         <h3 class="text-dark">{{$item->mnn}}</h3>
                         <p>{!!$item->annotations!!}</p>
                    </div>
                </div>
                <!-- end middle -->
  </div>
@endsection
