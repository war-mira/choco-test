@extends('redesign.layouts.inner-page')

@section('content')

    <!-- begin section -->
    <div class="section pattern-bg">
        <div class="section-profile">
        <!-- begin container -->
        <div class="container">
            <div class="tab-line">
                <a href="{{route('user.profile')}}" class="tab-line__item">
                    <span class="tab-line__item-text">Личные данные</span>
                </a>
                <a href="{{ url('/logout') }}" class="tab-line__item" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
                    <span class="tab-line__item-text">Выйти</span>
                </a>
                @if(Auth::user()->role == 1)
                    <a class="tab-line__item" href="{{ route('admin.dashboard') }}">
                        <span class="tab-line__item-text">Панель управления</span>
                    </a>
                @endif
            </div>
            <form id="profile-logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <user-profile></user-profile>
        </div>
        <!-- end container -->
        </div>
    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section top-clear bottom-clear hidden-xs hidden-sm">
        <!-- begin container -->
        <div class="container">
            @component('elements.banners-slider',['position'=>\App\Banner::POSITION_MAIN_B['id']])
            @endcomponent
        </div>
        <!-- end container -->
    </div>
    <!-- end section -->
@endsection