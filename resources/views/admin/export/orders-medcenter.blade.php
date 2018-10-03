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
    @foreach($medcenters as $medcenter)
        <tr>
            <td>{{$medcenter->id}}</td>
            <td>{{$medcenter->name}}</td>
            @foreach($dates as $date)
                <td>{{$medcenter->orders()->whereIn('status',$status)->whereBetween('date_create',[$date['begin'],$date['end']])->count()}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>