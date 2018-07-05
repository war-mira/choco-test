@extends('app')
@section('content')
    <!-- begin section -->
    <div class="section intro" style="overflow: visible" data-parallax="scroll"
         data-image-src="images/parallax/mount.jpg">

        <div class="intro__text">
            <h2 class="intro__title"><strong>Бесплатный</strong> сервис поиска врачей</h2>
            <p></p>
        </div>

        <div class="container-fluid">
            <div class="col-md-4 col-md-offset-4">
                @include('search.livesearch')
            </div>
        </div>

        <!-- begin statistics -->
        <div class="statistics">
            <a class="statistics__item" href="{{route('doctors.list')}}"
               style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="images/icons/icon_expert.png" width="47" height="55"
                             alt="квалифицированных специалистов в вашем городе"
                             title="квалифицированных специалистов в вашем городе">
                    </span>
                <strong class="statistics__num">{{\App\Doctor::whereStatus(1)->where('city_id',session('cityid',6))->count()}}</strong>
                <span class="statistics__text">квалифицированных специалистов в вашем городе</span>
            </a>
            <a class="statistics__item" href="{{route('medcenters.list')}}" style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="images/icons/icon_catalog.png" width="61" height="50"
                             alt="частных и государственных клиник в каталоге"
                             title="частных и государственных клиник в каталоге">
                    </span>
                <strong class="statistics__num">{{\App\Medcenter::whereStatus(1)->count()}}</strong>
                <span class="statistics__text">частных и государственных клиник в каталоге</span>
            </a>
            <a class="statistics__item" href="#comments" style="text-decoration: none">
                    <span class="statistics__img">
                        <img src="images/icons/icon_heart.png" width="57" height="49"
                             alt="довольных пользователя нашего сервиса" title="довольных пользователя нашего сервиса">
                    </span>
                <strong class="statistics__num">{{\App\Comment::count()}}</strong>
                <span class="statistics__text">отзывов реальных пациентов</span>
            </a>
        </div>
        <!-- end statistics -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section questions">
        <div class="container">
            @component('components.bootstrap.row')
                @component('components.bootstrap.column',['class'=>'col-md-4 col-md-offset-4'])
                    <div class="show-question-form">
                        <button class="btn-block button">Задать вопрос врачу</button>
                    </div>
                @endcomponent
            @endcomponent
            @component('components.bootstrap.row')
                @component('components.bootstrap.column',['class'=>'col-md-8 col-md-offset-2'])
                    @include('forms.public.question-form-old')
                @endcomponent
            @endcomponent
        </div>
    </div>
    <!-- end section -->

    @if($topDoctors->count() > 0)
        <!-- begin section -->
        <div class="section">

            <!-- begin container -->
            <div class="container">

                <h2 class="section-title">Топ врачей </h2>
                <p class="text-center"></p>

                <div class="slick-user">
                    @foreach ($topDoctors as $doctor)
                        <a href="{{ $doctor->href }}">
                            <div class="slick-user__item">
                                @component('components.rating-stars',['rating' => $doctor->avg_rate])
                                @endcomponent
                                <img class="slick-user__avatar" src="{{ asset($doctor->avatar) }}" width="120"
                                     height="120"
                                     alt="">
                                <h4 class="slick-user__name">{{ $doctor['name'] }}</h4>
                                <p>{{ isset($doctor['main_skill']) ? $doctor['main_skill']->name : ''  }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
            <!-- end container -->

        </div>
        <!-- end section -->
    @endif
    <!-- begin section -->
    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">
            @component('elements.banners-slider',['position' => App\Banner::POSITION_MAIN_A['id']])

            @endcomponent

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->


    <!-- begin section -->
    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">

            <h2 class="section-title">Каталог врачей</h2>
            <p class="text-center"></p>

            <div class="home-list mtop-30" id="skills_full_list">
                @foreach($skillLinks->chunk(ceil($skillLinks->count()/4)) as $skillLinksColumn)
                    <ul class="list-unstyled list-unstyled--count">
                        @foreach($skillLinksColumn as $skillLink)
                            <li>
                                <span>{{$skillLink['doctorsCount']}}</span>
                                <a href="{{ $skillLink['href'] }}">{{$skillLink['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->

    <!-- begin section -->
    <div class="section bg-pattern" style="overflow: hidden;">

        <!-- begin container -->
        <div class="container">

            <div class="use">
                <h2>Пользоваться сервисом iDoctor&nbsp;— проще простого!</h2>
                <div class="use__item">
                    <img class="use__img" src="images/icons/icon_building.png" width="70" height="70"
                         alt="Находите нужных специалистов">
                    <div class="use__content">
                        <h3 class="use__title">Находите нужных специалистов</h3>
                        <p>И записывайтесь к ним на прием онлайн, с компьютера или смартфона.</p>
                    </div>
                </div>
                <div class="use__item">
                    <img class="use__img" src="images/icons/icon_sale.png" width="70" height="70"
                         alt="Получайте информацию о скидках">
                    <div class="use__content">
                        <h3 class="use__title">Получайте информацию о скидках</h3>
                        <p></p>
                    </div>
                </div>
                <div class="use__item">
                    <img class="use__img" src="images/icons/icon_stethoscope.png" width="70" height="70"
                         alt="Оценивайте работу врачей и клиник">
                    <div class="use__content">
                        <h3 class="use__title">Оценивайте работу врачей и клиник</h3>
                        <p></p>
                    </div>
                </div>
                <div class="use__phone">
                    <p class="use__phone-button">
                        <button type="button" data-toggle="modal" data-target="#reception" style="margin-left: 20px"
                                class="button button--light">Записаться на прием
                        </button>
                    </p>
                    <img src="images/phone.png" alt="img">
                </div>
            </div>

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->
    <!-- begin section -->
    <div class="section bg-shadow">

        <!-- begin container -->
        <div class="container">

            <h2 class="section-title"><a href="{{url('posts')}}">Новости, интервью, блоги</a></h2>

            <!-- begin news -->
            <div class="news">
                @foreach($topPosts as $post)
                    <div class="news__item item-news">
                        <div class="item-news__inner">
                            <a href="{{url('post/'.$post['alias'])}}" class="item-news__img"
                               style="background-image:url({{ URL::asset($post['cover_image'])}})"></a>
                            <h3 class="item-news__title">
                                <a href="{{url('post/'.$post['alias'])}}">{{$post['title']}}</a>
                            </h3>
                            <p class="item-news__meta">
                                <a href="{{url('post/'.$post['alias'])}}">Статья</a>
                                <span class="date">{{$post['created_at']->format('Y-m-d')}}</span>
                                <span class="count"></span>
                            </p>
                            <div class="text-collapsible">
                                <div class="text-content">
                                    <p>{{$post['content_lite']}}</p>
                                </div>
                                <a href="#">Показать</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end news -->

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->
    <!-- begin section -->
    <div class="section top-clear">
        <!-- begin container -->
        <div class="container">
            @component('elements.banners-slider',['position' =>\App\Banner::POSITION_MAIN_B['id']])

            @endcomponent
        </div>
        <!-- end container -->
    </div>
    <!-- end section -->
    <!-- begin section -->
    @component('components.comments',['comments'=>$lastComments,'visible'=>5,'title'=>'Отзывы наших клиентов'])
    @endcomponent
    <!-- end section -->

    <!-- begin container -->

    <!-- end container -->

    <!-- begin section -->
    <div class="section slick-logo-wrap">

        <!-- begin container -->
        <div class="container">

            <h2 class="section-title">С нами работают</h2>

            <div class="slick-logo">
                <div class="slick-logo__item">
                    <img src="images/partners/bv.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/damu.png" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/forbes.png" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/gew.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/istartup.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/med.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/pers.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/rbk.jpg" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/startupsauna.png" alt="">
                </div>
                <div class="slick-logo__item">
                    <img src="images/partners/vox.jpg" alt="">
                </div>
            </div>

        </div>
        <!-- end container -->

    </div>
    <!-- end section -->
    <div id="question__modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content modal-light">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Отправить вопрос врачу</h3>
                </div>
                <div style="display:none" id="save_comment_mess_ok" class="modal-body">
                    <b>Спасибо! Ваш вопрос был отправлен!</b>
                </div>
            </div>
        </div>
    </div>
    <!-- begin section -->
    <script type="text/javascript">
        $(function () {
            $('#user-birthday').datetimepicker({
                format: 'yyyy-mm-dd',
                minView: 2
            });
        });

        $('.show-question-form button').on('click', function () {
           $('.question__form').slideToggle(300);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = $("#question__form");
        $("#question__form-send").click(function () {
            if (form[0].checkValidity()) {
                var data = form.serialize();
                $.post("{{url('/question/add')}}", form.serialize())
                    .done(function (json) {
                        $('#user-email').removeClass('has-warning');
                        $('#user-phone').removeClass('has-warning');
                        $('#user-birthday').removeClass('has-warning');
                        $('#user-gender').removeClass('has-warning');
                        $('#text').removeClass('has-warning');
                        $('#question__modal').addClass('in').show();
                        if (json.error) {
                            $('#save_comment_mess_ok').removeClass('access').addClass('error').html('<b>' + json.error + '</b>');
                            $('#save_comment_mess_ok').show();
                        }
                        else if (json.id) {
                            $('#save_comment_mess_ok').removeClass('error').addClass('access').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                            $('#save_comment_mess_ok').show();
                            form[0].reset();
                        }
                    });
            }
            else {
                $('#user-email').addClass('has-warning');
                $('#user-phone').addClass('has-warning');
                $('#user-birthday').addClass('has-warning');
                $('#user-gender').addClass('has-warning');
                $('#text').addClass('has-warning');
            }
        });
        
        $('.close').on('click', function () {
            $('#question__modal').removeClass('in').hide();
        });

    </script>
    <!-- end section -->
@endsection
