(function ($) {
    "use strict";

    new WOW().init();

    /*---background image---*/
    function dataBackgroundImage() {
        $('[data-bgimg]').each(function () {
            var bgImgUrl = $(this).data('bgimg');
            $(this).css({
                'background-image': 'url(' + bgImgUrl + ')', // + meaning concat
            });
        });
    }

    $(window).on('load', function () {
        dataBackgroundImage();
    });


    /*---stickey menu---*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".sticky-header").removeClass("sticky");
        } else {
            $(".sticky-header").addClass("sticky");
        }
    });



    /*---slider activation---*/
    var $slider = $('.slider_area');
    // var $img=$('.slider_area1');
    if ($slider.length > 0) {
        $slider.owlCarousel({
            animateOut: 'fadeOut',
            autoplay: true,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 6000,
            items: 1,
            dots: true,
            navText: ['<i class="ion-ios-arrow-left" style="color:white;"></i>', '<i class="ion-ios-arrow-right" style="color:white;"></i>'],
        });
    }

    // $img.hide();
    /*---product column4 activation---*/
    var $porductColumn4 = $('.product_column4');
    if ($porductColumn4.length > 0) {
        $porductColumn4.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            autoplay: true,
            autoplayTimeout: 2000,
            items: 4,
            dots: false,
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 4,
                    margin: 20,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 7,
                },
                1200: {
                    items: 8,
                },
            }
        });
    }




    /*---testimonial activation---*/
    var $testimonial = $('.testimonial_collumn1');
    if ($testimonial.length > 0) {
        $testimonial.owlCarousel({
            autoplay: true,
            loop: true,
            nav: true,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 2,
            dots: true,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 1,
                    margin: 20,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                },
                1200: {
                    items: 2,
                },
            }
        });
    }


    var $ourpartners = $('.partners-scroll');
    if ($ourpartners.length > 0) {
        $ourpartners.owlCarousel({
            autoplay: true,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 8000,
            items: 2,
            dots: true,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                },
                390: {
                    items: 3,
                    margin: 20,
                },
                490: {
                    items: 4,
                },
                690: {
                    items: 5,
                },
                1023:{
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1439:{
                    items: 6, 
                }
            }
        });
    }


    /*---product column5 activation---*/
    var $porductColumn5 = $('.product_column5');
    if ($porductColumn5.length > 0) {
        $porductColumn5.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            items: 4,
            dots: false,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                280:{
                    items: 2,
                    margin: 60,
                },
                320:{
                    items: 2,
                    margin:30,
                },
                360: {
                    items: 2,
                    margin:20,
                },
                390:{
                    items: 2,
                    margin:10,
                },
                475: {
                    items: 3,
                    margin: 10,
                },
                635: {
                    items: 4,
                    margin:10,
                },
                785:{
                    items: 5,
                    margin:10,
                },
                992: {
                    items: 5,
                    margin:10,
                },
                1023:{
                    items: 4,
                    margin:20,
                },
                1200: {
                    items: 5,
                    margin:30,
                },
                1300: {
                    items: 5,
                    margin:20,
                },
                1440:{
                    items: 5,
                    margin:10,
                },
                1500:{
                    items: 6,
                    margin:10,
                }
            }
        });
    }
    var $porductColumn3 = $('.product_column3');
    if ($porductColumn3.length > 0) {
        $porductColumn3.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            items: 4,
            dots: false,
            navText: ['<i class="ion-ios-arrow-left" style="color:white;"></i>', '<i class="ion-ios-arrow-right" style="color:white;"></i>'],
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                280:{
                    items: 2,
                    margin:100,
                   
                },
                300:{
                    items: 2,
                    margin:90,
                },
                360:{
                    items: 2,
                    margin:10,
                   
                },
                375: {
                    items: 2,
                    margin:10,
                    
                },
                490: {
                    items: 3,
                    margin:70,
                },
                607: {
                    items: 4,
                    margin:55,
                },
                768:{
                    items: 4,
                    margin:10,
                },
                890:{
                    items: 5,
                    margin:5,
                },
                992:{
                    items: 5,
                    margin:20,
                },
                1023: {
                    items: 4,
                    margin:15,
                   
                },
                1200:{
                    items: 4,
                    margin:20,
                },
                1370: {
                    items: 5,
                    margin:7,
                },
            }
        });
    }

    var $porductColumn2 = $('.product_column2');
    if ($porductColumn2.length > 0) {
        $porductColumn2.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            items: 4,
            dots: false,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                280:{
                    items: 2,
                    margin: 90,
                },
                320:{
                    items: 2,
                    margin:60,
                },
                360: {
                    items: 2,
                    margin:40,
                },
                390:{
                    items: 2,
                    margin:30,
                },
                410:{
                    items: 2,
                    margin:50,
                },
                475: {
                    items: 3,
                    margin: 40,
                },
                635: {
                    items: 4,
                    margin:40,
                },
                785:{
                    items: 5,
                    margin:40,
                },
                992: {
                    items: 5,
                    margin:10,
                },
                1023:{
                    items: 4,
                    margin:40,
                },
                1200: {
                    items: 5,
                    margin:60,
                },
                1300: {
                    items: 5,
                    margin:40,
                },
                1440:{
                    items: 5,
                    margin:50,
                },
            }
        });
    }
    var $clientTestimonials = $('.client_testimonials');
    if ($clientTestimonials.length > 0) {
        $clientTestimonials.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            items: 4,
            dots: false,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            margin: 30,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 2,
                    margin: 20,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 4,
                },
            }
        });
    }


    /*---product d column4 activation---*/
    var $porductDColumn4 = $('.product_d_column4');
    if ($porductDColumn4.length > 0) {
        $porductDColumn4.on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: true,
            nav: false,
            autoplay: true,
            autoplayTimeout: 8000,
            items: 4,
            dots: false,
            margin: 30,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                300: {
                    items: 2,
                    margin: 20,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 4,
                },
            }
        });
    }

    /*---brand container activation---*/
    var $brandContainer = $('.brand_container');
    if ($brandContainer.length > 0) {
        $('.brand_container').on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: true,
            nav: false,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 6,
            margin: 20,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                576: {
                    items: 3,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                },
                1200: {
                    items: 6,
                },
            }
        });
    }


    /*---brand container3 activation---*/
    var $brandContainer3 = $('.brand_container3');
    if ($brandContainer3.length > 0) {
        $('.brand_container3').on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target).find('.owl-item').removeClass('last').eq(event.item.index + event.page.size - 1).addClass('last')
        }).owlCarousel({
            autoplay: true,
            loop: true,
            nav: false,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 3,
            margin: 20,
            dots: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 2,
                },
                1200: {
                    items: 3,
                },
            }
        });
    }


    /*---blog column3 activation---*/
    var $blogColumn3 = $('.blog_column3');
    if ($blogColumn3.length > 0) {
        $('.blog_column3').owlCarousel({
            autoplay: true,
            loop: false,
            nav: true,
            navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
            autoplay: true,
            autoplayTimeout: 3000,
            items: 3,
            dots: false,
            margin: 30,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: false
                },
                768: {
                    items: 3,
                    loop: false
                },
                992: {
                    items: 3,
                    loop: false
                },
                1200: {
                    items: 4,
                    loop: false
                },
            }
        });
    }







    /*---blog thumb activation---*/
    var $blogThumbActive = $('.blog_thumb_active');
    if ($blogThumbActive.length > 0) {
        $('.blog_thumb_active').owlCarousel({
            autoplay: true,
            loop: true,
            nav: true,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 1,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        });
    }


    /*---single product activation---*/
    var $singleProductActive = $('.single-product-active');
    if ($singleProductActive.length > 0) {
        $('.single-product-active').owlCarousel({
            autoplay: false,
            loop: false,
            nav: true,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 4,
            margin: 0,
            dots: false,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    
                },
                240: {
                    items: 2,
                },
                400: {
                    items: 3,
                },
                550: {
                    items: 4,
                },
                768:{
                    items: 2,
                },
                992:{
                    items: 3,
                },
                1023:{
                    items: 4,
                },
                1439: {
                    items: 6,

                },

            }
        });
    }

    /*---product navactive activation---*/
    var $productNavactive = $('.product_navactive');
    if ($productNavactive.length > 0) {
        $('.product_navactive').owlCarousel({
            autoplay: true,
            loop: true,
            nav: true,
            autoplay: false,
            autoplayTimeout: 8000,
            items: 4,
            dots: false,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                250: {
                    items: 2,
                },
                480: {
                    items: 3,
                },
                768: {
                    items: 4,
                },

            }
        });
    }

    $('.modal').on('shown.bs.modal', function (e) {
        $('.product_navactive').resize();
    })

    $('.product_navactive a').on('click', function (e) {
        e.preventDefault();

        var $href = $(this).attr('href');

        $('.product_navactive a').removeClass('active');
        $(this).addClass('active');

        $('.product-details-large .tab-pane').removeClass('active show');
        $('.product-details-large ' + $href).addClass('active show');

    })

    /*--- video Popup---*/
    $('.video_popup').magnificPopup({
        type: 'iframe',
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

    /*--- Magnific Popup Video---*/
    $('.port_popup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /*--- Tooltip Active---*/
    $('.action_links ul li a,.add_to_cart a,.footer_social_link ul li a').tooltip({
        animated: 'fade',
        placement: 'top',
        container: 'body'
    });

    /*--- niceSelect---*/
    $('.select_option').niceSelect();

    /*---  Accordion---*/
    $(".faequently-accordion").collapse({
        accordion: true,
        open: function () {
            this.slideDown(300);
        },
        close: function () {
            this.slideUp(300);
        }
    });



    /*---  ScrollUp Active ---*/
    $.scrollUp({
        scrollText: '<i class="fal fa-angle-up fa-lg"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*---countdown activation---*/

    $('[data-countdown]').each(function () {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<div class="countdown_area"><div class="single_countdown"><div class="countdown_number">%D</div><div class="countdown_title">days</div></div><div class="single_countdown"><div class="countdown_number">%H</div><div class="countdown_title">hours</div></div><div class="single_countdown"><div class="countdown_number">%M</div><div class="countdown_title">mins</div></div><div class="single_countdown"><div class="countdown_number">%S</div><div class="countdown_title">secs</div></div></div>'));

        });
    });

    /*---slider-range here---*/
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 25000,
        values: [0, 25000],
        slide: function (event, ui) {
            $("#amount").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
        }
    });
    $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
            " - Rs." + $("#slider-range").slider("values", 1));

    /*---elevateZoom---*/
    $("#zoom1").elevateZoom({
        gallery: 'gallery_01',
        responsive: true,
        cursor: 'crosshair',
        zoomType: 'inner',
        

    });


    /*---addClass/removeClass categories---*/
    $("#cat_toggle.has-sub > a").on("click", function () {
        $(this).removeAttr('href');
        $(this).toggleClass('open').next('.categorie_sub').toggleClass('open');
        $(this).parents().siblings().find('#cat_toggle.has-sub > a').removeClass('open');
    });


    /*---widget sub categories---*/
    $(".sub_categories1 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories1').slideToggle('medium');
    });

    /*---widget sub categories---*/
    $(".sub_categories2 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories2').slideToggle('medium');
    });

    /*---widget sub categories---*/
    $(".sub_categories3 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories3').slideToggle('medium');
    });
    /*---widget sub categories---*/
    $(".sub_categories4 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories4').slideToggle('medium');
    });

    /*---widget sub categories---*/
    $(".sub_categories5 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories5').slideToggle('medium');
    });

    /*---widget sub categories---*/
    $(".sub_categories6 > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_categories6').slideToggle('medium');
    });


    /*---MailChimp---*/
    $('#mc-form').ajaxChimp({
        language: 'en',
        callback: mailChimpResponse,
        // ADD YOUR MAILCHIMP URL BELOW HERE!
        url: 'http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef'

    });
    function mailChimpResponse(resp) {

        if (resp.result === 'success') {
            $('.mailchimp-success').addClass('active')
            $('.mailchimp-success').html('' + resp.msg).fadeIn(900);
            $('.mailchimp-error').fadeOut(400);

        } else if (resp.result === 'error') {
            $('.mailchimp-error').html('' + resp.msg).fadeIn(900);
        }
    }

    /*---Category menu---*/
    function categorySubMenuToggle() {
        $('.categories_menu_toggle li.menu_item_children > a').on('click', function () {
            if ($(window).width() < 991) {
                $(this).removeAttr('href');
                var element = $(this).parent('li');
                if (element.hasClass('open')) {
                    element.removeClass('open');
                    element.find('li').removeClass('open');
                    element.find('ul').slideUp();
                } else {
                    element.addClass('open');
                    element.children('ul').slideDown();
                    element.siblings('li').children('ul').slideUp();
                    element.siblings('li').removeClass('open');
                    element.siblings('li').find('li').removeClass('open');
                    element.siblings('li').find('ul').slideUp();
                }
            }
        });
        $('.categories_menu_toggle li.menu_item_children > a').append('<span class="expand"></span>');
    }
    categorySubMenuToggle();


    /*---shop grid activation---*/
    $('.shop_toolbar_btn > button').on('click', function (e) {

        e.preventDefault();

        $('.shop_toolbar_btn > button').removeClass('active');
        $(this).addClass('active');

        var parentsDiv = $('.shop_wrapper');
        var viewMode = $(this).data('role');


        parentsDiv.removeClass('grid_3 grid_4 grid_5 grid_list').addClass(viewMode);

        if (viewMode == 'grid_3') {
            parentsDiv.children().addClass('col-lg-4 col-md-4 col-sm-6').removeClass('col-lg-3 col-cust-5 col-12');

        }

        if (viewMode == 'grid_4') {
            parentsDiv.children().addClass('col-lg-3 col-md-4 col-sm-6').removeClass('col-lg-4 col-cust-5 col-12');
        }

        if (viewMode == 'grid_list') {
            parentsDiv.children().addClass('col-12').removeClass('col-lg-3 col-lg-4 col-md-4 col-sm-6 col-cust-5');
        }

    });


    /*---Newsletter Popup activation---*/

    setTimeout(function () {
        if ($.cookie('shownewsletter') == 1)
            $('.newletter-popup').hide();
        $('#subscribe_pemail').keypress(function (e) {
            if (e.which == 13) {
                e.preventDefault();
                email_subscribepopup();
            }
            var name = $(this).val();
            $('#subscribe_pname').val(name);
        });
        $('#subscribe_pemail').change(function () {
            var name = $(this).val();
            $('#subscribe_pname').val(name);
        });
        //transition effect
        if ($.cookie("shownewsletter") != 1) {
            $('.newletter-popup').bPopup();
        }
        $('#newsletter_popup_dont_show_again').on('change', function () {
            if ($.cookie("shownewsletter") != 1) {
                $.cookie("shownewsletter", '1')
            } else {
                $.cookie("shownewsletter", '0')
            }
        });
    }, 2500);


    /*---search account slideToggle---*/
    $(".search_list > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_search').slideToggle('medium');
    });



    /*---header account slideToggle---*/
    $(".header_account > a").on("click", function () {
        $(this).toggleClass('active');
        $('.dropdown_account').slideToggle('medium');
    });




    /*---mini cart activation---*/
    $('.mini_cart_wrapper > a').on('click', function () {
        $('.mini_cart,.off_canvars_overlay').addClass('active')
    });

    $('.mini_cart_close > a,.off_canvars_overlay').on('click', function () {
        $('.mini_cart,.off_canvars_overlay').removeClass('active')
    });



    /*---canvas menu activation---*/
    $('.canvas_open').on('click', function () {
        $('.offcanvas_menu_wrapper,.off_canvars_overlay').addClass('active')
    });

    $('.canvas_close,.off_canvars_overlay').on('click', function () {
        $('.offcanvas_menu_wrapper,.off_canvars_overlay').removeClass('active')
    });



    /*---Off Canvas Menu---*/
    var $offcanvasNav = $('.offcanvas_main_menu'),
            $offcanvasNavSubMenu = $offcanvasNav.find('.sub-menu');
    $offcanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fal fa-angle-down fa-lg"></i></span>');

    $offcanvasNavSubMenu.slideUp();

    $offcanvasNav.on('click', 'li a, li .menu-expand', function (e) {
        var $this = $(this);
        if (($this.parent().attr('class').match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/)) && ($this.attr('href') === '#' || $this.hasClass('menu-expand'))) {
            e.preventDefault();
            if ($this.siblings('ul:visible').length) {
                $this.siblings('ul').slideUp('slow');
            } else {
                $this.closest('li').siblings('li').find('ul:visible').slideUp('slow');
                $this.siblings('ul').slideDown('slow');
            }
        }
        if ($this.is('a') || $this.is('span') || $this.attr('class').match(/\b(menu-expand)\b/)) {
            $this.parent().toggleClass('menu-open');
        } else if ($this.is('li') && $this.attr('class').match(/\b('menu-item-has-children')\b/)) {
            $this.toggleClass('menu-open');
        }
    });

    /*---product dl column3 activation---*/






})(jQuery);
