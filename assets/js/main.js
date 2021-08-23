(function ($) {
    "use strict";
    $('.menu-item-has-children>.dropdown-toggle').hover(function () {
        var items = $(this).attr('title');
        $('.dropdown-toggle').parents('.navbar-nav').find('.dropdown-menu').addClass('active');
        $('.dropdown-toggle').parents('.navbar-nav').find('.dropdown-menu').attr('data-title', items);
        $('.dropdown-toggle').parents('.navbar-nav').find('.dropdown-menu.active').css('display', 'flex');
    });
    $('.menu-item-has-children a').removeAttr('data-toggle');

    $(window).on('click', function (e) {
        $('.dropdown-menu').removeClass('active');
        $('.dropdown-menu').css('display', 'none');
    });


    // Header fix js
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 1) {
            $(".site_header").addClass("shrink-header");
        } else {
            $(".site_header").removeClass("shrink-header");
        }
    });

    // Search Toggle
    $("body").on("click", ".search_trigger img", function () {
        $(this).parents("li").addClass("clicked");
        $(this).addClass("search_close");
    });

    $("body").on("click", ".search_trigger .search_close", function () {
        $(this).parents("li").removeClass("clicked");
        $(this).removeClass("search_close");
    });
})(window.jQuery);
