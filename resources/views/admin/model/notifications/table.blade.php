@extends('admin.app')
@section('content')
    <style>
        .state-icon {
            left: -5px;
        }

        .list-group-item-primary {
            color: rgb(255, 255, 255);
            background-color: rgb(66, 139, 202);
        }

        .list-group-item-info.active {
            color: #31708f !important;
            background-color: #d9edf7 !important;
        }
    </style>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">SMS Уведомления
                <small>для пациентов</small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form method="get">

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="start">Дата приема</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder=""
                               min="2000-01-01" max="2100-01-01"
                               value="{{$dateStr}}">
                    </div>
                </div>
                <div class="col-md-4"><br>
                    <input type="submit" class="btn btn-default" value="ОК"></input>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Заказ</th>
                    <th style="width: 140px">Дата приема</th>
                    <th>Пациент</th>
                    <th>Телефон</th>
                    <th>Врач</th>
                    <th>Медцентр
                        {{--<div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Медцентр <i
                                        class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>--}}
                    </th>
                    <th>Отправлено</th>
                    <th>Тип</th>
                    <th>Статус</th>
                    <th>Уведомление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td><a
                                    href="/orders/form/{{$notification->order->id}}">{{$notification->order->id}}</a>
                        </td>
                        <td>{{$notification->order->event_date}}</td>
                        <td>{{$notification->order->client_info['name'] ?? '-'}}</td>
                        <td>{{$notification->order->client_info['phone'] ?? '-'}}</td>
                        <td>{{$notification->order['doctor']['name'] ?? '-'}}</td>
                        <td>{{$notification->order['medcenter']['name']}}</td>
                        <td>
                            {{$notification->delivered_at}}
                        </td>
                        <td>
                            {{$notification->type_description}}
                        </td>
                        <td>
                            {{$notification->send_status_description}}
                        </td>
                        <td>
                            {{$notification->text}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection