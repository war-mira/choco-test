@extends('app')
@section('content')
    <!-- begin section -->
    <div class="section profile-bg-pattern">
        <!-- begin container -->
        <div class="container">

            <!-- begin breadcrumbs -->
            <nav class="breadcrumbs">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="{{url('/')}}">Главная</a></li>
                    <li class="breadcrumbs__item"><a
                                href="{{ route('doctors.list') }}">Врачи</a>
                    </li>
                    <li class="breadcrumbs__item">{{$doctor['name']}}</li>
                </ul>
            </nav>
            <!-- end breadcrumbs -->

            <!-- begin middle -->
            <div class="middle mtop-20">
                <div class="sidebar sidebar--left">
                    @component('components.profile-img')
                        @slot('src')
                            {{$doctor['avatar']}}
                        @endslot
                        @slot('width')
                            250px
                        @endslot
                        @slot('height')
                            250px
                        @endslot
                    @endcomponent
                </div>

                <div class="column column--right">
                    <h1 class="page-title">{{$meta['h1']}}</h1>
                    <h3 class="profiles__short">
                        @foreach ($doctor['skills'] as $skill)
                            <a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                        @endforeach
                    </h3>
                    <p>

                        @component('components.rating-stars',['rating' => $doctor->avg_rate])
                        @endcomponent
                        <?php if(!empty($doctor->publicComments()->count())){ ?>
                        &nbsp;&nbsp;<a href="#comments">{{$doctor->publicComments()->count()}} отзывов</a>
                        <?php }else { ?>
                        &nbsp;&nbsp;<a href="#comments">Нет отзывов</a>
                        <?php } ?>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>О враче:</h4>
                            <ul class="profiles__desc-list top-clear">
                                <li><span>Рейтинг:</span> {{$doctor->avg_rate}}</li>
                                <li><span>Стаж:</span> {{$doctor->exp_formatted}}</li>
                                <li><span>Адрес:</span> <a class="link-dotted"
                                                           href="{{$doctor->city->href}}">{{$doctor->city->name}}</a>, {{$doctor['address']}}
                                </li>


                            </ul>
                            <p class="profiles__price">Стоимость приема: <strong>{{$doctor['price']}} тг</strong></p>
                        </div>

                        <div class="col-md-6">
                            <ul class="profiles__desc-list top-clear" style="font-size: 16px">
                                <li><strong>{{$doctor->orders()->whereIn('status',[1,2])->count()}}</strong><span> Записи(за все время)</span>
                                </li>
                                <li><i class="glyphicon    @if($doctor['ambulatory']==1)
                                            glyphicon-ok
@else
                                            glyphicon-remove
