<div id="city_modal" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-light">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Ваш город</h3>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-sm-12">
                        <ul class="list-unstyled">
                            @if(\App\City::active()->get())
                                @foreach(\App\City::active()->get() as $city)
                                    <li><a href="{{ route('setcity', $city->id) }}" rel="nofollow">{{ $city->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>