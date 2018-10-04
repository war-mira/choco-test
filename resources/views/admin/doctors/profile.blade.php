@extends('admin.form')

@section('page-heading')
    <h1 class="page-header">Врач</h1>
@endsection

@section('form')
    <div class="container-fluid">
        <div class="row">
            <div class="row content-box-large">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills nav-justified">
                            <li role="presentation" class="active">
                                <a href="#doctor-main" data-toggle="tab">Основное</a>
                            </li>

                            <li role="presentation">
                                <a href="#doctor-content" data-toggle="tab">Контент</a>
                            </li>

                            <li role="presentation">
                                <a href="#doctor-skills" data-toggle="tab">Специализации</a>
                            </li>

                            <li role="presentation">
                                <a href="#doctor-job" data-toggle="tab">Работа</a>
                            </li>

                            <li role="presentation">
                                <a href="#doctor-service" data-toggle="tab">Услуги</a>
                            </li>
                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="doctor-main">
                                @component('admin.doctors.forms.main', compact('doctor'))
                                @endcomponent
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="doctor-content">
                                @component('admin.doctors.forms.content', compact('doctor'))
                                @endcomponent
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="doctor-skills">
                                @component('admin.doctors.forms.skills', compact('doctor'))
                                @endcomponent
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="doctor-job">
                                @component('admin.doctors.forms.job', compact('doctor'))
                                @endcomponent
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="doctor-service">
                                @component('admin.doctors.forms.service', compact('doctor'))
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection