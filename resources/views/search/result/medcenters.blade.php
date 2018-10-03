<ul class="live-search__doctors">
    <li class="specs__placeholder">Медцентры</li>
    @foreach($medcenters as $medcenter)
        <li class="specs__doctor">
            <a href="{{route('medcenter.item',['alias'=>$medcenter->alias])}}">
                <div class="specs__doctor-description">
                    <div class="doctor-description__name">{{$medcenter->name}}</div>
                </div>
            </a>
        </li>
    @endforeach
</ul>