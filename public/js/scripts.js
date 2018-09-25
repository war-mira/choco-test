<<<<<<< HEAD
function checkblock(e){var t=!1;return($(e).find('input[name="date"]:checked').length||$(e).find('input[name="date"]').val().length)&&$(e).find('input[name="time"]:checked').length&&(t=!0),t}function changeTab(e){console.log(e);var t=$(e).data("tab");$("div.tabs a").removeClass("entity-about__tab-item_active"),$(".entity-about-article").removeClass("current"),$(e).addClass("entity-about__tab-item_active"),$("#"+t).addClass("current")}function isValidDate(e){var t=/^\d{4}-\d{2}-\d{2}$/;return null!=e.match(t)}function updateAllMessageForms(){for(instance in ClassicEditor.instances)ClassicEditor.instances[instance].updateElement()}function livesearch(){var e=$("#searchform"),t=e.val(),a=e.parents("form").find(".js-type-select").val();console.log(a),null!==liveSearchXHR&&liveSearchXHR.abort(),setTimeout(function(){liveSearchXHR=$.get("/ajax/index_search",{q:t,type:a},function(e,t){$("#liveresults").html(e)})},300)}function modalOpen(e){$(".modal-window").css("display","none"),$(".modal-mask").css("display","block"),$(".modal-container").css("display","flex"),setTimeout(function(e){$(".modal-mask").addClass("modal-mask--show")},100),$("#"+e).css("display","block"),setTimeout(function(t){$("#"+e).addClass("modal-hide")},100)}function modalClose(e){$("#"+e).removeClass("modal-hide"),setTimeout(function(e){$(".modal-container").css("display","none")},500),$(".modal-mask").removeClass("modal-mask--show"),setTimeout(function(e){$(".modal-mask").css("display","none")},700)}function readURL(e){if(e.files&&e.files[0]){var t=new FileReader;t.onload=function(e){$("#blah").attr("src",e.target.result).width(250).height(200).show(),$(".ready-for-upload").show(),$(".not-ready-for-upload").hide()},t.readAsDataURL(e.files[0])}}function getFormData(e){var t=e.serializeArray(),a={};return $.map(t,function(e,t){a[e.name]=e.value}),a}$(document).ready(function(){var e=$("#callback_form");ga(function(t){var a=t.get("clientId");e.find('[name="ga_cid"]').val(a).trigger("change")}),$(".js-input-add-entity").each(function(){var e=$(this);e.data("count",1),e.data("markup",e.outerHTML())}),$("input[data-mask]").each(function(){var e=$(this),t=""+e.data("mask");e.mask(t)});var t=window.location.hash.substr(1);t.length>0&&changeTab("div.tabs a[data-tab="+t+"]"),$("div.tabs a").click(function(e){e.preventDefault(),changeTab($(this))}),$("div.tabz a").click(function(e){e.preventDefault();var t=$(this).data("tab");$("div.tabz a").removeClass("btn_theme_radio_active"),$(".entity-about-articl").removeClass("current"),$(this).addClass("btn_theme_radio_active"),$("#"+t).addClass("current")}),$(".js-simple-select").selectize({render:{item:function(e,t){return"<div data-address='"+e.address+"'>"+e.text+"</div>"}}}),$(".selectize-input").find("input").prop("disabled","disabled"),$(".js-header-location").selectize({openOnFocus:!1}),$(".entity-slider").slick({infinite:!1,slidesToShow:4,slidesToScroll:1,dots:!0,responsive:[{breakpoint:1199.98,settings:{slidesToShow:3}},{breakpoint:991.98,settings:{slidesToShow:2}},{breakpoint:767.98,settings:{slidesToShow:1}}]}),$('input[name="client_phone"]').mask("+7 (999) 999-9999");var a={type:"inline",fixedContentPos:!1,focus:"#name",fixedBgPos:!0,overflowY:"auto",closeBtnInside:!0,callbacks:{beforeOpen:function(){$("form#callback_form").find('input[name="target_id"]').val(this.st.el.data("doc-id")),$("form#callback_form").find('input[name="status"]').val(this.st.el.data("status")),$("form#callback_form").find("#doctor_name").val(this.st.el.data("dname")),$("form#callback_form").find("#medcenter_name").val(this.st.el.data("dname"))}}},n=$("form#callback_form");$("#save_order").click(function(e){if(e.preventDefault(),ga("send","event",{eventCategory:"zapisatsya",eventAction:"click"}),yaCounter47714344.reachGoal("registration"),n[0].checkValidity()){var t=new FormData(n[0]);console.log(getFormData(n)),t.ga_cid=$.getJSON("/callback/newDoc",getFormData(n)).done(function(e){$.magnificPopup.open({items:{src:'<div class="white-popup"><p><strong>Спасибо!</strong> Ваша заявка принята. Мы вам перезвоним!</p></div>'},type:"inline"})})}}),$("body").on("click","a.popup-with-form",function(e){$(this).magnificPopup(a).magnificPopup("open")});$(".js-search-select").selectize({render:{option:function(e,t){return"Специализации"==e.optgroup?'<div><span class="option-doc-spec"><span class="option-text">'+e.text+'</span><span class="option-count">'+e.count+"</span></span></div>":"Врачи"==e.optgroup?'<div><span class="option-doc-item"><span class="option-doc-img"><img src="'+e.img+'" alt=""></span><span class="option-doc-info"><span class="option-doc-name">'+e.text+'</span><span class="option-doc-spec">'+e.spec+"</span></span></span></div>":void 0}}});$(".js-select-region").change(function(){var e=$(this).val();if("region-1"==e);else if("region-2"==e);$.ajax({type:"get",url:ajaxUrl,dataType:"json",success:function(e){$(".js-search-select")[0].selectize.clearOptions();for(var t=0;t<e.length;t++)$(".js-search-select")[0].selectize.addOption(e[t])}})}),$(".nav-toggle").click(function(){$(this).toggleClass("open"),$(".mobile-menu").slideToggle("fast",function(){$(".nav-toggle").hasClass("open")||$(".mobile-menu").removeAttr("style")})}),pickmeup.defaults.locales.ru={days:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],daysShort:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],daysMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],monthsShort:["Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"]},$(".js-custom-date .date-radio__item").each(function(){var e=$(this);pickmeup(e[0],{format:"Y-m-d",locale:"ru",minDate:new Date,hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e),e[0].addEventListener("pickmeup-change",function(t){e.find(".date-radio__text").html(t.detail.formatted_date),e.find(".js-custom-date-val").val(t.detail.formatted_date);var a=t.detail.date.toString().split(" ");e.find('input[name="dayweek"]').val(a[0]),e.find('input[type="radio"]').prop("checked",!0),get_times(e.closest("div.doc-line").data("id"),a[0],"",e.parent().parent().parent())})}),$(".js-appointment-book-date").each(function(){var e=$(this);pickmeup(e[0],{format:"Y-m-d",locale:"ru",minDate:new Date,hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e),e[0].addEventListener("pickmeup-change",function(t){e.find(".appointment-book-small__date-text").html(t.detail.formatted_date),e.find(".js-custom-date-val").val(t.detail.formatted_date);var a=t.detail.date.toString().split(" ");e.find('input[name="dayweek"]').val(a[0]),console.log(e.closest(".search-result__item").length),e.closest("div.search-result__item").length?get_times(e.closest("div.search-result__item").data("id"),a[0],"",e.parent().parent().parent()):get_times(e.closest(".search-result__item").data("id"),a[0],"",e.parent().parent().parent())})}),$('.date-radio input[type="radio"]').change(function(){var e=$(this);if(get_times($(this).closest(".search-result__item").data("id"),$(this).val(),e),e.is(":checked")&&"custom"!=e.val()){var t=e.closest(".date-radio").siblings(".js-custom-date").find(".date-radio__item");t.find(".date-radio__text").html("Выбрать дату"),t.find(".js-custom-date-val").val("")}}),$(".appointment-book-big__custom-time").click(function(){var e=$(this);e.closest(".appointment-book-big").find(".appointment-book-big__time-item_additional").show(),e.remove()}),$(".set-rating__btn").mouseenter(function(){$(this).addClass("set-rating__btn_highlight").prevUntil().addClass("set-rating__btn_highlight")}).mouseleave(function(){$(this).closest(".set-rating").find(".set-rating__btn").removeClass("set-rating__btn_highlight")}).click(function(){var e=$(this),t=$(this).closest(".set-rating"),a=e.closest(".set-rating").find("input"),n=e.data("rating");t.find(".set-rating__btn").removeClass("set-rating__btn_chosen"),e.addClass("set-rating__btn_chosen").prevUntil().addClass("set-rating__btn_chosen"),a.val(n)}),$(".js-edit-img-modal").magnificPopup({type:"inline",items:{src:"#edit-img-modal"},midClick:!0}),$(".gallery > a").magnificPopup({type:"image",gallery:{enabled:!0,preload:[0,2],navigateByImgClick:!0,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',tPrev:"Предыдущее",tNext:"Следующее",tCounter:'<span class="mfp-counter">%curr% из %total%</span>'}}),$(".js-input-add-btn").click(function(){var e=$(this),t=e.closest(".js-input-add-container"),a=t.find(".js-input-add-entity"),n=$(a.data("markup"));n.removeClass("js-input-add-entity"),n.removeClass("js-input-add-entity"),n.find("select, input, textarea").each(function(){var e=$(this),t=e.prop("name"),a=t.replace(/skills\[0\]/g,"skills["+entityCount+"]");e.prop("name",a)}),n.find("input[data-mask]").each(function(){var e=$(this),t=""+e.data("mask");e.mask(t)}),n.find(".js-simple-select").selectize(),t.find(".js-input-lines").append(n),a.data("count",++entityCount)}),$(document).on("click",".js-input-remove-btn",function(){$(this).parent().remove(),entityCount--}),$("#filtersGroup .btn-radio").click(function(){if($(this).prev("input[name=sort]").prop("checked")){var e=$("input[name=order]:checked").val();e="asc"==e?"desc":"asc",$("input[name=order]").val([e]).trigger("change")}}),$(".btn-radio").click(function(){var e=$(this).prev().prop("name"),t=$(this).prev().prop("value");$("input[name="+e+"]").val([t]).trigger("change")}),$(".js-add-select-tag").click(function(){var e=$(this),t=e.closest(".js-add-select-tags"),a=t.find(".js-tags-list"),n=t.find(".js-simple-select option[selected]"),s=n.html(),i=n.prop("value"),o=t.find(".js-tags-line"),r=!1;if(o.find(".js-tag").each(function(){$(this).data("value")==i&&(r=!0)}),r)return!1;var l='<div class="tags-line__item js-tag" data-value="'+i+'"><span class="tags-line__item-text">'+s+'</span><button class="js-remove-tag tags-line__item-remove"><i class="fa fa-times" aria-hidden="true"></i></button></div>';o.append(l),a.val(a.val()+","+i)}),$(document).on("click",".js-remove-tag",function(){var e=$(this),t=e.closest(".js-add-select-tags"),a=t.find(".js-tags-list"),n=e.closest(".js-tag").data("value"),s=a.val().replace(n,"");a.val(s),e.closest(".js-tag").remove()}),$(".accordion__title").click(function(){var e=$(this),t=e.closest(".accordion");if(t.hasClass("accordion_mobile")&&window.innerWidth>767.98)return!1;t.find(".accordion__body").slideToggle()}),$(".date-text-input input").each(function(){var e=$(this);e.is("[data-pmu-date]")&&pickmeup(e[0],{default_date:!1,format:"Y-m-d",locale:"ru",hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e.parent())}),$('.file-upload__btn input[type="file"]').change(function(){}),$(".hours-appointment-select").each(function(){var e=$(this),t=e.find(".hours-appointment-select__inner"),a=e.find(".hours-appointment-select__item").width(),n=e.find(".hours-appointment-select__item:first-child").offset().left,s=e.find(".hours-appointment-select__item:last-child").offset().left+a;t.css("width",s-n+2+"px")});try{$(".js-file-item").LiFileType()}catch(e){}$(".js-header-location").on("change",function(){var e=$(this).val();$.get("/setcity/"+e,function(e){"success"==e.message&&window.location.replace(e.url)})}),$("a[rel*=modal-link]").on("click",function(e){e.preventDefault(),modalOpen($(this).attr("href").substr(1))}),$(".modal-close").on("click",function(e){$(this).attr("data-flag");modalClose($(this).parent(".modal-window").attr("id"))}),$("#searchform").on("input",function(e){livesearch();var t=$(this).val();0==t.length&&$(this).hasClass("live-search--fold")||$(".live-search").addClass("live-search--fold"),0==t.length&&$(".live-search").removeClass("live-search--fold")}),$(".search-bar__item search-bar__item_search").on("focusout",function(e){$(".live-search").removeClass("live-search--fold")}),$(".upload-photo__upload-btn .not-ready-for-upload").on("click",function(){$("input[type=file]").trigger("click")}),$(".upload-photo__upload-btn .ready-for-upload").on("click",function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var e=$("#upload-photo__input").prop("files")[0],t=new FormData;t.append("file",e),$.ajax({url:"/cabinet/doctor/personal/photo-upload",dataType:"script",cache:!1,contentType:!1,processData:!1,data:t,type:"post",success:function(){location.reload()}})}),$(".js-entity-type-search").change(function(){var e=$(this).val();"medcenters"==e?($(".js-additional-search").show(),$(".index-search-bar").addClass("index-intro__search-bar_additional-search")):"all"==e&&($(".js-additional-search").hide(),$(".index-search-bar").removeClass("index-intro__search-bar_additional-search"))}),$(".search-bar__line .js-type-select").change(function(){var e=$(this).parents("form").find(".js-search-input"),t=void 0;"doctor"==$(this).val()?t="Введите специальность или фамилию врача":"medcenter"==$(this).val()&&(t="Введите название клиник"),e.attr("placeholder",t)}),$(".js-anchor-link").on("click",function(){var e=$(this).text(),t=$(".article-content__main").find("h2:contains("+e+")");$("html, body").animate({scrollTop:t.offset().top},1e3)}),setTimeout(function(){var e=document.querySelector(".entity-line__about-text");e.style.height=e.scrollHeight+"px"},1e3),$(".entity-line__about-text-more").on("click",function(){$(this).parents(".entity-line__about-block").find(".entity-line__about-text").toggleClass("less")});for(var s=document.querySelectorAll(".editor"),i=0;i<s.length;++i)ClassicEditor.create(s[i]);$(".submit-form-with-editor-button").on("click",function(e){e.preventDefault(),updateAllMessageForms(),$(".form-with-editor").submit()});var o=5;$("#loadMoreComments").click(function(e){e.preventDefault();var t=$(this).data("url");$.get(t,{offset:o},function(e){$("#hidden-comments").append($(e.view)),o=e.offset,$("#commentsLeftText").text(e.left),e.left<=0&&$("#loadMoreComments").prop("disabled",!0)})}),$(".comment-user-rate").each(function(){var e=$(this).find("a.comment-user-rate-up"),t=$(this).find("a.comment-user-rate-down");$(this).find("a").click(function(a){var n=$(this),s=n.data("url");parseInt(n.text());return $.get(s,function(a){e.text(a.up),t.text(a.down)}),a.preventDefault(),!1})}),$("#save_comment").click(function(e){e.preventDefault(),$("#comment_form")[0].checkValidity()?$.getJSON("/comment/new",{owner_id:$("#owner_id").val(),owner_type:$("#owner_type").val(),user_email:$("#user_email").val(),user_name:$("#user_name").val(),text:$("#comment_text").val(),user_rate:$("input[name=user_rate]:checked").val(),date_event:$("#date_event").val(),type:$("#type").val()}).done(function(e){$("#user_email").removeClass("has-warning"),$("#user_name").removeClass("has-warning"),$("#comment_text").removeClass("has-warning"),e.error?($("#user_email").addClass("has-warning"),$("#save_comment_mess_ok").html("<b>"+e.error+"</b>"),$("#save_comment_mess_ok").show()):e.id&&($("#save_comment_mess_ok").html("<b>Спасибо! Ваш комментарий отправлен на модерацию</b>"),$("#save_comment_mess_ok").show(),$("#comment_form")[0].reset())}):($("#user_email").addClass("has-warning"),$("#user_name").addClass("has-warning"),$("#comment_text").addClass("has-warning"))}),$(".show-question-form button").on("click",function(){$(".question__form").slideToggle(300)}),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var r=6e4*(new Date).getTimezoneOffset(),l=new Date(Date.now()-r).toISOString().slice(0,-1),c=(l.slice(0,16),document.querySelector('input[type="datetime-local"]'));c&&(c.value=l.slice(0,16));var d=$(".desktop-datetime"),m=$(".mobile-datetime");m.find("input").val(""),d.is(":visible")?m.remove():d.remove();var u=$("#question__form");$("#question__form-send").click(function(){if(u[0].checkValidity()){var e=u.serialize();console.log(e),$.post("/question/add",e).done(function(e){$("#user-email").removeClass("has-warning"),$("#user-phone").removeClass("has-warning"),$("#user-birthday").removeClass("has-warning"),$("#user-gender").removeClass("has-warning"),$("#question-text").removeClass("has-warning"),modalOpen("question__modal"),e.error?($("#save_comment_mess_ok").removeClass("access").addClass("error").html("<b>"+e.error+"</b>"),$("#save_comment_mess_ok").show()):e.id&&($("#save_comment_mess_ok").removeClass("error").addClass("access").html("<b>Спасибо! Ваш комментарий отправлен на модерацию</b>"),$("#save_comment_mess_ok").show(),u[0].reset())})}else $("#user-email").val()?$("#user-email").removeClass("has-warning"):$("#user-email").addClass("has-warning"),$("#user-phone").val()?$("#user-phone").removeClass("has-warning"):$("#user-phone").addClass("has-warning"),$("#user-birthday").val()&&isValidDate($("#user-birthday").val())?$("#user-birthday").removeClass("has-warning"):$("#user-birthday").addClass("has-warning"),$("#user-birthday-mobile").val()&&isValidDate($("#user-birthday-mobile").val())?$("#user-birthday-mobile").removeClass("has-warning"):$("#user-birthday-mobile").addClass("has-warning"),$("#user-gender").val()?$("#user-gender").removeClass("has-warning"):$("#user-gender").addClass("has-warning"),$("#question-text").val()?$("#question-text").removeClass("has-warning"):$("#question-text").addClass("has-warning")}),$(".search_event").on("click",function(){ga("send","event",{eventCategory:"poisk_glavnaya",eventAction:"click"})})}),jQuery.fn.outerHTML=function(){return $($("<div></div>").html(this.clone())).html()};var liveSearchXHR=null;
=======

function checkblock(block)
{
    let $back = false;
    if(($(block).find('input[name="date"]:checked').length || $(block).find('input[name="date"]').val().length) && $(block).find('input[name="time"]:checked').length){$back = true;}
    return $back;
}

$(document).ready(function() {

    let $receptionModalForm = $("#callback_form");
    ga(function (tracker) {
        let cid = tracker.get('clientId');
        $receptionModalForm.find('[name="ga_cid"]').val(cid).trigger('change');
    });

    $(".js-input-add-entity").each(function() {
        let $this = $(this);
        $this.data("count", 1);
        $this.data("markup", $this.outerHTML());
    });

    // $("input[name=\"phone\"]").mask("+7 (999) 999-9999");

    $("input[data-mask]").each(function() {
        let $this = $(this);
        let mask = "" + $this.data("mask");
        $this.mask(mask);
    });
    
	$('div.tabs a').click(function(e){
	   e.preventDefault();
		let tab_id = $(this).data('tab');

		$('div.tabs a').removeClass('entity-about__tab-item_active');
		$('.entity-about-article').removeClass('current');

		$(this).addClass('entity-about__tab-item_active');
		$("#"+tab_id).addClass('current');
	});

	$('div.tabz a').click(function(e){
	   e.preventDefault();
		let tab_id = $(this).data('tab');

		$('div.tabz a').removeClass('btn_theme_radio_active');
		$('.entity-about-articl').removeClass('current');

		$(this).addClass('btn_theme_radio_active');
		$("#"+tab_id).addClass('current');
	});

    $(".js-simple-select").selectize({
        render: {
            item: function (data, escape) {
                return "<div data-address='" + data.address + "'>" + data.text + "</div>"
            }
        }
    });

    $('.selectize-input').find('input').prop('disabled', 'disabled');

    $(".js-header-location").selectize({
        openOnFocus: false
    });

    $(".question-slider").slick({
        infinite: false,
        slidesToShow: 3,
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

    $('input[name="client_phone"]').mask('+7 (999) 999-9999');

    let popupDefaults = {
        type: 'inline',
        fixedContentPos: false,
        focus: '#name',
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        callbacks: {
            beforeOpen: function() {
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
    }

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
            formData.ga_cid =
                $.getJSON("/callback/newDoc", getFormData(callbackForm))
                    .done(function (json) {
                        $.magnificPopup.open({
                            items: {
                                src: '<div class="white-popup"><p><strong>Спасибо!</strong> Ваша заявка принята. Мы вам перезвоним!</p></div>',
                            },
                            type: 'inline'
                        });
                    });
        }
    });

    $('body').on('click', 'a.popup-with-form', function(e)
    {
            $(this).magnificPopup(popupDefaults).magnificPopup('open');
    });

    let $select = $(".js-search-select").selectize({
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
        let regionVal = $(this).val();

        if (regionVal == "region-1") {
            let ajaxUrl = '/search-example-region-1.php';
        } else if (regionVal =="region-2") {
            let ajaxUrl = '/search-example-region-2.php';
        }

        $.ajax({
            type: 'get',
            url: ajaxUrl,
            dataType: 'json',
            success: function(data) {
                $(".js-search-select")[0].selectize.clearOptions();
                
                for (let i = 0; i < data.length; i++) {
                    $(".js-search-select")[0].selectize.addOption(data[i]);
                }
            }
        });
    });

    $(".nav-toggle").click(function(){
        $(this).toggleClass("open");

        $(".mobile-menu").slideToggle("fast", function(){
            if(!$(".nav-toggle").hasClass("open")){
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
        let $this = $(this);

        pickmeup($this[0], {
            format  : 'Y-m-d',
            locale : "ru",
            minDate:new Date(),
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
            let dt = e.detail.date.toString().split(' ');
            $this.find('input[name="dayweek"]').val(dt[0]);
            $this.find("input[type=\"radio\"]").prop("checked", true);
            get_times($this.closest('div.doc-line').data('id'),dt[0],'',$this.parent().parent().parent());
            
        });
    });

    $(".js-appointment-book-date").each(function() {
        let $this = $(this);

        pickmeup($this[0], {
            format  : 'Y-m-d',
            locale : "ru",
            minDate:new Date(),
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
            let dt = e.detail.date.toString().split(' ');
            $this.find('input[name="dayweek"]').val(dt[0]);
            
            console.log($this.closest('.search-result__item').length);
            
            if($this.closest('div.search-result__item').length)
            {
                get_times($this.closest('div.search-result__item').data('id'),dt[0],'',$this.parent().parent().parent());
            }
            else
            {
                get_times($this.closest('.search-result__item').data('id'),dt[0],'',$this.parent().parent().parent());
            }
        })

    });

    $(".date-radio input[type=\"radio\"]").change(function()
    {
        let $this = $(this);
        get_times($(this).closest('.search-result__item').data('id'),$(this).val(),$this);
        if ($this.is(":checked") && !($this.val() == "custom")) {
            let $customDate = $this.closest(".date-radio").siblings(".js-custom-date").find(".date-radio__item");
            $customDate.find(".date-radio__text").html("Выбрать дату");
            $customDate.find(".js-custom-date-val").val("");
        }
    });

    $(".appointment-book-big__custom-time").click(function() {
        let $this = $(this);

        $this.closest(".appointment-book-big").find(".appointment-book-big__time-item_additional").show();

        $this.remove();
    });

    $(".set-rating__btn").mouseenter(function() {

        $(this).addClass("set-rating__btn_highlight").prevUntil().addClass("set-rating__btn_highlight");

    }).mouseleave(function() {

        $(this).closest(".set-rating").find(".set-rating__btn").removeClass("set-rating__btn_highlight");

    }).click(function() {

        let $this = $(this);
        let $container = $(this).closest(".set-rating");
        let $input = $this.closest(".set-rating").find("input");
        let rating = $this.data("rating");


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
        let $this = $(this);
        let $container = $this.closest(".js-input-add-container");
        let $entityToClone = $container.find(".js-input-add-entity");
        let $entityClone = $($entityToClone.data("markup"));

        $entityClone.removeClass("js-input-add-entity");
        $entityClone.removeClass("js-input-add-entity");

        //increment input names
        $entityClone.find("select, input, textarea").each(function() {
            let $this = $(this);
            let attrName = $this.prop("name");
            let replacedName = attrName.replace(/skills\[0\]/g, "skills[" + entityCount + "]");
            $this.prop("name", replacedName);
        });

        //add mask to inputs
        $entityClone.find("input[data-mask]").each(function() {
            let $this = $(this);
            let mask = "" + $this.data("mask");
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

    $('#filtersGroup .btn-radio').click(
        function () {
            if ($(this).prev('input[name=sort]').prop('checked')) {
                let order = $('input[name=order]:checked').val();
                order = (order == 'asc') ? 'desc' : 'asc';
                $('input[name=order]').val([order]).trigger("change");
            }
        });
    $('.btn-radio').click(function () {
        let name = $(this).prev().prop('name');
        let value = $(this).prev().prop('value');

        $('input[name=' + name + ']').val([value]).trigger("change");
    });


    $(".js-add-select-tag").click(function() {
        let $this = $(this);
        let $container = $this.closest(".js-add-select-tags");
        let $inputTagsList = $container.find(".js-tags-list");
        let $chosenOption = $container.find(".js-simple-select option[selected]");
        let optionName = $chosenOption.html();
        let optionVal = $chosenOption.prop("value");

        let $tagsLine = $container.find(".js-tags-line");

        let tagExists = false;

        $tagsLine.find(".js-tag").each(function() {
            let $this = $(this);
            let tagVal = $this.data("value");

            if (tagVal == optionVal) {
                tagExists = true;
            }

        });

        if (tagExists) return false;

        let markup = '<div class="tags-line__item js-tag" data-value="'+optionVal+'">' +
                        '<span class="tags-line__item-text">'+optionName+'</span>' +
                        '<button class="js-remove-tag tags-line__item-remove"><i class="fa fa-times" aria-hidden="true"></i></button>' +
                      '</div>'; 

        $tagsLine.append(markup);

        $inputTagsList.val($inputTagsList.val() + "," +optionVal);

    });

    $(document).on("click", ".js-remove-tag", function() {
        let $this = $(this);
        let $container = $this.closest(".js-add-select-tags");
        let $inputTagsList = $container.find(".js-tags-list");
        let tagValue = $this.closest(".js-tag").data("value");

        let newInputValue = $inputTagsList.val().replace(tagValue,'');

        $inputTagsList.val(newInputValue);
            
        $this.closest(".js-tag").remove();
    });

    $(".accordion__title").click(function() {
        let $this = $(this);
        let $accordion = $this.closest(".accordion");

        if ($accordion.hasClass("accordion_mobile") && window.innerWidth > 767.98) {
            return false;
        }
        // $(".accordion__body").not($accordion.find(".accordion__body")).slideToggle();
         $accordion.find(".accordion__body").slideToggle();

    });

    $(".date-text-input input").each(function() {
        let $this = $(this);

        if ($this.is("[data-pmu-date]")) {

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

    $(".hours-appointment-select").each(function() {
        let $this = $(this);
        let $container = $this.find(".hours-appointment-select__inner");
        let hourBtnWidth = $this.find(".hours-appointment-select__item").width();
        let leftOffset = $this.find(".hours-appointment-select__item:first-child").offset().left;
        let rightOffset = $this.find(".hours-appointment-select__item:last-child").offset().left + hourBtnWidth;
        
        $container.css("width", rightOffset-leftOffset+2+"px");

    });
    
    try {
        $(".js-file-item").LiFileType();
    } catch(er) {

    }

    $('.js-header-location').on('change', function () {
        let city = $(this).val();
        $.get('/setcity/'+ city, function (data) {
           if(data['message'] == 'success'){
               window.location.replace(data['url']);
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

        livesearch();
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

    $('.search-bar__item search-bar__item_search').on("focusout", function (e) {
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

    $(".js-entity-type-search").change(function() {
        let entityType = $(this).val();

        if (entityType == "medcenters") {

            $(".js-additional-search").show();
            $(".index-search-bar").addClass("index-intro__search-bar_additional-search");

        } else if (entityType =="all") {

            $(".js-additional-search").hide();
            $(".index-search-bar").removeClass("index-intro__search-bar_additional-search");
        }
    });

    $('.search-bar__line .js-type-select').on('change', function () {
        let input = $(this).parents('form').find('.js-search-input');
        input.val('');
        let placeholder;
        if($(this).val() == 'doctor'){
            placeholder = 'Введите специальность или фамилию врача';
        }else if($(this).val() == 'medcenter') {
            placeholder = 'Введите название клиник';
        }
        input.attr("placeholder", placeholder);
    });

    $('.js-anchor-link').on('click', function () {
       let anchor = $(this).text();
       let target = $('.article-content__main').find('h2:contains('+ anchor + ')');
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    });

    $('.entity-line__about-text-more').on('click', function () {
        let text = $(this).parents('.entity-line__about-block').find('.entity-line__about-text');
        if (text.hasClass('open')){
                text.animate({
                    height: "100px"
                }, 100).removeClass('open');
        }else{
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
                type:1
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
    
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
        var navbar = document.getElementById("navbar");
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            if(currentScrollPos == 0){
                navbar.style.top = "80px";
                navbar.classList.remove("navbar-pattern");
                document.getElementById('nav-top-container').classList.add('mr_0');
                document.getElementById('nav-top-container').classList.remove('ml_0');
            }
        }else {
            navbar.style.top = "0px";
            navbar.classList.add("navbar-pattern");
            document.getElementById('nav-top-container').classList.add('ml_0');
            document.getElementById('nav-top-container').classList.remove('mr_0');
        }
        prevScrollpos = currentScrollPos;
    };
    window.onload = function(){
        var navbar = document.getElementById("navbar");
        if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            navbar.style.position = "fixed";
        }
        var currentScrollPos = window.pageYOffset;
        if(currentScrollPos > 80){
            navbar.style.top = "0px";
            navbar.classList.add("navbar-pattern");
            document.getElementById('nav-top-container').classList.add('ml_0');
            document.getElementById('nav-top-container').classList.remove('mr_0');
        }
    };

});


function updateAllMessageForms(){
    for (instance in ClassicEditor.instances) {
        ClassicEditor.instances[instance].updateElement();
    }
}

//returns element markup
jQuery.fn.outerHTML = function() {
    return $($('<div></div>').html(this.clone())).html();
};

let liveSearchXHR = null;

function livesearch() {
    let input = $("#searchform");
    let query = input.val();
    let type = input.parents('form').find('.js-type-select').val();

    console.log(type);

    if (liveSearchXHR !== null)
        liveSearchXHR.abort();

    setTimeout(function () {
        let url = "/ajax/index_search" ;
        liveSearchXHR = $.get(url, {q:query, type:type}, function (data, textStatus) {
            $("#liveresults").html(data);
        });
    }, 300);
}

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
        let reader = new FileReader();

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

function getFormData($form) {
    let unindexed_array = $form.serializeArray();
    let indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
>>>>>>> aisha-dev
