<div class="row">
    <div class="col-md-2">
        @component('components.profile-img')
            @slot('src')
                {{$data->avatar}}
            @endslot
                @slot('width')
                    40px
                @endslot
                @slot('height')
                    40px
                @endslot
        @endcomponent
    </div>
    <div class="col-md-6">
        <h4>{{$data->lastname." ".$data->firstname}}</h4>
    </div>
    <div class="col-md-4">
        <h5>{{$data->skills->first()->name}}</h5>
    </div>
</div>