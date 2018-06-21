@extends('admin.app')
@section('content')
    <div class="content-box-large">
        <h2>Создание отчетов для медцентров</h2>
        <form class="form" action="{{route('admin.medcenter-reports.create')}}" method="POST">

            {{csrf_field()}}
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="name">Название</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="from">От</label>
                    <input class="form-control" type="datetime-local" name="from" id="from"
                           value="{{now()->startOfMonth()->format('Y-m-d\TH:i')}}" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="to">До</label>
                    <input class="form-control" type="datetime-local" name="to" id="to"
                           value="{{now()->endOfMonth()->format('Y-m-d\TH:i')}}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @component('components.form.multiselect')
                        @slot('field','med_ids')
                        @slot('value',\App\Medcenter::whereStatus(1)->pluck('id'))
                        @slot('placeholder','Медцентры')
                        @slot('label','Медцентры')
                        @slot('options',\App\Medcenter::orderBy('name')->get())
                        @slot('idField','id')
                        @slot('nameField','name_with_status')
                    @endcomponent
                </div>
            </div>
            <input class="form-control" type="submit" value="Создать">
        </form>
    </div>
@endsection