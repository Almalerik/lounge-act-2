/**
 * customizer.js
 * 
 * Theme Customizer enhancements for a better user experience.
 * 
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ( $ ) {

    // Site title and description.
    wp.customize('blogname', function ( value ) {
	value.bind(function ( to ) {
	    $('.site-title a').text(to);
	});
    });
    wp.customize('blogdescription', function ( value ) {
	value.bind(function ( to ) {
	    $('.site-description').text(to);
	});
    });
    // Header text color.
    wp.customize('header_textcolor', function ( value ) {
	value.bind(function ( to ) {
	    if ('blank' === to) {
		$('.site-title').css({
		    'clip' : 'rect(1px, 1px, 1px, 1px)',
		    'position' : 'absolute'
		});
	    } else {
		$('.site-title').css({
		    'clip' : 'auto',
		    'position' : 'relative'
		});
		$('.site-title').css({
		    'color' : to
		});
	    }
	});
    });

    // Hide title only in homepage
    wp.customize('loungeact[hide_title_in_homepage]', function ( value ) {
	value.bind(function ( to ) {
	    if (true === to) {
		$('.site-title').css({
		    'clip' : 'rect(1px, 1px, 1px, 1px)',
		    'position' : 'absolute'
		});
	    } else {
		$('.site-title').css({
		    'clip' : 'auto',
		    'position' : 'relative'
		});
	    }
	});
    });

    // Header fixed top
    wp.customize('loungeact[header_fixed_top]', function ( value ) {
	value.bind(function ( to ) {
	    if ('' === to) {
		$('.lougeact-header.navbar-fixed-top').next().css('margin-top', '0');
		$('.lougeact-header').removeClass('navbar-fixed-top');
	    } else {
		$('.lougeact-header').addClass('navbar-fixed-top');
		$('.lougeact-header.navbar-fixed-top').next().css('margin-top', $('.lougeact-header.navbar-fixed-top').outerHeight());
	    }
	});
    });


    // Site title color
    wp.customize('loungeact[site_title_color]', function ( value ) {
	value.bind(function ( to ) {
	    if (false === to) {
		$('.site-title a').css('color', 'transparent');
	    } else {
		$('.site-title a').css('color', to);
	    }
	});
    });

    // Blog description color
    wp.customize('loungeact[blogdescription_color]', function ( value ) {
	value.bind(function ( to ) {
	    if (false === to) {
		$('.site-description').css('color', 'transparent');
	    } else {
		$('.site-description').css('color', to);
	    }
	});
    });

    // Slider height
    wp.customize('loungeact[slider_height]', function ( value ) {
	value.bind(function ( to ) {
	    $('.loungeact-banner').css('height', to);
	});
    });

    // FullScreen slider
    wp.customize('loungeact[slider_fullscreen]', function ( value ) {
	value.bind(function ( to ) {
	    if (false === to) {
		$('#page').removeClass('loungeact-fullscreen-slider');
	    } else {
		$('#page').addClass('loungeact-fullscreen-slider');
	    }
	});
    });

    // Slide Opacity
    wp.customize('loungeact[slide_overlay_opacity]', function ( value ) {
	value.bind(function ( to ) {
	    $('.flexslider-overlay').css('opacity', to);
	});
    });
})(jQuery);

