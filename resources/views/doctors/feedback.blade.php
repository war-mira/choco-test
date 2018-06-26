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
        <div style="display:none" id="save_comment_mess_ok">
            <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
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
                        <input type="radio" class="rating__input" id="rating-input-1-5" value="10" name="user_rate" checked/>
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
                    <div class="row with-border-row">
                        <div class="form-group col-md-12">
                            <label>Ваш отзыв о враче</label>
                            <textarea id="text" name="text" minlength="100" required></textarea>
                            <p class="tip">Минимум 100 символов.</p>
                            <p class="characters-count">0</p>
                        </div>
                    </div>
                    <div class="row with-border-row">
                        <div class="form-group col-md-12">
                            <label>Что вам понравилось?</label>
                            <textarea id="user_likes" name="user_likes"></textarea>
                        </div>
                    </div>
                    <div class="row with-padding">
                        <div class="form-group col-md-12">
                            <label>Что не понравилось?</label>
                            <textarea id="user_doest_like" name="user_doest_like"></textarea>
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
                })
                    .done(function (json) {
                            $('#user_name').removeClass('has-warning');
                            $('#text').removeClass('has-warning');

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

    </script>
@endsection