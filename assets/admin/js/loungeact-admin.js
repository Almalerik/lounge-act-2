


/*
 * Select2 PostList init
 */
jQuery.fn.loungeact_select2_post_list = function() {
	jQuery(this).select2({
		'width' : 'resolve',
		'closeOnSelect' : true,
		'ajax' : {
			url : ajax_object.ajax_url,
			dataType : 'json',
			delay : 250,
			data : function(params) {
				return {
					action : "lougeact_get_post",
					// search term
					title : params.term,
					type : "post, page"
				};
			},
			cache : true
		},
		'templateResult' : function(data) {
			return data.text;
		},
		'templateSelection' : function(data) {
			return data.text;
		}
	});
	jQuery(this).trigger("change");
};



jQuery.noConflict()(function($) {
	"use strict";
	$(document).ready(function() {

		$('.lougeact-colorpicker').wpColorPicker();

		/*
		 * CUSTOM FIELDS
		 */


		// Init Select2 Post list
		$(".loungeact-cf-container .loungeact-cf-post-select2").loungeact_select2_post_list();

		

		/*
		 * Widget added or updated event
		 */
		jQuery(document).on('widget-added widget-updated', function(e, widget) {
			// After updtae have to reinit Select2
			$(".loungeact-cf-container .loungeact-cf-post-select2").loungeact_select2_post_list();
			$('.lougeact-colorpicker').wpColorPicker();
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

		// Event click on "Use post or page" button
		$("body").on('click', '.loungeact-cf-container .loungeact-cf-select-post', function(e) {
			e.preventDefault();
			var $container = $(this).closest(".loungeact-cf-container");
			$('.loungeact-cf-select-post-container, .loungeact-cf-option-button', $container).toggle();
			// I need to remove select2-container because if this is a new
			// widget wp clone an exist widget without attach event
			$('.select2-container', $container).remove()
			$(".loungeact-cf-post-select2", $container).loungeact_select2_post_list();
		});



		// END CUSTOM FIELDS


		




	});
});


