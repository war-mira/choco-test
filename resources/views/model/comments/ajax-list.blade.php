@foreach($comments as $comment)
    @component('model.comm',compact('comment'))
    @endcomponent
@endforeach