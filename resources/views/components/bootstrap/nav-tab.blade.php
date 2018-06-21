@push('tabs.nav')
    <li class="{{$active ?? false ? 'active' : ''}}">
        <a data-toggle="tab" href="#{{$id}}" aria-expanded="{{$active ?? false ? 'true' : 'false'}}">{!! $title !!}</a>
    </li>
@endpush
@push('tabs.content')
    <div id="{{$id}}" class="tab-pane fade{{$active ?? false ? ' in active' : ''}}">
        {!! $content !!}
    </div>
@endpush