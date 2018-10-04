@for($j=0;$j<3;$j++)

    <div>
        <div class="btn-group">
            @for($w=0;$w<7;$w++)
                <label class="btn btn-default checkbox-success">
                    День {{$w}}
                    <input class="timetable-day-checkbox" type="checkbox" data-day="{{$w}}" style="display: none">
                </label>
            @endfor
        </div>
    @for($w=0;$w<7;$w++)
        <div class="panel timetable-day" data-day="{{$w}}">
            <div class="panel-heading">
                <div class="panel-title">День {{$w}}</div>
            </div>
            <div class="panel-body">
                <div class="container">
                    @for($t=12;$t<=44;$t++)
                        <div class="form-group col-lg-1">
                            <label class="btn btn-default radio-success">
                                {{ Carbon\Carbon::create(0,0,0,intval($t/2),intval(($t*30)%60))->format('H:i') }}
                                <input type="radio" style="display: none" name="{{($w*48+$t)}}" value="{{$j}}">
                            </label>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    @endfor
    </div>
@endfor
@push('component_scripts')
    <script>
        $('.radio-success').on('click', function () {
            var $input = $(this).find('input');
            if ($input.prop('checked'))
                $input.prop('checked', false).trigger('change');
            else
                $input.prop('checked', true).trigger('change');
            return false;
        }).find('input').on('change', function () {
            $('input[name="' + this.name + '"]').parent().removeClass('btn-success');
            if ($(this).prop('checked')) {
                $(this).parent().addClass('btn-success');
            }
        });

        $('.checkbox-success input').on('change', function () {
            if ($(this).prop('checked')) {
                $(this).parent().addClass('btn-success');
                $(this).parent().parent().parent().find('.timetable-day[data-day="'+$(this).data('day')+'"]').show();
            }
            else {
                $(this).parent().removeClass('btn-success');
                $(this).parent().parent().parent().find('.timetable-day[data-day="'+$(this).data('day')+'"]').hide();
            }
        });
        var id = 2;
        var url = @jsroute('admin.doctors.form.view',['id'])({id: 5});
        alert(url);
    </script>
@endpush
