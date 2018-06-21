@extends('app')
@section('content')
    <div class="section profile-bg-client">

        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="#777">Главная</a></li>
                    <li class="breadcrumbs__item">Кабинет</li>
                    <li class="breadcrumbs__item">{{$doctor->name}}</li>
                </ul>
            </nav>
        </div>
        <!-- end breadcrumbs -->
        <div class="container-fluid">
            <!-- begin middle -->
            <div class="middle mtop-20 cabinet-container">

                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-orders">Приемы</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-profile">Профиль</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-feedback">Обратная связь</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-orders" class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">

                                <form id="filterOrders" class="form form-inline mbottom-20">
                                    <input class="form-control" type="date" name="date_start" placeholder="Начало">
                                    <span>-</span>
                                    <input class="form-control" type="date" name="date_end" placeholder="Начало">
                                    <input class="form-control" type="submit" name="orders_date_filter" value="OK">
                                </form>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div id="orders-list" class="slim-scroll"
                                     style=" max-height: 400px;">
                                    @component('cabinet.components.order.list')
                                        @slot('orders',$orders)
                                    @endcomponent
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div id="order-details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
    </div>
    <script>
        $('#filterOrders').submit(function (e) {
            var dateBeginStr = $(this).find('[name=date_start]').val();
            var dateEndStr = $(this).find('[name=date_end]').val();
            var dateBegin = Math.floor(new Date(dateBeginStr).getTime() / 1000);
            var dateEnd = Math.floor(new Date(dateEndStr).getTime() / 1000);
            var data = {
                _token: '{{csrf_token()}}',
                filter: [
                    ['date_event', 'between', [dateBegin, dateEnd]]
                ]
            };
            $('#orders-list').load('{{route('cabinet.doctor.orderList')}}', data, function () {
                $(".order-list-item").click(function () {
                    var orderId = $(this).data('order-id');
                    $('#order-details').load('{{route('cabinet.doctor.orderDetails')}}/' + orderId);
                });
            });
            e.preventDefault();
        });
        $(".order-list-item").click(function () {
            var orderId = $(this).data('order-id');
            $('#order-details').load('{{route('cabinet.doctor.orderDetails')}}/' + orderId);
        });
    </script>
@endsection