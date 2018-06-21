@inject('adminService', 'App\Services\AdminService')
{!! $adminService->ordersStatistics() !!}
<form action="{{route('test.import')}}" method="post" enctype="multipart/form-data">
    <input type="file" name="doctor_excel">
    {{csrf_field()}}
    <input type="submit" value="Submit">
</form>