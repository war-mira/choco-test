
$(document).ready(function() {

    $(".js-input-add-entity").each(function() {
        var $this = $(this);
        $this.data("count", 1);
        $this.data("markup", $this.outerHTML());
    });

    // $("input[name=\"phone\"]").mask("+7 (999) 999-9999");

    $("input[data-mask]").each(function() {
        var $this = $(this);
        var mask = "" + $this.data("mask")
        $this.mask(mask);
    });
    
	$('div.tabs a').click(function(e){
	   e.preventDefault();
		var tab_id = $(this).data('tab');

		$('div.tabs a').removeClass('entity-about__tab-item_active');
		$('.entity-about-article').removeClass('current');

		$(this).addClass('entity-about__tab-item_active');
		$("#"+tab_id).addClass('current');
	});

	$('div.tabz a').click(function(e){
	   e.preventDefault();
		var tab_id = $(this).data('tab');

		$('div.tabz a').removeClass('btn_theme_radio_active');
		$('.entity-about-articl').removeClass('current');

		$(this).addClass('btn_theme_radio_active');
		$("#"+tab_id).addClass('current');
	});

    $(".js-simple-select").selectize();

    $(".js-header-location").selectize();

    $(".entity-slider").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        responsive: [
        {
            breakpoint: 1199.98,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 991.98,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 767.98,
            settings: {
                slidesToShow: 1
            }
        }
        ]
    });
    $('a.popup-with-form').magnificPopup({
        type: 'inline',
        focus: '#name',
        callbacks: {
          beforeOpen: function() {
            $('form#callback_form').find('input[name="target_id"]').val(this.st.el.data('doc-id'));
            $('form#callback_form').find('#doctor_name').val(this.st.el.data('dname'));
            console.log(this.st.el.data('dname'));
          },
          elementParse: function(item) {
            // Function will fire for each target element
            // "item.el" is a target DOM element (if present)
            // "item.src" is a source that you may modify
        
            //console.log('Parsing content. Item object that is being parsed:', item);
          },
          change: function() {

          },
          resize: function() {
            //console.log('Popup resized');
            // resize event triggers only when height is changed or layout forced
          },
          open: function() {
            //console.log('Popup is opened');
          },
        
          beforeClose: function() {
            // Callback available since v0.9.0
            //console.log('Popup close has been initiated');
          },
          close: function() {
            //console.log('Popup removal initiated (after removalDelay timer finished)');
          },
          afterClose: function() {
            //console.log('Popup is completely closed');
          },
        
          markupParse: function(template, values, item) {
            // Triggers each time when content of popup changes
            // console.log('Parsing:', template, values, item);
          },
          updateStatus: function(data) {
            //console.log('Status changed', data);
            // "data" is an object that has two properties:
            // "data.status" - current status type, can be "loading", "error", "ready"
            // "data.text" - text that will be displayed (e.g. "Loading...")
            // you may modify this properties to change current status or its text dynamically
          },
          imageLoadComplete: function() {
            // fires when image in current popup finished loading
            // avaiable since v0.9.0
            //console.log('Image loaded');
          },
        
        
          // Only for ajax popup type
          parseAjax: function(mfpResponse) {
            // mfpResponse.data is a "data" object from ajax "success" callback
            // for simple HTML file, it will be just String
            // You may modify it to change contents of the popup
            // For example, to show just #some-element:
            // mfpResponse.data = $(mfpResponse.data).find('#some-element');
        
            // mfpResponse.data must be a String or a DOM (jQuery) element
        
            console.log('Ajax content loaded:', mfpResponse);
          },
          ajaxContentAdded: function() {
            // Ajax content is loaded and appended to DOM
            console.log(this.content);
          }
        }
    });
    /*
    $("#order_doctor").iziModal({
        title: 'Запись на прием',
        subtitle: '',
        headerColor: '#00A8FF',
        background: '#ffffff',
        theme: '',  // light
        icon: null,
        iconText: null,
        iconColor: '',
        rtl: false,
        width: 600,
        top: null,
        bottom: null,
        borderBottom: true,
        padding: 20,
        radius: 0,
        zindex: 999,
        iframe: false,
        iframeHeight: 400,
        iframeURL: null,
        focusInput: true,
        group: '',
        loop: false,
        arrowKeys: true,
        navigateCaption: true,
        navigateArrows: true, // Boolean, 'closeToModal', 'closeScreenEdge'
        history: false,
        restoreDefaultContent: false,
        autoOpen: 0, // Boolean, Number
        bodyOverflow: false,
        fullscreen: false,
        openFullscreen: false,
        closeOnEscape: true,
        closeButton: true,
        appendTo: 'body', // or false
        appendToOverlay: 'body', // or false
        overlay: true,
        overlayClose: true,
        overlayColor: 'rgba(0, 0, 0, 0.4)',
        timeout: false,
        timeoutProgressbar: false,
        pauseOnHover: false,
        timeoutProgressbarColor: 'rgba(255,255,255,0.5)',
        transitionIn: 'fadeInDown',   // comingIn, bounceInDown, bounceInUp, fadeInDown, fadeInUp, fadeInLeft, fadeInRight, flipInX
        transitionOut: 'fadeOutUp', // comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX
        transitionInOverlay: 'fadeIn',
        transitionOutOverlay: 'fadeOut',
        onFullscreen: function(){},
        onResize: function(){},
        onOpening: function(){},
        onOpened: function(){},
        onClosing: function(){},
        onClosed: function(){},
        afterRender: function(){}
    });

    $('a.trigger-link').click(function(){
      event.preventDefault();
      $('#order_doctor').iziModal('open');
    });*/
    $(".js-search-select").selectize({
        render: {
            option: function(data, escape) {
                if (data.optgroup == "Специализации") {

                    return '<div>' +
                        '<span class="option-doc-spec">' +
                            '<span class="option-text">' + data.text + '</span>' +
                            '<span class="option-count">' + data.count + '</span>' +
                        '</span>' +
                    '</div>';

                } else if (data.optgroup == "Врачи") {
                    return '<div>' +
                        '<span class="option-doc-item">' +
                            '<span class="option-doc-img"><img src="' + data.img + '" alt=""></span>' +
                            '<span class="option-doc-info">' +
                                '<span class="option-doc-name">' + data.text + '</span>' +
                                '<span class="option-doc-spec">' + data.spec + '</span>' +
                            '</span>' +
                        '</span>' +
                    '</div>';
                }
                
            }
        }
    });

    $(".js-select-region").change(function() {
        var regionVal = $(this).val();

        if (regionVal == "region-1") {
            var ajaxUrl = '/search-example-region-1.php';
        } else if (regionVal =="region-2") {
            var ajaxUrl = '/search-example-region-2.php';
        }

        $.ajax({
            type: 'get',
            url: ajaxUrl,
            dataType: 'json',
            success: function(data) {
                $(".js-search-select")[0].selectize.clearOptions();
                
                for (var i = 0; i < data.length; i++) {
                    $(".js-search-select")[0].selectize.addOption(data[i]);
                }
            }
        });
    });

    $(".nav-toggle").click(function() {
        $(this).toggleClass("open");

        $(".mobile-menu").slideToggle("fast", function() {
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

    $(".js-custom-date .date-radio__item").each(function() {
        var $this = $(this);

        pickmeup($this[0], {
            format  : 'Y-m-d',
            locale : "ru",
            hide_on_select : true,
            position : function() {
                return {
                    "top" : "100%"
                }
            }
        });

        $("body > .pickmeup").detach().appendTo($this);

        $this[0].addEventListener('pickmeup-change', function (e) {
            $this.find(".date-radio__text").html(e.detail.formatted_date);
            $this.find(".js-custom-date-val").val(e.detail.formatted_date);

            $this.find("input[type=\"radio\"]").prop("checked", true);
        })
    });

    $(".js-appointment-book-date").each(function() {
        var $this = $(this);

        pickmeup($this[0], {
            format  : 'Y-m-d',
            locale : "ru",
            hide_on_select : true,
            position : function() {
                return {
                    "top" : "100%"
                }
            }
        });

        $("body > .pickmeup").detach().appendTo($this);

        $this[0].addEventListener('pickmeup-change', function (e) {
            $this.find(".appointment-book-small__date-text").html(e.detail.formatted_date);
            $this.find(".js-custom-date-val").val(e.detail.formatted_date);
        })

    });

    $(".date-radio input[type=\"radio\"]").change(function() {
        var $this = $(this);

        if ($this.is(":checked") && !($this.val() == "custom")) {
            var $customDate = $this.closest(".date-radio").siblings(".js-custom-date").find(".date-radio__item");
            $customDate.find(".date-radio__text").html("Выбрать дату");
            $customDate.find(".js-custom-date-val").val("");
        }
    });

    $(".appointment-book-big__custom-time").click(function() {
        var $this = $(this);

        $this.closest(".appointment-book-big").find(".appointment-book-big__time-item_additional").show();

        $this.remove();
    });

    $(".set-rating__btn").mouseenter(function() {

        $(this).addClass("set-rating__btn_highlight").prevUntil().addClass("set-rating__btn_highlight");

    }).mouseleave(function() {

        $(this).closest(".set-rating").find(".set-rating__btn").removeClass("set-rating__btn_highlight");

    }).click(function() {

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
            preload: [0,2],
            navigateByImgClick: true,
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
            tPrev: 'Предыдущее', 
            tNext: 'Следующее',
            tCounter: '<span class="mfp-counter">%curr% из %total%</span>'
        }
    });

    $(".js-input-add-btn").click(function() {
        var $this = $(this);
        var $container = $this.closest(".js-input-add-container");
        var $entityToClone = $container.find(".js-input-add-entity");
        var $entityClone = $($entityToClone.data("markup"));
        console.log(entityCount);
        $entityClone.removeClass("js-input-add-entity");

        //increment input names
        $entityClone.find("select, input, textarea").each(function() {
            var $this = $(this);
            var attrName = $this.prop("name");
            var replacedName = attrName.replace(/skills\[0\]/g, "skills[" + entityCount + "]");
            $this.prop("name", replacedName);
        });

        //add mask to inputs
        $entityClone.find("input[data-mask]").each(function() {
            var $this = $(this);
            var mask = "" + $this.data("mask");
            $this.mask(mask);
        });

        //init selectize on dynamic added selects
        $entityClone.find(".js-simple-select").selectize();

        $container.find(".js-input-lines").append($entityClone);

        $entityToClone.data("count", ++entityCount);

    });

    $(document).on("click", ".js-input-remove-btn", function() {
        $(this).parent().remove();
        entityCount--;
    });

    $(".js-add-select-tag").click(function() {
        var $this = $(this);
        var $container = $this.closest(".js-add-select-tags");
        var $inputTagsList = $container.find(".js-tags-list");
        var $chosenOption = $container.find(".js-simple-select option[selected]");
        var optionName = $chosenOption.html();
        var optionVal = $chosenOption.prop("value");

        var $tagsLine = $container.find(".js-tags-line");

        var tagExists = false;

        $tagsLine.find(".js-tag").each(function() {
            var $this = $(this);
            var tagVal = $this.data("value");

            if (tagVal == optionVal) {
                tagExists = true;
            }

        });

        if (tagExists) return false;

        var markup = '<div class="tags-line__item js-tag" data-value="'+optionVal+'">' +
                        '<span class="tags-line__item-text">'+optionName+'</span>' +
                        '<button class="js-remove-tag tags-line__item-remove"><i class="fa fa-times" aria-hidden="true"></i></button>' +
                      '</div>'; 

        $tagsLine.append(markup);

        $inputTagsList.val($inputTagsList.val() + "," +optionVal);

    });

    $(document).on("click", ".js-remove-tag", function() {
        var $this = $(this);
        var $container = $this.closest(".js-add-select-tags");
        var $inputTagsList = $container.find(".js-tags-list");
        var tagValue = $this.closest(".js-tag").data("value");

        var newInputValue = $inputTagsList.val().replace(tagValue,'');

        $inputTagsList.val(newInputValue);
            
        $this.closest(".js-tag").remove();
    });

    $(".accordion__title").click(function() {
        var $this = $(this);
        var $accordion = $this.closest(".accordion");

        if ($accordion.hasClass("accordion_mobile") && window.innerWidth > 767.98) {
            return false;
        }
        // $(".accordion__body").not($accordion.find(".accordion__body")).slideToggle();
         $accordion.find(".accordion__body").slideToggle();

    });

    $(".date-text-input input").each(function() {
        var $this = $(this);

        if ($this.is("[data-pmu-date]")) {

            pickmeup($this[0], {
                format  : 'Y-m-d',
                locale : "ru",
                hide_on_select : true,
                position : function() {
                    return {
                        "top" : "100%"
                    }
                }
            });

        } else {

            pickmeup($this[0], {
                default_date: false,
                format  : 'Y-m-d',
                locale : "ru",
                hide_on_select : true,
                position : function() {
                    return {
                        "top" : "100%"
                    }
                }
            });

        }

        $("body > .pickmeup").detach().appendTo($this.parent());
    });

    $(".file-upload__btn input[type=\"file\"]").change(function() {
        // var $this = $(this);
        // var $fileList = $this.closest(".js-file-upload").find(".file-upload__file-list");
        // $fileList.find("span.file-upload__file").remove();

        // for (var i = 0; i < $this[0].files.length; ++i) {
        //     $fileList.append('<span class="file-upload__file">' +
        //         $this[0].files[i].name + 
        //         '<button class="file-upload__file-remove js-remove-file-btn" data-filename="' + $this[0].files[i].name + '">' +
        //         '<i class="fa fa-times" aria-hidden="true"></i>' +
        //         '</button>' +
        //         '</span>');
        // }

    });

    // $(document).on("click", ".js-remove-file-btn", function() {
    //     var $this = $(this);
    //     var $container = $this.closest(".js-file-upload");
    //     var fileName = $this.data("filename");
    //     var $fileInput = $container.find("input[type=\"file\"]");
    //     var files = $fileInput[0].files;

    //     for (var i = 0; i < files.length; ++i) {

    //         if (files[i].name == fileName) {
    //             delete files[i];
    //         }
    //     }

    //     $this.closest(".file-upload__file").remove();

    // });

    $(".hours-appointment-select").each(function() {
        var $this = $(this);
        var $container = $this.find(".hours-appointment-select__inner");
        var hourBtnWidth = $this.find(".hours-appointment-select__item").width();
        var leftOffset = $this.find(".hours-appointment-select__item:first-child").offset().left;
        var rightOffset = $this.find(".hours-appointment-select__item:last-child").offset().left + hourBtnWidth;
        
        $container.css("width", rightOffset-leftOffset+2+"px");

    });
    
    try {
        $(".js-file-item").LiFileType();
    } catch(er) {

    }

    $('.js-header-location').on('change', function () {
        var city = $(this).val();
        $.get('/setcity/'+ city, function (data) {
           if(data == 'success'){
               location.reload();
           }
        });
    });

    $('a[rel*=modal-link]').on("click", function (event) {
            event.preventDefault();

            let modalLink = $(this)
                .attr("href");

            modalOpen(modalLink.substr(1));
        });

        $(".modal-close").on("click", function (e) {
            let formFlag = $(this)
                .attr("data-flag");
            let modalId = $(this)
                .parent(".modal-window")
                .attr("id");

            modalClose(modalId);
        });

    $('#searchform').on("input", function (e) {
        let checkInput = $(this)
            .val();

        if (
            checkInput.length != 0 ||
            !$(this)
                .hasClass("live-search--fold")
        ) {
            $(".live-search")
                .addClass("live-search--fold");
        }

        if (checkInput.length == 0) {
            $(".live-search")
                .removeClass("live-search--fold");
        }
    });

    $('#searchform').on("focusout", function (e) {
        $(".live-search")
            .removeClass("live-search--fold");
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

        let file_data = $("#upload-photo__input").prop("files")[0];
        let form_data = new FormData();
        form_data.append("file", file_data);
        $.ajax({
            url: "/cabinet/doctor/personal/photo-upload",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(){
                location.reload();
            }
        });
    });
});

//returns element markup
jQuery.fn.outerHTML = function() {
    return $($('<div></div>').html(this.clone())).html();
};

function modalOpen(modalId) {
    $(".modal-window")
        .css("display", "none");
    $(".modal-mask")
        .css("display", "block");
    $(".modal-container")
        .css("display", "flex");

    setTimeout(function (e) {
        $(".modal-mask")
            .addClass("modal-mask--show");
    }, 100);

    $("#" + modalId)
        .css("display", "block");

    setTimeout(function (e) {
        $("#" + modalId)
            .addClass("modal-hide");
    }, 100);
}

function modalClose(modalId) {
    $("#" + modalId)
        .removeClass("modal-hide");

    setTimeout(function (e) {
        $(".modal-container")
            .css("display", "none");
    }, 500);

    $(".modal-mask")
        .removeClass("modal-mask--show");

    setTimeout(function (e) {
        $(".modal-mask")
            .css("display", "none");
    }, 700);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(250)
                .height(200)
                .show();

            $('.ready-for-upload').show();
            $('.not-ready-for-upload').hide();
        };

        reader.readAsDataURL(input.files[0]);
    }
}