<div class="panel panel-default">
    <div class="panel-heading">
        Места работы
    </div>

    <div class="panel-body">
        <div id="jobs-container">
            @component('components.form.select2.multi')
                @slot('id', 'med-centers')
                @slot('field', 'med_centers[]')
                @slot('value', $doctor->medCenters->pluck('id')->toArray() ?? [])
                @slot('options', \App\Medcenter::public()->orderBy('name')->get())
                @slot('search', true)
                @slot('idField', 'id')
                @slot('nameField', 'name')
                @slot('style', 'margin-bottom: 0;')
            @endcomponent

            <button data-scope="save-doctor-jobs"
                    type="button"
                    class="btn btn-block btn-primary"
                    style="margin-top: 15px;" disabled>Сохранить места работы</button>
        </div>
    </div>
</div>