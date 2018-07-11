<div class="modal-window" id="quick-order-modal">
    <div class="modal-close"></div>
    <div class="modal__content">
        <div class="modal__title">
            Запись на прием
        </div>

        <form action="#" id="reception-modal-form">
            <input type="hidden" name="ga_cid" value="">
            <input type="hidden" name="source" value="quick_site">
            <div class="input-block--text">
                <input class="input-block__input" name="client_name" type="text" value="" placeholder="ФИО *" required>
            </div>
            <div class="input-block--text inline-input">
                <input class="input-block__input" name="client_phone" type="text" value="" placeholder="Телефон *"
                       required>
            </div>
            <div class="input-block--text inline-input">
                <input class="input-block__input" name="client_email" type="email" value="" placeholder="Email">
            </div>
            <div class="text-center">
                <button type="button" class="form-submit-btn btn btn_theme_usual" id="сallback_save_button">Записаться на прием</button>
            </div>
        </form>
        <div id="callback_mess_ok" class="modal-body">
            <p>
                <strong>Спасибо!</strong> Ваша заявка принята мы вам перезвоним!
            </p>
        </div>
    </div>
</div>

<script type="text/javascript">
    //сallback_save
    $('#callback_mess_ok').hide();

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

            $.getJSON("{{url('/callback/new')}}", formData)
                .done(function (json) {

                    if (json.id != '') {

                        $('#callback_mess_ok').show();
                        $receptionModalForm[0].reset();
                        $receptionModalForm.hide();
                        setTimeout(function () {
                            $('#quick-order-modal').modal('hide');
                        }, 1000);
                    }
                });
            return false;
        }
    }

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }


    $("#сallback_save_button").click(validateForm);
</script>