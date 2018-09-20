
function checkblock(block) {
    var $back = false;
    if (($(block).find('input[name="date"]:checked').length || $(block).find('input[name="date"]').val().length) && $(block).find('input[name="time"]:checked').length) {
        $back = true;
    }
    return $back;
}

$(document).ready(function () {

    var $receptionModalForm = $("#callback_form");
    ga(function (tracker) {
        var cid = tracker.get('clientId');
        $receptionModalForm.find('[name="ga_cid"]').val(cid).trigger('change');
    });

    $(".js-input-add-entity").each(function () {
        var $this = $(this);
        $this.data("count", 1);
        $this.data("markup", $this.outerHTML());
    });

    // $("input[name=\"phone\"]").mask("+7 (999) 999-9999");

    $("input[data-mask]").each(function () {
        var $this = $(this);
        var mask = "" + $this.data("mask");
        $this.mask(mask);
    });

    $('div.tabs a').click(function (e) {
        e.preventDefault();
        var tab_id = $(this).data('tab');

        $('div.tabs a').removeClass('entity-about__tab-item_active');
        $('.entity-about-article').removeClass('current');

        $(this).addClass('entity-about__tab-item_active');
        $("#" + tab_id).addClass('current');
    });

    $('div.tabz a').click(function (e) {
        e.preventDefault();
        var tab_id = $(this).data('tab');

        $('div.tabz a').removeClass('btn_theme_radio_active');
        $('.entity-about-articl').removeClass('current');

        $(this).addClass('btn_theme_radio_active');
        $("#" + tab_id).addClass('current');
    });

    $(".js-simple-select").selectize({
        render: {
            item: function item(data, escape) {
                return "<div data-address='" + data.address + "'>" + data.text + "</div>";
            }
        }
    });

    $('.selectize-input').find('input').prop('disabled', 'disabled');

    $(".js-header-location").selectize({
        openOnFocus: false
    });

    $(".entity-slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        responsive: [{
            breakpoint: 1199.98,
            settings: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 991.98,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 767.98,
            settings: {
                slidesToShow: 1
            }
        }]
    });

    $('input[name="client_phone"]').mask('+7 (999) 999-9999');

    var popupDefaults = {
        type: 'inline',
        fixedContentPos: false,
        focus: '#name',
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        callbacks: {
            beforeOpen: function beforeOpen() {
                $('form#callback_form').find('input[name="target_id"]').val(this.st.el.data('doc-id'));
                $('form#callback_form').find('input[name="status"]').val(this.st.el.data('status'));
                $('form#callback_form').find('#doctor_name').val(this.st.el.data('dname'));
                $('form#callback_form').find('#medcenter_name').val(this.st.el.data('dname'));
                //
                //         if($(this.st.el).parent().parent().find('input[name="date"]:checked').val() != 'custom' && $(this.st.el).parent().parent().find('input[name="date"]').is(':radio'))
                //         {
                //             $('form#callback_form').find('input[name="date"]').val($(this.st.el).parent().parent().find('input[name="date"]:checked').val());
                //         }else if($(this.st.el).parent().parent().find('input[name="custom-date"]').length)
                //         {
                //             $('form#callback_form').find('input[name="date"]').val($(this.st.el).parent().parent().find('input[name="custom-date"]').val());
                //         }
                //         else
                //         {
                //             $('form#callback_form').find('input[name="date"]').val($(this.st.el).parent().parent().find('input.js-custom-date-val').val());
                //         }
                //
                //         $('form#callback_form').find('input[name="time"]').val($(this.st.el).parent().parent().find('input[name="time"]:checked').val());
            }
        }
    };

    var callbackForm = $('form#callback_form');

    $("#save_order").click(function (e) {
        e.preventDefault();
        ga('send', 'event', {
            eventCategory: 'zapisatsya',
            eventAction: 'click'
        });
        //Ya goal
        yaCounter47714344.reachGoal('registration');

        if (callbackForm[0].checkValidity()) {
            var formData = new FormData(callbackForm[0]);
            console.log(getFormData(callbackForm));
            formData.ga_cid = $.getJSON("/callback/newDoc", getFormData(callbackForm)).done(function (json) {
                $.magnificPopup.open({
                    items: {
                        src: '<div class="white-popup"><p><strong>Спасибо!</strong> Ваша заявка принята. Мы вам перезвоним!</p></div>'
                    },
                    type: 'inline'
                });
            });
        }
    });

    $('body').on('click', 'a.popup-with-form', function (e) {
        $(this).magnificPopup(popupDefaults).magnificPopup('open');
    });

    var $select = $(".js-search-select").selectize({
        render: {
            option: function option(data, escape) {
                if (data.optgroup == "Специализации") {

                    return '<div>' + '<span class="option-doc-spec">' + '<span class="option-text">' + data.text + '</span>' + '<span class="option-count">' + data.count + '</span>' + '</span>' + '</div>';
                } else if (data.optgroup == "Врачи") {
                    return '<div>' + '<span class="option-doc-item">' + '<span class="option-doc-img"><img src="' + data.img + '" alt=""></span>' + '<span class="option-doc-info">' + '<span class="option-doc-name">' + data.text + '</span>' + '<span class="option-doc-spec">' + data.spec + '</span>' + '</span>' + '</span>' + '</div>';
                }
            }
        }
    });

    $(".js-select-region").change(function () {
        var regionVal = $(this).val();

        if (regionVal == "region-1") {
            var _ajaxUrl = '/search-example-region-1.php';
        } else if (regionVal == "region-2") {
            var _ajaxUrl2 = '/search-example-region-2.php';
        }

        $.ajax({
            type: 'get',
            url: ajaxUrl,
            dataType: 'json',
            success: function success(data) {
                $(".js-search-select")[0].selectize.clearOptions();

                for (var _i = 0; _i < data.length; _i++) {
                    $(".js-search-select")[0].selectize.addOption(data[_i]);
                }
            }
        });
    });

    $(".nav-toggle").click(function () {
        $(this).toggleClass("open");

        $(".mobile-menu").slideToggle("fast", function () {
            if (!$(".nav-toggle").hasClass("open")) {
                $(".mobile-menu").removeAttr("style");
            }
        });
    });

    pickmeup.defaults.locales['ru'] = {
        days: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
        daysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
        months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек']
    };

    $(".js-custom-date .date-radio__item").each(function () {
        var $this = $(this);

        pickmeup($this[0], {
            format: 'Y-m-d',
            locale: "ru",
            minDate: new Date(),
            hide_on_select: true,
            position: function position() {
                return {
                    "top": "100%"
                };
            }
        });

        $("body > .pickmeup").detach().appendTo($this);

        $this[0].addEventListener('pickmeup-change', function (e) {
            $this.find(".date-radio__text").html(e.detail.formatted_date);
            $this.find(".js-custom-date-val").val(e.detail.formatted_date);
            var dt = e.detail.date.toString().split(' ');
            $this.find('input[name="dayweek"]').val(dt[0]);
            $this.find("input[type=\"radio\"]").prop("checked", true);
            get_times($this.closest('div.doc-line').data('id'), dt[0], '', $this.parent().parent().parent());
        });
    });

    $(".js-appointment-book-date").each(function () {
        var $this = $(this);

        pickmeup($this[0], {
            format: 'Y-m-d',
            locale: "ru",
            minDate: new Date(),
            hide_on_select: true,
            position: function position() {
                return {
                    "top": "100%"
                };
            }
        });

        $("body > .pickmeup").detach().appendTo($this);

        $this[0].addEventListener('pickmeup-change', function (e) {
            $this.find(".appointment-book-small__date-text").html(e.detail.formatted_date);
            $this.find(".js-custom-date-val").val(e.detail.formatted_date);
            var dt = e.detail.date.toString().split(' ');
            $this.find('input[name="dayweek"]').val(dt[0]);

            console.log($this.closest('.search-result__item').length);

            if ($this.closest('div.search-result__item').length) {
                get_times($this.closest('div.search-result__item').data('id'), dt[0], '', $this.parent().parent().parent());
            } else {
                get_times($this.closest('.search-result__item').data('id'), dt[0], '', $this.parent().parent().parent());
            }
        });
    });

    $(".date-radio input[type=\"radio\"]").change(function () {
        var $this = $(this);
        get_times($(this).closest('.search-result__item').data('id'), $(this).val(), $this);
        if ($this.is(":checked") && !($this.val() == "custom")) {
            var $customDate = $this.closest(".date-radio").siblings(".js-custom-date").find(".date-radio__item");
            $customDate.find(".date-radio__text").html("Выбрать дату");
            $customDate.find(".js-custom-date-val").val("");
        }
    });

    $(".appointment-book-big__custom-time").click(function () {
        var $this = $(this);

        $this.closest(".appointment-book-big").find(".appointment-book-big__time-item_additional").show();

        $this.remove();
    });

    $(".set-rating__btn").mouseenter(function () {

        $(this).addClass("set-rating__btn_highlight").prevUntil().addClass("set-rating__btn_highlight");
    }).mouseleave(function () {

        $(this).closest(".set-rating").find(".set-rating__btn").removeClass("set-rating__btn_highlight");
    }).click(function () {

        var $this = $(this);
        var $container = $(this).closest(".set-rating");
        var $input = $this.closest(".set-rating").find("input");
        var rating = $this.data("rating");

        $container.find(".set-rating__btn").removeClass("set-rating__btn_chosen");
        $this.addClass("set-rating__btn_chosen").prevUntil().addClass("set-rating__btn_chosen");

        $input.val(rating);
    });

    $(".js-edit-img-modal").magnificPopup({
        type: 'inline',
        items: {
            src: '#edit-img-modal'
        },
        midClick: true
    });

    $('.gallery > a').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true,
            preload: [0, 2],
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Предыдущее',
            tNext: 'Следующее',
            tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
        }
    });

    $(".js-input-add-btn").click(function () {
        var $this = $(this);
        var $container = $this.closest(".js-input-add-container");
        var $entityToClone = $container.find(".js-input-add-entity");
        var $entityClone = $($entityToClone.data("markup"));

        $entityClone.removeClass("js-input-add-entity");
        $entityClone.removeClass("js-input-add-entity");

        //increment input names
        $entityClone.find("select, input, textarea").each(function () {
            var $this = $(this);
            var attrName = $this.prop("name");
            var replacedName = attrName.replace(/skills\[0\]/g, "skills[" + entityCount + "]");
            $this.prop("name", replacedName);
        });

        //add mask to inputs
        $entityClone.find("input[data-mask]").each(function () {
            var $this = $(this);
            var mask = "" + $this.data("mask");
            $this.mask(mask);
        });

        //init selectize on dynamic added selects
        $entityClone.find(".js-simple-select").selectize();

        $container.find(".js-input-lines").append($entityClone);

        $entityToClone.data("count", ++entityCount);
    });

    $(document).on("click", ".js-input-remove-btn", function () {
        $(this).parent().remove();
        entityCount--;
    });

    $('#filtersGroup .btn-radio').click(function () {
        if ($(this).prev('input[name=sort]').prop('checked')) {
            var order = $('input[name=order]:checked').val();
            order = order == 'asc' ? 'desc' : 'asc';
            $('input[name=order]').val([order]).trigger("change");
        }
    });
    $('.btn-radio').click(function () {
        var name = $(this).prev().prop('name');
        var value = $(this).prev().prop('value');

        $('input[name=' + name + ']').val([value]).trigger("change");
    });

    $(".js-add-select-tag").click(function () {
        var $this = $(this);
        var $container = $this.closest(".js-add-select-tags");
        var $inputTagsList = $container.find(".js-tags-list");
        var $chosenOption = $container.find(".js-simple-select option[selected]");
        var optionName = $chosenOption.html();
        var optionVal = $chosenOption.prop("value");

        var $tagsLine = $container.find(".js-tags-line");

        var tagExists = false;

        $tagsLine.find(".js-tag").each(function () {
            var $this = $(this);
            var tagVal = $this.data("value");

            if (tagVal == optionVal) {
                tagExists = true;
            }
        });

        if (tagExists) return false;

        var markup = '<div class="tags-line__item js-tag" data-value="' + optionVal + '">' + '<span class="tags-line__item-text">' + optionName + '</span>' + '<button class="js-remove-tag tags-line__item-remove"><i class="fa fa-times" aria-hidden="true"></i></button>' + '</div>';

        $tagsLine.append(markup);

        $inputTagsList.val($inputTagsList.val() + "," + optionVal);
    });

    $(document).on("click", ".js-remove-tag", function () {
        var $this = $(this);
        var $container = $this.closest(".js-add-select-tags");
        var $inputTagsList = $container.find(".js-tags-list");
        var tagValue = $this.closest(".js-tag").data("value");

        var newInputValue = $inputTagsList.val().replace(tagValue, '');

        $inputTagsList.val(newInputValue);

        $this.closest(".js-tag").remove();
    });

    $(".accordion__title").click(function () {
        var $this = $(this);
        var $accordion = $this.closest(".accordion");

        if ($accordion.hasClass("accordion_mobile") && window.innerWidth > 767.98) {
            return false;
        }
        // $(".accordion__body").not($accordion.find(".accordion__body")).slideToggle();
        $accordion.find(".accordion__body").slideToggle();
    });

    $(".date-text-input input").each(function () {
        var $this = $(this);

        if ($this.is("[data-pmu-date]")) {

            pickmeup($this[0], {
                default_date: false,
                format: 'Y-m-d',
                locale: "ru",
                hide_on_select: true,
                position: function position() {
                    return {
                        "top": "100%"
                    };
                }
            });
        }

        $("body > .pickmeup").detach().appendTo($this.parent());
    });

    $(".file-upload__btn input[type=\"file\"]").change(function () {
        // let $this = $(this);
        // let $fileList = $this.closest(".js-file-upload").find(".file-upload__file-list");
        // $fileList.find("span.file-upload__file").remove();

        // for (let i = 0; i < $this[0].files.length; ++i) {
        //     $fileList.append('<span class="file-upload__file">' +
        //         $this[0].files[i].name + 
        //         '<button class="file-upload__file-remove js-remove-file-btn" data-filename="' + $this[0].files[i].name + '">' +
        //         '<i class="fa fa-times" aria-hidden="true"></i>' +
        //         '</button>' +
        //         '</span>');
        // }

    });

    // $(document).on("click", ".js-remove-file-btn", function() {
    //     let $this = $(this);
    //     let $container = $this.closest(".js-file-upload");
    //     let fileName = $this.data("filename");
    //     let $fileInput = $container.find("input[type=\"file\"]");
    //     let files = $fileInput[0].files;

    //     for (let i = 0; i < files.length; ++i) {

    //         if (files[i].name == fileName) {
    //             delete files[i];
    //         }
    //     }

    //     $this.closest(".file-upload__file").remove();

    // });

    $(".hours-appointment-select").each(function () {
        var $this = $(this);
        var $container = $this.find(".hours-appointment-select__inner");
        var hourBtnWidth = $this.find(".hours-appointment-select__item").width();
        var leftOffset = $this.find(".hours-appointment-select__item:first-child").offset().left;
        var rightOffset = $this.find(".hours-appointment-select__item:last-child").offset().left + hourBtnWidth;

        $container.css("width", rightOffset - leftOffset + 2 + "px");
    });

    try {
        $(".js-file-item").LiFileType();
    } catch (er) {}

    $('.js-header-location').on('change', function () {
        var city = $(this).val();
        $.get('/setcity/' + city, function (data) {
            if (data['message'] == 'success') {
                window.location.replace(data['url']);
            }
        });
    });

    $('a[rel*=modal-link]').on("click", function (event) {
        event.preventDefault();

        var modalLink = $(this).attr("href");

        modalOpen(modalLink.substr(1));
    });

    $(".modal-close").on("click", function (e) {
        var formFlag = $(this).attr("data-flag");
        var modalId = $(this).parent(".modal-window").attr("id");

        modalClose(modalId);
    });

    $('#searchform').on("input", function (e) {

        livesearch();
        var checkInput = $(this).val();

        if (checkInput.length != 0 || !$(this).hasClass("live-search--fold")) {
            $(".live-search").addClass("live-search--fold");
        }

        if (checkInput.length == 0) {
            $(".live-search").removeClass("live-search--fold");
        }
    });

    $('.search-bar__item search-bar__item_search').on("focusout", function (e) {
        $(".live-search").removeClass("live-search--fold");
    });

    $('.upload-photo__upload-btn .not-ready-for-upload').on('click', function () {
        $('input[type=file]').trigger('click');
    });

    $('.upload-photo__upload-btn .ready-for-upload').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var file_data = $("#upload-photo__input").prop("files")[0];
        var form_data = new FormData();
        form_data.append("file", file_data);
        $.ajax({
            url: "/cabinet/doctor/personal/photo-upload",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function success() {
                location.reload();
            }
        });
    });

    $(".js-entity-type-search").change(function () {
        var entityType = $(this).val();

        if (entityType == "medcenters") {

            $(".js-additional-search").show();
            $(".index-search-bar").addClass("index-intro__search-bar_additional-search");
        } else if (entityType == "all") {

            $(".js-additional-search").hide();
            $(".index-search-bar").removeClass("index-intro__search-bar_additional-search");
        }
    });

    $('.search-bar__line .js-type-select').on('change', function () {
        var input = $(this).parents('form').find('.js-search-input');
        input.val('');
        var placeholder = void 0;
        if ($(this).val() == 'doctor') {
            placeholder = 'Введите специальность или фамилию врача';
        } else if ($(this).val() == 'medcenter') {
            placeholder = 'Введите название клиник';
        }
        input.attr("placeholder", placeholder);
    });

    $('.js-anchor-link').on('click', function () {
        var anchor = $(this).text();
        var target = $('.article-content__main').find('h2:contains(' + anchor + ')');
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    });

    $('.entity-line__about-text-more').on('click', function () {
        var text = $(this).parents('.entity-line__about-block').find('.entity-line__about-text');
        if (text.hasClass('open')) {
            text.animate({
                height: "100px"
            }, 100).removeClass('open');
        } else {
            text.animate({
                height: "100%"
            }, 100).addClass('open');
        }
    });

    var allEditors = document.querySelectorAll('.editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }

    $('.submit-form-with-editor-button').on('click', function (e) {
        e.preventDefault();
        updateAllMessageForms();
        $('.form-with-editor').submit();
    });

    var offset = 5;
    var limit = 10;
    $('#loadMoreComments').click(function (e) {
        e.preventDefault();
        var source = $(this).data('url');
        $.get(source, { offset: offset }, function (comments) {
            //console.log(comments);
            $('#hidden-comments').append($(comments.view));
            offset = comments.offset;
            //console.log(comments.left);
            $('#commentsLeftText').text(comments.left);
            if (comments.left <= 0) $('#loadMoreComments').prop('disabled', true);
        });
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

    $("#save_comment").click(function (e) {
        e.preventDefault();
        if ($("#comment_form")[0].checkValidity()) {
            $.getJSON("/comment/new", {
                owner_id: $('#owner_id').val(),
                owner_type: $('#owner_type').val(),
                user_email: $('#user_email').val(),
                user_name: $('#user_name').val(),
                text: $('#comment_text').val(),
                user_rate: $('input[name=user_rate]:checked').val(),
                date_event: $('#date_event').val(),
                type: 1
            }).done(function (json) {
                $('#user_email').removeClass('has-warning');
                $('#user_name').removeClass('has-warning');
                $('#comment_text').removeClass('has-warning');
                if (json.error) {
                    $('#user_email').addClass('has-warning');
                    $('#save_comment_mess_ok').html('<b>' + json.error + '</b>');
                    $('#save_comment_mess_ok').show();
                } else if (json.id) {
                    $('#save_comment_mess_ok').html('<b>Спасибо! Ваш комментарий отправлен на модерацию</b>');
                    $('#save_comment_mess_ok').show();
                    $("#comment_form")[0].reset();
                }
            });
        } else {
            $('#user_email').addClass('has-warning');
            $('#user_name').addClass('has-warning');
            $('#comment_text').addClass('has-warning');
        }
    });
});

function updateAllMessageForms() {
    for (instance in ClassicEditor.instances) {
        ClassicEditor.instances[instance].updateElement();
    }
}

//returns element markup
jQuery.fn.outerHTML = function () {
    return $($('<div></div>').html(this.clone())).html();
};

var liveSearchXHR = null;

function livesearch() {
    var input = $("#searchform");
    var query = input.val();
    var type = input.parents('form').find('.js-type-select').val();

    console.log(type);

    if (liveSearchXHR !== null) liveSearchXHR.abort();

    setTimeout(function () {
        var url = "/ajax/index_search";
        liveSearchXHR = $.get(url, { q: query, type: type }, function (data, textStatus) {
            $("#liveresults").html(data);
        });
    }, 300);
}

function modalOpen(modalId) {
    $(".modal-window").css("display", "none");
    $(".modal-mask").css("display", "block");
    $(".modal-container").css("display", "flex");

    setTimeout(function (e) {
        $(".modal-mask").addClass("modal-mask--show");
    }, 100);

    $("#" + modalId).css("display", "block");

    setTimeout(function (e) {
        $("#" + modalId).addClass("modal-hide");
    }, 100);
}

function modalClose(modalId) {
    $("#" + modalId).removeClass("modal-hide");

    setTimeout(function (e) {
        $(".modal-container").css("display", "none");
    }, 500);

    $(".modal-mask").removeClass("modal-mask--show");

    setTimeout(function (e) {
        $(".modal-mask").css("display", "none");
    }, 700);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result).width(250).height(200).show();

            $('.ready-for-upload').show();
            $('.not-ready-for-upload').hide();
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}