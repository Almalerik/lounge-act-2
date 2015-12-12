jQuery.noConflict()(function($) {
    "use strict";

    $.fn.extend({
	loungeact_fullscreen_banner : function() {
		var windowHeight = $(window).height();
		if ($("#wpadminbar").length > 0) {
			windowHeight = windowHeight - jQuery("#wpadminbar").outerHeight();
		}
	    $(this).css('height', windowHeight);
	    /*
	    if ($('.lougeact-header').length > 0){
	    	$(this).css('top', -$('.lougeact-header').outerHeight());
	    }*/
	    	
	}
    });

    $(document).ready(function() {

	// Fix Wp-Admin ToolBar
	if ($("#wpadminbar").length > 0) {
	    fixWpAdminBarHeight();
	    $(window).resize(function() {
		fixWpAdminBarHeight();
	    });
	}

	$('.loungeact-fullscreen-banner .loungeact-banner').loungeact_fullscreen_banner();

	$(window).resize(function() {
	    $('.loungeact-fullscreen-banner .loungeact-banner').loungeact_fullscreen_banner();
	});

	// Responsive submenu open
	
	$("body").on("click", ".loungeact-menu .loungeact-open-submenu", function(e) {
	    e.preventDefault();
	    var $pli = $(this).closest("li");
	    if ($pli.hasClass("nav-open")) {
		$(this).removeClass("glyphicon-triangle-top");
		$(this).addClass("glyphicon-triangle-bottom");
		$(".dropdown-menu:first", $pli).toggle();
		$pli.toggleClass("nav-open");
	    } else {

		$(this).removeClass("glyphicon-triangle-bottom");
		$(this).addClass("glyphicon-triangle-top");
		$(".dropdown-menu:first", $pli).toggle();
		$pli.toggleClass("nav-open");
	    }
	});
	/*
	// Fix content if header is fixed top
	if ($('.lougeact-header.navbar-fixed-top').length > 0) {
	    $('.lougeact-header.navbar-fixed-top').next().css('margin-top', $('.lougeact-header.navbar-fixed-top').outerHeight());
	}*/

	// Slide menu
	$(".navbar-toggle").each(function() {
	    if ($(this).attr('data-toggle')) {
		var datatoggle = $(this).attr('data-toggle');
		if (datatoggle === 'loungeact-menu-slide-left' || datatoggle === 'loungeact-menu-slide-right') {
		    $(this).on('click', function() {
			var $datatarget = $($(this).attr('data-target'));
			if (!$datatarget.hasClass('loungeact-out')) {
			    $datatarget.toggleClass('loungeact-out')
			    $datatarget.stop().animate({
				'left' : '0'
			    }, 400);
			} else {
			    $datatarget.toggleClass('loungeact-out')
			    $datatarget.stop().animate({
				'left' : '-75%'
			    }, 400);
			}
		    });
		}
	    }
	});

    });

    /**
     * Fix Wp-Admin ToolBar
     */
    function fixWpAdminBarHeight() {

	var selectorToFix = [ '.lougeact-header.navbar-fixed-top', '.navbar-fixed-top .navbar-collapse.loungeact-menu-slide-left' ];
	for (var i = 0; i < selectorToFix.length; i++) {

	    // Check if exist
	    if ($(selectorToFix[i]).length > 0) {
		var topMargin = jQuery("#wpadminbar").outerHeight() - jQuery("body").scrollTop();
		topMargin = topMargin < 0 ? 0 : topMargin;
		$(selectorToFix[i]).css("top", jQuery("#wpadminbar").outerHeight());
	    }
	}
    }

});