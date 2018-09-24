<section class="search-bar-container pattern-bg">
    <div class="container">
        <div class="search-bar">
            <form action="#" class="search-bar__line index-search-bar__line question-search-bar">
                <input type="hidden" name="question" value="" />
                <div class="search-bar__item search-bar__item_search">
                    <input id="searchform" name="" value=""  placeholder="Введите ключевое слово" class="js-search-input"  autocomplete="off">
                    <label for="searchform" class="input-block__icon"><img src="{{asset('/img/icons/search-inactive.png')}}" alt=""></label>
                    <div class="live-search">
                        <div class="live-search__inner" id="liveresults">
                        </div>
                    </div>
                </div>
                <div class="search-bar__item search-bar__item_submit">
                    <button class="btn">Найти вопрос</button>
                </div>
            </form>
        </div>
    </div>
</section>
