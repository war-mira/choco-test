<table class="table table-striped">
    <thead>
    <tr>
        <th>
            Оператор
        </th>
        <th>Источник</th>
        <th>Запись</th>
        @foreach(\App\Order::STATUS as $status)
            <th>{{$status['name']}}</th>
        @endforeach
        <th>Всего</th>
    </tr>
    </thead>
    <tbody>
    @foreach($statistics as $operator)
        <tr @if($operator['name'] == 'Всего') style="border-top: 5px solid grey" @endif>
            <td rowspan="3" class="{{$operator['name'] == 'Всего' ? 'danger' :'success'}}">{{$operator['name']}}</td>
            <td class="info">Телефон</td>
            @foreach($operator['phone']['statuses'] as $status)
                <td class="info">{{$status['count']}}</td>
            @endforeach
            <td class="info">{{$operator['phone']['count']}}</td>
        </tr>
        <tr class="active">
            <td>Интернет</td>
            @foreach($operator['internet']['statuses'] as $status)
                <td>{{$status['count']}}</td>
            @endforeach
            <td>{{$operator['internet']['count']}}</td>
        </tr>
        <tr class="{{$operator['name'] == 'Всего' ? 'danger' :'success'}}">
            <td>Итог</td>
            @foreach($operator['total']['statuses'] as $status)
                <td>{{$status['count']}}</td>
            @endforeach
            <td>{{$operator['total']['count']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>