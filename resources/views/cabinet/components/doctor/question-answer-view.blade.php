<div class="account-content__body">
    <div class="account-content__body-heading">
        <div class="account-content__page-name">Мои ответы</div>
    </div>
    <div class="leave-account-review">
            <div class="leave-account-review__line">
                <div class="leave-account-review__input">
                    <div class="account-data-item">
                        <div class="account-data-item__name">Напишите ваш ответ</div>
                        <div class="account-data-item__val">{!! \App\QuestionAnswer::ByDoctorQuestion($doctor, $question)->first()->text !!}
                        </div>
                    </div>
                </div>
                <div class="leave-account-review__aside">
                    <a href="{{ route('cabinet.doctor.questions.edit', \App\QuestionAnswer::ByDoctorQuestion($doctor, $question)->first()->id ) }}" class="btn btn_theme_usual">Редактировать</a>
                </div>
            </div>
    </div>
</div>