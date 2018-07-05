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
                <input type="hidden" id="type" value="{{ \App\Comment::typeQR }}">
                <div class="feedback__rating">
                    <p>Оцените данного врача</p>
                    <div class="rating">
                        <input type="radio" class="rating__input" id="rating-input-1-5" value="10" name="user_rate"
                               checked/>
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
                    <div class="row with-border-row">
                        <div class="form-group col-md-6 small-padding-right">
                            <label>Ваше имя</label>
                            <input id="user_name" type="text" name="user_name" required>
                        </div>
                        <div class="form-group col-md-6 small-padding-left">
                            <label>Фамилия</label>
                            <input id="user_last_name" type="text" name="user_last_name" required>
                        </div>
                    </div>
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
                    <div class="row">
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
                    user_last_name: $('#user_last_name').val(),
                    text: $('#text').val(),
                    user_likes: $('#user_likes').val(),
                    user_doest_like: $('#user_doest_like').val(),
                    user_rate: $('input[name=user_rate]:checked').val(),
                    recommended: $('input[name=recommended]:checked').val(),
                })
                    .done(function (json) {
                        $('#user_name').removeClass('has-warning');
                        $('#text').removeClass('has-warning');
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
                    });
            }
            else {
                $('#user_name').addClass('has-warning');
                $('#user_last_name').addClass('has-warning');
                $('#text').addClass('has-warning');

            }
        });

        $("#text").on('keyup', function () {
            var len = $(this).val().length;
            $('.characters-count').text(len);
        });

        $('.close').on('click', function () {
            $('#feedback__modal').removeClass('in').hide();
        });

    </script>
@endsection