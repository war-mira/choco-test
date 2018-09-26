<div class="account-wrapper__top-line">
    <div class="account-wrapper__page-name">Личный кабинет</div>
    <div class="account-wrapper__rating account-top-rating">
        <div class="account-top-rating__heading">Ваш рейтинг:</div>
        <div class="account-top-rating__rating-line rating-line rating-line_blue">
            @if(isset(auth()->user()->doctor))
                <div class="rating-line__val">{{ auth()->user()->doctor->avg_rate }}</div>
                @component('cabinet.components.doctor.raiting-stars',['rating' => auth()->user()->doctor->avg_rate])
                @endcomponent
            @endif
        </div>
    </div>
</div>