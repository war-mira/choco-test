<div class="reviews-list-item__line">
    <div class="reviews-list-item__data-wr">
        <div class="reviews-list-item__data">
            <div class="reviews-list-item__data-item account-data-item">
                <div class="account-data-item__name">Текст ответа</div>
                <div class="account-data-item__val">{!! $answerExceptDoctor->text !!}</div>
            </div>
        </div>
    </div>
</div>
<div class="reviews-list-item__line">
    <div class="reviews-list-item__data-wr">
        <div class="reviews-list-item__data">
            <div class="reviews-list-item__data-item account-data-item">
                <div class="account-data-item__name">Дата ответа</div>
                <div class="account-data-item__val">{{ \App\Helpers\FormatHelper::userShothDate($answerExceptDoctor->created_at) }}</div>
            </div>
            <div class="reviews-list-item__data-item account-data-item">
                <div class="account-data-item__name">Доктор</div>
                <div class="account-data-item__val">{{ $answerExceptDoctor->doctor->firstname }} {{ $answerExceptDoctor->doctor->lastname }} {{ $answerExceptDoctor->doctor->middlename }}</div>
            </div>
        </div>
    </div>
</div>