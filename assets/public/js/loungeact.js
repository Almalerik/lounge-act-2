jQuery.noConflict()(function($) {
    "use strict";



    $(document).ready(function() {
    	
    	
    	//This is necessary if user refresh page when not top
    	if ($('#page').hasClass('loungeact-header-fixed-top')){
    	if ($(window).scrollTop() >= 50) {
    		$(".lougeact-wrapper").addClass("lougeact-scrolling");
    	}
    	$(window).scroll(function() {    
    	    var scroll = $(window).scrollTop();
    	    if (scroll >= 50) {
    	        $(".lougeact-wrapper").addClass("lougeact-scrolling");
    	    } else {
    	        $(".lougeact-wrapper").removeClass("lougeact-scrolling");
    	    }
    	});
    	}

	// Fix Wp-Admin ToolBar
    	/*
	if ($("#wpadminbar").length > 0) {
	    fixWpAdminBarHeight();
	    $(window).resize(function() {
		fixWpAdminBarHeight();
	    });
	}
	*/
	
	//Sticky Header
	$('.navbar-sticky-top').stick_in_parent({'sticky_class' : 'loungeact-header-sticked', 'parent': $('body')});
	
	


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
    /*
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
    }*/

});
