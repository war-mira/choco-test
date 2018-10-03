<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap -->
    <link href="{{URL::asset('admin/css/styles.css')}}" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <link rel="stylesheet" href="{{URL::asset('css/jquery-ui.css')}}">

    <style>
        .update {
            color: #333;

        }

        .remove {
            color: red;
        }

        .alert {
            padding: 0 14px;
            margin-bottom: 0;
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-table/bootstrap-table.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/multi-select.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.js"></script>
    <script src="{{asset('vendor/bootstrap-table/bootstrap-table.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
    <script src="{{URL::asset('js/jquery-ui.js')}}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{asset('assets/bootstrap-table/dist/extensions/select2-filter/bootstrap-table-select2-filter.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
    <script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}">
    <script src="{{asset('js/bootstrap-formhelpers.min.js')}}"></script>
    <script src="{{URL::asset('js/timepicker/jquery-ui-timepicker-addon.js')}}"></script>
    <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script>
        function copyToClipboard(id) {
            var elt = $("#" + id)[0];
            var plainNum = $(elt).val().match(/\d/g).slice(1).join('');
            var oldFormat = $(elt).data('format');

            $(elt).val("8" + plainNum);
            $(elt).select();
            document.execCommand("copy");
            $(elt).val("+7" + plainNum);
            $(elt).bfhphone({format: oldFormat}).trigger('keyup');

        }
    </script>
    <title>iDoctor</title>
</head>

