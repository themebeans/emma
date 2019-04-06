/**
 * Theme javascript functions file.
 *
 */
( function( $ ) {
    "use strict";

    $(document).ready(function() {

        /* Fitvids */
        $("body").fitVids();

        /* Mobile Nav */
        $('#mobile-nav').meanmenu();

        /* Dropdowns */
        $('nav ul').superfish({
                delay: 100,
                animation: { opacity:'show', height:'show' },
                speed: 150,
                cssArrows: false,
                disableHI: true
        });

        /* Body Preloader */
        setTimeout(function(){
            $('body').addClass('loaded');
        }, 500);

        /* Blogroll Masonry */
        if ($('#masonry-container').length > 0) {
            var container = document.querySelector('#masonry-container');
            var msnry;
            imagesLoaded( container, function() {
                msnry = new Masonry( container, {
                    itemSelector: '#masonry-container article',
                    transitionDuration:"0.2s",
                });
            });

            var $container = $('#masonry-container');

            $(function(){
                $container.infinitescroll({
                    navSelector  : '#page_nav',
                    nextSelector : '#page_nav a',
                    itemSelector : 'article',
                    loading: {
                        loadingText: 'Loading',
                        finishedMsg: 'Done Loading',
                        img: '',
                    }
                },

                function( newElements ) {
                    var $newElems = $( newElements ).css({ opacity: 0 });

                    $newElems.imagesLoaded(function() {
                        $newElems.addClass('loaded');
                        msnry.appended( $newElems, true );
                    });

                });
            });

        }

        /* Form Validation */
        if (jQuery().validate) {
        	jQuery("#commentform").validate();
        	jQuery("#BeanForm").validate();
        }

    });

    /* Window Height elements */
    $(window).load(function(){
        var pageHeight = jQuery(window).height();
        $('.page-item.no-content.bg-img, .page-item.parallax').css({ "height": $(window).height() + 'px' });
        ! function(a) {
            $(".mean-container a.meanmenu-reveal").css({"height": a(".header").outerHeight(),});
            $(".single-post-content, .mean-container .mean-nav, #masonry-container, .single-attachment .entry-content-media").css({"margin-top": a(".header").outerHeight(),});
            $(".contact-alert").css({"margin-top": a(".contact-alert").outerHeight() -  a(".contact-alert").outerHeight() * 2,});
        }(window.jQuery);
    });

    $(window).resize(function(){
        var pageHeight = jQuery(window).height();
        $('.page-item.no-content.bg-img, .page-item.parallax').css({ "height": $(window).height() + 'px' });
        ! function(a) {
            $(".mean-container a.meanmenu-reveal").css({"height": a(".header").outerHeight(),});
            $(".single-post-content, .mean-container .mean-nav, #masonry-container, .single-attachment .entry-content-media").css({"margin-top": a(".header").outerHeight(),});
            $(".contact-alert").css({"margin-top": a(".contact-alert").outerHeight() -  a(".contact-alert").outerHeight() * 2,});
        }(window.jQuery);
    });

} )( jQuery );