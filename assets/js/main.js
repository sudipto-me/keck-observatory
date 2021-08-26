(function ($) {
    "use strict";
    if (991 < $(window).width()) {
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
        // $('.header_menu li').not('.menu-item-has-children').hover(function(){
        //     $('.dropdown-menu').removeClass('active');
        //     $('.dropdown-menu').css('display', 'none');
        // });
    }



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

    $('.our-community').owlCarousel({
        autoplay: false,
        loop: true,
        smartSpeed: 1500,
        margin: 50,
        nav: true,
        dots: false,
        navText: ["<img src='../wp-content/themes/keck-observatory/assets/img/left.png' class='img-fluid'>","<img src='../wp-content/themes/keck-observatory/assets/img/right.png' class='img-fluid'>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            600: {
                items: 1
            },
            800: {
                items: 1
            },
            992: {
                items: 1
            }
        }
    });

})(window.jQuery);
