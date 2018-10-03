<div class="row well">
    <div class="col-xs-6">
        <p>Личные данные пациента:</p>
        <h3>{{$order['client_info']['name'] ?? '-'}}</h3>
        @isset($order['client_info']['birthday'])
            <span class="text-info text-bold text-primary">{{$order['client_info']['birthday']->format("d-m-Y")}}</span>
        @endisset
    </div>
    <div class="col-xs-6">
        <p>Дата и время приема:</p>
        <p>{{$order['date_event_date']}} <span class="badge"
                                               style="font-size: 24px">{{$order['date_event_time']}}</span></p>

    </div>
</div>
<div class="row mtop-30">
    <div class="col-xs-4">
        <ul class="list-unstyled">
            <li> Телефон: <a class="glyphicon glyphicon-phone patient-phone"
                             href="tel:+@formatPhone($order['client_info']['phone'])">@formatPhone($order['client_info']['phone'])</a>
            </li>
        </ul>
    </div>
</div>

