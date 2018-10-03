<div class="modal-window w40"
     id="extended-order-modal">
    <div class="modal-close"
         data-flag="comebacker"></div>
    {{--<div class="modal__message-overlay">--}}
    {{--<div class="message-overlay__icon">--}}
    {{--<i class="message-icon  icon--success"></i>--}}
    {{--</div>--}}
    {{--<div class="message-overlay__title">--}}
    {{--Ура! Мы получили Вашу заявку--}}
    {{--</div>--}}
    {{--<div class="message-overlay__text">--}}
    {{--Мы свяжемся с вами в течение 15 минут--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="modal__content">
        <div class="outcoming-data gray-top">
            <div class="modal__title">
                Запись на прием
            </div>

            <div class="modal__content__doctor-info">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="doctor-info__photo">
                                <img src="{{ asset($doctor['avatar']) }}"
                                     alt="">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-8">
                            <div class="doctor-info__description">
                                <div class="search-result-item__name">{{ $doctor['name'] }}</div>

                                <div class="search-result-item__speciality">{{ $doctor['skills_list'] }}</div>

                                <div class="param__item pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">Стоимость приема:</div>
                                        <div class="param__text__data p100">
                                            <span class="price-container"></span> тг.
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">
                                            Мед. центр:
                                        </div>

                                        <div class="param__text__data p100">
                                            <span class="med-container"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">
                                            Прием по адресу:
                                        </div>

                                        <div class="param__text__data p100">
                                            <span class="address-container"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-steps">
            <div class="modal-steps__inner">
                <div class="modal-steps__inner__step">
                    <div class="modal-widget-datepick-section">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="widget-datepick"
                                     data-doctor="{{ $doctor['alias'] }}">
                                    <input type="hidden"
                                           name="doc_id">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="widget-datepick-title">
                                                Выберите время приема
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="widget-datepick-header">
                                                <ul class="widget-datepick__day-select day-select">
                                                    <li class="day-option">
                                                        <input type="radio"
                                                               id="date-radio-today-modal"
                                                               name="_day"
                                                               value="{{ now()->startOfDay()->format('d.m.Y') }}">

                                                        <label for="date-radio-today-modal">Сегодня</label>
                                                    </li>

                                                    <li class="day-option">
                                                        <input type="radio"
                                                               id="date-radio-tomorrow-modal"
                                                               name="_day"
                                                               value="{{ now()->addDay()->startOfDay()->format('d.m.Y') }}">

                                                        <label for="date-radio-tomorrow-modal">Завтра</label>
                                                    </li>

                                                    <li class="day-option"
                                                        style="width: 105px;">
                                                        <div class="input-group date">
                                                            <input type="text"
                                                                   name="_day"
                                                                   class="input-datepicker"
                                                                   value="Другой день">

                                                            <label class="input-group-addon">
                                                                <i class=""><img src="{{ asset('img/icons/calendar.svg') }}"
                                                                                 alt=""></i>
                                                            </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <ul class="widget-datepick__time-select time-list"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-steps__inner__step">
                    <div class="incoming-data">
                        <div class="widget-datepick-title">
                            Заполните форму ниже
                        </div>

                        <form id="appointment-form">
                            {{ csrf_field() }}

                            <input type="hidden"
                                   name="callback_id">

                            <input type="hidden"
                                   name="doctor_alias">

                            <input type="hidden"
                                   name="med_center_id">

                            <input type="hidden"
                                   name="appointment_date">

                            <input type="hidden"
                                   name="appointment_time">

                            <div class="inlined-select inline-input--first-child">
                                <label for="doctor-skill-select"
                                       class="superscript-label">
                                    Специальность врача
                                </label>

                                <select id="doctor-skill-select"
                                        name="doctor-skill">
                                    @foreach (\App\Helpers\SelectOptions::skills() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-block--text inline-input ">
                                <label for="modal-date"
                                       class="superscript-label">
                                    Дата и время приема
                                </label>

                                <input id="modal-date"
                                       class="input-block__input date-trigger"
                                       type="text"
                                       autocomplete="off">

                                <label class="input-group-addon"
                                       for="modal-date">
                                    <i class=""><img src="{{ asset("img/icons/calendar.svg") }}"
                                                     alt=""></i>
                                </label>
                            </div>

                            <div class="input-block--text inline-input inline-input--first-child">
                                <label for="last-name-modal"
                                       class="superscript-label">
                                    Фамилия
                                </label>

                                <input id="last-name-modal"
                                       class="input-block__input"
                                       name="last_name"
                                       type="text"
                                       value=""
                                       placeholder="Иванов"
                                       required
                                       autocomplete="off">
                            </div>

                            <div class="input-block--text inline-input ">
                                <label for="first-name-modal"
                                       class="superscript-label">
                                    Имя
                                </label>

                                <input id="first-name-modal"
                                       class="input-block__input"
                                       name="first_name"
                                       type="text"
                                       value=""
                                       placeholder="Иван"
                                       required
                                       autocomplete="off">
                            </div>

                            <div class="input-block--text inline-input inline-input--first-child">
                                <label for="phone-modal"
                                       class="superscript-label">
                                    Контактный телефон
                                </label>

                                <input id="phone-modal"
                                       class="input-block__input bfh-phone"
                                       name="phone"
                                       data-format="+7 (ddd) ddd-dd-dd"
                                       pattern="\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}"
                                       title="Телефон в формате +7 (XXX) XXX XX-XX"
                                       type="text"
                                       placeholder="Телефон *"
                                       required
                                       autocomplete="off">
                            </div>

                            <div class="input-block--text inline-input">
                                <label for="email-modal"
                                       class="superscript-label">
                                    Email
                                </label>

                                <input id="email-modal"
                                       class="input-block__input"
                                       name="email"
                                       type="email"
                                       value=""
                                       placeholder="example@mail.com"
                                       autocomplete="off">
                            </div>

                            <div class="input-block--text inline-input ">
                                <label for="birthday-modal"
                                       class="superscript-label">
                                    Дата рождения
                                </label>

                                <input id="birthday-modal"
                                       class="input-block__input"
                                       name="birthday"
                                       type="text"
                                       value=""
                                       placeholder="Дата рождения"
                                       required
                                       autocomplete="off">

                                <label for="birthday-modal"
                                       class="input-group-addon">
                                    <i class=""><img src="{{ asset("img/icons/calendar.svg") }}"
                                                     alt=""></i>
                                </label>
                            </div>

                            <div class="textarea-block">
                                <label for="comment_text"
                                       class="black">Причина обращения</label>

                                <textarea id="comment_text"
                                          name="text"
                                          class="textarea-block__textarea"
                                          cols="30"
                                          rows="5"
                                          placeholder="Опишите причину обращения / симптомы"></textarea>

                                <p class="text-danger error-text"></p>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6 offset-sm-3">
                                    <button type="submit"
                                            class="form-submit-btn">Записаться на прием
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="comeback-overlay">
            <div class="comeback-overlay__title">
                Вы действительно хотите прервать запись?
            </div>

            <div class="comeback-overlay__content">
                <div class="dropdown__phone">
                    <span class="x16 p100">Если у вас возникли вопросы, звоните по телефону:</span><br>
                    <a class="phone__number black"
                       href="tel:+77272222200">+7 (727) 222-22-00</a>
                </div>
            </div>

            <div class="comeback-overlay__buttons">
                <div class="comeback-overlay__leave-btn"
                     data-id="extended-order-modal">Прервать
                </div>

                <div class="comeback-overlay__continue-btn"
                     data-id="extended-order-modal">Продолжить
                </div>
            </div>
        </div>
    </div>
</div>