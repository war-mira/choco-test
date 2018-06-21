@php
    $readonly = isset($readonly) && ($readonly == 1);
@endphp
<div class="load-blocker" id="order-client-loading">
    <div class="load-spinner"></div>
</div>
<input type="hidden" form="edit-form" name="client_id" value="{{$seed['id']??null}}">
<form id="order-client-form" method="POST" action="{{$action}}">
    {{csrf_field()}}
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-3'])
            @component('components.form.text')
                @slot('field','id')
                @slot('value',$seed['id'] ?? null)
                @slot('placeholder','Новый')
                @slot('label','Id')
                @slot('readonly',true)
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-9'])
            @component('components.form.text')
                @slot('errors',$errors)
                @slot('field','name')
                @slot('value',$seed['name'] ?? null)
                @slot('placeholder','ФИО')
                @slot('label','Имя')
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.date')
                @slot('field','birthday')
                @slot('value',isset($seed['birthday']) ? $seed['birthday']->format('Y-m-d') : null)
                @slot('placeholder','Дата рождения')
                @slot('label','Дата рождения')
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-6'])
            @component('components.form.text')
                @slot('field','email')
                @slot('value',$seed['email'] ?? null)
                @slot('placeholder','Email')
                @slot('label','Email')
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
        @component('components.bootstrap.column',['class'=>'col-md-6'])
            @component('components.form.select2.single')
                @slot('id','client_city_id')
                @slot('field','city_id')
                @slot('value',$seed['city_id'] ?? 6)
                @slot('placeholder','Город')
                @slot('label','Город')
                @slot('options',\App\City::orderBy('name')->get())
                @slot('idField','id')
                @slot('search','true')
                @slot('nameField','name')
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-12 '])
            @component('components.form.phone')
                @slot('field','phone')
                @slot('value',$seed['phone'] ?? null)
                @slot('placeholder','Телефон')
                @slot('label','Телефон')
                @slot('admin',true)
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @component('components.form.phone')
                @slot('field','phone2')
                @slot('value',$seed['phone2'] ?? null)
                @slot('placeholder','Телефон доп.')
                @slot('label','Телефон доп.')
                @slot('readonly',$readonly)
            @endcomponent
        @endcomponent
    @endcomponent
    @component('components.bootstrap.row')
        @component('components.bootstrap.column',['class'=>'col-md-12'])
            @if($readonly)
                <button type="button" class="btn btn-primary" id="edit-client-btn"
                        data-link="{{route('admin.users.form',['name'=>'admin.model.orders.client-form','id'=>$seed['id']])}}">
                    Изменить
                </button>
            @else
                <button type="button" data-link="{{$action}}" class="btn btn-primary" id="save-client-btn">Сохранить
                </button>

            @endif
        @endcomponent
    @endcomponent
    @isset($orderId)
        <input type="hidden" name="order_id" value="{{$orderId}}">
    @endisset
    <input type="hidden" name="role" value="3">
    <input type="hidden" name="force_phone" value="0">
</form>
<script>
    @foreach($errors->keys() as $field)
    $("#order-client-form *[name={{$field}}]").addClass("is-invalid");
    $("#order-client-form *[name={{$field}}]").after("<div class=\"invalid-feedback\">{{$errors->first($field)}}</div>");
    @endforeach
    document.addEventListener("DOMContentLoaded", function () {
        $('#order-client-loading').hide();
        $("#save-client-btn").click(postOrderClient);
        $("#new-client-btn").click(loadOrderClient);
        $("#edit-client-btn").click(loadOrderClient);

    });
    $('#order-client-loading').hide();
    $("#save-client-btn").click(postOrderClient);
    $("#new-client-btn").click(loadOrderClient);
    $("#edit-client-btn").click(loadOrderClient);

    function loadOrderClient() {
        $('#order-client-loading').show();
        var url = $(this).data('link');
        $("#client-form").load(url).trigger('change');
    }

    function postOrderClient() {
        $('#order-client-loading').show();
        $("#order-client-form").ajaxSubmit({
            success: function (formUpd) {
                $("#client-form").html(formUpd).trigger('change');
                $.notify({
                    // options
                    message: 'Для сохранения изменений СОХРАНИТЕ ЗАЯВКУ!'
                }, {
                    placement: {align: 'center'},
                    type: 'info',
                    allow_dismiss: false,
                    delay: 0
                });
                $('#order-client-loading').hide();
            },
            error: function (response) {
                var data = response.responseJSON;
                if (data.errors.phone) {
                    if (confirm('Дублировать номер и создать анкету пациента?')) {
                        $("input[name=force_phone]").val('1');
                        postOrderClient();
                    }

                }
                else {
                    var errors = data.errors;
                    var text = "";
                    $.each(errors, function (field, msgs) {
                        msgs.forEach(function (msg) {
                            text += msg + "\n";
                        });
                    });
                    alert(text);
                    $('#order-client-loading').hide();
                }
            }
        });
    }
</script>