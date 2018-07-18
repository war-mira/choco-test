<div id="order_doctor" class="white-popup mfp-hide">
    <form id="callback_form">
        <div class="leave-review__heading">Запись на прием</div>
        <br/>
        <div class="leave-review__input-line">
            <input type="hidden" name="ga_cid" value="">
            @if(Auth::user())
                <input type="hidden" name="client_id" value="{{auth()->user()->id}}">
            @endif
            <div class="leave-review__input-item">
                <input class="form-control " placeholder="*Имя и Фамилия" name="client_name" id="client_name" required type="text"
                       @if(Auth::user())
                       value="{{auth()->user()->name}}"
                       readonly="readonly"
                        @endif>
            </div>
            <div class="leave-review__input-item" id="phone-group">
                <input placeholder="*Телефон" class="form-control bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                       pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="client_phone" id="client_phone"
                       type="text"
                       @if(Auth::user())
                       value="{{auth()->user()->phone}}"
                       readonly="readonly"
                        @endif>
            </div>
            <div class="leave-review__input-item">
                <input class="form-control " placeholder="Email" name="client_email" id="client_email" type="text"
                       @if(Auth::user())
                       value="{{auth()->user()->email}}"
                       readonly="readonly"
                        @endif>
            </div>

            <div class="leave-review__input-item" id="datetime-group">
                <input class="form-control datepicker" placeholder="*Время и дата приема" required="" name="client_datetime" id="client_datetime" type="text">
            </div>

            <input type="hidden" name="target_type" value="Doctor">
            <input type="hidden" name="target_id" value="">
            <input type="hidden" name="source" value="doctor_page">
            <div class="leave-review__textarea-item tcentr">
                <input class="form-control tcentr fbold" placeholder="Врач" id="doctor_name"
                       type="text"
                       value=""
                       readonly="readonly">
            </div>
            <div class="leave-review__textarea-item">
                <div id="client_comment" class="collapse">
                    <textarea class="form-control" id="client_comment_text" name="client_comment" placeholder="Напишите свои пожелания сюда..(можно оставить пустым)"></textarea>
                </div>
            </div>
            <div class="leave-review__submit">
                <button type="submit" class="btn btn_theme_usual" id="save_order">Записаться</button>
            </div>
        </div>
    </form>
</div>