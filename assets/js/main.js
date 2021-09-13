(function ($) {
    "use strict";
    if (991 < $(window).width()) {
        $('.menu-item-has-children>.dropdown-toggle').hover(function () {
            var items = $(this).attr('title');
            // at first remove all active
            $(this).parents('.navbar-nav').find('.dropdown-menu').removeClass('active');
            $(this).parents('.navbar-nav').find('.dropdown-menu').css('display', 'none');

            $(this).parent('.menu-item-has-children').find('.dropdown-menu').addClass('active');
            $(this).parent('.menu-item-has-children').find('.dropdown-menu').attr('data-title', items);
            $(this).parent('.menu-item-has-children').find('.dropdown-menu.active').css('display', 'flex');
        });

        $('.menu-item-has-children a').removeAttr('data-toggle');

        $(window).on('click', function (e) {
            $('.dropdown-menu').removeClass('active');
            $('.dropdown-menu').css('display', 'none');
        });
        $('.header_menu li').not('.menu-item-has-children,.dropdown-menu li').hover(function () {
            $('.dropdown-menu').removeClass('active');
            $('.dropdown-menu').css('display', 'none');
        });
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

    $('.our-community').slick({
            autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
            dots: false,
            prevArrow: "<img src='../wp-content/themes/keck-observatory/assets/img/left.png' class='img-fluid'>",
            nextArrow: "<img src='../wp-content/themes/keck-observatory/assets/img/left.png' class='img-fluid right'>",
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        dots: true
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
                        dots: true
                    }
                }
            ]
        }
    );

    $('.featured_video_carousel').slick({
        autoplay: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        infinite: true,
        dots: true,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    arrows: false,
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                    arrows: false,
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                }
            }
        ]

    });
    // load carousels as featured item
    $('body').on('click', '.featured_video_carousel .carousel_item', function (e) {
        let current_post_id = $(this).find('input[name=carousel_id]').val();
        let ajax_data = {
            action: "load_featured_carousel",
            carousel_id: current_post_id,
        };
        $.post(carousel_object.ajax_url, ajax_data, function (response) {
            $('body').find('.post_section').html(response);
        });
    });

    $('.testimonials').slick({
        autoplay: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        dots: false,
        prevArrow: "<img src='../wp-content/themes/keck-observatory/assets/img/testimonial-left.png' class='img-fluid left'>",
        nextArrow: "<img src='../wp-content/themes/keck-observatory/assets/img/testimonial-left.png' class='img-fluid right'>",
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    slidesToShow: 1,
                    dots: true
                }
            }
        ]
    });

})(window.jQuery);
