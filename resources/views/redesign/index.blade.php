@extends('redesign.layouts.app')
@section('content')

    <!-- section intro start -->
    <section class="index-intro pattern-bg">
        @include('redesign.partials.nav_line')
        <div class="container">
            <div class="index-intro__container">
                <div class="index-intro__heading">
                    <div>Бесплатный сервис поиска врача</div>
                    <div>НАЙТи ПРОВЕРЕННОГО Врача — легко!</div>
                </div>

                @include('redesign.partials.index.search')

                <div class="index-intro__stats">
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-1.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Doctor::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Врачей работают с нами</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-2.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Callback::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Записались через нас</div>
                    </div>
                    <div class="index-intro__stat-item">
                        <div class="index-intro__stat-img"><img src="{{asset('img/icon-stat-3.svg')}}" alt=""></div>
                        <div class="index-intro__stat-val">{{\App\Comment::localPublic()->count()}}</div>
                        <div class="index-intro__stat-text">Реальных отзывов</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- section intro end -->

    <!-- begin questions -->
        <div class="section questions">
            @include('redesign.partials.questions_list')
        </div>
    <!-- end section -->

    <!-- section letter search start -->
    <section class="section pattern-bg doc-letter-search">
        <div class="container">
            <div class="section-heading doc-letter-search__heading">
                <div class="section-heading__text">Быть здоровым - просто!</div>
                <div class="section-heading__descr">Мы поможем найти проверенного врача и записаться на прием в удобное
                    для Вас время
                </div>
            </div>
            <div class="doc-letter-search__search">
                <div class="doc-letter-search__result" id="doc-letter-search__result">
                    @foreach($skillsList->chunk(ceil($skillsList->count()/3)) as $skillLinksColumn)
                        <div class="doc-letter-search__result-column">
                            @foreach($skillLinksColumn as $skillLink)
                                <a href="{{ $skillLink['href'] }}" class="doc-letter-search__result-item" title="{{$skillLink['name']}}">
                                    <span class="doc-letter-search__result-item-text">{{$skillLink['name']}}</span>
                                    <span class="doc-letter-search__result-item-count">{{$skillLink['doctorsCount']}}</span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- section search end -->

    <!-- section work-flow start -->
    <section class="section work-flow">
        <div class="container">
            <div class="section-heading work-flow__heading">
                <div class="section-heading__text">Как это работает?</div>
            </div>
            <div class="work-flow__steps">
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>1</span>
                        <img src="{{asset('img/work-flow-1.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Находите нужного специалиста</div>
                </div>
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>2</span>
                        <img src="{{asset('img/work-flow-2.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Записываетесь на прием <a href="#quick-order-modal"
                                                                                      rel="modal-link">онлайн</a> или по
                        телефону
                    </div>
                </div>
                <div class="work-flow__steps-item">
                    <div class="work-flow__steps-item-img">
                        <span>3</span>
                        <img src="{{asset('img/work-flow-3.svg')}}" alt="">
                    </div>
                    <div class="work-flow__steps-item-text">Оцениваете работу врача или клиники после посещения</div>
                </div>
            </div>
            <div class="video-block">
                <div class="video-block__videoframe">
                    <iframe src="https://drive.google.com/file/d/1UyUMN_E7BsqqwKjA9FIpKguI1N7FCjDk/preview" width="640" height="480"  frameborder="0" allow="autoplay; encrypted-media"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- section work-flow end -->

    <!-- section blog-list start -->
    <section class="section blog-list">
        <div class="container">
            <div class="section-heading blog-list__heading">
                <div class="section-heading__text">Новости и блоги</div>
            </div>
            <div class="blog-list__list">
                @foreach($topPosts as $post)
                    <div class="blog-item blog-list__list-item toning"
                         style="background-image: url({{ URL::asset($post['cover_image'])}});">
                        <div class="blog-item__name">{{$post['title']}}</div>
                        <div class="blog-item__bot-line">
                            <a href="{{url('post/'.$post['alias'])}}"
                               class="blog-item__link"><span>Читать целиком</span><i class="fa fa-chevron-right"
                                                                                     aria-hidden="true"></i></a>
                            <div class="blog-item__date">
                                <div>Дата публикации</div>
                                <div>{{$post['created_at']->format('Y-m-d')}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="blog-list__load-more"><a href="{{url('posts')}}">Больше записей</a></div>
        </div>
    </section>
    <!-- section blog-list end -->

    <!-- section partners start-->
    <section class="section partners">
        <div class="container">
            <div class="section-heading partners__heading">
                <div class="section-heading__text">Наши партнеры</div>
            </div>
            <div class="partners__list">
                <div class="partners__list-item"><img src="{{asset('img/partner/1.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/2.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/3.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/4.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/5.jpg')}}" alt=""></div>
                <div class="partners__list-item"><img src="{{asset('img/partner/6.jpg')}}" alt=""></div>
            </div>
        </div>
    </section>
    <!-- section partners end-->

    <!-- begin section -->
    <script type="text/javascript">

        $('.show-question-form button').on('click', function () {
            $('.question__form').slideToggle(300);
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

        var desktop_datetime = $('.desktop-datetime');
        var mobile_datetime = $('.mobile-datetime');
        mobile_datetime.find('input').val('');
        if(desktop_datetime.is(':visible')){
            mobile_datetime.remove();
        }else{
            desktop_datetime.remove();
        }
        var form = $("#question__form");
        $("#question__form-send").click(function () {
            if (form[0].checkValidity()) {
                var data = form.serialize();
                console.log(data);
                $.post("{{url('/question/add')}}", data)
                    .done(function (json) {
                        $('#user-email').removeClass('has-warning');
                        $('#user-phone').removeClass('has-warning');
                        $('#user-birthday').removeClass('has-warning');
                        $('#user-gender').removeClass('has-warning');
                        $('#question-text').removeClass('has-warning');

                        modalOpen('question__modal');

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
                if(!$('#user-email').val()){
                    $('#user-email').addClass('has-warning');
                }else{
                    $('#user-email').removeClass('has-warning');
                }
                if(!$('#user-phone').val()){
                    $('#user-phone').addClass('has-warning');
                }else{
                    $('#user-phone').removeClass('has-warning');
                }
                if(!$('#user-birthday').val() || !isValidDate($('#user-birthday').val())){
                    $('#user-birthday').addClass('has-warning');
                }else{
                    $('#user-birthday').removeClass('has-warning');
                }
                if(!$('#user-birthday-mobile').val() || !isValidDate($('#user-birthday-mobile').val())){
                    $('#user-birthday-mobile').addClass('has-warning');
                }else{
                    $('#user-birthday-mobile').removeClass('has-warning');
                }
                if(!$('#user-gender').val()){
                    $('#user-gender').addClass('has-warning');
                }else{
                    $('#user-gender').removeClass('has-warning');
                }
                if(!$('#question-text').val()){
                    $('#question-text').addClass('has-warning');
                }else{
                    $('#question-text').removeClass('has-warning');
                }
            }
        });

        function isValidDate(dateString) {
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            return dateString.match(regEx) != null;
        }
    </script>
    <!-- end section -->
@endsection