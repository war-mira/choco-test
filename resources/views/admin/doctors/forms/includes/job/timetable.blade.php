<style>
    .timetable-container {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: stretch;
    }

    .timetable-panel-heading {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
    }

    .timetable-panel-heading .btn {
        outline: none !important;
    }

    div.table-responsive {
        position: relative;
    }

    table.timetable-table {
        margin-bottom: 0;
    }

    table.timetable-table th,
    table.timetable-table td {
        text-align: center;
    }

    table.timetable-table tbody > tr > td {
        padding: 8px;
        background-color: transparent;
        cursor: pointer;
    }

    table.timetable-table tbody > tr > td:hover {
        background-color: #f5f5f5;
    }
</style>

<div id="timetable-container">
    <div class="panel panel-default">
        <div class="panel-heading timetable-panel-heading">
            <div class="btn-group timetable-day-buttons" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="radio" name="day" value="1" autocomplete="off"> Пн
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="2" autocomplete="off"> Вт
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="3" autocomplete="off"> Ср
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="4" autocomplete="off"> Чт
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="5" autocomplete="off"> Пт
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="6" autocomplete="off"> Сб
                </label>

                <label class="btn btn-primary">
                    <input type="radio" name="day" value="0" autocomplete="off"> Вс
                </label>
            </div>
        </div>
        <!-- /.panel-heading -->

        <div class="panel-body">
            <div class="timetable-container">
                <div class="carousel slide" data-interval="false" data-ride="carousel">
                    <div class="carousel-inner table-responsive">
                        @for ($day = 0; $day < 7; $day++)
                            <div class="item{{ $day == 0 ? ' active' : '' }}">
                                <table class="table table-bordered timetable-table" data-day="{{ ($day + 1) % 7 }}">
                                    <thead>
                                        <tr>
                                            @for ($i = 0; $i < 24; $i += 2)
                                                <th>
                                                    <strong>{{ sprintf('%02d', $i) }} - {{ sprintf('%02d', $i + 2) }}</strong>
                                                </th>
                                            @endfor
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @for ($m = 0; $m < 120; $m += 15)
                                            <tr>
                                                @for ($i = 0; $i < 24; $i += 2)
                                                    @php
                                                        $isSelected = 'false';
                                                        $scheduleId = $color = null;
                                                        $time       = sprintf('%02d', $i + ($m / 60)) . ":" . sprintf('%02d', $m % 60);

                                                        foreach ($doctor->jobs as $job) {
                                                            foreach ($job->schedules as $schedule) {
                                                                if ($schedule->isActive()) {
                                                                    foreach ($schedule->records as $record) {
                                                                        if ((($day + 1) % 7 === $record->day)
                                                                            &&
                                                                            (strtotime($time) === strtotime($record->time))
                                                                        ) {
                                                                            $isSelected = 'true';
                                                                            $scheduleId = $schedule->id;
                                                                            $color      = "#{$job->color}";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp

                                                    <td data-selected="{{ $isSelected }}"
                                                        data-schedule-id="{{ $scheduleId }}"
                                                        data-time="{{ $time . ":00" }}"
                                                        style="background-color: {{ $color }};">{{ $time }}</td>
                                                @endfor
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        @endfor
                    </div>
                </div>

                <button data-scope="save-timetable"
                        type="button"
                        class="btn btn-block btn-primary"
                        style="margin-top: 20px;" disabled>Сохранить расписание</button>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
</div>