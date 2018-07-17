<section class="search-bar-container pattern-bg">
    <div class="container">
        <div class="search-bar">
            <form action="{{route('doctors.list')}}" class="search-bar__line index-search-bar__line">
                    <input type="hidden" name="sort" value="@if(isset($_GET['sort'])) {{$_GET['sort']}} @endif"/>
                    <input type="hidden" name="order" value="@if(isset($_GET['order'])) {{$_GET['order']}} @endif"/>
                    <input type="hidden" name="q" value="@if(isset($_GET['q'])) {{$_GET['q']}} @endif"/>
                <div class="search-bar__item search-bar__item_type">
                    <select name="type" placeholder="Поиск медцентра" class="js-simple-select">
                        <option value="all" @if(isset($_GET['type']) && $_GET['type'] == 'medcenters') selected="selected" @endif>Поиск врача</option>
                        <option value="medcenters" @if(!isset($_GET['type']) || $_GET['type'] == 'all') selected="selected" @endif>Поиск медцентра</option>
                    </select>
                </div>
                <div class="search-bar__item search-bar__item_search">
                    <select name="name_md" placeholder="Поисковый запрос" class="js-search-select">
                        <option value="">Название медцентра</option>
                        <optgroup data-type="medcenters" label="Специализации"></optgroup>
                        <optgroup data-type="all" label="Врачи"></optgroup>
                    </select>
                </div>
                <div class="search-bar__item search-bar__item_region">
                    <select name="region" placeholder="Алмалинский район" class="js-simple-select js-select-region">
                        <option value="region-1">Алмалинский район</option>
                        <option value="region-2">Бескарагайский район</option>
                    </select>
                </div>
                <div class="search-bar__item search-bar__item_checkbox">
                    <label class="search-bar__checkbox-line checkbox-line">
                        <input type="checkbox" name="child" @if(isset($_GET['child']) && $_GET['child']) checked @endif value="1">
                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span class="checkbox-line__text">Детский врач</span>
                    </label>
                    <label class="search-bar__checkbox-line checkbox-line">
                        <input type="checkbox" name="ambulatory" @if(isset($_GET['ambulatory']) && $_GET['ambulatory']) checked @endif value="1">
                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span class="checkbox-line__text">Выезд на дом</span>
                    </label>
                </div>
                <div class="search-bar__item search-bar__item_submit">
                    <button class="btn">Найти</button>
                </div>
            </form>
        </div>
    </div>
</section>