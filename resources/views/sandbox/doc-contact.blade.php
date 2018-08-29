<table style="width: 100%;" cellspacing="0" cellpadding="0" >
    @foreach($docs as $doc)
    <tr>
        <td>{{ $doc->lastname }} {{ $doc->firstname }} {{ $doc->patronimyc }}</td>
        <td style="font-weight: bold; {{ $doc->user?"color:red":'' }}">{{ $doc->user?'есть аккаунт':'' }}</td>
        <td style="font-weight: bold; {{ $doc->partner?"color:green":'' }}">{{ $doc->partner?'партнер':'' }}</td>
        <td>{{ $doc->email }}</td>
        <td>{{ $doc->phone }}</td>
{{--        <td>{{ $doc->phone }}</td>--}}
    </tr>
    @endforeach
</table>
<style>
    table{
        border-collapse: collapse;
    }
    td{
        border: 1px solid;
        padding:3px;
    }
</style>