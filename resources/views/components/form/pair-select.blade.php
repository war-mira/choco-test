<div class="row" id="{{$id}}">
    <div class="col-md-6">
        <div class="panel-dropdown">
            <div class="panel" data-select="1">
                <div class="panel-heading">

                    <input type="hidden" name="{{$select1['name']}}" data-role="value"
                           value="{{$select1['value']??null}}">
                    <div class="input-group">
                        <input type="text" data-toggle="collapse" data-target="#{{$id}}-select1" readonly
                               data-role="title"
                               value="{{isset($select1['value']) ? $select1['data'][$select1['value']]['title']: null}}"
                               class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-default" data-role="clear" type="button">&times;</button>
                    </span>
                    </div>
                </div>
                <div class="panel-collapse collapse blur-hide" id="{{$id}}-select1">

                    <input type="text" data-role="search" class="form-control">
                    <div class="list-group" data-role="list"
                         style="height: 300px; overflow-y: scroll;margin-top: 10px">
                        @foreach($select1['data'] as $key=>$value)
                            <a href="#" data-value="{{$key}}" data-active="1" data-bind="{{$value['bind']}}"
                               class="list-group-item">{{$value['title']}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-dropdown">
            <div class="panel" data-select="2">
                <div class="panel-heading">
                    <input type="hidden" name="{{$select2['name']}}" data-role="value"
                           value="{{$select2['value']??null}}">
                    <div class="input-group">
                        <input type="text" data-toggle="collapse" data-target="#{{$id}}-select2" readonly
                               data-role="title"
                               value="{{isset($select2['value']) ? $select2['data'][$select2['value']]['title']: null}}"
                               class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-default" data-role="clear" type="button">&times;</button>
                    </span>
                    </div>
                </div>
                <div class="panel-collapse collapse blur-hide" id="{{$id}}-select2">
                    <input type="text" data-role="search" class="form-control">
                    <div class="list-group" data-role="list"
                         style="height: 300px; overflow-y: scroll;margin-top: 10px">
                        @foreach($select2['data'] as $key=>$value)
                            <a href="#" data-value="{{$key}}" data-active="1" data-bind="{{$value['bind']}}"
                               class="list-group-item">{{$value['title']}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('component_scripts')
    <script>
    $(function () {
        $(document).click(function (e) {
            var $collapseHide = $('.collapse.blur-hide');
            $collapseHide.not($collapseHide.has(e.target)).collapse('hide');
            e.stopPropagation();
        });

        var $container = $('#{{$id}}');
        var $select1Container = $container.find('*[data-select="1"]');
        var $select2Container = $container.find('*[data-select="2"]');

        var SelectContainer = function ($element) {
            this.$title = $element.find('*[data-role="title"]');
            this.$value = $element.find('*[data-role="value"]');
            this.$search = $element.find('*[data-role="search"]');
            this.$list = $element.find('*[data-role="list"]');
            this.$clear = $element.find('*[data-role="clear"]');
            this.$options = this.$list.find('a');
            var optionsArray = [];
            this.$options.each(function () {
                var optVal = {
                    element: $(this),
                    value: $(this).data('value'),
                    title: $(this).text(),
                    bind: $(this).data('bind'),
                    active: $(this).data('active'),
                    hide: function () {
                        this.element.hide();
                    },
                    show: function () {
                        if (this.active == 1) this.element.show();
                    },
                    activate: function (val) {
                        this.active = val;
                    }
                };
                $(this).data('option', optVal);
                optionsArray[optVal.value] = optVal;
            });
            this.optionsArray = optionsArray;
        };


        var initSelectContainer = function ($selectContainer) {
            $selectContainer.$search.quicksearch(
                $selectContainer.$options,
                {
                    'delay': 300,
                    'show':
                        function () {
                            $(this).data('option').show();
                        },
                    'hide': function () {
                        $(this).data('option').hide();
                    }
                });


        };

        var bindSelectContainer = function ($sourceSelect, $targetSelect) {
            $sourceSelect.$options.click(function (e) {
                var optVal = $(this).data('option');
                var value = optVal.value;
                var title = optVal.title;


                $sourceSelect.$title.val(title);
                $sourceSelect.$value.val(value);

                var bind = optVal.bind;

                var clear = true;
                $targetSelect.optionsArray.forEach(function (value) {
                    if (bind.indexOf(value.value) != -1) {
                        if ($targetSelect.$value.val() == value.value)
                            clear = false;
                        value.activate(1);
                        value.show();
                    }
                    else {
                        value.activate(0);
                        value.hide();
                    }
                });

                if (clear) {
                    $targetSelect.$title.val('');
                    $targetSelect.$value.val(null);
                    $targetSelect.$title.trigger('click');
                    $targetSelect.$search[0].focus();
                }

            });

            $sourceSelect.$clear.click(function () {
                $sourceSelect.$title.val("");
                $sourceSelect.$value.val(null);
                $targetSelect.optionsArray.forEach(function (value) {
                    value.activate(1);
                    value.show();
                });
            });
        };

        var initSelect = function ($selectElement1, $selectElement2) {
            var $select1 = new SelectContainer($selectElement1);
            var $select2 = new SelectContainer($selectElement2);

            initSelectContainer($select1);
            initSelectContainer($select2);

            bindSelectContainer($select1, $select2);
            bindSelectContainer($select2, $select1);
        };

        initSelect($select1Container, $select2Container);
    })
    ;
    </script>@endpush