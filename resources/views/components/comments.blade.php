<div class="section bg-shadow" id="comments">

    <!-- begin container -->
    <div class="container">

        <div class="text-center">
            <h2 class="section-title">{{$title}}</h2>
        </div>

        <!-- begin reviews -->
        <div class="reviews">
            @foreach($comments->slice(0,$visible) as $comment)
                @component('model.comment',compact('comment'))
                @endcomponent
            @endforeach
            <div id="hidden-comments">
                </div>


            <p class="reviews__more">
                <button class="button button--light show-hidden-comments-btn"
                        type="button" id="loadMoreComments" data-url="{{$url ?? ""}}">Еще <span id="commentsLeftText">...</span>
                    отзывов
                </button>

                </p>
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
    <div class="section top-clear">

        <!-- begin container -->
        <div class="container">

            <h2 class="section-title">Оставьте свой отзыв</h2>

            <form id="comment_form">
                {{ csrf_field() }}
                <input type="hidden" id="owner_type" value="{{$owner['type']}}">
                <input type="hidden" id="owner_id" value="{{$owner['id']}}">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="form__title">Ваш отзыв:</h3>
                        <p><textarea class="styler" id="comment_text" required name="text" rows="6"></textarea>
                        </p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="form__title">Ваша оценка</h3>
                        <span class="rating">
                <input type="radio" class="rating__input" id="rating-input-1-5" value="10" name="user_rate" checked/>
  <label for="rating-input-1-5" class="rating__star"> </label>

                    <input type="radio" class="rating__input" id="rating-input-1-4" value="8" name="user_rate"/>
  <label for="rating-input-1-4" class="rating__star">  </label>


                    <input type="radio" class="rating__input" id="rating-input-1-3" value="6" name="user_rate"/>
   <label for="rating-input-1-3" class="rating__star"> </label>


                    <input type="radio" class="rating__input" id="rating-input-1-2" value="4" name="user_rate"/>
  <label for="rating-input-1-2" class="rating__star">    </label>


                     <input type="radio" class="rating__input" id="rating-input-1-1" value="2" name="user_rate"/>
 <label for="rating-input-1-1" class="rating__star"> </label>
            </span>
                    </div>
                    @if(Auth::guest())
                    <div class="col-md-4">
                        <h3 class="form__title">Ваше имя:</h3>
                            <p><input type="text" class="styler" required id="user_name"/></p>
                    </div>
                    <div class="col-md-4">
                        <h3 class="form__title">Ваш телефон:</h3>
                        <p><input type="text" class="styler bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                                  pattern="\+7 \(\d{3}\) \d{3}-\d{4}" id="user_email"/></p>
                    </div>
                    @endif
                </div>
                <p style="text-align: right"><input class="button button--light" id="save_comment" type="button"
                                                    value="Отправить отзыв"></p>
            </form>
            <div style="display:none" id="save_comment_mess_ok">
                <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
            </div>
        </div>
        <!-- end container -->

    </div>
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