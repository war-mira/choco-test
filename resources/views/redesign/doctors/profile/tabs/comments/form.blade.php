<div class="side-feedback-form">
    <form id="doctor-comment-form" action="{{$doctor['links']['leave_comment']}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="doctor_id" value="{{$doctor['id']}}">
        <div class="side-feedback-form__title">
            Посещали этого врача?
        </div>
        <div class="side-feedback-form__subtitle">
            Оставьте ваш отзыв — нам важно
            ваше мнение
        </div>
        <div class="input-block--text inline-input">
            <input id="comment_author_name"
                   name="author_name"
                   type="text"
                   class="input-block__input"
                   placeholder="Имя"
                   required>
            <p class="text-danger error-text"></p>
        </div>
        <div class="input-block--text inline-input">
            <input id="comment_author_phone"
                   name="author_phone"
                   type="text"
                   class="input-block__input bfh-phone"
                   data-format="+7 (ddd) ddd-dddd"
                   autocomplete='tel'
                   pattern="\+7 \(\d{3}\) \d{3}-\d{4}"
                   placeholder="Телефон"
                   required>
            <p class="text-danger error-text"></p>
        </div>
        <div class="textarea-block">
            <label for="comment_text" class="black">Текст отзыва</label>
            <textarea id="comment_text"
                      name="text"
                      class="textarea-block__textarea"
                      cols="30"
                      rows="10"
                      placeholder="Оставьте подробный отзыв о данном враче!"></textarea>
            <p class="text-danger error-text"></p>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <label for="" class="field_label">Оценка</label>
                <fieldset class="rating" name="author_rate">
                    @foreach(\App\Comment::RATE_NAMES as $value=>$name)
                        <input type="radio" id="star{{$loop->iteration}}" name="author_rate"
                               value="{{$value}}"/>
                        <label class="full" for="star{{$loop->iteration}}" title="{{$name}}"></label>
                    @endforeach
                </fieldset>
                <p class="text-danger error-text"></p>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="form-submit-btn">Оставить отзыв</button>
            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        $(function () {
            var $doctorCommentForm = $('#doctor-comment-form');
            $doctorCommentForm.on('submit', function () {
                $doctorCommentForm.ajaxSubmit({
                    success: function (data) {

                    }, error: function (response) {
                        var errors = response.responseJSON.errors;
                        for (field in errors) {
                            $doctorCommentForm.find('[name="' + field + '"]').addClass('error').next('.error-text').text(errors[field][0]);
                        }
                    }
                });
                return false;
            })
        })
    </script>
@endpush