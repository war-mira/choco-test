<div class="result-control-bar">
    <div class="container">
        <div class="result-control-bar__line">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-name">@if(!empty($meta['h1_title'])) {{$meta['h1_title']}} @endif</div>
                <div class="result-control-bar__query-count">найдено {{$Medcenters->total()}} учреждений</div>

                <input type="radio" style="display:none;" checked="true" name="order" value="asc">
                <input type="radio" style="display:none;" name="order" value="desc">
            </div>
            <div class="result-control-bar__sort sort-line" id="filtersGroup">
                <div class="sort-line__item">
                    <span class="sort-line__heading">Сортировать по:</span>
                </div>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio @if(!isset($_GET['sort']) || $_GET['sort'] == 'rate') btn_theme_radio_active @endif">
                    <span class="sort-line-btn__text">Рейтингу</span>
                    <i class="fa @if(isset($_GET['sort']) && $_GET['sort'] == 'rate' && $_GET['order'] == 'asc') fa-chevron-up @else fa-chevron-down @endif" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" checked="true" name="sort" value="rate">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio @if(isset($_GET['sort']) && $_GET['sort'] == 'price') btn_theme_radio_active @endif">
                    <span class="sort-line-btn__text">Цене</span>
                    <i class="fa @if(isset($_GET['sort']) && $_GET['sort'] == 'price' && $_GET['order'] == 'asc') fa-chevron-up @else fa-chevron-down @endif" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="price">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio @if(isset($_GET['sort']) && $_GET['sort'] == 'orders_count') btn_theme_radio_active @endif">
                    <span class="sort-line-btn__text">Посещаемости</span>
                    <i class="fa @if(isset($_GET['sort']) && $_GET['sort'] == 'orders_count' && $_GET['order'] == 'asc') fa-chevron-up @else fa-chevron-down @endif" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="orders_count"/>
                </a>
            </div>
        </div>
    </div>
</div>