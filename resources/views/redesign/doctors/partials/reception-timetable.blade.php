@foreach($times as $time)
    <li class="time-select-item">
        <input type="radio" id="reception-time{{$time['week_time_id']}}" name="order-time"
               value="{{$time['day']['day_time']}}">
        <label for="reception-time{{$time['week_time_id']}}">{{$time['day']['day_time']}}</label>
    </li>
@endforeach