<section class="search-bar-container pattern-bg">
    <div class="container">
        <div class="search-bar">
            <form action="{{route('doctors.list')}}" class="search-bar__line index-search-bar__line">
                <div class="search-bar__item search-bar__item_type">
                    <select name="type" placeholder="Поиск медцентра" class="js-simple-select">
                        <option value="medcenter" selected="selected">Поиск медцентра</option>
                        <option value="doctor">Поиск врача</option>
                    </select>
                </div>
                <div class="search-bar__item search-bar__item_search">
                    <select name="entity" placeholder="Название медцентра" class="js-search-select">
                        <option value="">Название медцентра</option>
                        <optgroup data-type="medcenter" label="Специализации"></optgroup>
                        <optgroup data-type="doctor" label="Врачи"></optgroup>
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
                        <input type="checkbox" name="child" value="1">
                        <span class="checkbox-line__checkbox"><i class="fa fa-check" aria-hidden="true"></i></span>
                        <span class="checkbox-line__text">Детский врач</span>
                    </label>
                    <label class="search-bar__checkbox-line checkbox-line">
                        <input type="checkbox" name="home-visit">
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