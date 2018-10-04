<style>
    .admin-timetable-widget {
        display: flex;
    }
</style>

<div class="admin-timetable-widget row">
    <div class="col-lg-8">
        @include('admin.doctors.forms.includes.job.timetable')
    </div>

    <div class="col-lg-4">
        @include('admin.doctors.forms.includes.job.jobs')

        @include('admin.doctors.forms.includes.job.schedules')
    </div>
</div>

@push('component_scripts')
    <script>
        $(function () {
            const
                $dataHolder = $('body'),
                $loader     = $('#loader'),
                doctorId    = '{{ $doctor->id }}',
                doctorAlias = '{{ $doctor->alias }}';

            /* Job Listeners */
            let
                $jobsContainer    = $('#jobs-container'),
                $jobsInput        = $jobsContainer.find('select#med-centers'),
                $jobsSubmit       = $jobsContainer.find('[data-scope="save-doctor-jobs"]'),
                jobsInitialValues = $jobsInput.val();

            $jobsContainer.on('change', 'select#med-centers', function (event) {
                let $this = $(this);

                if ( ! arraysEqual(jobsInitialValues, $this.val())) {
                    $jobsSubmit.prop('disabled', false);
                } else {
                    $jobsSubmit.prop('disabled', true);
                }
            }).on('click', '[data-scope="save-doctor-jobs"]', function (event) {
                let $this = $(this);

                $loader.show();

                $.post(route('admin.doctors.job.jobs.save', doctorAlias), { medCenters: $jobsInput.val(), deleteAll: ! $jobsInput.val().length })
                    .done((response) => {
                        if (response.message) {
                            alertSuccess(response.message).then(() => {
                                location.replace(response.redirect);
                            });
                        } else {
                            alertError("Нет ответа от сервера!");
                        }
                    })
                    .fail(() => {
                        alertError("Возникла ошибка!");
                    });
            });

            /* Schedule Listeners */
            let
                $schedulesContainer = $('#schedules-container'),
                $schedulesAccordion = $schedulesContainer.find('#schedules-accordion');

            $schedulesAccordion.accordion({
                collapsible: true,
                active: false,
                heightStyle: 'content',
                activate: function (event, ui) {}
            });

            $schedulesContainer.on('change', 'select[id^="job-schedules"]', function (event) {
                let
                    $this               = $(this),
                    $timetableContainer = $('#timetable-container');

                if ($this.val()) {
                    $loader.show();

                    $.get(route('admin.doctors.job.schedules.get', $this.val()))
                        .done(function (response) {
                            if (response && Object.keys(response).length) {
                                // Reset every selector besides $this
                                $this
                                    .closest('.schedules')
                                    .siblings('.schedules')
                                    .find('select[id^="job-schedules"]')
                                    .val('').trigger('change');

                                // Set global data
                                $dataHolder
                                    .data('timetable-schedule', response.schedule.id)
                                    .data('timetable-color', response.schedule.doctor_job.color);

                                // Update timetable
                                $timetableContainer.find('table.timetable-table > tbody > tr > td').each(function (key, val) {
                                    let
                                        $column    = $(this),
                                        columnDay  = $column.closest('[data-day]').data('day'),
                                        columnTime = $column.data('time');

                                    // Reset records / columns that belong to other schedule for the same job
                                    if (($column.attr('data-selected') === 'true')
                                        &&
                                        (response.siblingSchedules.length && response.siblingSchedules.indexOf($column.data('schedule-id')) !== -1)
                                    ) {
                                        $column
                                            .attr('data-selected', false)
                                            .attr('data-schedule-id', '')
                                            .css({
                                                'background-color': '',
                                            });
                                    }

                                    // Set-up records / columns that belong to the freshly selected schedule
                                    $.each(response.schedule.records, function (index, record) {
                                        if ((columnDay === record.day) && (columnTime === record.time)) {
                                            $column
                                                .attr('data-selected', true)
                                                .attr('data-schedule-id', $dataHolder.data('timetable-schedule'))
                                                .css({
                                                    'background-color': `#${$dataHolder.data('timetable-color')}`,
                                                });
                                        }
                                    });
                                });

                                $loader.hide();
                            } else {
                                alertError("Данные по графику небыли получены!");
                            }
                        })
                        .fail(function () {
                            alertError("Возникла ошибка!");
                        });
                }
            }).on('click', '[data-scope="create-schedule"]', function (event) {
                let
                    $this = $(this),
                    jobId = $this.closest('[data-job-id]').data('job-id');

                swal("Введите заголовок графика:", {
                    icon: 'warning',
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "График на новый год",
                        },
                    },
                    buttons: ["Отмена", "Сохранить"],
                }).then((value) => {
                    if (value) {
                        $loader.show();

                        $.post(route('admin.doctors.job.schedules.create', jobId), { title: value })
                            .done((response) => {
                                alertSuccess(response.message).then(() => {
                                    location.replace(response.redirect);
                                });
                            })
                            .fail(() => {
                                alertError("Возникла ошибка!");
                            });
                    }
                });
            }).on('click', '[data-scope="update-price"]', function (event) {
                let
                    $this = $(this),
                    jobId = $this.closest('[data-job-id]').data('job-id');

                swal("Укажите минимальную цену за прием:", {
                    icon: 'warning',
                    content: {
                        element: "input",
                        attributes: {
                            placeholder: "156.90",
                        },
                    },
                    buttons: ["Отмена", "Сохранить"],
                }).then((value) => {
                    if (value) {
                        $loader.show();

                        $.post(route('admin.doctors.job.jobs.update-price', jobId), { _method: 'PATCH', minPrice: value })
                            .done((response) => {
                                $('strong', $this).text(response.min_price);

                                alertSuccess(response.message);
                            })
                            .fail(() => {
                                alertError("Возникла ошибка!");
                            });
                    }
                });
            }).on('click', '[data-scope="update-color"]', function (event) {
                let
                    $this    = $(this),
                    jobId    = $this.closest('[data-job-id]').data('job-id'),
                    colorHex = $this.siblings('[id^="color-value"]').val().toLowerCase();

                $loader.show();

                $.post(route('admin.doctors.job.jobs.update-color', jobId), { _method: 'PATCH', color: colorHex })
                    .done((response) => {
                        $dataHolder.data('timetable-color', response.color);

                        if (response.relatedSchedules.length) {
                            let $timetableContainer = $('#timetable-container');

                            $timetableContainer.find('table.timetable-table > tbody > tr > td').each(function (key, val) {
                                let $column = $(this);

                                if (($column.attr('data-selected') === 'true')
                                    &&
                                    (response.relatedSchedules.indexOf($column.data('schedule-id')) !== -1)
                                ) {
                                    $column.css({
                                        'background-color': `#${response.color}`,
                                    });
                                }
                            });
                        }

                        alertSuccess(response.message);
                    })
                    .fail((jqXHR, textStatus, errorThrown) => {
                        alertError(jqXHR.responseJSON.message);
                    });
            }).on('click', '[data-scope="update-schedule-status"]', function (event) {
                let
                    $this            = $(this),
                    jobId            = $this.closest('[data-job-id]').data('job-id'),
                    selectedSchedule = $(`select#job-schedules-${jobId}`).val();

                if (selectedSchedule) {
                    $loader.show();

                    $.post(route('admin.doctors.job.schedules.set-active', selectedSchedule), { _method: 'PATCH' })
                        .done((response) => {
                            alertSuccess(response.message);
                        })
                        .fail((jqXHR, textStatus, errorThrown) => {
                            alertError(jqXHR.responseJSON.message);
                        });
                } else {
                    alertWarning("Выберите график!");
                }
            }).on('click', '[data-scope="delete-schedule"]', function (event) {
                let
                    $this            = $(this),
                    jobId            = $this.closest('[data-job-id]').data('job-id'),
                    selectedSchedule = $(`select#job-schedules-${jobId}`).val();

                if (selectedSchedule) {
                    swal("Вы уверены?", "График будет удален.", {
                        'icon': 'error',
                        'buttons': ["Отмена", "Удалить"],
                    }).then((value) => {
                        if (value) {
                            $loader.show();

                            $.post(route('admin.doctors.job.schedules.delete', selectedSchedule), { _method: 'DELETE' })
                                .done((response) => {
                                    alertSuccess(response.message).then(() => {
                                        location.replace(response.redirect);
                                    });
                                })
                                .fail((jqXHR, textStatus, errorThrown) => {
                                    alertError(jqXHR.responseJSON.message);
                                });
                        }
                    });
                } else {
                    alertWarning("Выберите график!");
                }
            });

            /* Timetable Listeners */
            let
                $timetableContainer        = $('#timetable-container'),
                $timetableDayTriggerInputs = $timetableContainer.find('input[name="day"]'),
                $timetableCarousel         = $timetableContainer.find('.carousel');

            $timetableDayTriggerInputs.on('change', function () {
                if (this.checked) {
                    let day = parseInt(this.value);

                    $timetableCarousel.carousel((day + 6) % 7);
                }
            });

            $timetableDayTriggerInputs.filter(function () {
                return Number(this.value) === Number(new Date().getDay());
            }).closest('label').trigger('click');

            $timetableContainer.on('click', 'table.timetable-table > tbody > tr > td', function () {
                let
                    $this      = $(this),
                    scheduleId = $dataHolder.data('timetable-schedule'),
                    color      = $dataHolder.data('timetable-color');

                if (typeof scheduleId !== 'undefined' && typeof color !== 'undefined') {
                    if ($this.attr('data-selected') === 'true') {
                        $this
                            .attr('data-selected', false)
                            .attr('data-schedule-id', '')
                            .css({
                                'background-color': '',
                            });
                    } else {
                        $this
                            .attr('data-selected', true)
                            .attr('data-schedule-id', scheduleId)
                            .css({
                                'background-color': `#${color}`,
                            });
                    }

                    $('[data-scope="save-timetable"]').prop('disabled', false);
                } else {
                    alertWarning("Для редактирования выберите график из списка!");
                }
            }).on('click', '[data-scope="save-timetable"]', function (event) {
                let
                    $this           = $(this),
                    $timetableTable = $('table.timetable-table'),
                    records         = [];

                $loader.show();

                $timetableTable.find('tbody > tr > td[data-selected="true"]').each(function (key, value) {
                    let $selectedElement = $(this);

                    records.push({
                        'scheduleId': $selectedElement.data('schedule-id'),
                        'day': $selectedElement.closest('[data-day]').data('day'),
                        'time': $selectedElement.data('time'),
                    });
                });

                $.post(route('admin.doctors.job.timetable.save', doctorAlias), { data: records })
                    .done(function (response) {
                        $this.prop('disabled', true);

                        alertSuccess(response.message);
                    })
                    .fail(function () {
                        alertError("Возникла ошибка!");
                    });
            });
        });
    </script>
@endpush