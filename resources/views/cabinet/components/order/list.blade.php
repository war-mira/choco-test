<div class="list-group bottom-clear">
    @foreach($orders as $order)
        <div class="list-group-item order-list-item" data-order-id="{{$order->id}}" href="#orderDetails{{$order->id}}">
            <div class="row">
                <div class="col-xs-9">
                    <div class="row order-patient-info">
                        <div class="col-md-8">
                            <h4>{{$order['client_info']['name'] ?? '-'}}</h4>
                            @isset($order['client_info']['birthday'])
                                <span class="text-info text-bold text-primary">{{$order['client_info']['birthday']->format("d-m-Y")}}</span>
                            @endisset
                        </div>
                        <div class="col-md-4">
                            <a class="glyphicon glyphicon-phone pull-right patient-phone"
                               href="tel:+@formatPhone($order['client_info']['phone'])">@formatPhone($order['client_info']['phone'])</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="text-center pull-left">
                        <p>{{$order['date_event_date']}}</p>
                        <span class="badge"
                              style="font-size: 24px">{{$order['date_event_time']}}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>