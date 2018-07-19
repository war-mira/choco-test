<div class="account-content__body">
    <div class="account-content__body-heading">
        <i class="fa fa-level-up" aria-hidden="true"></i>
        <span>Мой ответ на вопрос</span>
    </div>
    <div class="leave-account-review">
        <form method="post">
            {{ csrf_field() }}
            <div class="leave-account-review__line">
                <div class="leave-account-review__input">
                    <div class="account-data-item">
                        <div class="account-data-item__name">Напишите ваш ответ</div>
                        <div class="account-data-item__val">
                            <textarea name="text">@if(old('text')){{ old('text') }}@elseif(isset($answer)){!! $answer->text  !!}@endif</textarea>
                            @if ($errors->has('text'))<p class="error"> Поле обязательно для заполнения </p>@endif
                        </div>
                    </div>
                </div>
                <div class="leave-account-review__aside">
                    <button class="btn btn_theme_usual">Отправить ответ</button>
                </div>
            </div>
        </form>
    </div>
</div>