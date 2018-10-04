<div class="panel panel-default">
    <div class="panel-heading">
        График работы врача
    </div>

    <div class="panel-body">
        <div id="schedules-container">
            @if ($doctor->jobs->count())
                <div id="schedules-accordion">
                    @foreach ($doctor->jobs as $job)
                        <h3>{{ $job->medCenter->name }}</h3>

                        <div data-job-id="{{ $job->id }}" class="schedules">
                            <div class="text-center">
                                <button data-scope="update-price"
                                        type="button"
                                        class="btn btn-sm btn-default">
                                    Обновить мин. цену приема: <strong>{{ $job->min_price ?? null }}</strong>
                                </button>

                                <hr>

                                <div class="btn-group" role="group" aria-label="color">
                                    <input id="color-value-{{ $job->id }}"
                                           type="hidden"
                                           value="{{ ( ! is_null($job->color) ? $job->color : '') }}">

                                    <button type="button"
                                            class="btn btn-default jscolor {valueElement: 'color-value-{{ $job->id }}'}"
                                            style="width: 33px; height: 33px; outline: none;"></button>

                                    <button data-scope="update-color"
                                            type="button"
                                            class="btn btn-sm btn-default">Обновить цвет</button>
                                </div>
                            </div>

                            <hr>

                            @if ($job->schedules->count())
                                <div class="form-group">
                                    <label for="active-schedule-{{ $job->id }}" class="control-label">
                                        Активный график:
                                    </label>

                                    <input type="text"
                                           id="active-schedule-{{ $job->id }}"
                                           class="form-control"
                                           value="{{ $job->getActiveSchedule()->title ?? null }}" disabled>
                                </div>

                                @component('components.form.select2.single')
                                    @slot('label', "Список графиков:")
                                    @slot('id', "job-schedules-{$job->id}")
                                    @slot('field', "job_schedules[{$job->id}]")
                                    @slot('value', null)
                                    @slot('options', $job->schedules)
                                    @slot('idField', 'id')
                                    @slot('nameField', 'title')
                                @endcomponent
                            @else
                                <div class="alert alert-info">
                                    Графиков нет.
                                </div>
                            @endif

                            <div class="text-center">
                                <div>
                                    <button data-scope="create-schedule"
                                            type="button"
                                            class="btn btn-sm btn-default">Добавить график</button>
                                </div>

                                <hr>

                                @if ($job->schedules->count())
                                    <div style="margin-bottom: 10px;">
                                        <button data-scope="update-schedule-status"
                                                type="button"
                                                class="btn btn-sm btn-default">Установить выбранный график как активный</button>
                                    </div>

                                    <div>
                                        <button data-scope="delete-schedule"
                                                type="button"
                                                class="btn btn-sm btn-danger">Удалить выбранный график</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info" style="margin-bottom: 0;">
                    Мест работы нет.
                </div>
            @endif
        </div>
    </div>
</div>