<body>
@component('components.bootstrap.row')
    @component('components.bootstrap.column',['class'=>'col-sm-12'])
        <div class="panel panel-default">
            <div class="panel-body">
                <form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="client[role]" value="3">
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-xs-7'])
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-9">
                                            <label class="control-label" for="clientSearchInput">Поиск
                                                пациентов:</label><input
                                                    type="text"
                                                    id="clientSearchInput"
                                                    onkeyup="searchUsers()"
                                                    class="form-control"
                                                    placeholder="Search for users..">
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-primary btn-block"
                                                    onclick="fillNewClient()">Новый
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="height: 300px; overflow-y: scroll; padding: 10px">
                                    <div class="panel-group" id="clientSearchList">

                                    </div>
                                </div>
                            </div>
                            <script>
                                $(function () {
                                    var search = document.getElementById('clientSearchInput');
                                    search.value = '{{$seed['client_info']['phone']}}';
                                    searchUsers();
                                });

                                $("#demo").on("hide.bs.collapse", function () {
                                    $(".btn").html('<span class="glyphicon glyphicon-collapse-down"></span> Open');
                                });
                                $("#demo").on("show.bs.collapse", function () {
                                    $(".btn").html('<span class="glyphicon glyphicon-collapse-up"></span> Close');
                                });

                                function searchUsers() {
                                    var search = document.getElementById('clientSearchInput');
                                    var list = document.getElementById('clientSearchList');
                                    var minSearchLength = 4;
                                    var searchLengthDiff = minSearchLength - search.value.length;
                                    if (searchLengthDiff > 0) {
                                        list.innerHTML = 'Введите еще ' + searchLengthDiff + ' символов...';
                                        return;
                                    }
                                    var data = {
                                        search: search.value,
                                        columns: {!! json_encode(['name','email','phone']) !!}
                                    };
                                    $.getJSON("{{route('api.users.search')}}", data, function (response) {
                                        var users = response.users;
                                        list.innerHTML = '';
                                        users.forEach(function (user) {
                                            $(list).append($('<div class="panel panel-default">\n' +
                                                '                            <div class="panel-heading">\n' +
                                                '                                    <div class="row" style="font-size: 16px">' +
                                                '<div class="col-xs-10"> \n' +
                                                '                                <a data-toggle="collapse" href="#user_details' + user.id + '">' +
                                                '<div class="row"> \n' +
                                                '<div class="col-xs-2">' + user.id + '</div>' +
                                                '        <div class="col-xs-4" >' + user.name + '</div>\n' +
                                                '        <div  class="col-xs-4 small">' + user.phone + '</div>\n' +
                                                '                              <div class="col-xs-2"><i class="glyphicon glyphicon-chevron-down"></i></span></div>   \n' +
                                                '                                </a>' +
                                                '</div>  ' +
                                                '</div>' +
                                                '<div class="col-xs-2">' +
                                                '<button type="button" class="btn btn-sm btn-primary pull-right" id="callbackUserBtn' + user.id + '"><i class="glyphicon glyphicon-plus"></i></button> \n' +
                                                '                              </div>      </div>\n' +
                                                '                            </div>\n' +
                                                '                            <div id="user_details' + user.id + '" class="panel-collapse collapse">\n' +
                                                '                                <div class="panel-body">\n' +
                                                '                                    <dl>\n' +
                                                '    <dt>Дата рождения:</dt>\n' +
                                                '    <dd>' + user.birthday_f + '</dd>' +
                                                '</dl>\n' +
                                                '                                </div>\n' +
                                                '                            </div>\n' +
                                                '                        </div>'));
                                            $('#callbackUserBtn' + user.id).click((function (user) {

                                                return function () {
                                                    fillUserFields(user);
                                                }
                                            })(user))

                                        })
                                    })
                                }

                                function fillUserFields(user) {
                                    $('#{{\App\Helpers\FormatHelper::jqSelectorName('client_id')}}').val(user.id);
                                    $('#{{\App\Helpers\FormatHelper::jqSelectorName('client[name]')}}').val(user.name);
                                    $('#{{\App\Helpers\FormatHelper::jqSelectorName('client[birthday]')}}').val(user.birthday_f);
                                    $("#{{\App\Helpers\FormatHelper::jqSelectorName('client[phone]')}}").val(user.phone);
                                }

                                function fillNewClient() {
                                    $('#{{\App\Helpers\FormatHelper::jqSelectorName('client_id')}}').val('new');
                                }
                            </script>
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-5'])
                            @component('components.bootstrap.column',['class'=>'col-xs-4'])
                                @component('components.form.text')
                                    @slot('field','client_id')
                                    @slot('value',$seed['client_id'] ?? null)
                                    @slot('label','Id')
                                    @slot('readonly',true)
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-xs-8'])
                                @component('components.form.phone')
                                    @slot('field','client[phone]')
                                    @slot('value',$seed['client_info']['phone'] ?? null)
                                    @slot('label','Телефон')
                                    @slot('required',true)
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-xs-12'])
                                @component('components.form.text')
                                    @slot('field','client[name]')
                                    @slot('value',$seed['client_info']['name'] ?? null)
                                    @slot('label','Имя')
                                    @slot('required',true)
                                @endcomponent
                            @endcomponent
                            @component('components.bootstrap.column',['class'=>'col-xs-12'])
                                @component('components.form.date')
                                    @slot('field','client[birthday]')
                                    @slot('value',$seed['client_info']['birthday'] ?? '01-01-1890')
                                    @slot('placeholder','Дата рождения')
                                    @slot('label','Дата рождения')
                                    @slot('required',true)
                                @endcomponent
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-xs-3'])
                            @component('components.form.select2.single')
                                @slot('field','operator_id')
                                @slot('value',$seed['operator_info']['id'] ?? 120)
                                @slot('options',\App\User::getOperators())
                                @slot('idField','id')
                                @slot('nameField','name')
                                @slot('placeholder','Оператор')
                                @slot('label','Оператор')
                                @slot('required',true)
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-3'])
                            @component('components.form.nested-select')
                                @slot('field','status')
                                @slot('options', \App\Order::STATUS)
                                @slot('value',$seed['status'] ?? 15)
                                @slot('label','Статус')
                                @slot('required',true)
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-6'])
                            @component('components.form.select2.single')
                                @slot('field','city_id')
                                @slot('value',$seed['city_id'] ?? 6)
                                @slot('search',true)
                                @slot('placeholder','Из города')
                                @slot('label','Из города')
                                @slot('options',\App\City::orderBy('name')->get())
                                @slot('idField','id')
                                @slot('nameField','name')
                                @slot('required',true)
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-xs-12'])
                            @component('admin.model.orders.form.doc-med-select',$data['select2'] )
                                @slot('doctor',$seed['doc_id'] ?? null)
                                @slot('medcenter',$seed['med_id'] ?? null)
                            @endcomponent
                        @endcomponent
                    @endcomponent
                    @component('components.bootstrap.row')
                        @component('components.bootstrap.column',['class'=>'col-xs-6'])
                            @component('components.form.datetime')
                                @slot('field','event_date')
                                @slot('value',$seed['event_date'] ?? \Carbon\Carbon::parse('today noon'))
                                @slot('placeholder','Дата приема')
                                @slot('label','Дата приема')
                                @slot('datetimepicker',true)
                                @slot('required',true)
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-6'])
                            @component('components.form.datetime')
                                @slot('field','event2_date')
                                @slot('value',$seed['event2_date'] ?? \Carbon\Carbon::parse('today noon'))
                                @slot('placeholder','Дата приема2')
                                @slot('label','Дата приема2')
                                @slot('datetimepicker',true)
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-6'])
                            @component('components.form.textarea')
                                @slot('field','problem')
                                @slot('value',$seed['problem'] ?? null)
                                @slot('placeholder','Проблема')
                                @slot('label','Проблема')
                            @endcomponent
                        @endcomponent
                        @component('components.bootstrap.column',['class'=>'col-xs-6'])
                            @component('components.form.textarea')
                                @slot('field','action')
                                @slot('value',$seed['action'] ?? null)
                                @slot('placeholder','Действие')
                                @slot('label','Действие')
                            @endcomponent
                        @endcomponent
                        <input type="hidden" name="from_internet" value="{{$seed['from_internet'] ?? 0}}">
                    @endcomponent
                    <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
                    <?php try{ ?>
                    @if(!str_contains(Request::server('HTTP_USER_AGENT'),'Chrome'))
                        <a class="btn btn-info btn-block" href="chromeurl:{{Request::fullUrl()}}">Открыть в Хроме</a>
                    @endif
                    <?php }catch (Exception $e) {
                    } ?>
                </form>
            </div>
        </div>
    @endcomponent
@endcomponent
@stack('component_scripts')
<script>


    var $phoneinput = $("#{{\App\Helpers\FormatHelper::jqSelectorName('client[phone]')}}")[0];
    $phoneinput.selectionStart = $phoneinput.selectionEnd = $phoneinput.value.length;
</script>

</body>
</html>