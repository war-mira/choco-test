<label for="preview_text" class="control-label">Расписание приема:</label>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Пон.
            </div>
            <div class="col-sm-8">
                @if(!empty($value) && $value["mond"])
                    @php
                        $nic = unserialize($value["mond"]);
                    @endphp
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="mond_from" class="form-control" value="{{$nic[0]}}">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="mond_to" class="form-control" value="{{$nic[1]}}">
                    </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="mond_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="mond_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Вторник
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["tues"])
                    @php
                        $nic = unserialize($value["tues"]);
                    @endphp
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="tues_from" class="form-control" value="{{$nic[0]}}">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="tues_to" class="form-control" value="{{$nic[1]}}">
                    </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="tues_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="tues_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Среда.
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["wedn"])
                    @php
                        $nic = unserialize($value["wedn"]);
                    @endphp
                <div class="input-group input-daterange">
                    <input ata-format="hh:mm" type='time' type="text" name="wedn_from" class="form-control" value="{{$nic[0]}}">
                    <div class="input-group-addon">-</div>
                    <input ata-format="hh:mm" type='time' type="text" name="wedn_to" class="form-control" value="{{$nic[1]}}">
                </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="wedn_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="wedn_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Четверг.
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["thur"])
                    @php
                        $nic = unserialize($value["thur"]);
                    @endphp
                <div class="input-group input-daterange">
                    <input ata-format="hh:mm" type='time' type="text" name="thur_from" class="form-control" value="{{$nic[0]}}">
                    <div class="input-group-addon">-</div>
                    <input ata-format="hh:mm" type='time' type="text" name="thur_to" class="form-control" value="{{$nic[1]}}">
                </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="thur_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="thur_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Пятница.
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["frid"])
                    @php
                        $nic = unserialize($value["frid"]);
                    @endphp
                <div class="input-group input-daterange">
                    <input ata-format="hh:mm" type='time' type="text" name="frid_from" class="form-control" value="{{$nic[0]}}">
                    <div class="input-group-addon">-</div>
                    <input ata-format="hh:mm" type='time' type="text" name="frid_to" class="form-control" value="{{$nic[1]}}">
                </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="frid_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="frid_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Субота.
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["satu"])
                    @php
                        $nic = unserialize($value["satu"]);
                    @endphp
                <div class="input-group input-daterange">
                    <input ata-format="hh:mm" type='time' type="text" name="satu_from" class="form-control" value="{{$nic[0]}}">
                    <div class="input-group-addon">-</div>
                    <input ata-format="hh:mm" type='time' type="text" name="satu_to" class="form-control" value="{{$nic[1]}}">
                </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="satu_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="satu_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class='col-sm-12'>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2">
                Воскр.
            </div>

            <div class="col-sm-8">
                @if(!empty($value) && $value["sund"])
                    @php
                        $nic = unserialize($value["sund"]);
                    @endphp
                <div class="input-group input-daterange">
                    <input ata-format="hh:mm" type='time' type="text" name="sund_from" class="form-control" value="{{$nic[0]}}">
                    <div class="input-group-addon">-</div>
                    <input ata-format="hh:mm" type='time' type="text" name="sund_to" class="form-control" value="{{$nic[1]}}">
                </div>
                @else
                    <div class="input-group input-daterange">
                        <input ata-format="hh:mm" type='time' type="text" name="sund_from" class="form-control" value="09:00">
                        <div class="input-group-addon">-</div>
                        <input ata-format="hh:mm" type='time' type="text" name="sund_to" class="form-control" value="17:00">
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker1').datetimepicker({
            locale: {
                format: 'HH:mm'
            }
        });
    });
</script>