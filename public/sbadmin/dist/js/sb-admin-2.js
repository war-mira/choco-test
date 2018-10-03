/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function () {
    $('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function () {
    $(window).bind("load resize", function () {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function () {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }

    $('#doctor-select-input').on("keyup", function () {
        let query = $(this).val();
        let type = $(this).data('type');
        if (query.length <= 0){
            $("#doctors-results").hide();
        }else {
            $.get('/ajax/autocomplete', {query:query, type:type}, function (data) {
                $("#doctors-results").html("").show();
                $.each(data, function (index) {
                    $("#doctors-results").append('<li class="autocomplite-result-li"><a data-id="'+ data[index].id +'">'+ data[index].lastname+' '+ data[index].firstname + ' '+ data[index].patronymic + '</a></li>');
                });
            });
        }
    });

    $('#doctors-results').on('click', 'a', function () {
        let id = $(this).data('id');
        let name = $(this).text();
        $('#doctor-real-input').val(id);
        $('#doctor-select-input').val(name);
        $("#doctors-results").hide();
        $('#medcenter-select-input').html('');
        $.get('/ajax/doctor/medcenters', {id:id}, function (data) {
            console.log(data);
            $.each(data, function (index) {
                $('#medcenter-select-input').append('<option value="'+ data[index].id+'">'+data[index].name+'</option>')
            })
        });
    });
});
