@if($comment->owner->status != 0)
<div class="comment-container">


    <div class="comment-header">
        <span class="comment-author-info">
            <span>
        <img class="comment-avatar" src="{{ $comment->creator->avatar ??  '/images/temp/120x120/user_avatar_1.png'}}"
             width="40" height="40">
        <span class="comment-author">{{$comment['user_name']}}</span>
                </span>
            @if($comment->author)
                <div class="comment-verified badge badge-success">Зарегистрирован</div>
            @endif
            </span>
        <span class="comment-owner-info">
            <span class="comment-rate">
             @component('components.rating-stars',['rating' => ($comment['user_rate']/2)])
                @endcomponent
                </span>
        <span class="comment-owner">О {{$comment->owner->type}}е <a
                    href="{{asset($comment->owner->href)}}">{{$comment->owner->name}}</a></span>

        </span>

    </div>
    <div class="comment-text">
        <p><?php print str_replace('\r\n', '<br />', $comment['text']) ?></p>
    </div>
    <div class="comment-footer">
        <span class="comment-date">{{$comment->created_at}}</span>
        <span class="comment-user-rate">
            <a href="#" data-url="{{route('rateComment',['id'=>$comment->id,'rate'=>'up'])}}"
               class="comment-user-rate-up glyphicon glyphicon-thumbs-up">{{$comment->rates()->up()->count()}}</a>
            <a href="#" data-url="{{route('rateComment',['id'=>$comment->id,'rate'=>'down'])}}"
               class="comment-user-rate-down glyphicon glyphicon-thumbs-down">{{$comment->rates()->down()->count()}}</a>
        </span>
    </div>
</div
    @endif