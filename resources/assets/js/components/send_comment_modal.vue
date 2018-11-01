<template>
    <div>
        <slot name="modal">
            <div id="comment__modal" class="white-popup mfp-hide">
        <div class="modal__content">
            <div class="modal__title">
                Оставьте ваш отзыв
            </div>
            <form class="comment_form leave-review__form">

                <div class="leave-review__input-line">
                        <div class="leave-review__input-item">
                            <input type="text" required class="styler user_name" placeholder="Имя"/>
                        </div>
                        <div class="leave-review__input-item">
                            <input type="text"
                                   placeholder="+7 (123) 456-7890"
                                   class="user_phone styler bfh-phone"
                                   required
                            />
                        </div>

                    <div class="leave-review__textarea-item">
                    <textarea class="comment_text styler" required name="text" placeholder="Отзыв о враче"
                              rows="6"></textarea>
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
                            <input type="text" name="user_rate" value="" class="set-rating__btn_highlight hidden-input"
                                   required>
                            <div class="set-rating__btn" data-rating="1"></div>
                            <div class="set-rating__btn" data-rating="2"></div>
                            <div class="set-rating__btn" data-rating="3"></div>
                            <div class="set-rating__btn" data-rating="4"></div>
                            <div class="set-rating__btn" data-rating="5"></div>
                        </div>
                    </div>
                    <div class="leave-review__submit">
                        <a class="btn btn_theme_usual button button--light save_comment">Оставить отзыв</a>
                    </div>
                </div>
            </form>
            <div style="display:none" class="save_comment_mess_ok">
                <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
            </div>
            <div style="display:none; padding-bottom: 10px" class="code_confirm">
                    <div class="row with-padding ">
                        <div class="form-group col-md-12 center">

                            <div class="text-center">
                                <div>
                                    <div style="font-size: 25px">Код из СМС</div>
                                    <input class="phone_code"
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

                                <button type="button"
                                        class="btn btn_theme_usual button button--light confirm_code">
                                    Подтвердить номер
                                </button>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
        </slot>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                message: '',
                errors: [],
                owner_type: '',
                owner_id: '',
                type: ''
            }
        },
        watch: {
            user_phone: function (newval, oldval) {
                console.log(newval);
                this.user_phone = val;
            }
        },
        methods: {
            send: function () {
                this.$http[this.method](
                    this.href, {params: {data: this.user_phone}}
                )
                    .then(
                        (response) => {
                            console.log(response.data);
                            this.message = (response.data);
                            this.isActive = true;
                        },
                        (error) => {
                        }
                    );
            }
        },
        props: {
            props:['user', 'type', 'ownerType', 'ownerId'],
            method: {
                type: String,
                default: 'get'
            },
            // data:{
            //     type:String,
            //     default:this.$refs.myTestField.value
            // }

        }


    }
</script>

<style scoped>

</style>