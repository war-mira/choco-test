<table>
    <thead>
    <tr>
        <th>Имя</th>
        <th>Телефон</th>
        <th>Последний заказ</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$client['name']}}</td>
            <td>{{$client['phone']}}</td>
            <td>{{$client['last_order']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
