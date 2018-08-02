<table>
    <thead>
    <tr>
        <th data-field="id" data-sortable="true">Id</th>
        <th>Источник</th>
        <th>Дата создания</th>
        <th>Время создания</th>
        <th data-field="client_info.name">Клиент</th>
        <th data-field="client_info.phone">Телефон</th>
        <th data-field="operator_info.name"> Оператор</th>
        <th data-field="date_event" data-sortable="true"> Дата приема</th>
        <th data-field="doctor" data-sortable="true" data-formatter="medcenterFormatter">Врач</th>
        <th data-field="doctor" data-sortable="true" data-formatter="medcenterFormatter">Медцентр</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->from_internet ? "Сайт":"Телефон"}}</td>
            <td>{{$order->created_at->format('Y-m-d')?? "-"}}</td>
            <td>{{$order->updated_at->format('H:i') ?? "-"}}</td>
            <td>{{$order->client_info['name'] ?? '-'}}</td>
            <td>{{$order->client_info['phone'] ?? '-'}}</td>
            <td>{{$order->operator_info['name'] ?? '-'}}</td>
            <td>{{$order->event_date}}</td>
            <td>{{$order->doctor['name'] ?? '-'}}</td>
            <td>{{$order->medcenter['name'] ?? '-'}}</td>
            <td>{{\App\Order::STATUS[$order->status]['name']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>