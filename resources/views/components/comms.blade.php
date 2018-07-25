<div class="section bg-shadow" id="comments">

    <!-- begin container -->
    <div class="">

        <div class="text-center">
            <h2 class="section-title">{{$title}}</h2>
        </div>

        <!-- begin reviews -->
        <div class="reviews">
            @foreach($comments->slice(0,$visible) as $comment)
                @component('model.comm',compact('comment'))
                @endcomponent
            @endforeach
            <div id="hidden-comments">
            </div>
            @if(count($comments) > 5)
                <div class="entity-reviews__more">
                    <a href="{{$url ?? ""}}" id="loadMoreComments" data-url="{{$url ?? ""}}" class="btn btn_theme_more">Все <span id="commentsLeftText">...</span>
                        отзывы</a>
                </div>
            @endif
            <!--p class="reviews__more">
                <button class="button button--light show-hidden-comments-btn"
                        type="button" id="loadMoreComments" data-url="{{$url ?? ""}}">Еще <span id="commentsLeftText">...</span>
                    отзывов
                </button>

            </p-->
        </div>
        <!-- end reviews -->
    </div>
    <!-- end container -->

</div>