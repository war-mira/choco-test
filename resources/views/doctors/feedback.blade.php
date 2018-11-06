@extends('layouts.doctors-feedback')
@section('content')
    <div class="feedback__doctor-container">
        <div class="feedback__doctor-description">
            <div class="doctor-photo">
                <img src="{{url($doctor['avatar'])}}">
            </div>
            <div class="doctor-name">{{$doctor['name']}}</div>
            <div class="doctor-specialization">@foreach ($doctor['skills'] as $skill)
                    <a href="{{$skill->href}}" style="text-decoration: none">{{$skill->name }}</a>
                @endforeach</div>
        </div>
        <div class="feedback__review-container">
            <form class="feedback__form" id="feedback__form">
                {{ csrf_field() }}
                <input type="hidden" id="owner_type" value="Doctor">
                <input type="hidden" id="owner_id" value="{{$doctor->id}}">
                <input type="hidden" id="type" value="{{ $type }}">
                <div class="feedback__rating">
                    <p>Оцените данного врача</p>
                    <div class="rating">
                        <input type="radio" class="rating__input" id="rating-input-1-5" value="10" name="user_rate"
                               required/>
                        <label for="rating-input-1-5" class="rating__star"> </label>

                        <input type="radio" class="rating__input" id="rating-input-1-4" value="8" name="user_rate"/>
                        <label for="rating-input-1-4" class="rating__star"> </label>

                        <input type="radio" class="rating__input" id="rating-input-1-3" value="6" name="user_rate"/>
                        <label for="rating-input-1-3" class="rating__star"> </label>

                        <input type="radio" class="rating__input" id="rating-input-1-2" value="4" name="user_rate"/>
                        <label for="rating-input-1-2" class="rating__star"> </label>

                        <input type="radio" class="rating__input" id="rating-input-1-1" value="2" name="user_rate"/>
                        <label for="rating-input-1-1" class="rating__star"> </label>
                    </div>
                </div>
                <div class="user-info">
                    @if(Auth::guest())
                    <div class="row with-border-row">
                        <div class="form-group col-md-6 small-padding-right">
                            <label>Ваше имя</label>
                            <input id="user_name" type="text" name="user_name" placeholder="Имя" required>
                        </div>
                        <div class="form-group col-md-6 small-padding-left">
                            <label>Телефон</label>
                            <input class="styler bfh-phone" id="user_email" data-format="+7 (ddd) ddd-dddd"
                                pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="phone"
                                title="Телефон в формате +7 (XXX) XXX XX-XX" type="text"
                                placeholder="Телефон" name="user_email" required>
                        </div>
                    </div>
                    @endif
                    <div class="row with-padding">
                        <div class="form-group col-md-12">
                            <label>Ваш отзыв о враче</label>
                            <p class="tip small with-border-row">Поделитесь впечатлениями о приеме: комфортно ли для вас прошла косультация и
                                процедуры, компетентно ли общался врач, понятно ли ответил на вопросы... Будьте
                                объективны, ваш отзыв поможет другим пользователям выбрать подходящего специалиста!</p>
                            <textarea id="text" name="text" required rows="6"></textarea>
                            <p class="tip">Желательно не менее 100 символов.</p>
                            <p class="characters-count">0</p>
                        </div>
                    </div>
                    <div class="row with-padding">
                        <div class="form-group col-md-12">
                            <div class="leave-review__review-recommend review-recommend">
                                <label class="review-recommend__item">
                                    <input type="radio" name="recommended" value="{{ \App\Comment::recommended  }}">
                                    <span class="review-recommend__btn review-recommend__btn_yes">Рекомендую</span>
                                </label>
                                <label class="review-recommend__item">
                                    <input type="radio" name="recommended" value="{{ \App\Comment::notRecommended  }}">
                                    <span class="review-recommend__btn review-recommend__btn_no">Не рекомендую</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row with-padding">
                        <div class="form-group col-md-12 center">
                            <button type="button" id="save_comment">Оставить свой голос</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="feedback__tips-container">
        <p>
            iDoctor.kz не публикует отзывы, которые содержат
            оскорбления и ненормативную лексику
        </p>
        <a href="">Публичная оферта</a>
    </div>
    <div id="feedback__modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content modal-light">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Оцените данного врача</h3>
                </div>
                <div style="display:none" id="save_comment_mess_ok" class="modal-body">
                    <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
                </div>
                <div style="display:none" id="code_confirm" class="modal-body">
                    @if(Auth::guest())
                        <div class="row with-padding ">
                            <div class="form-group col-md-12 center">

                                <div class="text-center">
                                    <div>
                                        <div style="font-size: 25px">Код из СМС</div>
                                        <input id="phone_code"
                                               type="text"
                                               placeholder="0000"
                                               data-format="dddd"
                                               pattern="\d{4}"
                                               maxlength="4"
                                               required
                                               style="font-size: 30px; width: 90px; text-align: center;"
                                        >

                                    </div>

                                    <p class="tip small">
                                        Введите код из СМС и нажмите подтвердить запрос
                                    </p>

                                    <button type="button" id="confirm_code">Подтвердить номер</button>
                                </div>

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>

        $("#save_comment").click(function () {
            if ($("#feedback__form")[0].checkValidity()) {
                $.getJSON("{{url('/comment/new')}}", {
                    owner_id: $('#owner_id').val(),
                    owner_type: $('#owner_type').val(),
                    type: $('#type').val(),
                    user_name: $('#user_name').val(),
                    user_email: $('#user_email').val(),
                    text: $('#text').val(),
                    user_likes: $('#user_likes').val(),
                    user_doest_like: $('#user_doest_like').val(),
                    user_rate: $('input[name=user_rate]:checked').val(),
                    recommended: $('input[name=recommended]:checked').val(),
                })
                    .done(function (json) {
                        $('#user_name').removeClass('has-warning');
                        $('#text').removeClass('has-warning');
                        $('.rating').removeClass('has-warning');
                        $('#feedback__modal').addClass('in').show();
                        if (json.error) {
                            $('#save_comment_mess_ok').removeClass('access').addClass('error').html('<b>' + json.error + '</b>');
                            $('#save_comment_mess_ok').show();
                        }
                        else if (json.id) {
                            $('#save_comment_mess_ok').removeClass('error').addClass('access').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                            $('#save_comment_mess_ok').show();
                            $("#feedback__form")[0].reset();
                        }
                        else if(json.code){
                            $('#code_confirm').show();
                            $('#save_comment_mess_ok').hide();
                        }
                    });
            }
            else {
                $('#user_name').addClass('has-warning');
                $('#user_phone').addClass('has-warning');
                $('#text').addClass('has-warning');
                $('.rating').addClass('has-warning');

            }
        });

        $("#text").on('keyup', function () {
            var len = $(this).val().length;
            $('.characters-count').text(len);
        });

        $('.close').on('click', function () {
            $('#feedback__modal').removeClass('in').hide();
        });



        $("#confirm_code").click(function () {
            if ($("#phone_code").val().length==4) {
                $.post("{{url('/comment/confirm-code')}}", {
                    code: $('#phone_code').val(),
                    _token:'{{ csrf_token() }}'
                })
                .done(function (json) {
                    if (json.error) {
                        $('#save_comment_mess_ok').removeClass('access').addClass('error').html('<b>' + json.error + '</b>');
                        $('#save_comment_mess_ok').show();
                        $('#code_confirm').hide();
                    }
                    else if (json.id) {
                        $('#save_comment_mess_ok').removeClass('error').addClass('access').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                        $('#save_comment_mess_ok').show();
                        $("#feedback__form")[0].reset();
                        $('#code_confirm').hide();
                    }
                });
            }
            else {
                $('#user_name').addClass('has-warning');
                $('#user_last_name').addClass('has-warning');
                $('#text').addClass('has-warning');

            }
        });
</script>
@endsection