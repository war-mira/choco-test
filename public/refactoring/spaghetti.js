let
    overlayFlag = false,
    burgerFlag  = false;

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

function comebackerOpen(modalId) {
    let $comebackOverlay = $("#" + modalId)
        .find(".comeback-overlay");

    $comebackOverlay.addClass("comeback-overlay--show");

    overlayFlag = true;
}

function comebackerClose(modalId) {
    let $comebackOverlay = $("#" + modalId)
        .find(".comeback-overlay");

    $comebackOverlay.removeClass("comeback-overlay--show");

    overlayFlag = false;
}

function isEmpty(el) {
    return !$.trim(el.html());
}

function roundToFour(num) {
    // ceiled = Math.ceil(num);
    return Math.round(num / 4) * 4;
}

$(function () {
    // Setting up bootstrap datepicker
    $(".input-datepicker").datepicker({
        format        : "dd.mm.yyyy",
        language      : "ru",
        autoclose     : true,
        todayHighlight: true,
        orientation   : "bottom auto",
        maxViewMode   : 0,
        startDate     : 'today',
    });

    $('input[name="birthday"]').datepicker({
        format     : "d MM yyyy",
        language   : "ru",
        autoclose  : true,
        orientation: "bottom auto",
        maxViewMode: "years",
    });

    $(document)
        .on("click", ".burger-menu", function (e) {
            if (burgerFlag == false) {
                $(".burger-menu")
                    .addClass("burger-menu--x");
                $(".main-nav-dropdown")
                    .addClass("dropdown--fold");

                burgerFlag = true;
            } else {
                $(".main-nav-dropdown")
                    .removeClass("dropdown--fold");
                $(".burger-menu")
                    .removeClass("burger-menu--x");

                burgerFlag = false;
            }
        })
        .on("click", ".hidden-phone__btn", function (e) {
            $(".hidden-phone-dropdown")
                .addClass("hidden-phone-dropdown--fold");
        })
        .on("click", "body", function (e) {
            if (
                e.target.id !=
                "checkboxes" &&
                $(e.target)
                    .closest(".main-nav-dropdown").length ==
                0
            ) {
                $(".main-nav-dropdown")
                    .removeClass("dropdown--fold");
                $(".burger-menu")
                    .removeClass("burger-menu--x");
            }

            if (
                e.target.id !=
                "checkboxes" &&
                $(e.target)
                    .closest(".hidden-phone-dropdown--fold").length ==
                0
            ) {
                $(".hidden-phone-dropdown")
                    .removeClass(
                        "hidden-phone-dropdown--fold"
                    );
            }
        })
        .on("input", "#searchform", function (e) {
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
        })
        .on("focusout", "#searchform", function (e) {
            $(".live-search")
                .removeClass("live-search--fold");
        })
        .on("change", ".auth-type__radio", function (e) {
            let formState = $(".auth-type__radio:checked")
                .val();

            $(".account-tab")
                .removeClass("account-tab--active");
            $("." + formState)
                .addClass("account-tab--active");
        })
        .on("click", ".modal-close", function (e) {
            let formFlag = $(this)
                .attr("data-flag");

            if (formFlag !=
                "comebacker" ||
                overlayFlag ==
                true) {
                let modalId = $(this)
                    .parent(".modal-window")
                    .attr("id");

                modalClose(modalId);
                comebackerClose(modalId);
            } else {
                let modalId = $(this)
                    .parent(".modal-window")
                    .attr("id");

                comebackerOpen(modalId);
            }
        })
        .on("click", ".comeback-overlay__leave-btn", function (e) {
            let modalId = $(this)
                .attr("data-id");

            // $(this).parent('.modal-window').find('.modal-close').hide();

            modalClose(modalId);
            comebackerClose(modalId);
        })
        .on("click", ".comeback-overlay__continue-btn", function (e) {
            let modalId = $(this)
                .attr("data-id");

            comebackerClose(modalId);
        })
        .on("click", "a[rel*=modal-link]", function (event) {
            event.preventDefault();

            let modalLink = $(this)
                .attr("href");

            modalOpen(modalLink.substr(1));
        })
        .on("change", ".page-tabs-links__radio", function (e) {
            let activeTab = $(this)
                .val();

            $(".page-tab")
                .hide();
            $(activeTab)
                .fadeIn("fast");
        })
        .on("click", ".error", function () {
            $(this)
                .removeClass("error");
        });

    $(".city-select")
        .hover(
            function () {
                $(".city-dropdown")
                    .toggleClass("city-dropdown--fold");
            },
            function () {
                $(".city-dropdown")
                    .toggleClass("city-dropdown--fold");
            }
        );

    $(".signup-btn")
        .hover(
            function () {
                $(".auth-dropdown")
                    .toggleClass("auth-dropdown--fold");
            },
            function () {
                $(".auth-dropdown")
                    .toggleClass("auth-dropdown--fold");
            }
        );

    $("select")
        .each(function () {
            let $this           = $(this),
                numberOfOptions = $(this)
                    .children("option").length;

            $this.addClass("select-hidden");
            $this.wrap('<div class="select"></div>');
            $this.after('<div class="select-styled"></div>');

            let $styledSelect  = $this.next("div.select-styled"),
                selectedOption = $this.children("option:selected")
                                      .text();

            $styledSelect.text(selectedOption);

            let $list = $("<ul />", {class: "select-options"})
                .insertAfter(
                    $styledSelect
                );

            for (let i = 0; i < numberOfOptions; i++) {
                $("<li />", {
                    text: $this
                        .children("option")
                        .eq(i)
                        .text(),
                    rel : $this
                        .children("option")
                        .eq(i)
                        .val()
                }).appendTo($list);
            }

            let $listItems = $list.children("li");

            $styledSelect.click(function (e) {
                e.stopPropagation();

                $("div.select-styled.active")
                    .not(this)
                    .each(function () {
                        $(this)
                            .removeClass("active")
                            .next("ul.select-options")
                            .hide();
                    });

                $(this)
                    .toggleClass("active")
                    .next("ul.select-options")
                    .toggle();
            });

            $listItems.click(function (e) {
                e.stopPropagation();

                $styledSelect.text($(this).text()).removeClass("active");
                $this.val($(this).attr("rel")).trigger("change");
                $list.hide();
            });

            $(document)
                .click(function () {
                    $styledSelect.removeClass("active");
                    $list.hide();
                });
        });

    $(".city-dropdown__ul a")
        .click(function (e) {
            e.preventDefault();

            let cityId   = $(this).data("id"),
                cityName = $(this).text();

            $.post(
                route("city.set"),
                {
                    _token: "{{ csrf_token() }}",
                    id    : cityId
                },
                function (response) {
                    window.location.reload();
                }
            );
        });

    $(".swiper-container")
        .kinetic({
            filterTarget: function (target, e) {
                if (!/down|start/.test(e.type)) {
                    return !/area|a|input/i.test(target.tagName);
                }
            },
            y           : false,
            slowdown    : 0.9
        });
});
