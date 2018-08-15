<div class="account-content__head">
    <div class="account-content__page-name">Отзывы</div>
    <div class="account-content__nav-line">
        <div class="account-content__tab-line">
            <div class="tab-line">
                <a href="{{route('cabinet.doctor.questions.index', 'answered='.\App\Question::NOT_ANSWERED)}}" class="tab-line__item  {{request()->input('answered') == \App\Question::NOT_ANSWERED ? 'tab-line__item_active':''}}">
                    <span class="tab-line__item-text">Не отвеченные</span>
                    <span class="tab-line__item-count">{{ \App\Question::notAnswered()->count() }}</span>
                </a>
                <a href="{{route('cabinet.doctor.questions.index', 'answered='.\App\Question::ANSWERED)}}" class="tab-line__item {{request()->input('answered') == \App\Question::ANSWERED ? 'tab-line__item_active':''}}">
                    <span class="tab-line__item-text">Отвеченные другими врачами</span>
                    <span class="tab-line__item-count">{{ \App\Question::answeredNotByDoctor(auth()->user()->doctor)->count() }}</span>
                </a>
                <a href="{{route('cabinet.doctor.questions.index', 'answered='.\App\Question::ANSWERED_BY_DOCTOR)}}" class="tab-line__item  {{request()->input('answered') == \App\Question::ANSWERED_BY_DOCTOR ? 'tab-line__item_active':''}}">
                    <span class="tab-line__item-text">Мои ответы</span>
                    <span class="tab-line__item-count">{{ \App\Question::answeredByDoctor(auth()->user()->doctor)->count() }}</span>
                </a>
            </div>
        </div>
        <div class="account-content__content-search search-text-input">
            <div class="appointment-content__line">
                <div class="account-data-item">
                    <form>
                        <div class="account-data-item__val">
                            <div class="account-data-item__name">Поиск</div>
                            <input type="text" name="search" placeholder="Введите слово" value="{{ request()->input('search') ? request()->input('search'):'' }}">
                            <button type="submit" class="fa fa-search"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>