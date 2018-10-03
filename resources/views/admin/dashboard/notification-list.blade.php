@foreach($notifications as $notification)
    <li><a href="{{$notification['url']}}">
            <table width="100%">
                <tr>
                    <td class="text-left"> {!! $notification['title'] !!}</td>
                    <td class="small text-right">
                        Открыть
                    </td>
                </tr>
            </table>
        </a>
    </li>
@endforeach