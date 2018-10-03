<div class="dropdown" id="{{$id}}">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        {{$title}}
    </button>
    <ul class="dropdown-menu dropdown-menu-left dropdown-checkbox-menu" id="{{$id}}-dropdown">
        <li><input class="form-control" type="text" placeholder="Поиск"></li>
        <li><a href="#" class="small" data-type="all" tabindex="-1"><input type="checkbox">&nbsp;Все</a></li>

        <li class="divider"></li>
        @foreach($options as $value=>$option)
            <li>
                <a href="#" class="small" data-value="{{$value}}" tabindex="-1"><input type="checkbox">
                    {{$option}}
                </a>
            </li>
        @endforeach
    </ul>
</div>