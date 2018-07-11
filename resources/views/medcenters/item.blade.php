@extends('app')
@section('content')
    <!-- begin section -->
    <div class="section top-clear bottom-clear">

        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a></li>
                    <li class="breadcrumbs__item"><a
                                href="{{route('medcenters.list')}}">Клиники</a>
                    </li>
                    <li class="breadcrumbs__item">{{$medcenter->name}}</li>
                </ul>
            </nav>
            <!-- end breadcrumbs -->

            <!-- begin middle -->
            <div class="middle mtop-20">

                <div class="sidebar sidebar--left">
                    @component('components.profile-img')
                        @slot('src')
                            {{$medcenter['avatar']}}
                        @endslot
                        @slot('width')
                            250px
                        @endslot
                        @slot('height')
                            250px
                        @endslot
                    @endcomponent
                </div>

                <div class="column column--right mbottom-20">
                    <h1 class="page-title">{{$meta['h1']}}</h1>
                    <h3 class="profiles__short">Многопрофильное медицинское учреждение</h3>
                    <p>
                        @component('components.rating-stars',['rating' => $medcenter['rate']])
                        @endcomponent
                        &nbsp;&nbsp;<a href="#comments">{{$medcenter->allComments()->count()}} отзывов</a>
                    </p>
                    <ul class="profiles__desc-list">
                        <li><span>Врачей: </span>{{$medcenter->publicDoctors()->count()}}</li>
                        <li><span>Специализаций: </span>{{$medcenter->skills()->count()}}</li>
                    </ul>
                    <?php if(!empty($medcenter['price'])){ ?>
                    <p class="profiles__price">Стоимость приема: от <strong>{{$medcenter['price']}} тг</strong></p>
                    <?php } ?>
                    @component('components.ya-share')
                    @endcomponent
                </div>

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section">

        <!-- begin container -->
        <div class="container">

            <!-- begin middle -->
            <div class="middle middle--border">

                <!-- begin sidebar -->
                <div class="sidebar sidebar--left">
                    <div class="sidebar__section bottom-clear">
                        <h3 class="sidebar__title">График работы:</h3>
                        @if(isset($medcenter['timetable']) && $medcenter['timetable'] != '')
                            {!! $medcenter['timetable']!!}
                        @else
                            Временно недоступен.
                        @endif
                    </div>
                </div>
                <!-- end sidebar -->

                <!-- begin column -->
                <div id="reg_form" class="column column--right">
                    <h3>Записаться на прием</h3>

                    <form id="callback_form">
                        <input type="hidden" name="ga_cid" value="">
                        @if(Auth::user())
                            <input type="hidden" name="client_id" value="{{auth()->user()->id}}">
                        @endif
                        <div class="form__group">
                            <label>*Имя и Фамилия</label><br>
                            <input class="form-control " name="client_name" id="client_name" required type="text"
                                   @if(Auth::user())
                                   value="{{auth()->user()->name}}"
                                   readonly="readonly"
                                    @endif>
                        </div>
                        <div class="form__group" id="phone-group">
                            <label>*Телефон</label><br>
                            <input class="form-control bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                                   pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="client_phone" id="client_phone"
                                   type="text"
                                   @if(Auth::user())
                                   value="{{auth()->user()->phone}}"
                                   readonly="readonly"
                                    @endif>
                        </div>
                        <div class="form__group">
                            <label>Email</label><br>
                            <input class="form-control " name="client_email" id="client_email" type="text"
                                   @if(Auth::user())
                                   value="{{auth()->user()->email}}"
                                   readonly="readonly"
                                    @endif>
                        </div>
                        <input type="hidden" name="target_type" value="Medcenter">
                        <input type="hidden" name="target_id" value="{{$medcenter['id']}}">
                        <input type="hidden" name="source" value="medcenter_page">
                        <div class="form-group">
                            <label>Врач</label><br>
                            <input class="form-control" id="medcenter_name"
                                   type="text"
                                   value="{{$medcenter['name']}}"
                                   readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label for="client_comment">
                                <a data-toggle="collapse" href="#client_comment" class="link-dotted">
                                    Есть особые пожелания?&nbsp;<i class="glyphicon glyphicon-chevron-down"></i>
                                </a>
                            </label>
                            <div id="client_comment" class="collapse">
                                <textarea class="form-control" style="height: 100px" id="client_comment_text"
                                          name="client_comment"
                                          placeholder="Напишите свои пожелания сюда..(можно оставить пустым)"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="save_order" class="button" value="Записаться">
                        </div>
                    </form>

                </div>
                <div id="mess_ok" style="padding:10px;    margin-left: 240px;font-size:18px;display:none" class="">
                    <strong>Спасибо!</strong> Вы оставили заявку на запись. В ближайшее время с вами свяжется наш
                    оператор
                </div>
                <!-- end column -->

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section bg-shadow">

        <!-- begin container -->
        <div class="container">

            <!-- begin middle -->
            <div class="middle">

                <!-- begin sidebar -->
                <aside class="sidebar sidebar--left hidden-xs hidden-sm">
                    <div class="sidebar__section">

                        @component('elements.banners-slider',['position'=>\App\Banner::POSITION_EXT_B['id']])
                        @endcomponent
                    </div>
                </aside>
                <!-- end sidebar -->

                <!-- begin column -->
                <div class="column column--right column--gray">
                    <h3>О клинике:</h3>
                    <p>{!!str_replace('\r\n',' ',$medcenter->content)!!}</p>
                </div>
                <!-- end column -->

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section bg-shadow">

        <!-- begin container -->
        <div class="container">

            <h2 class="section-title">Врачи клиники</h2>

            <!-- begin middle -->
            <div class="middle mtop-40">

                <!-- begin sidebar -->
                <div class="sidebar sidebar--left">
                    <ul class="nav nav-pills">
                        @foreach ($medcenter->skills() as $item)
                            <li @if($loop->first) class="active" @endif><a class="skill_item" data-toggle="pill"
                                                                           id="{{$item->id}}"
                                                                           href="#skill{{$item->id}}">{{$item->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="column column--right tab-content">
                    <!-- begin profiles -->
                    @foreach ($medcenter->skills() as $skill)
                        <div id="skill{{$skill->id}}" class="tab-pane fade @if($loop->first) in active @endif">
                            @foreach($skill->publicDoctors()->with('medcenters')
                            ->whereHas(
                            'medcenters',function($query)use($medcenter)
                            {
                            $query->where('medcenters.id',$medcenter->id);
                            })
                            ->orderBy('lastname')->get() as $doctor)
                                @include('model.doctor.profile-short')
                            @endforeach
                        </div>
                    @endforeach
                <!-- end profiles -->
                </div>
                <!-- end sidebar -->

                <!-- begin column -->

                <!-- end column -->

            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->

    <!-- end section -->

    <!-- begin section -->
    @component('components.comments',['comments'=>$comments,'owner'=>['type'=>'Medcenter','id'=>$medcenter->id]])
        @slot('title') Отзывы @endslot
        @slot('visible',5)
        @slot('url',route('medcenter.comments',['medcenter'=>$medcenter->alias]))
    @endcomponent
    <!-- end section -->

    <!-- begin section -->
    <div class="section top-clear bottom-clear hidden-xs hidden-sm">

        <!-- begin container -->
        <div class="container">
            <!-- begin slick-banner -->
        @component('elements.banners-slider',['position'=>\App\Banner::POSITION_MAIN_B['id']])
        @endcomponent
        <!-- end slick-banner -->
        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    @if(!empty($meta['seoText']))
        <!-- begin section -->
        <div class="section top-clear">

            <!-- begin container -->
            <div class="container">

                <!-- begin middle -->
                <div class="middle">

                    {!! $meta['seoText'] !!}

                </div>
                <!-- end middle -->

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->
    @endif

    <script type="text/javascript">

        ga(function (tracker) {
            var cid = tracker.get('clientId');
            $("#callback_form").find('[name="ga_cid"]').val(cid).trigger('change');
        });

        $("#show_all_comment").click(function () {
            $('#' + this.id).hide();
            $('.reviews__item').show();
            return false;
        });

        var callbackForm = $("form#callback_form");
        $("#save_order").click(function () {
            //Ga target
            ga('send', 'event', {
                eventCategory: 'zapisatsya',
                eventAction: 'click'
            });
            //Ya goal
            yaCounter47714344.reachGoal('registration');

            if (callbackForm[0].checkValidity()) {
                var formData = getFormData(callbackForm);
                $.getJSON("{{route('callback.newDoc')}}", formData)
                    .done(function (json) {
                        $('#mess_ok').show();
                        $("#reg_form").hide()
                    });
                return false;
            }

        });
    </script>
@endsection
