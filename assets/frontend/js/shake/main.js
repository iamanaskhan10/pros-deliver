(function ($) {
    "use strict";

    $(document).ready(function () {
        /*
        ========================================
            input search open item
        ========================================
        */
        $(document).on('keyup change', '#search_form_input', function (event) {

            let input_values = $(this).val();

            if (input_values.length > 0) {
                $('#search_suggestions_wrap, .search-suggestion-overlay').addClass("show");
            } else {
                $('#search_suggestions_wrap, .search-suggestion-overlay').removeClass("show");
            }
        });
        $(document).on('click', '.search-suggestion-overlay', function () {
            $('#search_suggestions_wrap, .search-suggestion-overlay').removeClass('show')
        })

        /*
        ========================================
            Nice Scroll js
        ========================================
        */
        if (typeof $.fn.niceScroll !== 'undefined') {
            $(".product-suggestion-list, .modal-scroll, .scroll-leftright, .scroll-bar").niceScroll({});
        }

        /* 
        ========================================
            Click & Open Popup Modal
        ========================================
        */
        $(document).on('click', '.close-icon, .body-overlay-modal', function () {
            $('.started-modal, .body-overlay-modal').removeClass('active');
        });
        $(document).on('click', '.popup-modal-click', function () {
            $('.started-modal, .body-overlay-modal').addClass('active');
        });

        $(document).on('click', '.close-icon, .body-overlay-modal', function () {
            $('.started-modal-two, .body-overlay-modal').removeClass('active');
        });
        $(document).on('click', '.popup-modal-two-click', function () {
            $('.started-modal-two, .body-overlay-modal').addClass('active');
        });

        /* 
        ========================================
            Active Class add remove
        ========================================
        */
        $(document).on('click', '.started-modal-contents-filter-single-list-link,.single-header-bottom-list-item-link', function () {
            $(this).toggleClass('active');
        });
        /* 
        ========================================
            Profile Sidebar Show Hide
        ========================================
        */
        $(document).on('click', '.profile-sidebar-icon', function () {
            $('.profile-right-sidebar, .body-overlay-profile').toggleClass('active');
        });
        $(document).on('click', '.profile-icon-close, .body-overlay-profile', function () {
            $('.profile-right-sidebar, .body-overlay-profile').removeClass('active');
        });

        /* 
        ========================================
            Profile Sidebar Show Hide
        ========================================
        */
        $(document).on('click', '.author-open-icon', function () {
            $('.conversation-author, .body-overlay-profile').toggleClass('active');
        });
        $(document).on('click', '.conversation-icon-close, .body-overlay-profile', function () {
            $('.conversation-author, .body-overlay-profile').removeClass('active');
        });

        /* 
        ========================================
            Conversation Archive Delete 
        ========================================
        */
        $(document).on('click', '.conversation-author-list-item-archive', function () {
            $(this).next('.archive-wrap').toggleClass('showing');
            $(this).next().next('.archive-overlay').toggleClass('showing');
        });
        $(document).on('click', '.archive-overlay', function () {
            $('.archive-wrap, .archive-overlay').removeClass('showing');
        });

        /* 
        ========================================
            Active Class add remove
        ========================================
        */
        $(document).on('click', '.single-blog-details-bottom-contents', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            $('.single-blog-details-bottom-contents').find('.check-input').prop('checked', false);
            $('.single-blog-details-bottom-contents.active').find('.check-input').prop('checked', true);
        });
        $('.single-blog-details-bottom-contents.active').find('.check-input').prop('checked', true);


        $(document).on('click', '.show-sort-item', '.conversation-author-list-item', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

        });

        $(document).on('click', '.conversation-author-list-item', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

        });


        /* 
        ========================================
            Video Js
        ========================================
        */
        $(document).on('mouseover', '.single-blog-thumb', function () {
            let el = $(this);
            let video = el.find('video')[0];
            if (video) {
                video.play();
            }
        });

        $(document).on('mouseout', '.single-blog-thumb', function () {
            let el = $(this);
            let video = el.find('video')[0];
            if (video) {
                video.pause();
            }

        });

        /* 
        ========================================
            Pagination On Click Js
        ========================================
        */
        $(document).on('click', '.pagination-list-item', function () {
            $(this).siblings().children().removeClass('active');
            $(this).children().addClass('active');
        });

        $(document).on('click', '.pagination-list-item-next', function () {
            // count length of a element
            let index = 0;
            let el = $(".pagination-list-item-link");
            let elArray = Array.from(el);

            for (let i = 0; i < el.length; i++) {
                if ($(elArray[i]).hasClass('active')) {
                    break;
                } else {
                    index++;
                }
            }

            el.removeClass('active');
            // check index length is should be less then el length
            let nextIndex = (function () {
                if (index == (el.length - 1)) {
                    return 0;
                } else {
                    return index + 1;
                }
            })();

            $(elArray[nextIndex]).addClass('active');
        });
        $(document).on('click', '.pagination-list-item-prev', function () {
            // count length of a element
            let index = 0;
            let el = $(".pagination-list-item-link");
            let elArray = Array.from(el);

            for (let i = 0; i < el.length; i++) {
                if ($(elArray[i]).hasClass('active')) {
                    break;
                } else {
                    index++;
                }
            }

            el.removeClass('active');
            // check index length is should be less then el length
            let nextIndex = (function () {
                if (index == 0) {
                    return (el.length - 1);
                } else {
                    return index - 1;
                }
            })();

            $(elArray[nextIndex]).addClass('active');
        });

        /* 
        ========================================
            Navbar Toggler
        ========================================
        */
        $(document).on('click', '.navbar-toggler', function () {
            $(".navbar-toggler").toggleClass("active");
        });

        $(document).on('click', '.click-nav-right-search', function () {
            $(".show-nav-content").toggleClass("show");
        });

        $(document).on('click', '.click-nav-right-icon', function () {
            $(".hide-right-content").toggleClass("show");
        });

        /* 
        ========================================
            Nice Select
        ========================================
        */
        $('#nice-select').niceSelect();

        /* 
        ========================================
            Click Active Class
        ========================================
        */
        $(document).on('click', '.active-list .list', function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });

        /*-------------------------------
            Click Slide Open Close
        ------------------------------*/

        $(document).on('click', '.shop-left-title .title', function (e) {
            var shopTitle = $(this).parent('.shop-left-title');
            if (shopTitle.hasClass('open')) {
                shopTitle.removeClass('open');
                shopTitle.find('.shop-left-list').removeClass('open');
                shopTitle.find('.shop-left-list').slideUp(300, "swing");
            } else {
                shopTitle.addClass('open');
                shopTitle.children('.shop-left-list').slideDown(300, "swing");
                shopTitle.siblings('.shop-left-title').children('.shop-left-list').slideUp(300, "swing");
                shopTitle.siblings('.shop-left-title').removeClass('open');
            }
        });

        /*
        ========================================
            Magnific Popup Js
        ========================================
        */
        $('.popup-gallery').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        /*
        ========================================
            wow js init
        ========================================
        */

        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }

        /* 
        ========================================
            Initialize tooltips
        ========================================
        */
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        /*
        ========================================
        accordion
        ========================================
        */
        $('.faq-contents .faq-title').on('click', function (e) {
            var element = $(this).parent('.faq-item');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('.faq-panel').removeClass('open');
                element.find('.faq-panel').slideUp(300, "swing");
            } else {
                element.addClass('open');
                element.children('.faq-panel').slideDown(300, "swing");
                element.siblings('.faq-item').children('.faq-panel').slideUp(300, "swing");
                element.siblings('.faq-item').removeClass('open');
                element.siblings('.faq-item').find('.faq-title').removeClass('open');
                element.siblings('.faq-item').find('.faq-panel').slideUp(300, "swing");
            }
        });

        /*
        ========================================
            Global Slider Init
        ========================================
        */
        var globalSlickInit = $('.global-slick-init');
        if (globalSlickInit.length > 0) {
            //have to check slider item
            $.each(globalSlickInit, function (index, value) {
                if ($(this).children('div').length > 1) {
                    //configure slider settings object
                    var sliderSettings = {};
                    var allData = $(this).data();
                    var infinite = typeof allData.infinite == 'undefined' ? false : allData.infinite;
                    var arrows = typeof allData.arrows == 'undefined' ? false : allData.arrows;
                    var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                    var focusOnSelect = typeof allData.focusonselect == 'undefined' ? false : allData.focusonselect;
                    var swipeToSlide = typeof allData.swipetoslide == 'undefined' ? false : allData.swipetoslide;
                    var slidesToShow = typeof allData.slidestoshow == 'undefined' ? 1 : allData.slidestoshow;
                    var slidesToScroll = typeof allData.slidestoscroll == 'undefined' ? 1 : allData.slidestoscroll;
                    var speed = typeof allData.speed == 'undefined' ? '500' : allData.speed;
                    var dots = typeof allData.dots == 'undefined' ? false : allData.dots;
                    var cssEase = typeof allData.cssease == 'undefined' ? 'linear' : allData.cssease;
                    var prevArrow = typeof allData.prevarrow == 'undefined' ? '' : allData.prevarrow;
                    var nextArrow = typeof allData.nextarrow == 'undefined' ? '' : allData.nextarrow;
                    var centerMode = typeof allData.centermode == 'undefined' ? false : allData.centermode;
                    var centerPadding = typeof allData.centerpadding == 'undefined' ? false : allData.centerpadding;
                    var rows = typeof allData.rows == 'undefined' ? 1 : parseInt(allData.rows);
                    var autoplay = typeof allData.autoplay == 'undefined' ? false : allData.autoplay;
                    var autoplaySpeed = typeof allData.autoplayspeed == 'undefined' ? 2000 : parseInt(allData.autoplayspeed);
                    var lazyLoad = typeof allData.lazyload == 'undefined' ? false : allData.lazyload; // have to remove it from settings object if it undefined
                    var appendDots = typeof allData.appenddots == 'undefined' ? false : allData.appenddots;
                    var appendArrows = typeof allData.appendarrows == 'undefined' ? false : allData.appendarrows;
                    var asNavFor = typeof allData.asnavfor == 'undefined' ? false : allData.asnavfor;
                    var verticalSwiping = typeof allData.verticalswiping == 'undefined' ? false : allData.verticalswiping;
                    var vertical = typeof allData.vertical == 'undefined' ? false : allData.vertical;
                    var fade = typeof allData.fade == 'undefined' ? false : allData.fade;
                    var rtl = typeof allData.rtl == 'undefined' ? false : allData.rtl;
                    var responsive = typeof $(this).data('responsive') == 'undefined' ? false : $(this).data('responsive');
                    //slider settings object setup
                    sliderSettings.infinite = infinite;
                    sliderSettings.arrows = arrows;
                    sliderSettings.autoplay = autoplay;
                    sliderSettings.focusOnSelect = focusOnSelect;
                    sliderSettings.swipeToSlide = swipeToSlide;
                    sliderSettings.slidesToShow = slidesToShow;
                    sliderSettings.slidesToScroll = slidesToScroll;
                    sliderSettings.speed = speed;
                    sliderSettings.dots = dots;
                    sliderSettings.cssEase = cssEase;
                    sliderSettings.prevArrow = prevArrow;
                    sliderSettings.nextArrow = nextArrow;
                    sliderSettings.rows = rows;
                    sliderSettings.autoplaySpeed = autoplaySpeed;
                    sliderSettings.autoplay = autoplay;
                    sliderSettings.verticalSwiping = verticalSwiping;
                    sliderSettings.vertical = vertical;
                    sliderSettings.rtl = rtl;
                    if (centerMode != false) {
                        sliderSettings.centerMode = centerMode;
                    }
                    if (centerPadding != false) {
                        sliderSettings.centerPadding = centerPadding;
                    }
                    if (lazyLoad != false) {
                        sliderSettings.lazyLoad = lazyLoad;
                    }
                    if (appendDots != false) {
                        sliderSettings.appendDots = appendDots;
                    }
                    if (appendArrows != false) {
                        sliderSettings.appendArrows = appendArrows;
                    }
                    if (asNavFor != false) {
                        sliderSettings.asNavFor = asNavFor;
                    }
                    if (fade != false) {
                        sliderSettings.fade = fade;
                    }
                    if (responsive != false) {
                        sliderSettings.responsive = responsive;
                    }
                    $(this).slick(sliderSettings);
                }
            });
        }

        /* 
        ========================================
            Range Slider
        ========================================
        */
        var i = document.querySelector(".ui-range-slider");
        if (void 0 !== i && null !== i) {
            var j = parseInt(i.parentNode.getAttribute("data-start-min"), 10),
                k = parseInt(i.parentNode.getAttribute("data-start-max"), 10),
                l = parseInt(i.parentNode.getAttribute("data-min"), 10),
                m = parseInt(i.parentNode.getAttribute("data-max"), 10),
                n = parseInt(i.parentNode.getAttribute("data-step"), 10),
                o = document.querySelector(".ui-range-value-min span"),
                p = document.querySelector(".ui-range-value-max span"),
                q = document.querySelector(".ui-range-value-min input"),
                r = document.querySelector(".ui-range-value-max input");
            noUiSlider.create(i, {
                start: [j, k],
                connect: !0,
                step: n,

                range: {
                    min: l,
                    max: m
                }
            }), i.noUiSlider.on("update", function (a, b) {
                var c = a[b];
                b ? (p.innerHTML = Math.round(c), r.value = Math.round(c)) : (o.innerHTML = Math.round(c), q.value = Math.round(c))
            })
        }

    });

        /* 
        ========================================
            accordion js
        ========================================
        */
    $('.custom-accordion-item').on('click', function() {
        let all_accordion_bodies = $('.custom-accordion-collapse');
        let this_body = $(this).find('.custom-accordion-collapse');
        let this_icon = $(this).find("i");
        let this_item = $(this);
        if (this_body.hasClass('show')) {
            this_body.removeClass('show');
            this_item.removeClass('active');
            this_icon.removeClass('fa-minus-circle color_gradient').addClass('fa-plus-circle color_gary_300');
        } else {
            all_accordion_bodies.removeClass('show');
            $('.custom-accordion-item').removeClass('active');
            $('i.fa-minus-circle').removeClass('fa-minus-circle').addClass('fa-plus-circle');
            $('i').removeClass('color_gradient').addClass('color_gary_300');
            this_body.addClass('show');
            this_item.addClass('active');
            this_icon.removeClass('fa-plus-circle color_gary_300').addClass('fa-minus-circle color_gradient');
        }
    });

})(jQuery);