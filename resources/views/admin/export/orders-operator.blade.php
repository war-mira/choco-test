<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Оператор</th>
        @foreach($dates as $date)
            <th>{{$date['day']}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($operators as $operator)
        <tr>
            <td>{{$operator->id}}</td>
            <td>{{$operator->name}}</td>
            @foreach($dates as $date)
                <td>{{$operator->operatorOrders()->whereIn('status',$status)->whereBetween('date_create',[$date['begin'],$date['end']])->count()}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>