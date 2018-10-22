<div class="grid__row">
    <div class="grid__row--container {{$container->type}}">
        @foreach ($container->columns as $column)
            {!! $column->getHtmlBlock() !!}
        @endforeach
    </div>
</div>