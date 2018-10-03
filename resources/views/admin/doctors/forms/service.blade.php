<form data-action="{{route('admin.doctors.medical-services.save',['id'=>$doctor['id']])}}"
      id="doctor-medical-services-form" method="post">
    {{csrf_field()}}
    <div class="row">
        <div class="col-md-12">
            <table id="doctor-medical-services-table" class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 100px">Id</th>
                    <th style="width: 200px">Категория</th>
                    <th style="width: 200px">Услуга</th>
                    <th>Место работы</th>
                    <th>Цена</th>
                    <th style="width: 150px; text-align: center;"></th>
                </tr>
                </thead>
                <tbody>


                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6" class="bg-success">
                        <a href="#" class="add-row">Добавить</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
        </div>
    </div>


    @push('component_scripts')
        <script type="text/html" id="service-row-tmpl">
            <tr>
                <td><input class="form-control" type="text" readonly name="id"></td>
                <td><select name="category_id"></select></td>
                <td><select name="service_id"></select></td>
                <td><select name="job_id"></select></td>
                <td><input class="form-control" type="number" name="price"></td>
                <td><a href="#" class="delete-row">Удалить</a></td>
            </tr>
        </script>
        <script>

            $(function () {
                $('select').on(
                    'select2:select',(
                        function(){
                            $(this).focus();
                        }
                    )
                );
                var $servicesForm = $('#doctor-medical-services-form');
                $sbmtBtn = $servicesForm.find('button[type="submit"]');
                var $servicesTable = $('#doctor-medical-services-table');
                var $servicesTBody = $servicesTable.find('tbody');
                var getRowValues = function ($rowElement) {
                    return {
                        id: $rowElement.find('[name="id"]').val(),
                        provider_type: "DoctorJob",
                        provider_id: $rowElement.find('[name="job_id"]').val(),
                        service_id: $rowElement.find('[name="service_id"]').val(),
                        price: $rowElement.find('[name="price"]').val()
                    };
                };

                var getTableValues = function () {
                    var data = $servicesTable.find('tbody>tr').map(function (index, row) {
                        return getRowValues($(row));
                    }).get();
                    return data;
                };

                var buildServiceRow = function (values) {

                    $rowElement = $($('#service-row-tmpl').html());
                    var categorySelect = $rowElement.find('[name=category_id]').select2({
                        allowClear: true,
                        placeholder: 'Выберите категорию',
                        data: @json(\App\Helpers\Select2Options::medicalServiceCategories())
                    });

                    filterServiceItems = function (item) {
                        var cat = categorySelect.val();
                        if (cat && cat != item.category_id) {
                            return null;
                        }
                        return item.text;
                    };

                    var serviceSelect = $rowElement.find('[name=service_id]').select2({
                        placeholder: 'Выберите услугу',
                        allowClear: true,
                        templateResult: filterServiceItems,
                        data: @json(\App\Helpers\Select2Options::medicalServices())
                    });

                    var jobSelect = $rowElement.find('[name=job_id]').select2({
                        placeholder: 'Выберите ',
                        data: @json(\App\Helpers\Select2Options::doctorJobs($doctor))
                    });

                    $servicesTBody.append($rowElement);


                    if (values) {
                        categorySelect.val(values.service.parent_id).trigger('change');
                        serviceSelect.val(values.service.id).trigger('change');
                        jobSelect.val(values.provider_id).trigger('change');
                        $rowElement.find('[name="price"]').val(values.price).trigger('change');
                        $rowElement.find('[name="id"]').val(values.id).trigger('change');
                    } else {
                        categorySelect.val(null).trigger('change');
                        serviceSelect.val(null).trigger('change');
                    }
                };

                $servicesTable.on('click', '.add-row', function () {
                    buildServiceRow();
                });

                $servicesTable.on('click', '.delete-row', function () {
                    $(this).parents('tr').detach();
                });

                $.get($servicesForm.data('action'), function (services) {
                    services.forEach(function (offer) {
                        buildServiceRow(offer);
                    });
                });
                $servicesForm.on('submit', function () {
                    $sbmtBtn.button('loading');
                    var servicesData = {services: getTableValues()};
                    servicesData._token = "{{csrf_token()}}";
                    var url = $(this).data('action');

                    $.ajax({
                        url: url,
                        type: 'post',
                        dataType: 'json', // use json instead of text
                        data: servicesData,
                        success: function (data) {
                            $sbmtBtn.button('reset');
                            $servicesTBody.empty();
                            data.forEach(function (offer) {
                                buildServiceRow(offer);
                            });
                            showAlert('Сохранено!', 'success');
                        },
                        error: function () {
                            $sbmtBtn.button('reset');
                            showAlert('Ошибка!', 'danger');
                        }
                    });
                    return false;
                })
            });
        </script>
    @endpush
</form>