@if(Session::has('flash_message'))
    <div class="alert alert-success">
        {{ Session::get('flash_message') }}
    </div>
@endif
<form action="{{$action}}" id="edit-form" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include('components.form.fields',['template'=>$template,'seed'=>$seed ?? []])
    <input type="submit" class="btn btn-primary btn-block" value="Сохранить">
</form>
