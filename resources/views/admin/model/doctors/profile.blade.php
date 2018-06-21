<div class="container-fluid">
    <div class="row">
        <div class="row content-box-large">
            @component('components.bootstrap.nav-tabs')
                @component('components.bootstrap.nav-tab',['id'=>'yesterday_check_orders'])
                    @slot('title')
                        Вчера<span class="badge badge-info pull-right">{{count($yesterdayOrders)}}</span>
                    @endslot
                    @slot('content')
                        <h3>Вчера</h3>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Номер</th>
                                <th>Дата и время приема</th>
                                <th>Имя киента</th>
                                <th>Оператор</th>
                                <th>Статус</th>
                                <th>Открыть</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($yesterdayOrders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->event_date}}</td>
                                    <td>{{$order->client_info['name'] ?? "Нет"}}</td>
                                    <td>{{$order->operator_info['name'] ?? "Нет"}}</td>
                                    <td>{{$status_array[$order->status]}}</td>
                                    <td>
                                        <a href="{{route('admin.orders.form',['id'=>$order->id])}}"
                                           class="btn btn-info">Открыть</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            </tbody>
                        </table>
                    @endslot
                @endcomponent
                @component('components.bootstrap.nav-tab',['id'=>'today_check_orders','active'=>true])
                    @slot('title')
                        Сегодня<span class="badge badge-info pull-right">{{count($todayOrders)}}</span>
                    @endslot
                    @slot('content')
                        <h3>Сегодня</h3>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Номер</th>
                                <th>Дата и время приема</th>
                                <th>Имя киента</th>
                                <th>Оператор</th>
                                <th>Статус</th>
                                <th>Открыть</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($todayOrders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->event_date}}</td>
                                    <td>{{$order->client_info['name'] ?? "Нет"}}</td>
                                    <td>{{$order->operator_info['name'] ?? "Нет"}}</td>
                                    <td>{{$status_array[$order->status]}}</td>
                                    <td>
                                        <a href="{{route('admin.orders.form',['id'=>$order->id])}}"
                                           class="btn btn-info">Открыть</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            </tbody>
                        </table>
                    @endslot
                @endcomponent
                @component('components.bootstrap.nav-tab',['id'=>'tomorrow_check_orders'])
                    @slot('title')
                        Завтра<span class="badge badge-info pull-right">{{count($tomorrowOrders)}}</span>
                    @endslot
                    @slot('content')
                        <h3>Завтра</h3>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Номер</th>
                                <th>Дата и время приема</th>
                                <th>Имя киента</th>
                                <th>Оператор</th>
                                <th>Статус</th>
                                <th>Открыть</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tomorrowOrders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->event_date}}</td>
                                    <td>{{$order->client_info['name'] ?? "Нет"}}</td>
                                    <td>{{$order->operator_info['name'] ?? "Нет"}}</td>
                                    <td>{{$status_array[$order->status]}}</td>
                                    <td>
                                        <a href="{{route('admin.orders.form',['id'=>$order->id])}}"
                                           class="btn btn-info">Открыть</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            </tbody>
                        </table>
                    @endslot
                @endcomponent
            @endcomponent
            <div id="today_check_orders" class="tab-pane active">
                <h3>Сегодня</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Дата и время приема</th>
                        <th>Имя киента</th>
                        <th>Оператор</th>
                        <th>Статус</th>
                        <th>Открыть</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($todayOrders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->event_date}}</td>
                            <td>{{$order->client_info['name'] ?? "Нет"}}</td>
                            <td>{{$order->operator_info['name'] ?? "Нет"}}</td>
                            <td>{{$status_array[$order->status]}}</td>
                            <td>
                                <a href="{{route('admin.orders.form',['id'=>$order->id])}}"
                                   class="btn btn-info">Открыть</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                    </tbody>
                </table>
            </div>
            <div id="tomorrow_check_orders" class="tab-pane">
                <h3>Завтра</h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Номер</th>
                        <th>Дата и время приема</th>
                        <th>Имя киента</th>
                        <th>Оператор</th>
                        <th>Статус</th>
                        <th>Открыть</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tomorrowOrders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->event_date}}</td>
                            <td>{{$order->client_info['name'] ?? "Нет"}}</td>
                            <td>{{$order->operator_info['name'] ?? "Нет"}}</td>
                            <td>{{$status_array[$order->status]}}</td>
                            <td>
                                <a href="{{route('admin.orders.form',['id'=>$order->id])}}"
                                   class="btn btn-info">Открыть</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>