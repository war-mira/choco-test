@foreach($comments as $comment)
    @component('model.comm',compact('comment', 'about'))
    @endcomponent
@endforeach