<div class="account-wrapper__top-line">
    <div class="account-wrapper__page-name">Личный кабинет</div>
    <div class="account-wrapper__rating account-top-rating">
        <div class="account-top-rating__heading">Ваш рейтинг:</div>
        <div class="account-top-rating__rating-line rating-line rating-line_blue">
            <div class="rating-line__val">{{ isset(auth()->user()->doctor) ?? auth()->user()->doctor->avg_rate }}</div>
            @component('cabinet.components.doctor.raiting-stars',['rating' => isset(auth()->user()->doctor) ?? auth()->user()->doctor->avg_rate])
            @endcomponent
        </div>
    </div>
</div>