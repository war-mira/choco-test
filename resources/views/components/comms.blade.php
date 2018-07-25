<div class="section bg-shadow" id="comments">

    <!-- begin container -->
    <div class="">

        <div class="text-center">
            <h2 class="section-title">{{$title}}</h2>
        </div>

        <!-- begin reviews -->
        <div class="reviews">
            @foreach($comments->slice(0,$visible) as $comment)
                @component('model.comm',compact('comment'))
                @endcomponent
            @endforeach
            <div id="hidden-comments">
            </div>
            @if(count($comments) > 5)
                <div class="entity-reviews__more">
                    <a href="{{$url ?? ""}}" id="loadMoreComments" class="btn btn_theme_more">Все отзывы</a>
                </div>
            @endif
            <!--p class="reviews__more">
                <button class="button button--light show-hidden-comments-btn"
                        type="button" id="loadMoreComments" data-url="{{$url ?? ""}}">Еще <span id="commentsLeftText">...</span>
                    отзывов
                </button>

            </p-->
        </div>
        <!-- end reviews -->
    </div>
    <!-- end container -->

</div>
<script>
    var offset = {{$visible}};
    var limit = 10;
    $('#loadMoreComments').click(function () {
        var source = $(this).data('url');
        $.get(source, {offset: offset}, function (comments) {
            $('#hidden-comments').append($(comments.view));
            offset = comments.offset;
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


        $("#save_comment").click(function () {
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