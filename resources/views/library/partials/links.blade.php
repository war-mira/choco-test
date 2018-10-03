<div class="container">
    <div class="library__tab-line">
        <div class="tab-line">
            <a href="{{ route('library.index') }}" class="tab-line__item
                    @if (Route::is('library.index') || Route::is('library.illnesses-group-articles') || Route::is('library.illnesses-group-article'))
                    tab-line__item_active @endif">
                <span class="tab-line__item-text">Медицинская библиотека</span>
            </a>
            <a href="{{ route('illnesses.index') }}" class="tab-line__item
                    @if (Route::is('illnesses.index')|| Route::is('illness')) tab-line__item_active @endif">
                <span class="tab-line__item-text">Справочник заболеваний</span>
            </a>
        </div>
    </div>
</div>
