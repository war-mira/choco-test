<div class="row">
    <div class="col-sm-8">
        <div class="about-info">
            @foreach(App\Models\Doctors\Doctor::CONTENTS as $field=>$title)
                @if(isset($doctor[$field]) && !empty(trim($doctor[$field])))
                    <div class="about-info__info-block">
                        <div class="info-block__title">{{$title}}</div>
                        <div class="info-block__content">{!! str_replace('\r\n', '<br />', $doctor[$field]) !!}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- /Tab content block -->
    <div class="col-sm-4">
        <aside class="side-content">
            <div class="adv-banner">
                <img src="{{asset('img/promotion/banner.jpg')}}" alt="">
            </div>
        </aside>
    </div>
</div>