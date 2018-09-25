@include('search.filtr_questions')
    <div class="container">
        <section class="section-question__content">
            <div class="article-list-block">
                @foreach($questions as $question)
                    <div class="search-result__item entity-line article-line">
<!--                        <div class="entity-line__img">
                            <div class="entity-thumb-img">
                                <div class="entity-thumb-img__img-wr">
                                    <div class="parent_cont articles">
                                        <img src="http://medbooking.com/images/cache/Diseases/Disease142/b9a56f6627-1_x200.jpg" alt="{{ $question->text }}">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="article-line__main">
                            <div class="h3 profiles__title">
                                <div class="entity-line__name">
                                    <a href="{{url('question_item/'.$question->id)}}">{{ $question->text }}</a>
                                </div>
                            </div>
                            <div class="entity-line__about-text">
                                @foreach($question->answers->take(1) as $answer) 
                                    <p> {{ $answer->text }} </p>
                                @endforeach
                            </div>
                            <div class="article-line__brief">
                                <div class="article-line__brief-line">
                                    <div class="article-line__brief-item">
                                        <div class="article-line__brief-name">
                                            Ответов на вопрос: {{ $question->answers->count() }}
                                        </div>
                                        <div class="article-line__brief-descr">
                                            <a href="#">{{ $answer->count }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="article__aside-desktop">
                <div class="entity-content__banner">
                    <img src="{{asset('img/banner.jpg')}}" alt="">
                </div>
            </div>
        </section>
        @if($questions->count() != "")
                    <div class="results filter">
                        <div class="container">
                            <div class="text-center search-pagination" id="topPagination">
                                {!! $questions->count() !!}
                            </div>
                        </div>
                    </div>
                @endif
    </div>
