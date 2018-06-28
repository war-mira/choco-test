@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('control')
        <textarea class="form-control" name="{{$field}}"
          @if(isset($maxlength) && $maxlength) maxlength="{{$maxlength}}" @endif
          @if(isset($required) && $required) required @endif
          @if(isset($rows)) rows="{{$rows}}" @endif
          @if(isset($readonly) && $readonly) readonly
          @endif id="{{$id??$field}}"
          style=" resize: vertical;height: {{$height??'auto'}}">{!! $value !!}</textarea>
    @endslot
@endcomponent