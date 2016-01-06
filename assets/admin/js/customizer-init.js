jQuery(document).ready(function() {

	// Move title tagline in header panel
	wp.customize.section('title_tagline').panel('loungeact_header');
	wp.customize.section('title_tagline').priority('20');

	// Header widget
	
	

	// //jQuery(wp.customize.control('alcor_container_class_fixed_max_width').container).css("display","none");

	
	// Show or hide slider height
	/*
	if (wp.customize('loungeact[slider_fullscreen]').get() === true) {
		wp.customize.control('loungeact_slider_height').deactivate();
	} else {
		wp.customize.control('loungeact_slider_height').activate();
	}
	jQuery('#customize-control-loungeact_slider_fullscreen input').on('change', function() {
		if (this.checked) {
			wp.customize.control('loungeact_slider_height').deactivate();
			//wp.customize.control('loungeact_slider_header_inside').setting(false);
		} else {
			wp.customize.control('loungeact_slider_height').activate();
		}
	});*/
	

	
	jQuery('body').on('click', '.lougeact-goto-swh-highlights', function(){
	    wp.customize.section('sidebar-widgets-homepage-highlights').focus();
	});
	
	/*
	jQuery('#customize-control-loungeact_header_fixed_top select').on('change', function() {
		if (jQuery(this).val == "") {
			wp.customize.control('header_margin_bottom').deactivate();
		} else {
			wp.customize.control('header_margin_bottom').activate();
		}
	});*/
	
});
