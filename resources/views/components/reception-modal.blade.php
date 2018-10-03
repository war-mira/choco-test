<div id="reception" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-light">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Записаться на прием</h3>
            </div>
            <form class="form" id="reception-modal-form">
                <input type="hidden" name="ga_cid" value="">
                <input type="hidden" name="source" value="quick_site">
                <div class="modal-body">


                    <div class="form__group">
                        <label>*Имя и Фамилия</label><br>
                        <input class="styler" required name="client_name" id="client_r" type="text">
                    </div>
                    <div class="form__group">
                        <label>*Телефон</label><br>
                        <input class="styler bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="client_phone" id="phone_r"
                               title="Телефон в формате +7 (XXX) XXX XX-XX" type="text">
                    </div>
                    <div class="form__group">
                        <label>Email</label><br>
                        <input class="styler" name="client_email" id="email_r" type="text">
                    </div>
                    <div style="display:none" class="form__group">
                        <label>Специализация врача:</label><br>
                        <select class="styler" id="specialization_r" name="specialization">
                            <option disabled></option>
                            @foreach (\App\Skill::all() as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="display:none" class="form__group">
                        <label>Дата посещения:</label><br>
                        <input class="styler styler--calendar datepicker" name="date_event" id="date_event_r"
                               type="text">
                    </div>
                    <div style="display:none" class="form__group">
                        <label>Время:</label><br>
                        <label class="radio-button">
                            <input type="radio" name="time" value="10:00"><span>10:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="10:30"><span>10:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="11:00"><span>11:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="11:30"><span>11:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="12:00"><span>12:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="12:30"><span>12:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="13:00"><span>13:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="13:30"><span>13:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="14:00"><span>14:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="14:30"><span>14:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="15:00"><span>15:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="15:30"><span>15:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="16:00"><span>16:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="16:30"><span>16:30</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="17:00"><span>17:00</span>
                        </label>
                        <label class="radio-button">
                            <input type="radio" name="time" value="17:30"><span>17:30</span>
                        </label>
                    </div>
                    <div class="form__footer">

                    </div>


                </div>
                <div class="modal-footer">
                    <input type="submit" id="сallback_save_r" class="button" value="Записаться">
                </div>
            </form>
            <div id="callback_mess_ok" class="modal-body callback_mess_ok">
                <p>
                    <strong>Спасибо!</strong> Ваша заявка принята мы вам перезвоним!
                </p>
            </div>


        </div>
    </div>
</div>

<div id="modal" style="display:none;">
    <h3 class="modal__title">Спасибо!</h3>
    <div class="line"></div>
    <p id="ModalInfoText"></p>
</div>
@push('custom.js')
<script type="text/javascript">
    //сallback_save
    $('#reception .callback_mess_ok').hide();

    var $receptionModalForm = $("#reception-modal-form");
    ga(function (tracker) {
        var cid = tracker.get('clientId');
        $receptionModalForm.find('[name="ga_cid"]').val(cid).trigger('change');
    });

    function validateForm() {
        //Ga target
        ga('send', 'event', {
            eventCategory: 'bystraya_zapis',
            eventAction: 'click'
        });
        //Ya goal
        yaCounter47714344.reachGoal('fastregistration');

        if ($receptionModalForm[0].checkValidity()) {
            var formData = getFormData($receptionModalForm);
            $.getJSON("{{URL::asset('callback/new')}}", formData)
                .done(function (json) {
                    if (json.id != '') {

                        $('#callback_mess_ok').show();
                        $receptionModalForm[0].reset();
                        $receptionModalForm.hide();
                        $('#reception .callback_mess_ok').show();
                        setTimeout(function () {
                            $('#reception').modal('hide');
                        }, 1000);
                    }
                });
            return false;
        }
    }

    $("#сallback_save_r").click(validateForm);


</script>
@push('custom.js')