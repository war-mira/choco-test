@extends('admin.app')
@section('content')

    @php
        $positions = [
          \App\Banner::POSITION_MAIN_A,
          \App\Banner::POSITION_MAIN_B,
          \App\Banner::POSITION_EXT_A,
          \App\Banner::POSITION_EXT_B,
          \App\Banner::POSITION_EXT_C
        ];
         $bannerId = Request::query('banner_id',false);
         $selectedPosition = $bannerId?$banners->find($bannerId)->position:0;
    @endphp

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Баннера</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs nav-justified">
                @foreach($positions as $position)
                    <li class="@if($position['id'] == $selectedPosition) active @endif"><a data-toggle="tab"
                                                                                           href="#position{{$position['id']}}">{{$position['name']}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($positions as $position)
                    <div id="position{{$position['id']}}"
                         class="tab-pane  @if($position['id'] == $selectedPosition) active @else fade @endif ">
                        <h3>{{$position['name']}}</h3>
                        <ul class="list-group">
                            @foreach($banners->where('position','=',$position['id']) as $banner)
                                <li id="banner-container{{$banner->id}}" class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-5" style="width: 39%">
                                            <img id="image_desktop{{$banner->id}}"
                                                 class="img-rounded img-responsive center-block"
                                                 src="{{URL::asset($banner->image_file_desktop)}}" alt=""/>

                                        </div>
                                        <div class="col-md-5" style="width: 39%">
                                            <img id="image_mobile{{$banner->id}}"
                                                 class="img-rounded img-responsive center-block"
                                                 src="{{URL::asset($banner->image_file_mobile)}}" alt=""/>

                                        </div>
                                        <div class="col-md-2" style="width:22%;">
                                            <div class="btn-toolbar col-md-12">
                                                <div class="btn-group-vertical center-block">
                                                    <input id="href{{$banner->id}}" type="text" class="btn btn-default"
                                                           value="{{$banner->href}}"/>

                                                    <input id="datetime{{$banner->id}}" type="date"
                                                           class="btn btn-default form-control"
                                                           value="{{$banner->date_to}}"/>

                                                    <button type="button" class="btn btn-primary"
                                                            onclick="$('#banner_desktop{{$banner->id}}').trigger('click');">
                                                        Картинка Б
                                                    </button>
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="$('#banner_mobile{{$banner->id}}').trigger('click');">
                                                        Картинка М
                                                    </button>
                                                </div>
                                                <div class="btn-group center-block">
                                                    <button id="delete-btn{{$banner->id}}" type="button"
                                                            class="btn btn-danger"
                                                            onclick="deleteBanner({{$banner->id}})">
                                                        Удалить
                                                    </button>
                                                    <button id="save-btn{{$banner->id}}" type="button"
                                                            class="btn btn-default"
                                                            onclick="updateBanner({{$banner->id}})">
                                                        Сохранить
                                                    </button>
                                                </div>
                                            </div>

                                            <input id="banner_desktop{{$banner->id}}" type="file" style="display: none;"
                                                   onchange="loadImage(this,{{ ($banner->id) }},'desktop');"/>
                                            <input id="banner_mobile{{$banner->id}}" type="file" style="display: none;"
                                                   onchange="loadImage(this,{{ ($banner->id) }},'mobile');"/>

                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="list-group-item">
                                <div class="btn btn-block btn-primary" onclick="addBanner({!! $position['id']!!});">
                                    Добавить
                                </div>
                            </li>
                        </ul>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function loadImage(fileInput, id, type) {
            var files = fileInput.files;
            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function () {
                    $("#image_" + type + id).attr('src', fr.result);
                };
                fr.readAsDataURL(files[0]);
            }
            else {
                //Fail
            }
        }


        function updateBanner(id) {

            var form = new FormData();

            var href = $('#href' + id).val();
            form.append('href', href);

            var dateTo = $('#datetime' + id).val();
            form.append('date_to', dateTo);

            var files_d = $('#banner_desktop' + id).prop('files');
            if (files_d.length > 0) {
                var photo = files_d[0];
                form.append("image_desktop", photo);
            }

            var files_m = $('#banner_mobile' + id).prop('files');
            if (files_m.length > 0) {
                var photo = files_m[0];
                form.append("image_mobile", photo);
            }

            $('#save-btn' + id).html('Сохранение');
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/banner/update/" + id, true);
            xhr.onload = function () {
                if (this.status === 200) {
                    successUpdate(id);
                }
                else {
                    errorUpdate(id);
                }
            };
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
            xhr.send(form);
        }

        function addBanner(positionId) {
            var xhr = new XMLHttpRequest();

            xhr.open("POST", "/banner/create", true);
            xhr.responseType = 'json';
            xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
            xhr.onload = function () {
                if (this.status === 200) {
                    var id = this.response.id;
                    var newurl = "{{url('/banners/list')}}?banner_id=" + id + '#banner-container' + id;

                    window.location.replace(newurl);
                }
                else {

                }
            };
            var data = {position: positionId};
            xhr.send(JSON.stringify(data));
        }

        function successUpdate(id) {
            var btn = $('#save-btn' + id);
            btn.removeClass('btn-default');
            btn.addClass('btn-success');
            btn.html('Успех!');
            setTimeout(function () {
                btn.removeClass('btn-success');
                btn.addClass('btn-default');
                btn.html('Сохранить');
            }, 2000);
        }

        function errorUpdate(id) {
            var btn = $('#save-btn' + id);
            btn.removeClass('btn-default');
            btn.addClass('btn-danger');
            btn.html('Ошибка!');
        }


        function deleteBanner(id) {
            if (confirm('Удалить баннер?')) {
                $('#delete-btn' + id).html('Удаление');
                var xhr = new XMLHttpRequest();
                xhr.open("DELETE", "/banner/delete/" + id, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{csrf_token()}}');
                xhr.onload = function () {
                    if (this.status === 200) {
                        $('#banner-container' + id).remove();
                    }
                    else {
                        $('#delete-btn' + id).html('Ошибка');
                    }
                };
                xhr.send();
            }
        }
    </script>
@endsection
