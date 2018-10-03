@extends('admin.form')
@section('form')
    <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-2'])
                @component('components.form.text')
                    @slot('field','id')
                    @slot('value',$seed['id'] ?? null)
                    @slot('placeholder','Новый')
                    @slot('label','Id')
                    @slot('readonly',true)
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.datetime')
                    @slot('field','begin')
                    @slot('value',$seed['begin'] ?? null)
                    @slot('placeholder','С')
                    @slot('label','С')
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-3'])
                @component('components.form.datetime')
                    @slot('field','end')
                    @slot('value',$seed['end'] ?? null)
                    @slot('placeholder','По')
                    @slot('label','По')
                @endcomponent
            @endcomponent
            <div class="col-md-2" style="margin-top: 30px">
                @component('components.form.checkbox')
                    @slot('field','one_time')
                    @slot('value',$seed['one_time'] ?? false)
                    @slot('label','Один раз')
                @endcomponent
            </div>
            <div class="col-md-2" style="margin-top: 30px">
                @component('components.form.checkbox')
                    @slot('field','is_active')
                    @slot('value',$seed['is_active'] ?? false)
                    @slot('label','Активно')
                @endcomponent
            </div>
        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-4'])
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                        @component('components.form.text')
                            @slot('field','name')
                            @slot('value',$seed['name'] ?? null)
                            @slot('placeholder','Название')
                            @slot('label','Название')
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                        @component('components.form.select2.single')
                            @slot('field','page_filter')
                            @slot('id','page-filter-select')
                            @slot('value',$seed['page_filter'] ?? 0)
                            @slot('label','Показывать на страницах')
                            @slot('options',[0=>'Всех',-1=>'Кроме',1=>'Только'])
                            @slot('required',true)
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                        @component('components.form.textarea')
                            @slot('id','filter-pages-textarea')
                            @slot('field','raw_filter_pages')
                            @slot('height','357px')
                            @slot('value',$seed['raw_filter_pages'] ?? null)
                            @slot('placeholder','Список страниц')
                            @slot('readonly',$seed['page_filter'] == 0)
                        @endcomponent
                    @endcomponent
                @endcomponent
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-8'])
                @component('components.bootstrap.row')
                    @component('components.bootstrap.column',['class'=>'col-md-12'])
                        @component('components.form.textarea')
                            @slot('field','content')
                            @slot('height','473px')
                            @slot('value',$seed['content'] ?? null)
                            @slot('placeholder','Контент')
                            @slot('label','Контент')
                        @endcomponent
                    @endcomponent
                @endcomponent

            @endcomponent

        @endcomponent
        @component('components.bootstrap.row')
            @component('components.bootstrap.column',['class'=>'col-md-6'])
                <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
            @endcomponent
            @component('components.bootstrap.column',['class'=>'col-md-6'])
                <button id="previewNotification" type="button" class="btn btn-default btn-block">Предпросмотр</button>
            @endcomponent
        @endcomponent
    </form>
    <div id="previewContainer"></div>
    <script>

        $("#page-filter-select").on('change', function () {
            var value = $(this).val();
            var disable = (value == null || value == 0);
            $('#filter-pages-textarea').prop('readonly', disable);
        });

        $("#previewNotification").click(function () {
            $.post('{{route('admin.page_notifications.preview')}}', {
                content: $('#content').val(),
                _token: '{{csrf_token()}}'
            }, function (data) {
                $('#previewContainer').html(data);
            });

        });
    </script>
@endsection