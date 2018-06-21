<div id="page-notification{{$notification->id}}" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <button data-dismiss="modal" class="close">&times;</button>
                <div style="margin-top: 20px">
                    {!! $notification->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#page-notification{{$notification->id}}').modal('show');
</script>