@endif"></i>Выезд на дом

                                </li>
                                <li><i class="glyphicon glyphicon-user"></i>Врач для взрослых
                                </li>
                                @if($doctor['child']==1)
                                    <li><i class="glyphicon glyphicon-baby-formula"></i>Детский врач
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="mbottom-10">
                        {{--<a class="btn btn-success call-collapse" style="font-size: 17px;padding-top: 13px"
                           data-phone=" +7(771)503-32-21"
                           href="tel:+77715033221">
                            <span><i style="font-size: 20px" class="glyphicon glyphicon-earphone"></i></span>
                        </a>--}}
                        <a class="btn btn-success call-collapse" data-phone=" +7(727)222-22-00"
                           style="background-color: #2aabd2;font-size: 17px;padding-top: 13px"
                           href="tel:+77272222200">
                            <span><i style="font-size: 20px" class="glyphicon glyphicon-earphone"></i></span>
                        </a>
                    </div>
                    <script>
                        $('.call-collapse').click(function (e) {
                            if (!$(this).hasClass('call-expand')) {
                                $(this).toggleClass('call-expand');
                                $(this).find('span>i').after($(this).data('phone'));
                                e.preventDefault();
                            }
                            else {
                                ga('send', 'event', {
                                    eventCategory: 'doctor_phone',
                                    eventAction: 'call'
                                });
                            }

                        });
                    </script>
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
                        @if(isset($doctor['timetable']) && $doctor['timetable'] != '')
                            {!! $doctor['timetable']!!}
                        @endif
                    </div>
                </div>
                <!-- end sidebar -->

                <!-- begin column -->
                <div id="reg_form" class="column column--right">
                    @if($doctor->partner == \App\Doctor::PARTNER)
                        <h3>Записаться на прием</h3>
                    @else
                        <h3>Я хочу посетить этого врача, когда появится возможность</h3>
                    @endif
                    <form id="callback_form">
                        <input type="hidden" name="ga_cid" value="">
                        @if($doctor->partner == \App\Doctor::NOT_PARTNER)
                            <input type="hidden" name="status" value="6">
                        @endif
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
                        @if($doctor->partner == \App\Doctor::PARTNER)
                            <div class="form__group desktop-ditetime" id="datetime-group">
                                <label>*Время и дата приема</label><br>
                                <input class="form-control datepicker" required
                                       name="client_datetime" id="client_datetime" type="text">
                            </div>
                            <div class="form__group mobile-ditetime" id="datetime-group">
                                <label>*Время и дата приема</label><br>
                                <input class="form-control datepicker"
                                       name="client_datetime_2" type="datetime-local">
                            </div>
                        @endif
                        <div class="form__group">
                            <label>Email</label><br>
                            <input class="form-control " name="client_email" id="client_email" type="text"
                                   @if(Auth::user())
                                   value="{{auth()->user()->email}}"
                                   readonly="readonly"
                                    @endif>
                        </div>
                        <input type="hidden" name="target_type" value="Doctor">
                        <input type="hidden" name="target_id" value="{{$doctor['id']}}">
                        <input type="hidden" name="source" value="doctor_page">
                        <div class="form-group">
                            <label>Врач</label><br>
                            <input class="form-control" id="doctor_name"
                                   type="text"
                                   value="{{$doctor['name']}}"
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
                                          placeholder="Напишите свои пожелания сюда"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="button" id="save_order" class="button" value="Записаться">
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
    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">

            <!-- begin middle -->
            <div class="middle">

                <div style="float:left">
                    @component('elements.banners-slider',['position' => App\Banner::POSITION_EXT_A['id']])

                    @endcomponent
                </div>
                @foreach(App\Doctor::CONTENTS as $field=>$title)
                    @if(!empty(trim($doctor[$field])) && $doctor[$field] != '0' && strlen($doctor[$field])>10)
                        <h3>{{$title}}</h3>
                        <p>{!! str_replace('\r\n', '<br />', $doctor[$field]) !!}</p>
                    @endif
                @endforeach
            </div>
            <!-- end middle -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    @component('components.comments',['comments'=>$doctor->publicComments()->get(),'owner'=>['type'=>'Doctor','id'=>$doctor->id]])
        @slot('title') Отзывы @endslot
        @slot('visible',5)
        @slot('url',route('doctor.comments',['doctor'=>$doctor->alias]))
    @endcomponent
    <!-- end section -->

    @if(!empty($meta['seoText']))
        <!-- begin section -->
        <div class="section top-clear">

            <!-- begin container -->
            <div class="container">

                <!-- begin middle -->
                <div class="middle">

                    {{$meta['seoText']}}

                </div>
                <!-- end middle -->

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->
    @endif

    <!-- begin section -->

    <script type="text/javascript">
        $(function () {
            $('#client_datetime').datetimepicker();
        });

        // get the iso time string formatted for usage in an input['type="datetime-local"']
        var tzoffset = (new Date()).getTimezoneOffset() * 60000; //offset in milliseconds
        var localISOTime = (new Date(Date.now() - tzoffset)).toISOString().slice(0,-1);
        var localISOTimeWithoutSeconds = localISOTime.slice(0,16);

        // select the "datetime-local" input to set the default value on
        var dtlInput = document.querySelector('input[type="datetime-local"]');

        if(dtlInput){
            // set it and forget it ;)
            dtlInput.value = localISOTime.slice(0,16);
        }

        var mobile_detetime = $('.mobile-ditetime');
        var desktop_detetime = $('.desktop-ditetime');
        if(desktop_detetime.is(":visible")){
            mobile_detetime.remove();
            mobile_detetime.find('.datepicker').prop('required',true);
        }else{
            desktop_detetime.remove();
            desktop_detetime.find('.datepicker').prop('required',true);
        }
        $phoneInput = $('.bfh-phone');
        $phoneInput.bfhphone($phoneInput.data());

        var callbackForm = $("form#callback_form");
        ga(function (tracker) {
            var cid = tracker.get('clientId');
            callbackForm.find('[name="ga_cid"]').val(cid).trigger('change');
        });

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
                formData.ga_cid =
                    $.getJSON("{{route('callback.oldDoc')}}", formData)
                        .done(function (json) {
                            $('#mess_ok').show();
                            $("#reg_form").hide()
                        });

                return false;
            }

        });
    </script>
    <!-- end section -->
@endsection
