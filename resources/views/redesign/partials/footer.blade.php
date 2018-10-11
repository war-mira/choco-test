<footer class="main-footer">
    <div class="container">
        <div class="main-footer__line">
            <div class="main-footer__column"><a href="#" class="footer-logo"><img src="/img/footer-logo.png" alt=""></a></div>
            <div class="main-footer__column main-footer__footer-nav footer-nav">
                <div class="footer-nav__column footer-nav-column accordion accordion_mobile">
                    <div class="footer-nav-column__heading accordion__title"><span>Сервис</span><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    <div class="footer-nav-column__items accordion__body">
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">О нас</a>--}}
                        {{--</div>--}}
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">О рейтинге</a>--}}
                        {{--</div>--}}
                        <div class="footer-nav-column__item">
                            <a href="{{ route('library.index') }}">Медицинская библиотека</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{ route('question.list') }}">Вопросы и ответы</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{ route('illnesses.index') }}">Справочник заболеваний</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{route('posts')}}">Блог</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{route('agreement')}}">Правовая информация</a>
                        </div>
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Партнерам</a>--}}
                        {{--</div>--}}
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Правила сервиса</a>--}}
                        {{--</div>--}}
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Политика конфиденциальности</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="footer-nav__column footer-nav-column accordion accordion_mobile">
                    <div class="footer-nav-column__heading accordion__title"><span>Пациенту</span><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                    <div class="footer-nav-column__items accordion__body">
                        <div class="footer-nav-column__item">
                            <a href="{{route('doctors.list')}}">Врачи</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{route('medcenters.list')}}">Клиники</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="{{route('service.index')}}">Услуги</a>
                        </div>
                        <div class="footer-nav-column__item">
                            <a href="/#doc-letter-search__result">Специализации</a>
                        </div>
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Акции</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
                <div class="footer-nav__column footer-nav-column accordion accordion_mobile">
                    {{--<div class="footer-nav-column__heading accordion__title"><span>Врачу</span><i class="fa fa-chevron-down" aria-hidden="true"></i></div>--}}
                    {{--<div class="footer-nav-column__items accordion__body">--}}
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Регистрация</a>--}}
                        {{--</div>--}}
                        {{--<div class="footer-nav-column__item">--}}
                            {{--<a href="#">Сотрудничество</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="main-footer__column">
                <div class="footer-contacts">
                    <div class="footer-contacts__heading">Ищете врача? Мы поможем!</div>
                    <a href="tel:+77272222200" class="footer-contacts__phone">+7 (727) 222-22-00</a>
                    <div class="footer-contacts__social-btns">
                        <a href="https://www.instagram.com/idoctor_kz/" class="footer-contacts__social-btn social-btn" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="https://vk.com/idoctorkz1" class="footer-contacts__social-btn social-btn" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                        <a href="https://www.facebook.com/kz.idoctor" class="footer-contacts__social-btn social-btn" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </div>
                    <div class="footer-contacts__appointment">
                        <a href="#quick-order-modal" rel="modal-link" class="btn">Записаться на прием</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-footer__footer-text">iDoctor — сервис по поиску врачей по всему Казахстану. Вызов врача на дом, онлайн-консультация, бесплатная запись на прием.</div>
        <div class="main-footer__footer-copyright">2013 - {{ date('Y') }} &copy; iDoctor.kz</div>
    </div>
    <div class="make_order_fixed">
        <div class="footer-contacts__appointment">
            <a href="#quick-order-modal" rel="modal-link" class="btn">Записаться на прием</a>
        </div>
    </div>
</footer>