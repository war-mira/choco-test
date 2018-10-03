@if(isset($owner))
    <div class="entity-content__leave-review leave-review">

        <!-- begin container -->

            <div class="leave-review__heading">Посещали этого врача?</div>
            <div class="leave-review__descr">Оставьте ваш отзыв — нам важно ваше мнение</div>

            <form id="comment_form" class="leave-review__form">
                {{ csrf_field() }}
                <input type="hidden" id="owner_type" value="{{$owner['type']}}">
                <input type="hidden" id="owner_id" value="{{$owner['id']}}">
                <input type="hidden" id="type" value="{{ \App\Comment::typeCommon }}">

                <div class="leave-review__input-line">
                    @if(Auth::guest())
                    <div class="leave-review__input-item">
                        <input type="text" class="styler" required id="user_name" placeholder="Имя"/>
                    </div>
                    <div class="leave-review__input-item">
                        <input type="text"
                               class="styler bfh-phone"
                               placeholder="+7 (123) 456-7890"
                               id="user_phone"
                               required
                        />
                    </div>
                    @endif
                    <div class="leave-review__textarea-item">
                        <textarea class="styler" id="comment_text" required name="text" placeholder="Отзыв о враче" rows="6"></textarea>
                    </div>
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
                            <input type="hidden" name="user_rate" value="" class="set-rating__btn_highlight">
                            <div class="set-rating__btn" data-rating="1"></div>
                            <div class="set-rating__btn" data-rating="2"></div>
                            <div class="set-rating__btn" data-rating="3"></div>
                            <div class="set-rating__btn" data-rating="4"></div>
                            <div class="set-rating__btn" data-rating="5"></div>
                        </div>
                    </div>
                    <div class="leave-review__submit">
                        <a class="btn btn_theme_usual button button--light" id="save_comment">Оставить отзыв</a>
                    </div>
                </div>
            </form>
            <div style="display:none" id="save_comment_mess_ok">
                <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
            </div>
            <div style="display:none; padding-bottom: 10px" id="code_confirm">
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

                                <button type="button" id="confirm_code" class="btn btn_theme_usual button button--light">Подтвердить номер</button>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        <!-- end container -->

    </div>

@endif


