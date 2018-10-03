<div class="section">

    <!-- begin container -->
    <div class="container">

        <!-- begin middle -->
        <div class="middle middle--border">

            <!-- begin sidebar -->
        <!--div class="sidebar sidebar--left">
                    <div class="sidebar__section bottom-clear">
                        <h3 class="sidebar__title">График работы:</h3>
                        @if(isset($medcenter['timetable']) && $medcenter['timetable'] != '')
            {!! $medcenter['timetable']!!}
        @else
            Временно недоступен.
@endif
                </div>
            </div-->
            <!-- end sidebar -->

            <!-- begin column -->
            <div id="reg_form" class="column column--right">
                <h3>Записаться на прием</h3>

                <form id="callback_form">
                    <input type="hidden" name="ga_cid" value="">
                    @if(Auth::user())
                        <input type="hidden" name="client_id" value="{{auth()->user()->id}}">
                    @endif
                    <div class="form__group">
                        <label>*Имя и Фамилия</label><br>
                        <input class="form-control " name="client_name" id="client_name" required type="text"
                               @if(Auth::user())
                               value="{{auth()->user()->name}}"
                               readonly="readonly"
                                @endif>
                    </div>
                    <div class="form__group" id="phone-group">
                        <label>*Телефон</label><br>
                        <input class="form-control bfh-phone" data-format="+7 (ddd) ddd-dddd" required
                               pattern="\+7 \(\d{3}\) \d{3}-\d{4}" name="client_phone" id="client_phone"
                               type="text"
                               @if(Auth::user())
                               value="{{auth()->user()->phone}}"
                               readonly="readonly"
                                @endif>
                    </div>
                    <div class="form__group">
                        <label>Email</label><br>
                        <input class="form-control " name="client_email" id="client_email" type="text"
                               @if(Auth::user())
                               value="{{auth()->user()->email}}"
                               readonly="readonly"
                                @endif>
                    </div>
                    <input type="hidden" name="target_type" value="Medcenter">
                    <input type="hidden" name="target_id" value="{{$medcenter['id']}}">
                    <input type="hidden" name="source" value="medcenter_page">
                    <div class="form-group">
                        <label>Врач</label><br>
                        <input class="form-control" id="medcenter_name"
                               type="text"
                               value="{{$medcenter['name']}}"
                               readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label for="client_comment">
                            <a data-toggle="collapse" href="#client_comment" class="link-dotted">
                                Есть особые пожелания?&nbsp;<i class="glyphicon glyphicon-chevron-down"></i>
                            </a>
                        </label>
                        <div id="client_comment" class="collapse">
                                <textarea class="form-control" style="height: 100px" id="client_comment_text"
                                          name="client_comment"
                                          placeholder="Напишите свои пожелания сюда..(можно оставить пустым)"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="save_order" class="button" value="Записаться">
                    </div>
                </form>

            </div>
            <div id="mess_ok" style="padding:10px;    margin-left: 240px;font-size:18px;display:none" class="">
                <strong>Спасибо!</strong> Вы оставили заявку на запись. В ближайшее время с вами свяжется наш
                оператор
            </div>
            <!-- end column -->

        </div>
        <!-- end middle -->

    </div>
    <!-- end container -->

</div>