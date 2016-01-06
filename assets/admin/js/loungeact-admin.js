



jQuery.noConflict()(function($) {
	"use strict";
	$(document).ready(function() {

		

		/*
		 * CUSTOM FIELDS
		 */


		// Init Select2 Post list
		

		

		/*
		 * Widget added or updated event
		 */
		jQuery(document).on('widget-added widget-updated', function(e, widget) {
			// After updtae have to reinit Select2
			
		});





		// Event on change preview image input
		$(".loungeact-cf-image-url").change(function(e) {
			$('.loungeact-cf-image-preview', $(this).closest(".loungeact-cf-field-custom ")).empty().append('<img src="' + $(this).val() + '">');
		});

		// Event click on "Add custom html" button
		$("body").on('click', '.loungeact-cf-container .loungeact-cf-add-custom', function(e) {
			e.preventDefault();
			var $container = $(this).closest(".loungeact-cf-container");
			$('.loungeact-cf-add-custom-container, .loungeact-cf-option-button', $container).toggle();
		});





		// END CUSTOM FIELDS


		




	});
});


