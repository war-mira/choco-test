<div class="row">
    <div class="col-sm-8">
        <div class="doctor-services">
            @foreach($doctor['offers'] as $offerCategory)
                <div class="services-category">
                    <div class="services-category__title">
                        {{$offerCategory['name']}}
                    </div>
                    <div class="services-category__content">
                        <ul class="services-list">
                            @foreach($offerCategory['offers'] as $offer)
                                <li class="service">
                                    <div class="service__name">{{$offer['service']['name']}}</div>
                                    <div class="service__order">
                                        <span class="service_price">{{$offer['price']}} тг.</span>
                                        <a rel="modal-link" href="#service-modal" data-offer="{{$offer['id']}}"
                                           class="service__order-btn">Записаться</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /Tab content block -->
    <div class="col-sm-4">
        <aside class="side-content">
            <div class="adv-banner">
                <img src="{{asset('img/promotion/banner.jpg')}}" alt="">
            </div>
        </aside>
    </div>
</div>