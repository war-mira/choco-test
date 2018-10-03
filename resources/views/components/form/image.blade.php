@component('components.form.form-group',['field' => $field,'label' => $label ?? null])
    @slot('preview')
        <div class="container-fluid text-center">
            <img id="{{$field}}_img" style="max-width: 100%;max-height: 250px;" alt="" src="{{asset($value) ?? ''}}">
        </div>

    @endslot
    @slot('control')
        <label class="btn btn-block btn-primary">
            Загрузить...
            <input class="form-control-file" name="{{$field}}" style="display: none" type="file" id="{{$field}}">
        </label>
    @endslot
@endcomponent
@section('scripts')
    @parent('scripts')
    @push('component_scripts')
        <script>
        function registerFileInputHandler(id, callback) {
            document.getElementById(id).onchange = function (evt) {
                var tgt = evt.target || window.event.srcElement,
                    files = tgt.files;

                // FileReader support
                if (FileReader && files && files.length) {
                    var fr = new FileReader();
                    fr.onload = function () {
                        callback(fr.result);
                    };
                    fr.readAsDataURL(files[0]);
                }

                // Not supported
                else {
                    // fallback -- perhaps submit the input to an iframe and temporarily store
                    // them on the server until the user's session ends.
                }
            }
        }

        registerFileInputHandler('{{$field}}', function (data) {
            document.getElementById('{{$field}}_img').src = data;
        });

        </script>@endpush
@endsection
