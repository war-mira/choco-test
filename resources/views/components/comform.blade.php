@if(isset($owner))
    <div class="entity-content__leave-review leave-review">

        <!-- begin container -->

            <div class="leave-review__heading">Посещали этого врача?</div>
            <div class="leave-review__descr">Оставьте ваш отзыв — нам важно ваше мнение</div>

            <form id="comment_form" class="leave-review__form">
                {{ csrf_field() }}
                <input type="hidden" id="owner_type" value="{{$owner['type']}}">
                <input type="hidden" id="owner_id" value="{{$owner['id']}}">
                <div class="leave-review__input-line">
                    @if(Auth::guest())
                    <div class="leave-review__input-item">
                        <input type="text" class="styler" required id="user_name" placeholder="Имя"/>
                    </div>
                    <div class="leave-review__input-item">
                        <input type="text" class="styler bfh-phone" placeholder="Телефон" data-format="+7 (ddd) ddd-dddd" required
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}" id="user_email"/>
                    </div>
                    <div class="leave-review__textarea-item">
                        <textarea class="styler" id="comment_text" required name="text" placeholder="Отзыв о враче" rows="6"></textarea>
                    </div>
                        @else
                    @endif
                </div>
                <div class="leave-review__review-recommend review-recommend">
                    <label class="review-recommend__item">
                        <input type="radio" name="recommend" value="yes">
                        <span class="review-recommend__btn review-recommend__btn_yes">Рекомендую</span>
                    </label>
                    <label class="review-recommend__item">
                        <input type="radio" name="recommend" value="no">
                        <span class="review-recommend__btn review-recommend__btn_no">Не рекомендую</span>
                    </label>
                </div>
                <div class="leave-review__bot-line">
                    <div class="leave-review__rate">
                        <div class="leave-review__rate-text">Оценка</div>
                        <div class="leave-review__rate-stars set-rating">
                            <input type="hidden" name="rate" value="" class="set-rating__btn_highlight">
                            <div class="set-rating__btn" data-rating="1"></div>
                            <div class="set-rating__btn" data-rating="2"></div>
                            <div class="set-rating__btn" data-rating="3"></div>
                            <div class="set-rating__btn" data-rating="4"></div>
                            <div class="set-rating__btn" data-rating="5"></div>
                        </div>
                    </div>
                    <div class="leave-review__submit">
                        <button class="btn btn_theme_usual button button--light" id="save_comment">Оставить отзыв</button>
                    </div>
                </div>
            </form>
            <div style="display:none" id="save_comment_mess_ok">
                <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
            </div>
        <!-- end container -->

    </div>
    <script>


        $("#save_comment").click(function () {
            if ($("#comment_form")[0].checkValidity()) {
                $.getJSON("{{url('/comment/new')}}", {
                    owner_id: $('#owner_id').val(),
                    owner_type: $('#owner_type').val(),
                    user_email: $('#user_email').val(),
                    user_name: $('#user_name').val(),
                    text: $('#comment_text').val(),
                    user_rate: $('input[name=user_rate]:checked').val(),
                    date_event: $('#date_event').val()
                })
                    .done(function (json) {
                        $('#user_email').removeClass('has-warning');
                        $('#user_name').removeClass('has-warning');
                        $('#comment_text').removeClass('has-warning');
                        if (json.error) {
                            $('#user_email').addClass('has-warning');
                            $('#save_comment_mess_ok').html('<b>' + json.error + '</b>');
                            $('#save_comment_mess_ok').show();
                        }
                        else if (json.id) {
                            $('#save_comment_mess_ok').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                            $('#save_comment_mess_ok').show();
                            $("#comment_form")[0].reset();
                        }
                    });
            }
            else {
                $('#user_email').addClass('has-warning');
                $('#user_name').addClass('has-warning');
                $('#comment_text').addClass('has-warning');

            }
        });
    </script>
@endif