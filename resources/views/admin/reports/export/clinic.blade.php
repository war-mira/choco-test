<table cellspacing="0" class="table table-hover">
    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td colspan="3" height="20"><b style="text-align: center; font-size: 20px">Отчет</b></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="3" height="20"><b style="text-align: center; font-size: 20px">за период с {{$start}}
                по {{$end}}</b></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td align="right" colspan="2"><strong>Наименование: </strong></td>
        <td align="right" colspan="2" style="text-align: center;">{{$Medcenter->name}}</td>
    </tr>
    <tr></tr>
    <tr>
        <th style="border:  1px solid #000000;"><b>№</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>Дата записи</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>ФИО пациента</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>Время записи</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>Контактные данные пациента</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>ФИО врача</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>Статус</b></th>
        <th align="center" valign="bottom" style="border:  1px solid #000000;"><b>Сверка</b></th>
    </tr>

    @foreach($Orders as $Order)
        <tr>
            <td align="left" valign="bottom" style="border:  1px solid #000000;">{{isset($i) ? ++$i : $i = 1}}</td>
            <td align="left" valign="bottom" style="border:  1px solid #000000;">{{$Order->created_at}}</td>
            <td align="left" valign="bottom"
                style="border:  1px solid #000000;">{{$Order['client_info']['name'] ?? '-'}}</td>
            <td align="left" valign="bottom" style="border:  1px solid #000000;">{{$Order->event_date}}</td>
            <td align="left" valign="bottom"
                style="border:  1px solid #000000;">{{$Order['client_info']['phone'] ??'-'}}</td>
            @if(!empty($Order->doctor))
                <td align="left" valign="bottom" style="border:  1px solid #000000;">
                    <b>{{$Order->doctor->firstname}} {{$Order->doctor->lastname}}</b></td>
            @else
                <td align="left" valign="bottom" style="border:  1px solid #000000;"><b>Врач не
                        указан. {{$Order->action}}</b></td>
            @endif
            <td align="left" valign="bottom" style="border:  1px solid #000000;">{{$Order->status_tag}}</td>
            <td align="left" valign="bottom" style="border:  1px solid #000000;"></td>

        </tr>
    @endforeach

    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right" colspan="3"><strong>Количество записанных пациентов: </strong></td>
        <td align="right">{{$Orders->count()}}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right" colspan="3"><strong>Количество сходивших пациентов: </strong></td>
        <td align="right"></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td align="right" colspan="2"><strong>Итого к оплате: </strong></td>
        <td></td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td align="right" colspan="2"><strong>Заказчик</strong></td>
        <td></td>
        <td></td>
        <td align="right" colspan="2" style="text-align: right;"><strong>Исполнитель</strong></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td align="right" colspan="2"><strong></strong></td>
        <td></td>
        <td></td>
        <td align="right" colspan="2" style="text-align: right;"><strong>ТОО "iDoctor.kz"</strong></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td align="right" colspan="2" rowspan="2"><strong>_____________________</strong></td>
        <td></td>
        <td></td>
        <td align="right" colspan="2" rowspan="2" style="text-align: right;"><strong>_____________________</strong></td>
    </tr>
    <tr>
    </tr>

    </tbody>
</table>