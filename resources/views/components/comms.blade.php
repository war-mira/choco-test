<div class="section bg-shadow" id="comments">

    <!-- begin container -->
    <div class="">

        <div class="text-center">
            <h2 class="section-title">{{$title}}</h2>
        </div>

        <!-- begin reviews -->
        <div class="reviews">
            @foreach($comments->slice(0,$visible) as $comment)
                @component('model.comm',compact('comment', 'about'))
                @endcomponent
            @endforeach
            <div class="hidden-comments">
            </div>
            @if(count($comments) > 5)
                <div class="entity-reviews__more">
                    <a href="#" data-url="{{$url ?? ""}}" class="btn btn_theme_more loadMoreComments">Все отзывы</a>
                </div>
            @endif
        </div>
        <!-- end reviews -->
    </div>
    <!-- end container -->

</div>