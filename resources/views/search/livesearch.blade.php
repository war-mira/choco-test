<div class="row">
    <div class="container-fluid">
        {{--<form id="search_form" action="{{route('doctors.searchPage')}}" method="get">--}}

            {{--<input id="is_child" class="hidden" name="child" type="checkbox" value="1"--}}
                   {{--@if(\Request::get('child','0') == '1') checked @endif />--}}


            {{--<input id="ambulatory" class="hidden" name="ambulatory" type="checkbox" value="1"--}}
                   {{--@if(\Request::get('ambulatory','0') == '1') checked @endif />--}}
            {{--<div class="row">--}}
                {{--<div id="searchbox" class="livesearch col-sm-12">--}}


                {{--<div class="dropdown-toggle">--}}
            {{--<div class="input-group">--}}
                {{--<input name="q" id="search-input" class="form-control search-input" autocomplete="off"--}}
                       {{--value="{{\Request::get('q','')}}"--}}
                       {{--placeholder="Поиск">--}}


                {{--<div class="input-group-btn">--}}
                    {{--<button id="search-btn" type="button" class="btn btn-default" style="border-radius: 0">--}}
                        {{--<span class="glyphicon glyphicon-cog"></span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="input-group-btn ">--}}
                    {{--<button id="search-bn" type="submit" class="btn btn-default">--}}
                        {{--<span class="glyphicon glyphicon-search"></span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--</div>--}}
                {{--</div>--}}
        {{--</div>--}}
                {{--<div id="search-results" class="dropdown-menu col-md-12"--}}
                     {{--style="padding: 0; margin-left: 10px; border-radius: 4px; border: none; overflow-y: scroll; max-height: 500px;"></div>--}}

    {{--</div>--}}

        {{--</form>--}}

    {{--<script>--}}
        {{--$("#search-input").focusin(function () {--}}
            {{--setTimeout(function () {--}}
                {{--$("#search-results").show();--}}
            {{--}, 330);--}}
        {{--});--}}
        {{--$("#search-input").focusout(function () {--}}
            {{--setTimeout(function () {--}}
                {{--$("#search-results").hide();--}}
            {{--}, 300);--}}
        {{--});--}}
        {{--var inputTimeout = null;--}}

        {{--function focusSearch() {--}}
            {{--$("#search-input").click();--}}
            {{--$("#search-input").focus();--}}
            {{--livesearch();--}}
        {{--}--}}

        {{--$("#search-input").on('input', livesearch);--}}

        {{--function livesearch() {--}}
            {{--var input = $("#search-input").val();--}}
            {{--var child = $("#is_child").prop('checked');--}}
            {{--var ambulatory = $("#ambulatory").prop('checked');--}}

            {{--if(inputTimeout !== null)--}}
                {{--clearTimeout(inputTimeout);--}}
            {{--inputTimeout = setTimeout(function () {--}}
                {{--var url = "{{url("/ajax/search")}}?q=" + input + '&child=' + child + '&ambulatory=' + ambulatory;--}}
                {{--$("#search-results").load(url);--}}

            {{--}, 300);--}}
        {{--}--}}

        {{--function closeSearchParams() {--}}
            {{--$pop.popover('hide');--}}
        {{--}--}}

        {{--var $pop = $("#search-btn").popover({--}}
            {{--html: true,--}}
            {{--placement: 'top',--}}
            {{--content: "<div style='margin-bottom: -9px;'><div class='row' style='width: 270px'>" +--}}
            {{--" <div style='margin-top: -5px; margin-bottom: 15px' class='text-left col-xs-12 text-bold'>Параметры поиска" +--}}
            {{--"<a id='close_search_params_btn' href=\"#\"><span  class='glyphicon glyphicon-minus pull-right'></span></a> </div> </div><div class='row' style='width: 270px'> <div class=\"col-sm-12\" style=\"height: 30px\">\n" +--}}
            {{--" Детский врач\n" +--}}
            {{--"                <div class=\"material-switch pull-right\">\n" +--}}
            {{--"                   \n" +--}}
            {{--"                    <input id='_is_child' type=\"checkbox\" value=\"1\" />\n" +--}}
            {{--"                    <label for='_is_child'  class=\"label-primary\"></label>\n" +--}}
            {{--"                </div>\n" +--}}
            {{--"\n" +--}}
            {{--"            </div></div><hr style='margin-top: 0px;margin-bottom: 10px'><div class='row' style='width: 270px'> \n" +--}}
            {{--"            <div class=\"col-sm-12\"  style=\"height: 30px\">\n" +--}}
            {{--"\n" +--}}
            {{--"               Выезд на дом <div class=\"material-switch pull-right\">\n" +--}}
            {{--"                    \n" +--}}
            {{--"                    <input id='_ambulatory' type=\"checkbox\" value=\"1\" />\n" +--}}
            {{--"                    <label for='_ambulatory' class=\"label-primary\"></label>\n" +--}}
            {{--"                </div>\n" +--}}
            {{--"\n" +--}}
            {{--"            </div></div></div>\n" +--}}
            {{--"            <script>\n" +--}}
            {{--"                $('#_is_child').prop('checked',$(\"#is_child\").prop('checked'));\n" +--}}
            {{--"                $('#_ambulatory').prop('checked',$(\"#ambulatory\").prop('checked'));\n" +--}}
            {{--"                $('#_is_child').change(function () {\n" +--}}
            {{--"                    $(\"#is_child\").prop('checked',$(this).prop('checked'));" +--}}
            {{--"focusSearch();" +--}}
            {{--"                });\n" +--}}
            {{--"                $('#_ambulatory').change(function () {\n" +--}}
            {{--"                    $(\"#ambulatory\").prop('checked',$(this).prop('checked'));" +--}}
            {{--"focusSearch();" +--}}
            {{--"});" +--}}
            {{--"$('#close_search_params_btn').click(function(e) { $(\"#search-btn\").trigger('click'); });" +--}}
            {{--"            <\/script>"--}}
        {{--});--}}
    {{--</script>--}}


        <live-search></live-search>
</div>
</div>