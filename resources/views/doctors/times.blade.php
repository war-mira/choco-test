@php
    $today = $day; $st = 1;
    $week = array(1=>'mond',2=>'tues',3=>'wedn',4=>'thur',5=>'frid',6=>'satu',7=>'sund');
    if($doctor[$week[$today]])
    {
        $nic = unserialize($doctor[$week[$today]]);
        $starttime = $nic[0];  // your start time
        $endtime = $nic[1];  // End time
        $duration = '30';  // split by 30 mins
        $start_time    = strtotime ($starttime); //change to strtotime
        $end_time      = strtotime ($endtime); //change to strtotime
        $add_mins  = $duration * 60;
    }
@endphp

@if(isset($nic) && $nic)
    @while($start_time <= $end_time)
        <div class="appointment-book-small__time-item time-radio">
            <label class="time-radio__item">
                <input type="radio" name="time" value="@php echo date('H:i',$start_time); @endphp"/>
                <span class="time-radio__text btn btn_theme_radio noselect">@php echo date('H:i',$start_time); @endphp</span>
            </label>
        </div>
        @php $start_time += $add_mins; $st++; @endphp
    @endwhile
@endif