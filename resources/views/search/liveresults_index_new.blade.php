<ul class="live-search__specs">
    <li class="specs__placeholder">Специализации</li>
    @foreach($skills as $skill)
            @if(isset($skill))
            <li><a href="{{route('doctors.list', ['skill' => $skill->alias])}}">{{$skill->name}}<span
                            class="column-li__number">{{$skill->doctors_count}}</span></a></li>
            @endif
        @endforeach
</ul>
<!-- / Specialities -->
<ul class="live-search__doctors">
    <li class="specs__placeholder">Врачи</li>

    @foreach($doctors as $doctor)

        <li class="specs__doctor">
            <a href="{{route('doctor.item',['alias'=>$doctor->alias])}}">
                <div class="specs__doctor-photo">
                    <img src="{{url($doctor->avatar)}}" alt="">
                </div>
                <div class="specs__doctor-description">
                    <div class="doctor-description__name">{{$doctor->name}}</div>
                    <div class="doctor-description__speciality">
                        {{implode('/',$doctor->skills->pluck('name')->toArray())}}
                    </div>
                </div>
            </a>
        </li>
    @endforeach
</ul>