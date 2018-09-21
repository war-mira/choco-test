@if(isset($owner))
    <div class="entity-content__leave-review leave-review">

        <!-- begin container -->

            <div class="leave-review__heading">Посещали этого врача?</div>
            <div class="leave-review__descr">Оставьте ваш отзыв — нам важно ваше мнение</div>

            <form id="comment_form" class="leave-review__form">
                {{ csrf_field() }}
                <input type="hidden" id="owner_type" value="{{$owner['type']}}">
                <input type="hidden" id="owner_id" value="{{$owner['id']}}">
                <input type="hidden" id="type" value="{{ \App\Comment::typeCommon }}">

                <div class="leave-review__input-line">
                    @if(Auth::guest())
                    <div class="leave-review__input-item">
                        <input type="text" class="styler" required id="user_name" placeholder="Имя"/>
                    </div>
                    <div class="leave-review__input-item">
                        <input type="text"
                               class="styler bfh-phone"
                               placeholder="+7 (123) 456-7890"
                               data-format="+7 (ddd) ddd-dddd"
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}"
                               id="user_email"
                               required
                        />
                    </div>
                    @endif
                    <div class="leave-review__textarea-item">
                        <textarea class="styler" id="comment_text" required name="text" placeholder="Отзыв о враче" rows="6"></textarea>
                    </div>
                </div>
                <div class="leave-review__review-recommend review-recommend">
                    <label class="review-recommend__item">
                        <input type="radio" name="recommend" value="yes">
                        <span class="review-recommend__btn review-recommend__btn_yes">Рекомендую</span>
                    </label>
                    <label class="review-recommend__item">
                        <input type="radio" name="recommend" value="no">
                        <span class="review-recommend__btn review-recommend__btn_no">Не рекомендую</span>
                    </label>
                </div>
                <div class="leave-review__bot-line">
                    <div class="leave-review__rate">
                        <div class="leave-review__rate-text">Оценка</div>
                        <div class="leave-review__rate-stars set-rating">
                            <input type="hidden" name="rate" value="" class="set-rating__btn_highlight">
                            <div class="set-rating__btn" data-rating="1"></div>
                            <div class="set-rating__btn" data-rating="2"></div>
                            <div class="set-rating__btn" data-rating="3"></div>
                            <div class="set-rating__btn" data-rating="4"></div>
                            <div class="set-rating__btn" data-rating="5"></div>
                        </div>
                    </div>
                    <div class="leave-review__submit">
                        <a class="btn btn_theme_usual button button--light" id="save_comment">Оставить отзыв</a>
                    </div>
                </div>
            </form>
            <div style="display:none" id="save_comment_mess_ok">
                <b>Спасибо! Ваш комментарий отправлен на модерацию</b>
            </div>
            <div style="display:none; padding-bottom: 10px" id="code_confirm">
                @if(Auth::guest())
                    <div class="row with-padding ">
                        <div class="form-group col-md-12 center">

                            <div class="text-center">
                                <div>
                                    <div style="font-size: 25px">Код из СМС</div>
                                    <input id="phone_code"
                                           type="text"
                                           placeholder="0000"
                                           data-format="dddd"
                                           pattern="\d{4}"
                                           maxlength="4"
                                           required
                                           style="font-size: 30px; width: 90px; text-align: center;"
                                    >

                                </div>

                                <p class="tip small">
                                    Введите код из СМС и нажмите подтвердить запрос
                                </p>

                                <button type="button" id="confirm_code" class="btn btn_theme_usual button button--light">Подтвердить номер</button>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        <!-- end container -->

    </div>
    @push('custom.js')
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
                            console.log(json.code,'what is love?')
                            $('#user_email').removeClass('has-warning');
                            $('#user_name').removeClass('has-warning');
                            $('#comment_text').removeClass('has-warning');
                            if (json.error) {
                                $('#user_email').addClass('has-warning');
                                $('#save_comment_mess_ok').html('<b>' + json.error + '</b>');
                                $('#save_comment_mess_ok').slideDown(200);
                            }
                            else if (json.id) {
                                $('#save_comment_mess_ok').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                                $('#save_comment_mess_ok').slideDown(200);
                                $("#comment_form")[0].reset();
                            }
                            else if(json.code){
                                console.log(json.code,"baby don't hurt me")
                                $('#code_confirm').slideDown(200);
                                $("#comment_form").slideUp(200);
                                $('#save_comment_mess_ok').slideUp(200);
                            }
                        });
                }
                else {
                    $('#user_email').addClass('has-warning');
                    $('#user_name').addClass('has-warning');
                    $('#comment_text').addClass('has-warning');

                }
            });


            $("#confirm_code").click(function () {
                if ($("#phone_code").val().length==4) {
                    $.post("{{url('/comment/confirm-code')}}", {
                        code: $('#phone_code').val(),
                        _token:'{{ csrf_token() }}'
                    })
                        .done(function (json) {
                            if (json.error) {
                                $('#save_comment_mess_ok').removeClass('access').addClass('error').html('<b>' + json.error + '</b>');
                                $('#save_comment_mess_ok').slideDown(200);
                                // $('#code_confirm').hide();
                            }
                            else if (json.id) {
                                $('#code_confirm').slideUp(200);
                                $('#save_comment_mess_ok').removeClass('error').addClass('access').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                                $('#save_comment_mess_ok').slideDown(200);
                                $("#feedback__form")[0].reset();
                            }
                        });
                }
                else {
                    $('#user_name').addClass('has-warning');
                    $('#user_last_name').addClass('has-warning');
                    $('#text').addClass('has-warning');

                }
            });











            window.onload = function() {
                MaskedInput({
                    elm: document.getElementById('user_email'), // select only by id
                    format: '+7 (___) ___-____',
                    separator: '+7 ()-'
                });
            };


            // TODO: masked input - must be built with webpack from resources
            // masked_input_1.4-min.js
            // angelwatt.com/coding/masked_input.php
            (function(a){a.MaskedInput=function(f){if(!f||!f.elm||!f.format){return null}if(!(this instanceof a.MaskedInput)){return new a.MaskedInput(f)}var o=this,d=f.elm,s=f.format,i=f.allowed||"0123456789",h=f.allowedfx||function(){return true},p=f.separator||"/:-",n=f.typeon||"_YMDhms",c=f.onbadkey||function(){},q=f.onfilled||function(){},w=f.badkeywait||0,A=f.hasOwnProperty("preserve")?!!f.preserve:true,l=true,y=false,t=s,j=(function(){if(window.addEventListener){return function(E,C,D,B){E.addEventListener(C,D,(B===undefined)?false:B)}}if(window.attachEvent){return function(D,B,C){D.attachEvent("on"+B,C)}}return function(D,B,C){D["on"+B]=C}}()),u=function(){for(var B=d.value.length-1;B>=0;B--){for(var D=0,C=n.length;D<C;D++){if(d.value[B]===n[D]){return false}}}return true},x=function(C){try{C.focus();if(C.selectionStart>=0){return C.selectionStart}if(document.selection){var B=document.selection.createRange();return -B.moveStart("character",-C.value.length)}return -1}catch(D){return -1}},b=function(C,E){try{if(C.selectionStart){C.focus();C.setSelectionRange(E,E)}else{if(C.createTextRange){var B=C.createTextRange();B.move("character",E);B.select()}}}catch(D){return false}return true},m=function(D){D=D||window.event;var C="",E=D.which,B=D.type;if(E===undefined||E===null){E=D.keyCode}if(E===undefined||E===null){return""}switch(E){case 8:C="bksp";break;case 46:C=(B==="keydown")?"del":".";break;case 16:C="shift";break;case 0:case 9:case 13:C="etc";break;case 37:case 38:case 39:case 40:C=(!D.shiftKey&&(D.charCode!==39&&D.charCode!==undefined))?"etc":String.fromCharCode(E);break;default:C=String.fromCharCode(E);break}return C},v=function(B,C){if(B.preventDefault){B.preventDefault()}B.returnValue=C||false},k=function(B){var D=x(d),F=d.value,E="",C=true;switch(C){case (i.indexOf(B)!==-1):D=D+1;if(D>s.length){return false}while(p.indexOf(F.charAt(D-1))!==-1&&D<=s.length){D=D+1}if(!h(B,D)){c(B);return false}E=F.substr(0,D-1)+B+F.substr(D);if(i.indexOf(F.charAt(D))===-1&&n.indexOf(F.charAt(D))===-1){D=D+1}break;case (B==="bksp"):D=D-1;if(D<0){return false}while(i.indexOf(F.charAt(D))===-1&&n.indexOf(F.charAt(D))===-1&&D>1){D=D-1}E=F.substr(0,D)+s.substr(D,1)+F.substr(D+1);break;case (B==="del"):if(D>=F.length){return false}while(p.indexOf(F.charAt(D))!==-1&&F.charAt(D)!==""){D=D+1}E=F.substr(0,D)+s.substr(D,1)+F.substr(D+1);D=D+1;break;case (B==="etc"):return true;default:return false}d.value="";d.value=E;b(d,D);return false},g=function(B){if(i.indexOf(B)===-1&&B!=="bksp"&&B!=="del"&&B!=="etc"){var C=x(d);y=true;c(B);setTimeout(function(){y=false;b(d,C)},w);return false}return true},z=function(C){if(!l){return true}C=C||event;if(y){v(C);return false}var B=m(C);if((C.metaKey||C.ctrlKey)&&(B==="X"||B==="V")){v(C);return false}if(C.metaKey||C.ctrlKey){return true}if(d.value===""){d.value=s;b(d,0)}if(B==="bksp"||B==="del"){k(B);v(C);return false}return true},e=function(C){if(!l){return true}C=C||event;if(y){v(C);return false}var B=m(C);if(B==="etc"||C.metaKey||C.ctrlKey||C.altKey){return true}if(B!=="bksp"&&B!=="del"&&B!=="shift"){if(!g(B)){v(C);return false}if(k(B)){if(u()){q()}v(C,true);return true}if(u()){q()}v(C);return false}return false},r=function(){if(!d.tagName||(d.tagName.toUpperCase()!=="INPUT"&&d.tagName.toUpperCase()!=="TEXTAREA")){return null}if(!A||d.value===""){d.value=s}j(d,"keydown",function(B){z(B)});j(d,"keypress",function(B){e(B)});j(d,"focus",function(){t=d.value});j(d,"blur",function(){if(d.value!==t&&d.onchange){d.onchange()}});return o};o.resetField=function(){d.value=s};o.setAllowed=function(B){i=B;o.resetField()};o.setFormat=function(B){s=B;o.resetField()};o.setSeparator=function(B){p=B;o.resetField()};o.setTypeon=function(B){n=B;o.resetField()};o.setEnabled=function(B){l=B};return r()}}(window));
        </script>
    @endpush
@endif


