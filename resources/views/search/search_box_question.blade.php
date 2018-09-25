<section class="search-bar-container pattern-bg">
    <div class="container">
        <div class="search-bar">
            <form action="{{route('question.list')}}" class="questions__search--form search-bar__line index-search-bar__line  question-search-bar">
                <input type="hidden" name="sort" value="{{request()->get('sort')??'date'}}" />
                <input type="hidden" name="order" value="{{request()->get('order')??'desc'}}" />
                <div class="form-question-row">
                    
                </div>
                <div class="form-question-row">
                    
                </div>
                <div class="search-bar__item search-bar__item_type">
                    <select name="type" placeholder="Поиск вопроса" class="js-simple-select js-type-select" data-select="action">
                        <option value="question">Поиск вопроса</option>
                        <option value="doctor">Поиск врача</option>
                        <option value="medcenter">Поиск медцентра</option>
                    </select>
                </div>
                <div class="search-bar__item search-bar__item_search">
                    <input id="searchform" name="" value=""  placeholder="Введите ключевое слово" class="js-search-input"  autocomplete="off">
                    <label for="searchform" class="input-block__icon"><img src="{{asset('/img/icons/search-inactive.png')}}" alt=""></label>
                    <div class="live-search">
                        <div class="live-search__inner" id="liveresults">
                        </div>
                    </div>
                </div>
                <div class="search-bar__item search-bar__item_submit">
                    <button class="btn">Найти</button>
                </div>
            </form>
        </div>
    </div>
</section>
