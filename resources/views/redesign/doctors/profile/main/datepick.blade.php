<div class="single-page-widget-section">
    <div class="row">
        <div class="col-sm-12">
            <div class="widget-datepick"
                 data-doctor="{{ $doctor['alias'] }}">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="widget-datepick-header">
                            <ul class="widget-datepick__day-select day-select">
                                <li class="day-option">
                                    <input type="radio"
                                           id="date-radio-today"
                                           name="day"
                                           value="{{ now()->startOfDay()->format('d.m.Y') }}">

                                    <label for="date-radio-today">Сегодня</label>
                                </li>

                                <li class="day-option">
                                    <input type="radio"
                                           id="date-radio-tomorrow"
                                           name="day"
                                           value="{{ now()->addDay()->startOfDay()->format('d.m.Y') }}">

                                    <label>Завтра</label>
                                </li>

                                <li class="day-option"
                                    style="width: 105px;">
                                    <div class="input-group date">
                                        <input type="text"
                                               name="day"
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

                        <ul class="widget-datepick__time-select time-list">
                            <div style="font-size: 18px; text-align: center;">Выберите день для записи!</div>
                        </ul>
                    </div>

                    <div class="col-sm-4">
                        <div class="widget-datepick-order-section">
                            <div class="inner"
                                 style="display: none;">
                                <div class="param__item">
                                    <div class="param__text">
                                        <div class="param__text__title">Стоимость приема:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="price-container"></span>
                                            тг.
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">Мед. центр:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="med-container"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="param__item pt10">
                                    <div class="param__text">
                                        <div class="param__text__title">Прием по адресу:</div>
                                        <div class="param__text__data proxima_bold">
                                            <span class="address-container"></span>
                                        </div>
                                    </div>
                                </div>

                                <a href="javascript:void(0)"
                                   data-role="open-order-modal"
                                   class="widget-order-section__order-btn">
                                    Записаться
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script type="text/javascript"
            src="{{ asset('refactoring/order/order.js') . '?' . rand() }}"></script>
@endpush