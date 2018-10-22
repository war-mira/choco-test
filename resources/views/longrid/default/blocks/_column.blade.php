<div class="grid__column">
  @foreach ($column->items as $item)
      {!! $item->getHtml() !!}
  @endforeach
</div>