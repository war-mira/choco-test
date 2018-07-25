<script>
    //var offset = {{$visible}};
    var offset = 0;
    var limit = 10;
    $('#loadMoreComments').click(function (e) {
        e.preventDefault();
        var source = $(this).data('url');
        $.get(source, {offset: offset}, function (comments){
            //console.log(comments);
            $('#hidden-comments').append($(comments.view));
            offset = comments.offset;
            //console.log(comments.left);
            $('#commentsLeftText').text(comments.left);
            if (comments.left <= 0)
                $('#loadMoreComments').prop('disabled', true);
        })
    });
    $('.comment-user-rate').each(function () {
        var userRateUp = $(this).find('a.comment-user-rate-up');
        var userRateDown = $(this).find('a.comment-user-rate-down');
        $(this).find('a').click(function (e) {
            var anchor = $(this);
            var url = anchor.data('url');
            var oldRate = parseInt(anchor.text());
            $.get(url, function (response) {
                userRateUp.text(response.up);
                userRateDown.text(response.down);
            });
            e.preventDefault();
            return false;
        });
    });
</script>
@if(isset($owner))
<script>
    $("#save_comment").click(function (e) {
        e.preventDefault();
        if ($("#comment_form")[0].checkValidity()) {
            $.getJSON("{{url('/comment/new')}}", {
                owner_id: $('#owner_id').val(),
                owner_type: $('#owner_type').val(),
                user_email: $('#user_email').val(),
                user_name: $('#user_name').val(),
                text: $('#comment_text').val(),
                user_rate: $('input[name=user_rate]:checked').val(),
                date_event: $('#date_event').val()
            })
                .done(function (json) {
                    $('#user_email').removeClass('has-warning');
                    $('#user_name').removeClass('has-warning');
                    $('#comment_text').removeClass('has-warning');
                    if (json.error) {
                        $('#user_email').addClass('has-warning');
                        $('#save_comment_mess_ok').html('<b>' + json.error + '</b>');
                        $('#save_comment_mess_ok').show();
                    }
                    else if (json.id) {
                        $('#save_comment_mess_ok').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                        $('#save_comment_mess_ok').show();
                        $("#comment_form")[0].reset();
                    }
                });
        }
        else {
            $('#user_email').addClass('has-warning');
            $('#user_name').addClass('has-warning');
            $('#comment_text').addClass('has-warning');

        }
    });
</script>
@endif