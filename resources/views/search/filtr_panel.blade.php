<div class="result-control-bar">
    <div class="container">
        <div class="result-control-bar__line" id="filtersGroup">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-name">@if(!empty($meta['h1'])) {{$meta['h1']}} @endif</div>
                <div class="result-control-bar__query-count">найдено {{$doctors->total()}} врачей</div>

                <input type="radio" style="display:none;" name="order" value="asc">
                <input type="radio" style="display:none;" name="order" value="desc">
            </div>
            <div class="result-control-bar__sort sort-line" id="filtersGroup">
                <div class="sort-line__item">
                    <span class="sort-line__heading">Сортировать по:</span>
                </div>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio btn_theme_radio_active">
                    <span class="sort-line-btn__text">Рейтингу</span>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="rate">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                    <span class="sort-line-btn__text">Стажу</span>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="exp">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                    <span class="sort-line-btn__text">Отзывам</span>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="comments_count">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                    <span class="sort-line-btn__text">Стоимости</span>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="price">
                </a>
                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio">
                    <span class="sort-line-btn__text">Посещаемости</span>
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    <input type="radio" style="display:none;" name="sort" value="viewed"/>
                </a>
            </div>
        </div>
    </div>
</div>