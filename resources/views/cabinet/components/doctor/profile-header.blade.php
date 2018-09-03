<div class="account-content__head">
    <div class="account-content__page-name">Профиль</div>
    <div class="account-content__nav-line">
        <div class="account-content__tab-line">
            <div class="tab-line">
                <a href="{{route('cabinet.doctor.personal.index')}}" class="tab-line__item
                    @if(Route::is('cabinet.doctor.personal.index') || Route::is('cabinet.doctor.personal.edit')) tab-line__item_active @endif">
                    <span class="tab-line__item-text">Личные данные</span>
                </a>
                <a href="{{ route('cabinet.doctor.professional.index') }}" class="tab-line__item
                    @if(Route::is('cabinet.doctor.professional.index') || Route::is('cabinet.doctor.professional.edit')) tab-line__item_active @endif" >
                    <span class="tab-line__item-text">Профессиональные данные</span>
                </a>
            </div>
        </div>
    </div>
</div>