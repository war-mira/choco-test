<div class="entity-reviews__item entity-review">
    <div class="entity-review__line">
            <div class="entity-review__aside">
                @if((int)($comment['user_rate']/2) == 5)
                    <div class="entity-review__thumbs-img"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div>
                    <div class="entity-review__assess-string">Отлично</div>
                @elseif((int)($comment['user_rate']/2) == 4)
                    <div class="entity-review__thumbs-img"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></div>
                    <div class="entity-review__assess-string">Хорошо</div>
                @elseif((int)($comment['user_rate']/2) < 4)
                    <div class="entity-review__thumbs-img"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></div>
                    <div class="entity-review__assess-string">Плохо</div>
                @endif
                <div class="entity-review__rating-line rating-line rating-line_blue">
                    @component('components.rstars',['rating' => ($comment['user_rate']/2)])
                    @endcomponent
                </div>
            </div>

            <div class="entity-review__main">
                <div class="entity-review__top-line">
                    <!-- <div class="entity-review__heading">
                        <?php //print str_replace('\r\n', '<br />', $comment['text']) ?>
                    </div> -->
                    <div class="entity-review__date">{{$comment->created_at}}</div>
                    @if($comment['type']==1) <span style="font-size: small; color: #ff9933; font-weight: bold">Был на приеме</span>@endif
                </div>
                <div class="entity-review__text">
                    <?php print str_replace('\r\n', '<br />', $comment['text']) ?>
                </div>

                <div class="entity-review__bot-line">
                    <div class="entity-review__who">От: <b>{{$comment['user_name']}}</b></div>
                    <div class="entity-review__about-who">Отзыв о враче: <a href="{{asset($comment->owner->href)}}">{{$comment->owner->name}}</a></div>
                </div>
            </div>


        <!--div class="comment-footer">
            <span class="comment-user-rate">
                <a href="#" data-url="{{route('rateComment',['id'=>$comment->id,'rate'=>'up'])}}"
                   class="comment-user-rate-up glyphicon glyphicon-thumbs-up">{{$comment->rates()->up()->count()}}</a>
                <a href="#" data-url="{{route('rateComment',['id'=>$comment->id,'rate'=>'down'])}}"
                   class="comment-user-rate-down glyphicon glyphicon-thumbs-down">{{$comment->rates()->down()->count()}}</a>
            </span>
        </div-->
    </div>
</div>