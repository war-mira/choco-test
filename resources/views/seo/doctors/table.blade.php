@extends('seo.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Врачи</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список врачей
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-bordered table-hover"
                               id="doctors-main-table">
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.row -->
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            var $doctorsMainTable = $('#doctors-main-table');
            var table = $doctorsMainTable.DataTable({
                select: true,
                serverSide: true,
                order: [[0, 'desc']],
                columns: [
                    {
                        data: 'id',
                        title: 'Id'
                    },
                    {
                        title: 'ФИО',
                        data: 'name',
                        name: ['lastname', 'firstname']
                    },
                    {
                        title: 'Слак',
                        data: 'alias'
                    },
                    {
                        title: 'Город',
                        data: 'city_id'
                    },
                    {
                        title: 'SEO title',
                        data: 'meta_title'
                    },
                    {
                        title: 'SEO description',
                        data: 'meta_desc'
                    },
                    {
                        title: 'SEO keywords',
                        data: 'meta_key'
                    }
                ],
                ajax: {
                    url: '{{$dataSrc}}',
                    type:
                        'POST',
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    }
                }
            });
            $doctorsMainTable.find('tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                if (confirm('Хотите открыть запись'))
                    window.location.assign('{{route('seo.doctors.form.view')}}/' + data.id);
            });
        });
    </script>
@endsection