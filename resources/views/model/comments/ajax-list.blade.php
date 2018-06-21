@foreach($comments as $comment)
    @component('model.comments.item',compact('comment'))
    @endcomponent
@endforeach