@push('custom.js')
    <script src="{{hotreload('/build/js/libs/Filters.js')}}"></script>
@endpush
<div class="result-control-bar">
    <div class="container">
        <div class="section-heading__text question_heading">Вопросы и ответы</div>
        <div class="result-control-bar__line group__filters" id="filtersGroup">
            <div class="result-control-bar__query">
                <div class="result-control-bar__query-count">
                    <a href="{{url('question/list')}}">{{ $answered_questions }}+ отвеченных врачами вопросов</a>
                </div>

                <input type="radio" style="display:none;" name="order" value="asc" >
                <input type="radio" style="display:none;" name="order" value="desc" checked="true">
            </div>
            <div class="result-control-bar__sort sort-line" id="filtersGroup">
                <div class="sort-line__item">
                    <span class="sort-line__heading">Сортировать по:</span>
                </div>

                <a href="#" class="sort-line__item sort-line-btn btn btn_theme_radio sort__change
                        {{(request()->get('sort') == 'date' ||is_null(request()->get('sort')))?'btn_theme_radio_active':''}}">
                    <span class="sort-line-btn__text">Дате</span>
                    <i class="fa {{(request()->get('sort') == 'date' && request()->get('order') == 'asc')?'fa-chevron-up':'fa-chevron-down'}}
                            " aria-hidden="true"></i>
                    <input type="radio" style="display:none;" checked="true" name="sort" value="date">
                </a>
            </div>
        </div>
    </div>
</div>