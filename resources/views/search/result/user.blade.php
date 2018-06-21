<li class="client-result list-group-item" style="cursor:pointer;"
    data-link="{{route('admin.users.form',['form'=>'admin.model.orders.client-form','id'=>$data->id,'readonly'=>true])}}">
    <div class="row">
        <div class="col-md-6">
            {{$data->name}}
        </div>
        <div class="col-md-6">
            {{$data->phone}}
        </div>
    </div>
</li>