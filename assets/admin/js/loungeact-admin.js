
/*
 * Select2 FontAwesome init
 */
jQuery.fn.loungeact_select2_fa = function() {
	jQuery(this).select2({
		'templateResult' : formatMenuIcon,
		'templateSelection' : formatMenuIcon,
		'width' : 'resolve',
		'closeOnSelect' : true
	});
};

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

/*
 * Select2 theme menu template to show icons
 */
function formatMenuIcon(icon) {
	if (!icon.id) {
		return icon.text;
	}
	var $icon = jQuery('<span><i class="' + icon.element.value.toLowerCase() + '"></i> ' + icon.text + '</span>');
	return $icon;
};

jQuery.noConflict()(function($) {
	"use strict";
	$(document).ready(function() {

		$('.lougeact-colorpicker').wpColorPicker();

		/*
		 * CUSTOM FIELDS
		 */
		// Init Select2 FontAwesome
		$(".loungeact-cf-container .loungeact-cf-icon-select2").loungeact_select2_fa();

		// Init Select2 Post list
		$(".loungeact-cf-container .loungeact-cf-post-select2").loungeact_select2_post_list();

		

		/*
		 * Widget added or updated event
		 */
		jQuery(document).on('widget-added widget-updated', function(e, widget) {
			// After updtae have to reinit Select2
			$(".loungeact-cf-icon-select2", widget).loungeact_select2_fa();
			$(".loungeact-cf-container .loungeact-cf-post-select2").loungeact_select2_post_list();
			$('.lougeact-colorpicker').wpColorPicker();
			$(".loungeact-accordion").loungeact_accordion();
		});

		// Event click on "Add icon" button
		$("body").on('click', '.loungeact-cf-container .loungeact-cf-add-font-icon', function(e) {
			e.preventDefault();
			var $container = $(this).closest(".loungeact-cf-container");
			$('.loungeact-cf-add-font-icon-container, .loungeact-cf-option-button', $container).toggle();
			// I need to remove select2-container because if this is a new
			// widget wp clone an exist widget without attach event
			$('.select2-container', $container).remove()
			$(".loungeact-cf-icon-select2", $container).loungeact_select2_fa();
		});

		// Event click on "Add media" button
		$("body").on('click', '.loungeact-cf-container .loungeact-cf-add-image', function(e) {
			e.preventDefault();
			var $container = $(this).closest(".loungeact-cf-container");
			$('.loungeact-cf-add-image-container, .loungeact-cf-option-button', $container).toggle();
			$('.loungeact-cf-options-val', $container).val('');
			$('.loungeact-cf-image-preview', $container).html("");

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

		// Event click on trash menu button
		$("body").on('click', '.loungeact-cf-container .loungeact-cf-option-reset', function(e) {
			e.preventDefault();
			var $container = $(this).closest(".loungeact-cf-container");
			$('.loungeact-cf-options-val', $container).val('').change();
			$(this).closest('.loungeact-cf-field-custom').toggle();
			$(".loungeact-cf-option-button", $container).toggle();
		})

		// END CUSTOM FIELDS


		




	});
});


