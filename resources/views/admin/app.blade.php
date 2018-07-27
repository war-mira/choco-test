<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">

    <title>iDoctor - Admin</title>

    <!-- Old assets -->
    <link rel="stylesheet" href="{{URL::asset('css/multi-select.css?hw34h')}}">
    <link rel="stylesheet" href="{{asset('css/material-switch.css?hw34h')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/table.css')}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{asset("sbadmin/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset("sbadmin/vendor/metisMenu/metisMenu.min.css")}}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{asset("sbadmin/vendor/datatables-plugins/dataTables.bootstrap.css")}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset("sbadmin/vendor/datatables-responsive/dataTables.responsive.css")}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset("sbadmin/dist/css/sb-admin-2.css")}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset("sbadmin/vendor/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('vendor/bootstrap-table/bootstrap-table.min.css')}}">


    <link href="{{asset('assets/bootstrap-table/dist/extensions/group-by-v2/bootstrap-table-group-by.css')}}"
          rel="stylesheet"/>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset("css/load-spinner.css")}}">

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-formhelpers.min.css')}}">


    <link rel="stylesheet" type="text/css"
          href="{{asset('vendor/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css')}}">


    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="{{asset("sbadmin/vendor/jquery/jquery.min.js")}}"></script>
</head>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">iDoctor - Admin</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li id="alert" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">  <span
                            style="color: green; font-size: 20px;"
                            class="glyphicon glyphicon-bell"></span>
                    <span id="notofications_count_badge" class="badge">0</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="width: 400px;" id="notifications_list">
                </ul>
            </li>
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('admin.callbacks.table')}}"><i class="fa fa-inbox fa-fw"></i> Заявки</a>
                    </li>
                    <li>
                        <a href="{{route('admin.orders.table')}}"><i class="fa fa-check-square-o fa-fw"></i> Заказы</a>
                    </li>
                    <li>
                        <a href="{{route('admin.notifications.forDate')}}"><i class="fa fa-bell fa-fw"></i> Уведомления</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-th-list fa-fw"></i> Контент<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.doctors.table')}}"><i class="fa fa-group fa-fw"></i> Врачи</a>
                            </li>
                            <li>
                                <a href="{{route('admin.medcenters.table')}}"><i class="fa fa-hospital-o fa-fw"></i>
                                    Медцентры</a>
                            </li>
                            <li>
                                <a href="{{route('admin.skills.table')}}"><i class="fa fa-plus-square fa-fw"></i>
                                    Специализации</a>
                            </li>
                            <li>
                                <a href="{{route('admin.posts.table')}}"><i class="fa fa-font fa-fw"></i> Посты</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-ambulance fa-fw"></i> Медицинская библиотека<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.illnesses-groups.table')}}"><i class="fa fa-stethoscope fa-fw"></i> Группы заболеваний</a>
                            </li>
                            <li>
                                <a href="{{route('admin.illnesses.table')}}"><i class="fa fa-heartbeat fa-fw"></i> Заболевания</a>
                            </li>
                            <li>
                                <a href="{{route('admin.illnesses-articles.table')}}"><i class="fa fa-medkit fa-fw"></i> Статьи</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-th-list fa-fw"></i> Баннера<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.banner.list')}}"><i class="fa fa-group fa-fw"></i> Список</a>
                            </li>
                            <li>
                                <a href="{{route('admin.banner.statistics')}}"><i class="fa fa-hospital-o fa-fw"></i>
                                    Статистика</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-comments fa-fw"></i> Отзывы<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.comments.table')}}"><i class="fa fa-list-ul fa-fw"></i>
                                    Список</a>
                            </li>
                            <li>
                                <a href="{{route('admin.comments.statistics.all')}}"><i
                                            class="fa fa-bar-chart-o fa-fw"></i> Статистика общая</a>
                            </li>
                            <li>
                                <a href="{{route('admin.comments.statistics.doctors')}}"><i
                                            class="fa fa-bar-chart-o fa-fw"></i> Статистика врачи</a>
                            </li>
                            <li>
                                <a href="{{route('admin.comments.statistics.medcenters')}}"><i
                                            class="fa fa-bar-chart-o fa-fw"></i> Статистика медцентры</a>
                            </li>
                            <li>
                                <a href="{{route('admin.comments.statistics.skills')}}"><i
                                            class="fa fa-bar-chart-o fa-fw"></i> Статистика специализации</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Отчет <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.report.daily')}}"><i class="fa fa-file-text-o fa-fw"></i> За
                                    день</a>
                            </li>
                            <li>
                                <a href="{{route('admin.report.doctor')}}"><i class="fa fa-file-text-o fa-fw"></i> Для
                                    врачей</a>
                            </li>
                            <li>
                                <a href="{{route('admin.medcenter-reports.table')}}"><i
                                            class="fa fa-file-text-o fa-fw"></i> Для медцентров</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('admin.settings.form')}}"><i class="fa fa-cog fa-fw"></i> Настройки</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div id="page-wrapper">
        @yield('content')
    </div>
</div>
<body>


<!-- Bootstrap Core JavaScript -->
<script src="{{asset("sbadmin/vendor/bootstrap/js/bootstrap.min.js")}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset("sbadmin/vendor/metisMenu/metisMenu.min.js")}}"></script>

<!-- DataTables JavaScript -->
<script src="{{asset("sbadmin/vendor/datatables/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("sbadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js")}}"></script>
<script src="{{asset("sbadmin/vendor/datatables-responsive/dataTables.responsive.js")}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset("sbadmin/dist/js/sb-admin-2.js")}}"></script>

<!-- Old scripts -->
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
<script src="{{asset('custom/checkbox-dropdown.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"
        integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i"
        crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.js"></script>
<script src="{{asset('vendor/bootstrap-table/bootstrap-table.js')}}"></script>
<script src="{{asset('assets/bootstrap-table/dist/extensions/group-by-v2/bootstrap-table-group-by.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="{{asset('vendor/jquery.quicksearch.js')}}"></script>
<script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
<script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('js/bootstrap-formhelpers.min.js')}}"></script>
<script src="{{asset('js/bootstrap-formhelpers-datepicker.ru_RU.js')}}"></script>
<script src="{{asset('vendor/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="{{asset('vendor/bootstrap-datepicker/js/locales/bootstrap-datetimepicker.ru.js')}}"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
@yield('scripts')
@stack('component_scripts')
<script type="text/javascript">
    function checkNotificatons() {
        $.get("{{url('dashboard/getNotifications')}}", function (data) {

            $('#notofications_count_badge').text(data.count);
            $('#notifications_list').html(data.html);
            $('#alert').show();

        });
    }

    $(function () {
        checkNotificatons();
        var timerId = setInterval(function () {
            checkNotificatons();
        }, 5000);
    });

</script>
</body>

</html>
