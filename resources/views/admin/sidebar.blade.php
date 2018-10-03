<div class="sidebar content-box well" style="display: block;">
    <ul class="nav nav-pills nav-stacked">
        @foreach($links ?? [] as $key => $link)
            @if(!isset($link['children']))
                <li @if(str_contains(Route::current()->getName(),$key)) class="active" @endif>
                    <a href="{{route($key.($link['default']??''))}}">
                        <i class="glyphicon glyphicon-{{$link['icon'] ?? 'list'}}"></i>{{$link['name'] ?? $key}}
                    </a>
                </li>
            @else
                <li class="dropdown @if(str_contains(Route::current()->getName(),$key)) active @endif">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                                class="glyphicon glyphicon-{{$link['icon'] ?? 'list'}}"></i>
                        {{$link['name'] ?? $key}}
                        <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        @foreach($link['children'] ?? [] as $subkey => $sublink)
                            <li @if(str_contains(Route::current()->getName(),$subkey)) class="active" @endif>
                                <a href="{{route($subkey.($sublink['default']??''))}}">
                                    <i class="glyphicon glyphicon-{{$sublink['icon'] ?? 'list'}}"></i>{{$sublink['name'] ?? $subkey}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</div>