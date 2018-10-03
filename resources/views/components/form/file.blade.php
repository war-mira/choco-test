@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <label class="btn btn-block btn-primary">
            Загрузить...<input class="form-control-file" style="display: none" name="{{$field}}" type="file"
                               id="{{$field}}">
        </label>
    @endslot
@endcomponent