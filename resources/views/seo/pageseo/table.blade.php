@extends('seo.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">PageSeo</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Список PageSeo
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-bordered table-hover"
                               id="pageseo-main-table">
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
            var $pageseoMainTable = $('#pageseo-main-table');
            var table = $pageseoMainTable.DataTable({
                serverSide: true,
                order: [[0, 'desc']],
                columns: [
                    {
                        data: 'id',
                        title: 'Id'
                    },
                    {
                        title: 'Model',
                        data: 'class'
                    },
                    {
                        title: 'Action',
                        data: 'action'
                    },
                    {
                        title: 'SEO title',
                        data: 'title'
                    },
                    {
                        title: 'SEO description',
                        data: 'description'
                    },
                    {
                        title: 'SEO keywords',
                        data: 'keywords'
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
            $pageseoMainTable.find('tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                if (confirm('Хотите открыть запись'))
                    window.location.assign('{{route('seo.pageseo.form.view')}}/' + data.id);
            });
        });
    </script>
@endsection