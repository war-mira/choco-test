<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">iDoctor - Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li id="alert" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span style="color: green; font-size: 20px;" class="glyphicon glyphicon-bell"></span>
                <span id="notifications_count_badge" class="badge">0</span>
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" style="width: 400px;" id="notifications_list"></ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-dashboard fa-fw"></i> Главная панель
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.callbacks.table.view') }}">
                        <i class="fa fa-inbox fa-fw"></i> Заявки
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.orders.table.view') }}">
                        <i class="fa fa-check-square-o fa-fw"></i> Заказы
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.notifications.forDate') }}">
                        <i class="fa fa-bell fa-fw"></i> Уведомления
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-th-list fa-fw"></i> Люди <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.patients.table.view') }}">
                                <i class="fa fa-group fa-fw"></i> Пациенты
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.users.table.view') }}">
                                <i class="fa fa-group-o fa-fw"></i> Пользователи
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-th-list fa-fw"></i> Контент <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.medical-services.table.view') }}">
                                <i class="fa fa-hospital-o fa-fw"></i> Услуги
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.doctors.table.view') }}">
                                <i class="fa fa-group fa-fw"></i> Врачи
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.medcenters.table.view') }}">
                                <i class="fa fa-hospital-o fa-fw"></i> Медцентры
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.skills.table.view') }}">
                                <i class="fa fa-plus-square fa-fw"></i> Специализации
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.posts.table.view') }}">
                                <i class="fa fa-font fa-fw"></i> Посты
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-location-arrow fa-fw"></i> Локация <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.cities.table.view') }}">
                                <i class="fa fa-location-arrow fa-fw"></i> Города
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.districts.table.view') }}">
                                <i class="fa fa-location-arrow fa-fw"></i> Районы
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-th-list fa-fw"></i> Баннера <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.banner.list') }}">
                                <i class="fa fa-group fa-fw"></i> Список
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.banner.statistics') }}">
                                <i class="fa fa-hospital-o fa-fw"></i> Статистика
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-comments fa-fw"></i> Отзывы <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.comments.table.view') }}">
                                <i class="fa fa-list-ul fa-fw"></i> Список
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.feedbacks.table.view') }}">
                                <i class="fa fa-group fa-fw"></i> Обратная связь
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.comments.statistics.all') }}">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Статистика общая
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.comments.statistics.doctors') }}">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Статистика врачи
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.comments.statistics.medcenters') }}">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Статистика медцентры
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.comments.statistics.skills') }}">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Статистика специализации
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-file-text-o fa-fw"></i> Отчет <span class="fa arrow"></span>
                    </a>

                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('admin.report.daily') }}">
                                <i class="fa fa-file-text-o fa-fw"></i> За день
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.report.doctor') }}">
                                <i class="fa fa-file-text-o fa-fw"></i> Для врачей
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.medcenter-reports.table') }}">
                                <i class="fa fa-file-text-o fa-fw"></i> Для медцентров
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>