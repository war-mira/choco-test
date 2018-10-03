<div id="feedback_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content modal-light">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Обратная связь</h3>
            </div>
            <div class="modal-body">
                <form class="form" id="feedback-modal-form" action="{{route('feedback.create')}}" method="POST">
                    {{csrf_field()}}
                    <div class="modal-body">


                        <div class="form__group">
                            <label>*Имя и Фамилия:</label><br>
                            <input class="styler" required name="name" id="feedback_name" type="text"
                                   value="{{auth()->user()->name ?? ''}}">
                        </div>
                        <div class="form__group">
                            <label>*Телефон:</label><br>
                            <input class="styler bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                                   pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="phone" id="feedback_phone"
                                   title="Телефон в формате +7 (XXX) XXX XX-XX" type="text"
                                   value="{{auth()->user()->phone ?? ''}}">
                        </div>
                        <div class="form__group">
                            <label>*E-mail:</label><br>
                            <input class="styler" required name="email" id="feedback_email" type="text"
                                   value="{{auth()->user()->email ?? ''}}">
                        </div>
                        <div class="form-group">
                            <label>Причина обращения(30-500 символов):</label>
                            <textarea class="form-control" name="text" minlength="30" maxlength="500"
                                      style="resize: vertical; height: 200px"></textarea>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" id="feedback_send_btn" class="button" value="Записаться">
                    </div>
                </form>
                <div id="feedback_success" class="modal-body" style="display: none">
                    <p>
                        <strong>Спасибо за обращение!</strong> В ближайшее время мы постараемся решить ваш вопрос.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#feedback-modal-form').on('submit', function (e) {
        e.preventDefault(); // prevent native submit
        $(this).ajaxSubmit({
            success: function (data) {
                $('#feedback-modal-form').hide();
                $('#feedback_success').show();
                setTimeout(function () {
                    $('#feedback_modal').modal('hide');
                }, 1000);
            },
            error: function (error) {
                alert('Ошибка!');
            }
        });
    });
</script>