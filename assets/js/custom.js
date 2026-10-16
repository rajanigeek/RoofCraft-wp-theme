jQuery(document).ready(function ($) {
    // Scroll animations.
    new WOW().init();

    // Before / after slider.
    $("#after_before").twentytwenty({
        overlay: false, // true (default) or false
        orientation: "horizontal" // horizontal (default) or vertical
    });

    var window_size = jQuery(window).width();

    // FAQ. Clicking the open item closes it. The first one starts open from PHP.
    jQuery(document).on("click", ".accordion .accordion-box-title", function () {
        const $currentBox = jQuery(this).closest(".accordion-box");
        const $parentAccordion = $currentBox.closest(".accordion");
        const isActive = $currentBox.hasClass("accordion-box-active");

        $parentAccordion.find(".accordion-box").removeClass("accordion-box-active");

        if (!isActive) {
            $currentBox.addClass("accordion-box-active");
        }
    });

    // Turn plain markup into a slider. Too few slides and it stays static.
    function resolveSlidesPerView(settings, width) {
        var slidesPerView = settings.slidesPerView || 1;
        if (settings.breakpoints) {
            Object.keys(settings.breakpoints).map(Number).sort(function (a, b) {
                return a - b;
            }).forEach(function (breakpoint) {
                if (width >= breakpoint && typeof settings.breakpoints[breakpoint].slidesPerView !== 'undefined') {
                    slidesPerView = settings.breakpoints[breakpoint].slidesPerView;
                }
            });
        }
        return slidesPerView;
    }

    function initAutoSwiper(selector, settings = {}) {
        $(selector).each(function () {
            var $slider = $(this);
            var sliderSettings = $.extend(true, {}, settings);

            if (!$slider.data('swiper-source-html')) {
                $slider.data('swiper-source-html', $slider.html());
                $slider.data('swiper-slide-count', $slider.children().length);
            }

            function getArrowHost() {
                var $parent = $slider.parent();
                var $arrowWrapper = $parent.find('.custom-arrow-wrapper');
                if (!$arrowWrapper.length) {
                    $arrowWrapper = $slider.closest('section').find('.custom-arrow-wrapper').first();
                }
                return $arrowWrapper;
            }

            function buildSwiper() {
                var $wrapper = $('<div class="swiper-wrapper"></div>');
                $slider.children().each(function () {
                    $(this).addClass('swiper-slide').appendTo($wrapper);
                });
                $slider.addClass('swiper').empty().append($wrapper);
                var swiperSettings = $.extend({}, sliderSettings);
                delete swiperSettings.skipIfInsufficient;
                if (swiperSettings.pagination) {
                    $slider.append('<div class="swiper-pagination"></div>');
                }
                if (swiperSettings.navigation) {
                    var $navWrapper = $('<div class="swiper-nav-wrapper"></div>'),
                        $prevEl = $('<div class="swiper-nav-btn swiper-nav-btn-prev"><iconify-icon icon="mingcute:left-line"></iconify-icon></div>').appendTo($navWrapper),
                        $nextEl = $('<div class="swiper-nav-btn swiper-nav-btn-next"><iconify-icon icon="mingcute:right-line"></iconify-icon></div>').appendTo($navWrapper);
                    var $arrowWrapper = getArrowHost();
                    ($arrowWrapper.length ? $arrowWrapper : $slider).append($navWrapper);
                    swiperSettings.navigation = swiperSettings.navigation === true ? {
                        nextEl: $nextEl[0],
                        prevEl: $prevEl[0]
                    } : $.extend({}, swiperSettings.navigation, {
                        nextEl: swiperSettings.navigation.nextEl || $nextEl[0],
                        prevEl: swiperSettings.navigation.prevEl || $prevEl[0]
                    });
                }
                $slider.data('swiper-instance', new Swiper($slider[0], swiperSettings));
            }

            function teardownSwiper() {
                var instance = $slider.data('swiper-instance');
                if (instance) {
                    instance.destroy(true, true);
                    $slider.removeData('swiper-instance');
                }
                getArrowHost().empty();
                $slider.removeClass('swiper').html($slider.data('swiper-source-html'));
            }

            function syncSwiper() {
                var slideCount = $slider.data('swiper-slide-count');
                var skip = !!sliderSettings.skipIfInsufficient && slideCount <= resolveSlidesPerView(sliderSettings, $(window).width());
                var hasInstance = !!$slider.data('swiper-instance');
                var $staticHost = $slider.parent();

                if (skip) {
                    if (hasInstance) {
                        teardownSwiper();
                    }
                    $slider.addClass('is-static');
                    $staticHost.addClass('is-static');
                    return;
                }

                $slider.removeClass('is-static');
                $staticHost.removeClass('is-static');
                if (!hasInstance) {
                    buildSwiper();
                }
            }

            syncSwiper();

            if (sliderSettings.skipIfInsufficient) {
                $(window).on('resize.autoSwiper', function () {
                    clearTimeout($slider.data('swiper-resize-timer'));
                    $slider.data('swiper-resize-timer', setTimeout(syncSwiper, 150));
                });
            }
        });
    }

    // Generic slider.
    initAutoSwiper('.custom-swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: true,
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 25,
            },
        }
    });

    // Testimonial quotes.
    initAutoSwiper('.testimonials-swiper', {
        slidesPerView: 1.22,
        spaceBetween: 16,
        slidesPerGroup: 1,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: true,
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 32,
            },
        }
    });

    // Warranty logos. No arrows, and no slider if there is only one slide.
    initAutoSwiper('.service-products-swiper', {
        slidesPerView: 1,
        spaceBetween: 16,
        slidesPerGroup: 1,
        loop: true,
        navigation: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        skipIfInsufficient: true,
        breakpoints: {
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
            },
        }
    });

    // aria-hidden follows the modal open and close.
    jQuery('.modal').each(function () {
        if (!jQuery(this).hasClass('show') && !jQuery(this).hasClass('in')) {
            jQuery(this).attr('aria-hidden', 'true');
        }
    });
    jQuery(document).on('show.bs.modal', '.modal', function () {
        jQuery(this).attr('aria-hidden', 'false');
    });
    jQuery(document).on('hidden.bs.modal', '.modal', function () {
        jQuery(this).attr('aria-hidden', 'true');
    });

    // Quote popup. Pin the header and pause the sliders while it is open.
    jQuery("#request_quote_modal").on('show.bs.modal', function () {
        jQuery(window).off('scroll.quoteModalSticky').on('scroll.quoteModalSticky', function () {
            jQuery(".site-header").addClass("sticky-head");
        });
        var scrolly = window.scrollY;
        jQuery("body").css("top", "-" + scrolly + "px");
        jQuery(this).attr("data-top", scrolly);
        jQuery('.swiper').each(function () {
            if (this.swiper && this.swiper.autoplay) {
                this.swiper.autoplay.pause();
            }
        });
    });
    jQuery('#request_quote_modal').on('hidden.bs.modal', function () {
        jQuery(window).off('scroll.quoteModalSticky').on('scroll.quoteModalSticky', function () {
            var height = jQuery(window).scrollTop();
            if (height < 100) {
                jQuery(".site-header").removeClass("sticky-head");
            }
        });
        var scrolly = jQuery(this).attr("data-top");
        jQuery("body").css("top", "0px");
        window.scrollTo(0, scrolly);
        jQuery('.swiper').each(function () {
            if (this.swiper && this.swiper.autoplay) {
                this.swiper.autoplay.resume();
            }
        });
    });

    // Footer "view all services".
    jQuery('#view_all_services').click(function () {
        jQuery('.all-services').slideToggle(500);
        jQuery('.all-services').css('display', 'block');
    });
    // SEO page. Read more drops the height limit.
    jQuery('#read-more').click(function () {
        jQuery('.excerpt-content').css({ 'max-height': 'unset' });
        jQuery(this).hide();
    });


    // A menu link closes the mobile nav.
    jQuery("#primary-menu .menu-item a").on("click", function () {
        jQuery(".main-navigation").removeClass("toggled");
    });

    var window_size = jQuery(window).width();
    // Under 991px, parent items open their submenu.
    if (window_size <= 991) {
        jQuery(document).on('click', '#primary-menu .menu-item-has-children', function (e) {
            e.stopPropagation();
            jQuery(this).siblings('.menu-item-has-children').removeClass('active-sub-menu');
            jQuery(this).toggleClass('active-sub-menu');
            jQuery(this).siblings('.menu-item-has-children').find('.sub-menu').hide();
            jQuery(this).find('.sub-menu').eq(0).toggle();
        });

        jQuery(document).on('click', '#primary-menu .sub-menu li', function (e) {
            e.stopPropagation();
        });
    }

    // Menu JS Start
    // jQuery(".menu-toggle").on("click", function () {
    //     jQuery(".header-menu .header-mob-bg").fadeToggle();
    //     jQuery(".main-navigation ul li.menu-item-has-children").removeClass("active-sub-menu").find("ul").slideUp();
    // });

    // jQuery(".menu-item a").not("#primary-menu .menu-item-has-children ").click(function () {
    //     jQuery(".main-navigation").removeClass("toggled");
    //     jQuery(".header-menu .header-mob-bg").fadeOut();
    // });

    // if (window_size <= 991) {
    //     jQuery(".header-menu .header-mob-bg").on("click", function () {
    //         jQuery(this).fadeOut();
    //         jQuery(".main-navigation ul li.menu-item-has-children").removeClass("active-sub-menu").find("ul").slideUp();
    //     });
    // }
    // Menu JS End


    // Stick the header after a short scroll. Mobile also fades in the call button.
    jQuery(window).scroll(function () {
        var height = jQuery(window).scrollTop();
        if (height > 100) {
            jQuery(".site-header").addClass("sticky-head");
        } else {
            jQuery(".site-header").removeClass("sticky-head");
        }
    });

    if (window_size <= 991) {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.cta-btn').fadeIn();
            } else {
                jQuery('.cta-btn').fadeOut();
            }
        });
    }
    // Menu hashes point at the section on this page, or back to the homepage.
    jQuery("ul.menu li.menu-item").each(function () {
        var href = jQuery(this).find("a").attr("href");
        if (href.includes("#")) {
            if (href.substr(0, 1) == '#') {
                if (jQuery(href).length > 0) {
                    jQuery(this).find("a").first().attr("href", window.location.href.replace('#', '') + href);
                } else {
                    jQuery(this).find("a").first().attr("href", custom_call.homeurl + href);
                }
            }
        }
    });

    // Lightbox. Sliders pause while a photo is open.
    Fancybox.bind("[data-fancybox]", {
        Carousel: {
            Thumbs: {
                type: "classic"
            }
        },
        on: {
            reveal: function (fancybox, slide) {
                jQuery('.swiper').each(function () {
                    if (this.swiper && this.swiper.autoplay) {
                        this.swiper.autoplay.pause();
                    }
                });
            },
            close: function (fancybox, slide) {
                setTimeout(function () {
                    jQuery('.swiper').each(function () {
                        if (this.swiper && this.swiper.autoplay) {
                            this.swiper.autoplay.resume();
                        }
                    });
                    jQuery("body").trigger("click");
                }, 1000);
            }
        }
    });

    // Land on a hash with room for the sticky header.
    let scrollOffset = 100;
    if (window.location.hash) {
        jQuery('html,body').animate({
            scrollTop: jQuery(window.location.hash).offset().top - scrollOffset
        });
    } else {
        setTimeout(function () { scroll(0, 0); }, 1);
    }

    jQuery('a[href*=\\#]:not([href$=\\#])').on('click', function (evt) {

        evt.preventDefault();
        var url = jQuery(this).attr('href');
        var id = url.substring(url.lastIndexOf('#'));
        if (jQuery(id).length > 0) {
            jQuery('html, body').animate({
                scrollTop: jQuery(id).offset().top - scrollOffset
            }, 500);
        }
        else {
            window.location.href = url;
        }
    });
    // Back to top. Shows once you have scrolled a bit.
    var $scrollBtn = jQuery('#scroll-to-top');
    var isVisible = false;

    jQuery(window).on('scroll', function () {
        var shouldShow = jQuery(window).scrollTop() > 100;
        if (shouldShow !== isVisible) {
            isVisible = shouldShow;
            $scrollBtn[shouldShow ? 'fadeIn' : 'fadeOut']();
        }
    });

    $scrollBtn.on('click', function (e) {
        e.preventDefault();
        jQuery("html, body").animate({ scrollTop: 0 }, 800);
    });

    // Service area map. A circle around the towns, click one to zoom in.
    var SERVICE_AREA_CIRCLE = {
        fillColor: '#F4A460',
        fillOpacity: 0.35,
        strokeColor: '#D2691E',
        strokeOpacity: 0.95,
        strokeWeight: 3
    };

    function serviceAreaDistanceM(a, b) {
        var R = 6371000;
        var dLat = (b.lat - a.lat) * Math.PI / 180;
        var dLng = (b.lng - a.lng) * Math.PI / 180;
        var lat1 = a.lat * Math.PI / 180;
        var lat2 = b.lat * Math.PI / 180;
        var h = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1) * Math.cos(lat2) * Math.sin(dLng / 2) * Math.sin(dLng / 2);
        return 2 * R * Math.asin(Math.min(1, Math.sqrt(h)));
    }

    function serviceAreaCoverage(points) {
        var bounds = new google.maps.LatLngBounds();
        var coords = points.map(function (loc) {
            var pos = { lat: parseFloat(loc.lat), lng: parseFloat(loc.lng) };
            bounds.extend(pos);
            return pos;
        });
        var centerLatLng = bounds.getCenter();
        var center = { lat: centerLatLng.lat(), lng: centerLatLng.lng() };
        var radius = 0;
        coords.forEach(function (pos) {
            var d = serviceAreaDistanceM(center, pos);
            if (d > radius) {
                radius = d;
            }
        });
        return {
            center: center,
            radius: Math.max(radius * 1.25, 20000)
        };
    }

    function serviceAreaOffset(center, distanceMeters, bearingDeg) {
        var R = 6371000;
        var bearing = bearingDeg * Math.PI / 180;
        var lat1 = center.lat * Math.PI / 180;
        var lng1 = center.lng * Math.PI / 180;
        var angularDist = distanceMeters / R;
        var lat2 = Math.asin(Math.sin(lat1) * Math.cos(angularDist) + Math.cos(lat1) * Math.sin(angularDist) * Math.cos(bearing));
        var lng2 = lng1 + Math.atan2(
            Math.sin(bearing) * Math.sin(angularDist) * Math.cos(lat1),
            Math.cos(angularDist) - Math.sin(lat1) * Math.sin(lat2)
        );
        return { lat: lat2 * 180 / Math.PI, lng: lng2 * 180 / Math.PI };
    }

    function serviceAreaCirclePath(center, radius) {
        var path = [];
        for (var deg = 0; deg <= 360; deg += 6) {
            path.push(serviceAreaOffset(center, radius, deg));
        }
        return path;
    }

    function drawServiceAreaCircle(map, center, radius) {
        var path = serviceAreaCirclePath(center, radius);
        var bounds = new google.maps.LatLngBounds();
        path.forEach(function (pt) {
            bounds.extend(pt);
        });

        var fill = new google.maps.Polygon({
            map: map,
            paths: path,
            fillColor: SERVICE_AREA_CIRCLE.fillColor,
            fillOpacity: SERVICE_AREA_CIRCLE.fillOpacity,
            strokeOpacity: 0,
            clickable: false
        });
        var border = new google.maps.Polyline({
            map: map,
            path: path,
            strokeOpacity: 0,
            clickable: false,
            icons: [{
                icon: {
                    path: 'M 0,-1 0,1',
                    strokeColor: SERVICE_AREA_CIRCLE.strokeColor,
                    strokeOpacity: SERVICE_AREA_CIRCLE.strokeOpacity,
                    strokeWeight: SERVICE_AREA_CIRCLE.strokeWeight,
                    scale: 4
                },
                offset: '0',
                repeat: '16px'
            }]
        });

        return {
            setVisible: function (visible) {
                fill.setVisible(visible);
                border.setVisible(visible);
            },
            getBounds: function () {
                return bounds;
            }
        };
    }

    function showServiceAreaOverview(map, markers, circle) {
        markers.forEach(function (marker) {
            marker.setVisible(true);
        });
        if (circle) {
            circle.setVisible(true);
            map.fitBounds(circle.getBounds(), 40);
        }
    }

    function showServiceAreaCity(map, markers, circle, index) {
        if (circle) {
            circle.setVisible(false);
        }
        markers.forEach(function (marker, i) {
            marker.setVisible(i === index);
        });
        var marker = markers[index];
        if (!marker) {
            return;
        }
        map.panTo(marker.getPosition());
        map.setZoom(13);
    }

    function focusServiceAreaMarker($item) {
        var $section = $item.closest('.service-area');
        var $mapWrap = $section.find('.service-area-map');
        var map = $mapWrap.data('service-map');
        var markers = $mapWrap.data('service-markers') || [];
        var circle = $mapWrap.data('service-circle');
        var index = parseInt($item.attr('data-map-index'), 10);
        var lat = parseFloat($item.attr('data-lat'));
        var lng = parseFloat($item.attr('data-lng'));
        var name = jQuery.trim($item.find('.h6-title').text());

        $item.closest('.service-area-list-inner').find('.service-area-item').removeClass('is-active');
        $item.addClass('is-active');

        if (map && !isNaN(index) && markers[index]) {
            showServiceAreaCity(map, markers, circle, index);
            return true;
        }

        if (map && !isNaN(lat) && !isNaN(lng)) {
            map.panTo({ lat: lat, lng: lng });
            map.setZoom(13);
            return true;
        }

        var mapSrc = $item.attr('data-map-src') || $item.find('.service-area-link').attr('data-map-src');
        var $iframe = $mapWrap.find('iframe');
        if (mapSrc && $iframe.length) {
            $iframe.attr('src', mapSrc);
            if (name) {
                $iframe.attr('title', name);
            }
            return true;
        }

        return false;
    }

    function initServiceAreaMap() {
        if (!window.google || !google.maps) {
            return;
        }

        jQuery('.service-area-map[data-map-locations]').each(function () {
            var $wrap = jQuery(this);
            if ($wrap.data('service-map')) {
                return;
            }

            var points = [];
            try {
                points = JSON.parse($wrap.attr('data-map-locations') || '[]');
            } catch (err) {
                points = [];
            }
            points = jQuery.isArray(points) ? points.filter(function (loc) {
                return loc && !isNaN(parseFloat(loc.lat)) && !isNaN(parseFloat(loc.lng));
            }) : [];
            if (!points.length) {
                return;
            }

            var $iframe = $wrap.find('iframe');
            var $canvas = jQuery('<div class="service-area-map-canvas"></div>');
            var height = $iframe.outerHeight() || 723;
            $canvas.css({ width: '100%', height: height + 'px', minHeight: height + 'px' });
            if ($iframe.length) {
                $iframe.replaceWith($canvas);
            } else {
                $wrap.append($canvas);
            }

            var start = {
                lat: parseFloat(points[0].lat),
                lng: parseFloat(points[0].lng)
            };
            var map = new google.maps.Map($canvas[0], {
                center: start,
                zoom: 9,
                mapTypeControl: false,
                streetViewControl: false
            });
            var cover = serviceAreaCoverage(points);
            var circle = drawServiceAreaCircle(map, cover.center, cover.radius);
            var markers = points.map(function (loc, index) {
                var marker = new google.maps.Marker({
                    position: { lat: parseFloat(loc.lat), lng: parseFloat(loc.lng) },
                    map: map,
                    title: loc.name || ''
                });
                marker.addListener('click', function () {
                    showServiceAreaCity(map, markers, circle, index);
                    $wrap.closest('.service-area').find('.service-area-item').removeClass('is-active')
                        .filter('[data-map-index="' + index + '"]').addClass('is-active');
                });
                return marker;
            });

            showServiceAreaOverview(map, markers, circle);

            $wrap.data('service-map', map);
            $wrap.data('service-markers', markers);
            $wrap.data('service-circle', circle);
        });
    }

    window.initServiceAreaMap = initServiceAreaMap;

    (function loadServiceAreaMap() {
        if (!jQuery('.service-area-map[data-map-locations]').length) {
            return;
        }
        if (window.google && google.maps) {
            initServiceAreaMap();
            return;
        }
        var key = (typeof custom_call !== 'undefined' && custom_call.googleMapApi) ? custom_call.googleMapApi : '';
        if (!key || jQuery('#service-area-google-maps').length) {
            return;
        }
        var script = document.createElement('script');
        script.id = 'service-area-google-maps';
        script.src = 'https://maps.googleapis.com/maps/api/js?key=' + encodeURIComponent(key) + '&callback=initServiceAreaMap';
        script.async = true;
        document.head.appendChild(script);
    })();

    jQuery(document).on('click', '.service-area-item', function (e) {
        var $item = jQuery(this);
        if (jQuery(e.target).closest('.service-area-link').length && $item.find('.service-area-title').length) {
            return;
        }
        if (focusServiceAreaMarker($item)) {
            e.preventDefault();
        }
    });

    // Reviews. Next page of cards, then hide the button.
    var reviewsRequestInProgress = false;
    jQuery(document).on('click', '.js-reviews-load-more', function (e) {
        e.preventDefault();
        if (reviewsRequestInProgress || typeof custom_call === 'undefined') {
            return;
        }

        var $button = jQuery(this);
        var $list = jQuery('.reviews-list');
        var page = (parseInt($list.attr('data-page'), 10) || 1) + 1;

        reviewsRequestInProgress = true;
        $button.prop('disabled', true);

        jQuery.ajax({
            url: custom_call.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_more_reviews',
                nonce: custom_call.reviewsNonce,
                page: page
            }
        }).done(function (response) {
            if (!response || !response.success || !response.data) {
                return;
            }
            if (response.data.html) {
                var $newCards = jQuery(response.data.html);
                $newCards.removeClass('wow').css({ visibility: 'visible', opacity: 0 });
                $list.append($newCards);
                $newCards.animate({ opacity: 1 }, 250);
                $list.attr('data-page', page);
            }
            if (!response.data.has_more) {
                $button.closest('.reviews-more').hide();
            }
        }).always(function () {
            reviewsRequestInProgress = false;
            $button.prop('disabled', false);
        });
    });

    // Portfolio. A tab replaces the grid, load more appends.
    var portfolioRequestInProgress = false;

    function requestPortfolioGallery($section, term, page, replace) {
        if (portfolioRequestInProgress || typeof custom_call === 'undefined') {
            return;
        }

        var $content = $section.find('.portfolio-gallery-content');
        var $grid = $content.find('.portfolio-gallery-grid');
        var $loader = $content.find('.loader-wp');
        var $more = $section.find('.portfolio-gallery-more');

        portfolioRequestInProgress = true;
        $loader.show();
        $section.find('.js-portfolio-load-more').prop('disabled', true);

        jQuery.ajax({
            url: custom_call.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_portfolio_gallery',
                nonce: custom_call.portfolioNonce,
                term: term,
                page: page
            }
        }).done(function (response) {
            if (!response || !response.success || !response.data) {
                return;
            }
            var $items = jQuery(response.data.html || '');
            $items.find('.wow').addBack('.wow').removeClass('wow').css({ visibility: 'visible', opacity: 1 });
            if (replace) {
                $grid.empty();
            }
            if ($items.length) {
                $grid.append($items);
            }
            $content.attr('data-term', term);
            $content.attr('data-page', page);
            if (response.data.has_more) {
                $more.show();
            } else {
                $more.hide();
            }
        }).always(function () {
            portfolioRequestInProgress = false;
            $loader.hide();
            $section.find('.js-portfolio-load-more').prop('disabled', false);
        });
    }

    jQuery(document).on('click', '.portfolio-gallery-tab', function (e) {
        e.preventDefault();
        var $tab = jQuery(this);
        if ($tab.hasClass('is-active') || portfolioRequestInProgress) {
            return;
        }

        var term = parseInt($tab.attr('data-term'), 10);
        if (!term) {
            return;
        }

        $tab.addClass('is-active').siblings('.portfolio-gallery-tab').removeClass('is-active');
        requestPortfolioGallery($tab.closest('.portfolio-gallery'), term, 1, true);
    });

    jQuery(document).on('click', '.js-portfolio-load-more', function (e) {
        e.preventDefault();
        if (portfolioRequestInProgress) {
            return;
        }

        var $section = jQuery(this).closest('.portfolio-gallery');
        var $content = $section.find('.portfolio-gallery-content');
        var term = parseInt($content.attr('data-term'), 10);
        var page = (parseInt($content.attr('data-page'), 10) || 1) + 1;
        if (!term) {
            return;
        }

        requestPortfolioGallery($section, term, page, false);
    });

    // Blog. Sends the current archive filters with the next page.
    var blogRequestInProgress = false;
    jQuery(document).on('click', '.js-blog-load-more', function (e) {
        e.preventDefault();
        if (blogRequestInProgress || typeof custom_call === 'undefined') {
            return;
        }

        var $button = jQuery(this);
        var $section = $button.closest('.blog-grid');
        var $cards = $section.find('.blog-grid-cards');
        var $loader = $section.find('.loader-wp');
        var page = (parseInt($cards.attr('data-page'), 10) || 1) + 1;

        blogRequestInProgress = true;
        $loader.show();
        $button.prop('disabled', true);

        jQuery.ajax({
            url: custom_call.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'load_more_blog',
                nonce: custom_call.blogNonce,
                page: page,
                context: $cards.attr('data-context') || '{}'
            }
        }).done(function (response) {
            if (!response || !response.success || !response.data) {
                return;
            }
            if (response.data.html) {
                var $newCards = jQuery(response.data.html);
                $newCards.find('.wow').addBack('.wow').removeClass('wow').css({ visibility: 'visible', opacity: 0 });
                $cards.append($newCards);
                $newCards.animate({ opacity: 1 }, 250);
                $cards.attr('data-page', page);
            }
            if (response.data.count) {
                $section.find('.blog-grid-count').text(response.data.count);
            }
            if (!response.data.has_more) {
                $button.closest('.blog-grid-more').hide();
            }
        }).always(function () {
            blogRequestInProgress = false;
            $loader.hide();
            $button.prop('disabled', false);
        });
    });
});
