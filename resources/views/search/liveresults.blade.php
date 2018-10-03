@foreach($groups as $group)
    @if(isset($group['results']) && count($group['results']['data']) > 0)
        @isset($group['header'])
            <div class="dropdown-header list-group-item" style="background-color: #B7B7B7"><h5>{{$group['header']}}</h5>
            </div>
        @endisset
        @foreach($group['results']['data'] as $result)
            @if(isset($result->href) )
                <a href="{{$result->href}}" class="list-group-item">
                <li>
                    @include($group['results']['view'],['data'=>$result])
                </li>
            </a>
            @else

                @include($group['results']['view'],['data'=>$result])
            @endif
        @endforeach
    @endif
@endforeach
<script>
    $(".client-result").click(loadOrderClient);
</script>