<form action="{{route('admin.doctors.form.save',['id'=>$doctor['id']])}}" method="post">
    {{csrf_field()}}
       <div class="row">
        <div class="col-md-12">
            <table id="doctor-skills-table" class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 100px">Вес</th>
                    <th>Специализация</th>
                    <th style="width: 90px; text-align: center;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach(($doctor['skills'] ?? []) as $skill)
                    @component('admin.doctors.form.skill-row', ['id' => $loop->iteration, 'skill' => $skill])
                    @endcomponent
                @endforeach
                <tr>
                    <td colspan="3" class="bg-success">
                        <a href="#" class="add-row">Добавить</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
        </div>
    </div>


    @push('component_scripts')
        <script>
            var $skillsTable = $('#doctor-skills-table');
            var sortTable = function () {
                var sorted = $skillsTable.find('tr[data-id]').sort(function (a, b) {
                    var an = parseInt($(a).find('input[type="number"]').val()),
                        bn = parseInt($(b).find('input[type="number"]').val());

                    if (an < bn) {
                        return 1;
                    }
                    if (an > bn) {
                        return -1;
                    }
                    return 0;
                });
                sorted.each(function (index, element) {
                    var weightInputName = 'skills[' + index + '][weight]';
                    var skillIdInputName = 'skills[' + index + '][id]';
                    $(element).find('input[type="number"]').attr('name', weightInputName);
                    $(element).find('select').attr('name', skillIdInputName);
                });

                sorted.detach().prependTo($skillsTable.find('tbody'));
            };
            var buildSkillRow = function () {

                var dataIds = $skillsTable.find('tr[data-id]').map(function () {
                    return $(this).data("id");
                }).get();
                var lastSkillRow = dataIds.length > 0 ? Math.max.apply(Math, dataIds) : 0;
                var nextId = lastSkillRow + 1;
                $.get('{{ route('admin.doctors.form.skill-row') }}', { id: nextId }, function (rowHtml) {
                    var row = $(rowHtml);
                    row.find('.delete-row').click(function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        row.detach();
                    });
                    row.find('input[type="number"]').on('change', sortTable);
                    $skillsTable.prepend(row);
                });
            };
            $skillsTable.find('input[type="number"]').on('change', sortTable);

            $skillsTable.find('.add-row').click(function (e) {
                e.preventDefault();
                buildSkillRow($skillsTable);
            });

            $skillsTable.find('.delete-row').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $skillsTable.find('tr[data-id="' + id + '"]').detach();
            })
        </script>
    @endpush
</form>