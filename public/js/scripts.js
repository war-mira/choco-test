function checkblock(e){var t=!1;return($(e).find('input[name="date"]:checked').length||$(e).find('input[name="date"]').val().length)&&$(e).find('input[name="time"]:checked').length&&(t=!0),t}function changeTab(e){console.log(e);var t=$(e).data("tab");$("div.tabs a").removeClass("entity-about__tab-item_active"),$(".entity-about-article").removeClass("current"),$(e).addClass("entity-about__tab-item_active"),$("#"+t).addClass("current")}function isValidDate(e){var t=/^\d{4}-\d{2}-\d{2}$/;return null!=e.match(t)}function updateAllMessageForms(){for(instance in ClassicEditor.instances)ClassicEditor.instances[instance].updateElement()}function livesearch(){var e=$("#searchform"),t=e.val(),a=e.parents("form").find(".js-type-select").val();console.log(a),null!==liveSearchXHR&&liveSearchXHR.abort(),setTimeout(function(){liveSearchXHR=$.get("/ajax/index_search",{q:t,type:a},function(e,t){$("#liveresults").html(e)})},300)}function modalOpen(e){$(".modal-window").css("display","none"),$(".modal-mask").css("display","block"),$(".modal-container").css("display","flex"),setTimeout(function(e){$(".modal-mask").addClass("modal-mask--show")},100),$("#"+e).css("display","block"),setTimeout(function(t){$("#"+e).addClass("modal-hide")},100)}function modalClose(e){$("#"+e).removeClass("modal-hide"),setTimeout(function(e){$(".modal-container").css("display","none")},500),$(".modal-mask").removeClass("modal-mask--show"),setTimeout(function(e){$(".modal-mask").css("display","none")},700)}function readURL(e){if(e.files&&e.files[0]){var t=new FileReader;t.onload=function(e){$("#blah").attr("src",e.target.result).width(250).height(200).show(),$(".ready-for-upload").show(),$(".not-ready-for-upload").hide()},t.readAsDataURL(e.files[0])}}function getFormData(e){var t=e.serializeArray(),a={};return $.map(t,function(e,t){a[e.name]=e.value}),a}$(document).ready(function(){var e=$("#callback_form");ga(function(t){var a=t.get("clientId");e.find('[name="ga_cid"]').val(a).trigger("change")}),$(".js-input-add-entity").each(function(){var e=$(this);e.data("count",1),e.data("markup",e.outerHTML())}),$("input[data-mask]").each(function(){var e=$(this),t=""+e.data("mask");e.mask(t)});var t=window.location.hash.substr(1);t.length>0&&changeTab("div.tabs a[data-tab="+t+"]"),$("div.tabs a").click(function(e){e.preventDefault(),changeTab($(this))}),$("div.tabz a").click(function(e){e.preventDefault();var t=$(this).data("tab");$("div.tabz a").removeClass("btn_theme_radio_active"),$(".entity-about-articl").removeClass("current"),$(this).addClass("btn_theme_radio_active"),$("#"+t).addClass("current")}),$(".js-simple-select").selectize({render:{item:function(e,t){return"<div data-address='"+e.address+"'>"+e.text+"</div>"}}}),$(".selectize-input").find("input").prop("disabled","disabled"),$(".js-header-location").selectize({openOnFocus:!1}),$(".question-slider").slick({infinite:!1,slidesToShow:3,slidesToScroll:1,dots:!0,responsive:[{breakpoint:1199.98,settings:{slidesToShow:3}},{breakpoint:991.98,settings:{slidesToShow:2}},{breakpoint:767.98,settings:{slidesToShow:1}}]}),$(".entity-slider").slick({infinite:!1,slidesToShow:4,slidesToScroll:1,dots:!0,responsive:[{breakpoint:1199.98,settings:{slidesToShow:3}},{breakpoint:991.98,settings:{slidesToShow:2}},{breakpoint:767.98,settings:{slidesToShow:1}}]}),$('input[name="client_phone"]').mask("+7 (999) 999-9999");var a={type:"inline",fixedContentPos:!1,focus:"#name",fixedBgPos:!0,overflowY:"auto",closeBtnInside:!0,callbacks:{beforeOpen:function(){$("form#callback_form").find('input[name="target_id"]').val(this.st.el.data("doc-id")),$("form#callback_form").find('input[name="status"]').val(this.st.el.data("status")),$("form#callback_form").find("#doctor_name").val(this.st.el.data("dname")),$("form#callback_form").find("#medcenter_name").val(this.st.el.data("dname"))}}},n=$("form#callback_form");$("#save_order").click(function(e){if(e.preventDefault(),ga("send","event",{eventCategory:"zapisatsya",eventAction:"click"}),yaCounter47714344.reachGoal("registration"),n[0].checkValidity()){var t=new FormData(n[0]);console.log(getFormData(n)),t.ga_cid=$.getJSON("/callback/newDoc",getFormData(n)).done(function(e){$.magnificPopup.open({items:{src:'<div class="white-popup"><p><strong>Спасибо!</strong> Ваша заявка принята. Мы вам перезвоним!</p></div>'},type:"inline"})})}}),$("body").on("click","a.popup-with-form",function(e){$(this).magnificPopup(a).magnificPopup("open")});$(".js-search-select").selectize({render:{option:function(e,t){return"Специализации"==e.optgroup?'<div><span class="option-doc-spec"><span class="option-text">'+e.text+'</span><span class="option-count">'+e.count+"</span></span></div>":"Врачи"==e.optgroup?'<div><span class="option-doc-item"><span class="option-doc-img"><img src="'+e.img+'" alt=""></span><span class="option-doc-info"><span class="option-doc-name">'+e.text+'</span><span class="option-doc-spec">'+e.spec+"</span></span></span></div>":void 0}}});$(".js-select-region").change(function(){var e=$(this).val();if("region-1"==e);else if("region-2"==e);$.ajax({type:"get",url:ajaxUrl,dataType:"json",success:function(e){$(".js-search-select")[0].selectize.clearOptions();for(var t=0;t<e.length;t++)$(".js-search-select")[0].selectize.addOption(e[t])}})}),$(".nav-toggle").click(function(){$(this).toggleClass("open"),$(".mobile-menu").slideToggle("fast",function(){$(".nav-toggle").hasClass("open")||$(".mobile-menu").removeAttr("style")})}),pickmeup.defaults.locales.ru={days:["Воскресенье","Понедельник","Вторник","Среда","Четверг","Пятница","Суббота"],daysShort:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],daysMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],months:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],monthsShort:["Янв","Фев","Мар","Апр","Май","Июн","Июл","Авг","Сен","Окт","Ноя","Дек"]},$(".js-custom-date .date-radio__item").each(function(){var e=$(this);pickmeup(e[0],{format:"Y-m-d",locale:"ru",minDate:new Date,hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e),e[0].addEventListener("pickmeup-change",function(t){e.find(".date-radio__text").html(t.detail.formatted_date),e.find(".js-custom-date-val").val(t.detail.formatted_date);var a=t.detail.date.toString().split(" ");e.find('input[name="dayweek"]').val(a[0]),e.find('input[type="radio"]').prop("checked",!0),get_times(e.closest("div.doc-line").data("id"),a[0],"",e.parent().parent().parent())})}),$(".js-appointment-book-date").each(function(){var e=$(this);pickmeup(e[0],{format:"Y-m-d",locale:"ru",minDate:new Date,hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e),e[0].addEventListener("pickmeup-change",function(t){e.find(".appointment-book-small__date-text").html(t.detail.formatted_date),e.find(".js-custom-date-val").val(t.detail.formatted_date);var a=t.detail.date.toString().split(" ");e.find('input[name="dayweek"]').val(a[0]),console.log(e.closest(".search-result__item").length),e.closest("div.search-result__item").length?get_times(e.closest("div.search-result__item").data("id"),a[0],"",e.parent().parent().parent()):get_times(e.closest(".search-result__item").data("id"),a[0],"",e.parent().parent().parent())})}),$('.date-radio input[type="radio"]').change(function(){var e=$(this);if(get_times($(this).closest(".search-result__item").data("id"),$(this).val(),e),e.is(":checked")&&"custom"!=e.val()){var t=e.closest(".date-radio").siblings(".js-custom-date").find(".date-radio__item");t.find(".date-radio__text").html("Выбрать дату"),t.find(".js-custom-date-val").val("")}}),$(".appointment-book-big__custom-time").click(function(){var e=$(this);e.closest(".appointment-book-big").find(".appointment-book-big__time-item_additional").show(),e.remove()}),$(".set-rating__btn").mouseenter(function(){$(this).addClass("set-rating__btn_highlight").prevUntil().addClass("set-rating__btn_highlight")}).mouseleave(function(){$(this).closest(".set-rating").find(".set-rating__btn").removeClass("set-rating__btn_highlight")}).click(function(){var e=$(this),t=$(this).closest(".set-rating"),a=e.closest(".set-rating").find("input"),n=e.data("rating");t.find(".set-rating__btn").removeClass("set-rating__btn_chosen"),e.addClass("set-rating__btn_chosen").prevUntil().addClass("set-rating__btn_chosen"),a.val(n)}),$(".js-edit-img-modal").magnificPopup({type:"inline",items:{src:"#edit-img-modal"},midClick:!0}),$(".gallery > a").magnificPopup({type:"image",gallery:{enabled:!0,preload:[0,2],navigateByImgClick:!0,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',tPrev:"Предыдущее",tNext:"Следующее",tCounter:'<span class="mfp-counter">%curr% из %total%</span>'}}),$(".js-input-add-btn").click(function(){var e=$(this),t=e.closest(".js-input-add-container"),a=t.find(".js-input-add-entity"),n=$(a.data("markup"));n.removeClass("js-input-add-entity"),n.removeClass("js-input-add-entity"),n.find("select, input, textarea").each(function(){var e=$(this),t=e.prop("name"),a=t.replace(/skills\[0\]/g,"skills["+entityCount+"]");e.prop("name",a)}),n.find("input[data-mask]").each(function(){var e=$(this),t=""+e.data("mask");e.mask(t)}),n.find(".js-simple-select").selectize(),t.find(".js-input-lines").append(n),a.data("count",++entityCount)}),$(document).on("click",".js-input-remove-btn",function(){$(this).parent().remove(),entityCount--}),$("#filtersGroup .btn-radio").click(function(){if($(this).prev("input[name=sort]").prop("checked")){var e=$("input[name=order]:checked").val();e="asc"==e?"desc":"asc",$("input[name=order]").val([e]).trigger("change")}}),$(".btn-radio").click(function(){var e=$(this).prev().prop("name"),t=$(this).prev().prop("value");$("input[name="+e+"]").val([t]).trigger("change")}),$(".js-add-select-tag").click(function(){var e=$(this),t=e.closest(".js-add-select-tags"),a=t.find(".js-tags-list"),n=t.find(".js-simple-select option[selected]"),s=n.html(),i=n.prop("value"),o=t.find(".js-tags-line"),r=!1;if(o.find(".js-tag").each(function(){$(this).data("value")==i&&(r=!0)}),r)return!1;var l='<div class="tags-line__item js-tag" data-value="'+i+'"><span class="tags-line__item-text">'+s+'</span><button class="js-remove-tag tags-line__item-remove"><i class="fa fa-times" aria-hidden="true"></i></button></div>';o.append(l),a.val(a.val()+","+i)}),$(document).on("click",".js-remove-tag",function(){var e=$(this),t=e.closest(".js-add-select-tags"),a=t.find(".js-tags-list"),n=e.closest(".js-tag").data("value"),s=a.val().replace(n,"");a.val(s),e.closest(".js-tag").remove()}),$(".accordion__title").click(function(){var e=$(this),t=e.closest(".accordion");if(t.hasClass("accordion_mobile")&&window.innerWidth>767.98)return!1;t.find(".accordion__body").slideToggle()}),$(".date-text-input input").each(function(){var e=$(this);e.is("[data-pmu-date]")&&pickmeup(e[0],{default_date:!1,format:"Y-m-d",locale:"ru",hide_on_select:!0,position:function(){return{top:"100%"}}}),$("body > .pickmeup").detach().appendTo(e.parent())}),$('.file-upload__btn input[type="file"]').change(function(){}),$(".hours-appointment-select").each(function(){var e=$(this),t=e.find(".hours-appointment-select__inner"),a=e.find(".hours-appointment-select__item").width(),n=e.find(".hours-appointment-select__item:first-child").offset().left,s=e.find(".hours-appointment-select__item:last-child").offset().left+a;t.css("width",s-n+2+"px")});try{$(".js-file-item").LiFileType()}catch(e){}$(".js-header-location").on("change",function(){var e=$(this).val();$.get("/setcity/"+e,function(e){"success"==e.message&&window.location.replace(e.url)})}),$("a[rel*=modal-link]").on("click",function(e){e.preventDefault(),modalOpen($(this).attr("href").substr(1))}),$(".modal-close").on("click",function(e){$(this).attr("data-flag");modalClose($(this).parent(".modal-window").attr("id"))}),$("#searchform").on("input",function(e){livesearch();var t=$(this).val();0==t.length&&$(this).hasClass("live-search--fold")||$(".live-search").addClass("live-search--fold"),0==t.length&&$(".live-search").removeClass("live-search--fold")}),$(".search-bar__item search-bar__item_search").on("focusout",function(e){$(".live-search").removeClass("live-search--fold")}),$(".upload-photo__upload-btn .not-ready-for-upload").on("click",function(){$("input[type=file]").trigger("click")}),$(".upload-photo__upload-btn .ready-for-upload").on("click",function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var e=$("#upload-photo__input").prop("files")[0],t=new FormData;t.append("file",e),$.ajax({url:"/cabinet/doctor/personal/photo-upload",dataType:"script",cache:!1,contentType:!1,processData:!1,data:t,type:"post",success:function(){location.reload()}})}),$(".js-entity-type-search").change(function(){var e=$(this).val();"medcenters"==e?($(".js-additional-search").show(),$(".index-search-bar").addClass("index-intro__search-bar_additional-search")):"all"==e&&($(".js-additional-search").hide(),$(".index-search-bar").removeClass("index-intro__search-bar_additional-search"))}),$(".search-bar__line .js-type-select").change(function(){var e=$(this).parents("form").find(".js-search-input"),t=void 0;"doctor"==$(this).val()?t="Введите специальность или фамилию врача":"medcenter"==$(this).val()&&(t="Введите название клиник"),e.attr("placeholder",t)}),$(".js-anchor-link").on("click",function(){var e=$(this).text(),t=$(".article-content__main").find("h2:contains("+e+")");$("html, body").animate({scrollTop:t.offset().top},1e3)}),setTimeout(function(){var e=document.querySelector(".entity-line__about-text");e&&(e.style.height=e.scrollHeight+"px")},1e3),$(".entity-line__about-text-more").on("click",function(){$(this).parents(".entity-line__about-block").find(".entity-line__about-text").toggleClass("less")});for(var s=document.querySelectorAll(".editor"),i=0;i<s.length;++i)ClassicEditor.create(s[i]);$(".submit-form-with-editor-button").on("click",function(e){e.preventDefault(),updateAllMessageForms(),$(".form-with-editor").submit()});var o=5;$("#loadMoreComments").click(function(e){e.preventDefault();var t=$(this).data("url");$.get(t,{offset:o},function(e){$("#hidden-comments").append($(e.view)),o=e.offset,$("#commentsLeftText").text(e.left),e.left<=0&&$("#loadMoreComments").prop("disabled",!0)})}),$(".comment-user-rate").each(function(){var e=$(this).find("a.comment-user-rate-up"),t=$(this).find("a.comment-user-rate-down");$(this).find("a").click(function(a){var n=$(this),s=n.data("url");parseInt(n.text());return $.get(s,function(a){e.text(a.up),t.text(a.down)}),a.preventDefault(),!1})}),$("#save_comment").click(function(e){e.preventDefault(),$("#comment_form")[0].checkValidity()?$.getJSON("/comment/new",{owner_id:$("#owner_id").val(),owner_type:$("#owner_type").val(),user_email:$("#user_email").val(),user_name:$("#user_name").val(),text:$("#comment_text").val(),user_rate:$("input[name=user_rate]:checked").val(),date_event:$("#date_event").val(),type:$("#type").val()}).done(function(e){$("#user_email").removeClass("has-warning"),$("#user_name").removeClass("has-warning"),$("#comment_text").removeClass("has-warning"),e.error?($("#user_email").addClass("has-warning"),$("#save_comment_mess_ok").html("<b>"+e.error+"</b>"),$("#save_comment_mess_ok").show()):e.id&&($("#save_comment_mess_ok").html("<b>Спасибо! Ваш комментарий отправлен на модерацию</b>"),$("#save_comment_mess_ok").show(),$("#comment_form")[0].reset())}):($("#user_email").addClass("has-warning"),$("#user_name").addClass("has-warning"),$("#comment_text").addClass("has-warning"))}),$("#confirm_code").click(function(){4==$("#phone_code").val().length?$.post("{{url('/comment/confirm-code')}}",{code:$("#phone_code").val(),_token:"{{ csrf_token() }}"}).done(function(e){e.error?($("#save_comment_mess_ok").removeClass("access").addClass("error").html("<b>"+e.error+"</b>"),$("#save_comment_mess_ok").slideDown(200)):e.id&&($("#code_confirm").slideUp(200),$("#save_comment_mess_ok").removeClass("error").addClass("access").html("<b>Спасибо! Ваш комментарий отправлен на модерацию</b>"),$("#save_comment_mess_ok").slideDown(200),$("#feedback__form")[0].reset())}):($("#user_name").addClass("has-warning"),$("#user_last_name").addClass("has-warning"),$("#text").addClass("has-warning"))}),$(".show-question-form button").on("click",function(){$(".question__form").slideToggle(300)}),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}});var r=6e4*(new Date).getTimezoneOffset(),l=new Date(Date.now()-r).toISOString().slice(0,-1),c=(l.slice(0,16),document.querySelector('input[type="datetime-local"]'));c&&(c.value=l.slice(0,16));var d=$(".desktop-datetime"),m=$(".mobile-datetime");m.find("input").val(""),d.is(":visible")?m.remove():d.remove();var u=$("#question__form");$("#question__form-send").click(function(){if(u[0].checkValidity()){var e=u.serialize();console.log(e),$.post("/question/add",e).done(function(e){$("#user-email").removeClass("has-warning"),$("#user-phone").removeClass("has-warning"),$("#user-birthday").removeClass("has-warning"),$("#user-gender").removeClass("has-warning"),$("#question-text").removeClass("has-warning"),modalOpen("question__modal"),e.error?($("#save_comment_mess_ok").removeClass("access").addClass("error").html("<b>"+e.error+"</b>"),$("#save_comment_mess_ok").show()):e.id&&($("#save_comment_mess_ok").removeClass("error").addClass("access").html("<b>Спасибо! Ваш комментарий отправлен на модерацию</b>"),$("#save_comment_mess_ok").show(),u[0].reset())})}else $("#user-email").val()?$("#user-email").removeClass("has-warning"):$("#user-email").addClass("has-warning"),$("#user-phone").val()?$("#user-phone").removeClass("has-warning"):$("#user-phone").addClass("has-warning"),$("#user-birthday").val()&&isValidDate($("#user-birthday").val())?$("#user-birthday").removeClass("has-warning"):$("#user-birthday").addClass("has-warning"),$("#user-birthday-mobile").val()&&isValidDate($("#user-birthday-mobile").val())?$("#user-birthday-mobile").removeClass("has-warning"):$("#user-birthday-mobile").addClass("has-warning"),$("#user-gender").val()?$("#user-gender").removeClass("has-warning"):$("#user-gender").addClass("has-warning"),$("#question-text").val()?$("#question-text").removeClass("has-warning"):$("#question-text").addClass("has-warning")}),$(".search_event").on("click",function(){ga("send","event",{eventCategory:"poisk_glavnaya",eventAction:"click"})});var p=window.pageYOffset;window.onscroll=function(){var e=document.getElementById("navbar"),t=window.pageYOffset;p>t?0==t&&(e.style.top="80px",e.classList.remove("navbar-pattern"),document.getElementById("nav-top-container").classList.add("mr_0"),document.getElementById("nav-top-container").classList.remove("ml_0")):(e.style.top="0px",e.classList.add("navbar-pattern"),document.getElementById("nav-top-container").classList.add("ml_0"),document.getElementById("nav-top-container").classList.remove("mr_0")),p=t},window.onload=function(){var e=document.getElementById("navbar");/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||(e.style.position="fixed"),window.pageYOffset>80&&(e.style.top="0px",e.classList.add("navbar-pattern"),document.getElementById("nav-top-container").classList.add("ml_0"),document.getElementById("nav-top-container").classList.remove("mr_0"))}}),jQuery.fn.outerHTML=function(){return $($("<div></div>").html(this.clone())).html()};var liveSearchXHR=null;$(".section-question__content").length;
