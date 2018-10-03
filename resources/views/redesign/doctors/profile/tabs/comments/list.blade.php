<div class="feedbacks" id="{{$doctor['id']}}-doctor-comments">
    <form action="{{$doctor['links']['load_comments']}}" data-role="filter">
        <div class="feedbacks__sorting">

            <input type="hidden" name="page" value="1">
            <div class="search-results__sort">
                <ul class="sort-container">
                    <li class="sort-type-item">
                        <input id="{{$doctor['id']}}-comments-rate-all"
                               name="rate"
                               type="radio"
                               class="feedback--sort"
                               value="all"
                               checked>
                        <label for="{{$doctor['id']}}-comments-rate-all"
                               class="sort-type-item__order">Все отзывы
                            <span>{{$doctor['comments_count']}}</span>
                        </label>
                    </li>
                    <li class="sort-type-item">
                        <input id="{{$doctor['id']}}-comments-rate-positive"
                               name="rate"
                               type="radio"
                               class="feedback--sort"
                               value="positive">
                        <label for="{{$doctor['id']}}-comments-rate-positive"
                               class="sort-type-item__order">Положительные
                            <span>{{$doctor['positive_comments_count']}}</span>
                        </label>
                    </li>
                    <li class="sort-type-item">
                        <input id="{{$doctor['id']}}-comments-rate-negative"
                               name="rate"
                               type="radio"
                               class="feedback--sort"
                               value="negative">
                        <label for="{{$doctor['id']}}-comments-rate-negative"
                               class="sort-type-item__order">Негативные
                            <span>{{$doctor['negative_comments_count']}}</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="search-results__paginate">
                <ul class="comments-pagination pagination__items">

                </ul>
            </div>


        </div>
    </form>
    <!-- /Feedback sortbar -->
    <div class="feedbacks__container all" data-role="list">

    </div>

    <ul class="comments-pagination pagination__items"></ul>
</div>