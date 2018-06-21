<nav class="breadcrumbs">
    <ul class="breadcrumbs__list">
        @foreach($nodes as $node)
            <li class="breadcrumbs__item">
                @if(isset($node['href']))
                    <a href="{{url($node['href'])}}"> {{$node['name']}}</a>
                @else
                    {{$node['name']}}
                @endif
            </li>
        @endforeach
    </ul>
</nav>