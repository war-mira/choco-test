<section class="search-bar-container search-bar-default">
    <div class="container">
        <div class="search-bar">
            <form action="{{$route}}" class="search-bar__line index-search-bar__line ">
                <div class="search-bar__item search-bar__item_search ">
                    <input id="searchform" name="query" value=""  placeholder="Введите ключевое слово" class="js-search-input"  autocomplete="off">
                    <label for="searchform" class="input-block__icon"><img src="{{asset('/img/icons/search-inactive.png')}}" alt=""></label>
                </div>
                <div class="search-bar__item search-bar__item_submit search-bar__question_submit">
                    <button class="btn"><i class="fa fa-search"></i>Найти</button>
                </div>
            </form>
        </div>
    </div>
</section>