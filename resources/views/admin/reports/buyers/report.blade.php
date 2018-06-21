<table>
    <thead>
    <tr>
        <th>Месяц</th>
        <th>Всего заказов</th>
        <th>Заказов от старых</th>
        <th>Заказов от новых</th>
        <th>Покупателей на начало</th>
        <th>Новых покупателей</th>
        <th>Потеряно покупателей</th>
    </tr>
    </thead>
    <tbody>
    @foreach($monthReports as $report)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$report['total_orders']}}</td>
            <td>{{$report['old_b_orders']}}</td>
            <td>{{$report['new_b_orders']}}</td>
            <td>{{$report['begin_b']}}</td>
            <td>{{$report['new_b']}}</td>
            <td>{{$report['lost_b']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
