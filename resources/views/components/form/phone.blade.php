@component('components.form.form-group',['field' => $field,'label' => $label ?? null,'errorField'=>$errorField ?? null,'errorBag'=>$errorBag ?? null])
    @slot('control')
        @if(isset($admin) && $admin)
            <div class="input-group">
                @endif
                <input class="form-control bfh-phone" name="{{$field}}" type="text"
                       @if(isset($required) && $required) required @endif
                       @if(isset($readonly) && $readonly) readonly @endif
                       @if(isset($placeholder)) placeholder="{{$placeholder}}" @endif id="{{$field}}"
                       value="{{$value ?? 7}}"
                       data-format="{{$format??"+7 (ddd) ddd-dddd"}}">
                @if(isset($admin) && $admin)
                    <span class="input-group-btn">
                    <button class="btn btn-default"
                            onclick="copyToClipboard('{{\App\Helpers\FormatHelper::jqSelectorName($field)}}')"
                            type="button"><i class="glyphicon glyphicon-floppy-disk"></i></button>
                </span>
            </div>
        @endif
        @push('component_scripts')
            <script>
                $(function () {
                    $phoneInput = $("#{{\App\Helpers\FormatHelper::jqSelectorName($field)}}");
                    $phoneInput.bfhphone($phoneInput.data());
                })

            </script>@endpush
    @endslot
@endcomponent
