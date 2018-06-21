<table>
    <thead>
    <tr>
        <th>Месяц</th>
        <th>Всего заказов(18 м)</th>
        <th>Заказов от старых(18 м)</th>
        <th>Заказов от новых(18 м)</th>
        <th>Покупателей на начало(18 м)</th>
        <th>Новых покупателей(18 м)</th>
        <th>Потеряно покупателей(18 м)</th>
        <th>Всего покупателей(все время)</th>
        <th>Всего заказов(все время)</th>
        <th>Новый покупателей(все время)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($monthReports as $report)
        <tr>
            <td>{{$report['date']}}</td>
            <td>{{$report['total_orders']}}</td>
            <td>{{$report['old_b_orders']}}</td>
            <td>{{$report['new_b_orders']}}</td>
            <td>{{$report['begin_b']}}</td>
            <td>{{$report['new_b']}}</td>
            <td>{{$report['lost_b']}}</td>
            <td>{{$report['overall_b']}}</td>
            <td>{{$report['overall_orders']}}</td>
            <td>{{$report['overall_new_b']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
