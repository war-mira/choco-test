<div class="entity-line__img">
    <div class="entity-thumb-img">
        <div class="entity-thumb-img__img-wr">
            @component('components.medcenters-img',['width'=>$width??'200px','height'=>$height??'200px','class_min'=>$medcenter->checkImageheight()??'0', 'alt'=>$medcenter->name])
                @slot('src')
                    {{$medcenter->avatar}}
                @endslot
            @endcomponent
        </div>
        <div class="entity-thumb-img__rating-line rating-line">
            <div class="rating-line__val">{{$medcenter['rate']}}</div>
            @component('components.rstars',['rating' => $medcenter['rate'] == 0 ? 0:$medcenter['rate']])
            @endcomponent
        </div>
    </div>
</div>
<div class="entity-line__main">
    <div class="h3 profiles__title">
        <div class="entity-line__name">
         <a href="{{ route('medcenter.item',['medcenter'=>$medcenter->alias, 'city' => $medcenter->city->alias]) }}">{{$medcenter->name}}</a>
        </div>

    </div>
    <div class="entity-line__about-text">
        <p>
            Медицинский центр "Савинова" успешно работает уже на протяжении 12 лет.
            В самом начале он стартовал в качестве медицинского центра, предоставляющего обширный перечень разнообразных услуг.
            Сегодня это уже крупное медицинское учреждение с главным центром в Алматы. В клинике работают высококвалифицированные специалисты, которые готовы оказать качественную медицинскую помощь каждому пациенту.
        </p>
    </div>
    <div class="clinic-line__brief">
        <div class="clinic-line__brief-line">
            <div class="clinic-line__brief-item">
                <div class="clinic-line__brief-name">Адрес: </div>
                <div class="profiles__desc clinic-line__brief-descr">
                    <a class="link-dotted" href="#">Алматы</a>, ул. Макатаева, 47 (уг. Нусупбекова)
                </div>
            </div>
        </div>
    </div>
</div>
<div class="entity-line__additional">
    <div class="service-price__heading">
        Стоимость услуги:
        <p>3500 тг</p>
        <p class="service-booking-btn">
            <a href="#order_med" data-doc-id="" data-dname="" data-status="6" class="appointment-book-big__book-btn btn btn_theme_usual trigger-link popup-with-form">
                Записаться<span class="hidden-xl"> онлайн</span>
            </a>
        </p>
    </div>
</div>