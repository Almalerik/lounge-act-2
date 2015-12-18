<?php

require_once 'wordpress-theme-customizer-custom-controls/select/google-font-dropdown-custom-control.php';
require_once 'wordpress-theme-customizer-custom-controls/select/post-dropdown-custom-control.php';
require_once 'wordpress-theme-customizer-custom-controls/text/fixed-text-custom-control.php';
/**
 * Lounge Act Theme Customizer.
 *
 * @package Lounge_Act
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize
 *        	Theme Customizer object.
 */
function loungeact_customize_register($wp_customize) {
	$wp_customize->get_setting ( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting ( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting ( 'header_textcolor' )->transport = 'postMessage';
	// Remove wp header image section
	$wp_customize->remove_section ( 'header_image' );
	
	$loungeact = new Lounge_Act_Theme ();

	/*
	 * ============== HEADER ==============
	 */
	$wp_customize->add_panel ( 'loungeact_header', array (
			'title' => esc_html__ ( 'Header', 'loungeact' ),
			'priority' => 20 
	) );
	
	/* ============== HEADER OPTIONS ============== */
	$wp_customize->add_section ( 'loungeact_header_options', array (
			'title' => esc_html__ ( 'Options', 'loungeact' ),
			'panel' => 'loungeact_header',
			'priority' => 10 
	) );
	// Header fixed top
	$wp_customize->add_setting ( 'loungeact[header_fixed_top]', array (
			'default' => $loungeact->get_setting ( 'header_fixed_top' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_header_fixed_top', array (
			'label' => esc_html__ ( 'Position', 'loungeact' ),
			'section' => 'loungeact_header_options',
			'settings' => 'loungeact[header_fixed_top]',
			'type' => 'select',
			'choices' => array (
					'' => esc_html__ ( 'Top', 'loungeact' ),
					'navbar-sticky-top' => esc_html__ ( 'Fixed top', 'loungeact' ) 
			),
			'priority' => 10 
	) );
	// Header templates
	$wp_customize->add_setting ( 'loungeact[header_template]', array (
			'default' => $loungeact->get_setting ( 'header_template' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_header_template', array (
			'label' => esc_html__ ( 'Template', 'loungeact' ),
			'section' => 'loungeact_header_options',
			'settings' => 'loungeact[header_template]',
			'type' => 'select',
			'choices' => loungeact_admin_header_template_list (),
			'priority' => 30 
	) );
	
	// ============== STYLES AND COLORS ==============
	$wp_customize->add_section ( 'loungeact_header_styles', array (
			'title' => esc_html__ ( 'Colors', 'loungeact' ),
			'panel' => 'loungeact_header',
			'priority' => 30 
	) );
	// Header background color
	$wp_customize->add_setting ( 'loungeact[header_background_color]', array (
			'default' => $loungeact->get_setting ( 'header_background_color' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_header_background_color', array (
			'label' => esc_html__ ( 'Background color', 'loungeact' ),
			'description' => esc_html__ ( 'This will be applied in all the page and post.', 'loungeact' ),
			'section' => 'loungeact_header_styles',
			'settings' => 'loungeact[header_background_color]',
			'priority' => 10 
	) ) );
	// Header background color opacity
	$wp_customize->add_setting ( 'loungeact[header_background_opacity]', array (
			'default' => $loungeact->get_setting ( 'header_background_opacity' ),
			'type' => 'option',
			 
	) );
	$wp_customize->add_control ( 'loungeact_header_background_opacity', array (
			'label' => esc_html__ ( 'Background opacity', 'loungeact' ),
			'description' => esc_html__ ( 'Opacity in all page and post and during scroll if header fixed top.', 'loungeact' ),
			'section' => 'loungeact_header_styles',
			'settings' => 'loungeact[header_background_opacity]',
			'type' => 'range',
			'priority' => 20,
			'input_attrs' => array (
					'min' => 0,
					'max' => 1,
					'step' => 0.1 
			) 
	) );
	// Header background color opacity on scroll
	$wp_customize->add_setting ( 'loungeact[header_background_opacity_inside_slider]', array (
			'default' => $loungeact->get_setting ( 'header_background_opacity_inside_slider' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_header_background_opacity_inside_slider', array (
			'label' => esc_html__ ( 'Background opacity inside slider', 'loungeact' ),
			'description' => esc_html__ ( 'Opacity applied only if the header is inside a slider.', 'loungeact' ),
			'section' => 'loungeact_header_styles',
			'settings' => 'loungeact[header_background_opacity_inside_slider]',
			'type' => 'range',
			'priority' => 30,
			'input_attrs' => array (
					'min' => 0,
					'max' => 1,
					'step' => 0.1 
			) 
	) );
	// Site title color
	$wp_customize->add_setting ( 'loungeact[site_title_color]', array (
			'default' => $loungeact->get_setting ( 'site_title_color' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_site_title_color', array (
			'label' => esc_html__ ( 'Site title color', 'loungeact' ),
			'section' => 'loungeact_header_styles',
			'settings' => 'loungeact[site_title_color]',
			'priority' => 40 
	) ) );
	// Blogdescription color
	$wp_customize->add_setting ( 'loungeact[blogdescription_color]', array (
			'default' => $loungeact->get_setting ( 'blogdescription_color' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'blogdescription_color', array (
			'label' => esc_html__ ( 'Site description color', 'loungeact' ),
			'section' => 'loungeact_header_styles',
			'settings' => 'loungeact[blogdescription_color]',
			'priority' => 50 
	) ) );
	/*
	 * ============== SITE IDENTITY ==============
	 */
	// Logo
	$wp_customize->add_setting ( 'loungeact[font_family_title]', array (
			'default' => $loungeact->get_setting ( "font_family_title" ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new Google_Font_Dropdown_Custom_Control ( $wp_customize, 'loungeact_font_family_title', array (
			'label' => esc_html__ ( 'Title font family', 'loungeact' ),
			'section' => 'title_tagline',
			'settings' => 'loungeact[font_family_title]',
			'priority' => 25 
	) ) );
	// Logo
	$wp_customize->add_setting ( 'loungeact[hide_title_in_homepage]', array (
			'default' => $loungeact->get_setting ( "hide_title_in_homepage" ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_hide_title_in_homepage', array (
			'label' => esc_html__ ( 'Hide header text in homepage', 'loungeact' ),
			'section' => 'title_tagline',
			'settings' => 'loungeact[hide_title_in_homepage]',
			'type' => 'checkbox',
			'priority' => 40 
	) );
	$wp_customize->add_setting ( 'loungeact[logo]', array (
			'default' => $loungeact->get_setting ( "logo" ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Image_Control ( $wp_customize, 'loungeact_logo', array (
			'label' => esc_html__ ( 'Site logo', 'loungeact' ),
			'section' => 'title_tagline',
			'settings' => 'loungeact[logo]',
			'priority' => 100 
	) ) );
	// Logo max height
	$wp_customize->add_setting ( 'loungeact[logo_max_height]', array (
			'default' => $loungeact->get_setting ( "logo_max_height" ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_logo_max_height', array (
			'label' => esc_html__ ( 'Site logo max height', 'loungeact' ),
			'description' => esc_html__ ( 'Define also the unit system like px,% ...', 'loungeact' ),
			'section' => 'title_tagline',
			'settings' => 'loungeact[logo_max_height]',
			'priority' => 200 
	) );
	
	/*
	 * ============== SLIDER ==============
	 */
	$wp_customize->add_section ( 'loungeact_slider', array (
			'title' => esc_html__ ( 'Slider', 'loungeact' ),
			'priority' => 30 
	) );
	// Helper
	$wp_customize->add_control ( new Fixed_Text_Custom_Control ( $wp_customize, 'loungeact_slider_helper', array (
			'description' => __ ( 'To create or edit a slider, save and go <a href="' . admin_url ( 'edit.php?post_type=loungeact_slide' ) . '">here</a>.', 'loungeact' ),
			'section' => 'loungeact_slider',
			'priority' => 10 
	) ) );
	// select slider
	$wp_customize->add_setting ( 'loungeact[slider]', array (
			'default' => $loungeact->get_setting ( 'slider' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new Post_Dropdown_Custom_Control ( $wp_customize, 'loungeact_slider', array (
			'label' => esc_html__ ( 'Slider', 'loungeact' ),
			'section' => 'loungeact_slider',
			'settings' => 'loungeact[slider]',
			'priority' => 20,
			'active_callback' => 'loungeact_slider_exist' 
	), array (
			'post_type' => 'loungeact_slide' 
	) ) );
	// slider height
	$wp_customize->add_setting ( 'loungeact[slider_height]', array (
			'default' => $loungeact->get_setting ( 'slider_height' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_slider_height', array (
			'label' => esc_html__ ( 'Slider height', 'loungeact' ),
			'description' => esc_html__ ( 'Define also the unit system like px,% ...', 'loungeact' ),
			'section' => 'loungeact_slider',
			'settings' => 'loungeact[slider_height]',
			'type' => 'text',
			'priority' => 30,
			'active_callback' => 'is_loungeact_slider_not_fullscreen' 
	) );
	// slide opacity
	$wp_customize->add_setting ( 'loungeact[slide_overlay_opacity]', array (
			'default' => $loungeact->get_setting ( 'slide_overlay_opacity' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_slide_overlay_opacity', array (
			'label' => esc_html__ ( 'Slide overlay opacity', 'loungeact' ),
			'section' => 'loungeact_slider',
			'settings' => 'loungeact[slide_overlay_opacity]',
			'type' => 'range',
			'priority' => 40,
			'input_attrs' => array (
					'min' => 0,
					'max' => 1,
					'step' => 0.1 
			),
			'active_callback' => 'loungeact_slider_selected' 
	) );
	// slide layout
	$wp_customize->add_setting ( 'loungeact[slider_layout]', array (
			'default' => $loungeact->get_setting ( 'slider_layout' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_slider_layout', array (
			'label' => esc_html__ ( 'Slider layout', 'loungeact' ),
			'section' => 'loungeact_slider',
			'settings' => 'loungeact[slider_layout]',
			'type' => 'select',
			'choices' => array (
					'' => esc_html__ ( 'Normal', 'loungeact' ),
					'loungeact-fullscreen-banner' => esc_html__ ( 'FullScreen', 'loungeact' ),
					'loungeact-header-inside-banner' => esc_html__ ( 'Header inside', 'loungeact' ) 
			),
			'priority' => 50,
			'active_callback' => 'loungeact_slider_selected' 
	) );
	// slide only in home
	$wp_customize->add_setting ( 'loungeact[slider_only_in_homepage]', array (
			'default' => $loungeact->get_setting ( 'slider_only_in_homepage' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_slider_only_in_homepage', array (
			'label' => esc_html__ ( 'Show only in homepage', 'loungeact' ),
			'section' => 'loungeact_slider',
			'settings' => 'loungeact[slider_only_in_homepage]',
			'type' => 'checkbox',
			'priority' => 60,
			'active_callback' => 'loungeact_slider_selected'
	) );
	
	/*
	 * ============== Style ==============
	 */
	$wp_customize->add_panel ( 'loungeact_styles', array (
			'title' => esc_html__ ( 'Styles', 'loungeact' ),
			'priority' => 30 
	) );
	$wp_customize->add_section ( 'loungeact_typography', array (
			'title' => esc_html__ ( 'Typography', 'loungeact' ),
			'panel' => 'loungeact_styles',
			'priority' => 10 
	) );
	$wp_customize->add_setting ( 'loungeact[font_family_default]', array (
			'default' => $loungeact->get_setting ( 'font_family_default' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new Google_Font_Dropdown_Custom_Control ( $wp_customize, 'loungeact_font_family_default', array (
			'label' => esc_html__ ( 'Default font family', 'loungeact' ),
			'section' => 'loungeact_typography',
			'settings' => 'loungeact[font_family_default]',
			'priority' => 10 
	) ) );
	$wp_customize->add_setting ( 'loungeact[font_family_h1]', array (
			'default' => $loungeact->get_setting ( 'font_family_h1' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new Google_Font_Dropdown_Custom_Control ( $wp_customize, 'loungeact_font_family_h1', array (
			'label' => esc_html__ ( 'H1 font family', 'loungeact' ),
			'section' => 'loungeact_typography',
			'settings' => 'loungeact[font_family_h1]',
			'priority' => 20 
	) ) );
	$wp_customize->add_setting ( 'loungeact[font_family_h2]', array (
			'default' => $loungeact->get_setting ( 'font_family_h2' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new Google_Font_Dropdown_Custom_Control ( $wp_customize, 'loungeact_font_family_h2', array (
			'label' => esc_html__ ( 'H2 font family', 'loungeact' ),
			'section' => 'loungeact_typography',
			'settings' => 'loungeact[font_family_h2]',
			'priority' => 30 
	) ) );
	// Colors
	$wp_customize->add_section ( 'loungeact_colors', array (
			'title' => esc_html__ ( 'Colors' ),
			'panel' => 'loungeact_styles',
			'priority' => 20
	) );
	$wp_customize->add_setting ( 'loungeact[color_link]', array (
			'default' => $loungeact->get_setting ( 'color_link' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_color_link', array (
			'label' => esc_html__ ( 'Link', 'loungeact' ),
			'section' => 'loungeact_colors',
			'settings' => 'loungeact[color_link]',
			'priority' => 10
	) ) );
	$wp_customize->add_setting ( 'loungeact[color_link_visited]', array (
			'default' => $loungeact->get_setting ( 'color_link_visited' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_color_link_visited', array (
			'label' => esc_html__ ( 'Visited link', 'loungeact' ),
			'section' => 'loungeact_colors',
			'settings' => 'loungeact[color_link_visited]',
			'priority' => 20
	) ) );
	$wp_customize->add_setting ( 'loungeact[color_link_hover]', array (
			'default' => $loungeact->get_setting ( 'color_link_hover' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_color_link_hover', array (
			'label' => esc_html__ ( 'Hover link', 'loungeact' ),
			'section' => 'loungeact_colors',
			'settings' => 'loungeact[color_link_hover]',
			'priority' => 30
	) ) );
	
	/*
	 * ============== Menu ==============
	 */
	$wp_customize->add_section ( 'loungeact_menu_responsive_options', array (
			'title' => esc_html__ ( 'Responsive options', 'loungeact' ),
			'panel' => 'nav_menus',
			'priority' => 1 
	) );
	$wp_customize->add_setting ( 'loungeact[menu_slide]', array (
			'default' => $loungeact->get_setting ( 'menu_slide' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_menu_slide', array (
			'label' => esc_html__ ( 'Menu slide', 'loungeact' ),
			'section' => 'loungeact_menu_responsive_options',
			'settings' => 'loungeact[menu_slide]',
			'type' => 'select',
			'choices' => array (
					'' => esc_html__ ( 'No', 'loungeact' ),
					'loungeact-menu-slide-left' => esc_html__ ( 'From the left', 'loungeact' ),
					'loungeact-menu-slide-right' => esc_html__ ( 'From the right', 'loungeact' ) 
			),
			'priority' => 10 
	) );
	$wp_customize->add_section ( 'loungeact_menu_styles', array (
			'title' => esc_html__ ( 'Styles', 'loungeact' ),
			'panel' => 'nav_menus',
			'priority' => 2 
	) );
	$wp_customize->add_setting ( 'loungeact[menu_font_color]', array (
			'default' => $loungeact->get_setting ( 'menu_font_color' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_menu_font_color', array (
			'label' => esc_html__ ( 'Font color', 'loungeact' ),
			'section' => 'loungeact_menu_styles',
			'settings' => 'loungeact[menu_font_color]',
			'priority' => 10 
	) ) );
	$wp_customize->add_setting ( 'loungeact[menu_font_color_hover]', array (
			'default' => $loungeact->get_setting ( 'menu_font_color' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( new WP_Customize_Color_Control ( $wp_customize, 'loungeact_menu_font_color_hover', array (
			'label' => esc_html__ ( 'Font color on mouse over', 'loungeact' ),
			'section' => 'loungeact_menu_styles',
			'settings' => 'loungeact[menu_font_color_hover]',
			'priority' => 20 
	) ) );
	
	/*
	 * ============== HOMEPAGE FEATURES ==============
	 */
	$wp_customize->add_panel ( 'loungeact_homepage_features', array (
			'title' => esc_html__ ( 'Homepage Features', 'loungeact' ) 
	) );
	
	$wp_customize->add_section ( 'loungeact_homepage_features_option', array (
			'title' => esc_html__ ( 'Settings' ),
			'panel' => 'loungeact_homepage_features',
			'active_callback' => 'is_front_page',
			'priority' => 10 
	) );
	// Helper
	$wp_customize->add_control ( new Fixed_Text_Custom_Control ( $wp_customize, 'loungeact_homepage_features_option_helper', array (
			'description' => __ ( 'To add a "Loungeact Feature" widget <a href="#" class="button lougeact-goto-swh-features">click here</a>', 'loungeact' ),
			'section' => 'loungeact_homepage_features_option',
			'priority' => 10 
	) ) );
	// Show
	$wp_customize->add_setting ( 'loungeact[homepage_features_show]', array (
			'default' => $loungeact->get_setting ( 'homepage_features_show' ),
			'type' => 'option' 
	) );
	$wp_customize->add_control ( 'loungeact_homepage_features_show', array (
			'label' => esc_html__ ( 'Show' ),
			'section' => 'loungeact_homepage_features_option',
			'settings' => 'loungeact[homepage_features_show]',
			'type' => 'checkbox',
			'priority' => 20 
	) );
	// Title
	$wp_customize->add_setting ( 'loungeact[homepage_features_title]', array (
			'default' => $loungeact->get_setting ( 'homepage_features_title' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_homepage_features_title', array (
			'label' => esc_html__ ( 'Title' ),
			'section' => 'loungeact_homepage_features_option',
			'settings' => 'loungeact[homepage_features_title]',
			'priority' => 30
	) );
	// Subtitle
	$wp_customize->add_setting ( 'loungeact[homepage_features_subtitle]', array (
			'default' => $loungeact->get_setting ( 'homepage_features_subtitle' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_homepage_features_subtitle', array (
			'label' => esc_html__ ( 'Description' ),
			'section' => 'loungeact_homepage_features_option',
			'settings' => 'loungeact[homepage_features_subtitle]',
			'priority' => 30
	) );
	
	/*
	 * ============== HOMEPAGE HIGHLIGHTS ==============
	 */
	$wp_customize->add_panel ( 'loungeact_homepage_highlights', array (
			'title' => esc_html__ ( 'Homepage Highlights', 'loungeact' )
	) );
	$wp_customize->add_section ( 'loungeact_homepage_highlights_option', array (
			'title' => esc_html__ ( 'Settings' ),
			'panel' => 'loungeact_homepage_highlights',
			'active_callback' => 'is_front_page',
			'priority' => 10
	) );
	// Helper
	$wp_customize->add_control ( new Fixed_Text_Custom_Control ( $wp_customize, 'loungeact_homepage_features_option_helper', array (
			'description' => __ ( 'To add a "Loungeact Highlights" widget <a href="#" class="button lougeact-goto-swh-highlights">click here</a>', 'loungeact' ),
			'section' => 'loungeact_homepage_highlights_option',
			'priority' => 10
	) ) );
	// Show
	$wp_customize->add_setting ( 'loungeact[homepage_highlights_show]', array (
			'default' => $loungeact->get_setting ( 'homepage_highlights_show' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_homepage_highlights_show', array (
			'label' => esc_html__ ( 'Show' ),
			'section' => 'loungeact_homepage_highlights_option',
			'settings' => 'loungeact[homepage_highlights_show]',
			'type' => 'checkbox',
			'priority' => 20
	) );
	// Title
	$wp_customize->add_setting ( 'loungeact[homepage_highlights_title]', array (
			'default' => $loungeact->get_setting ( 'homepage_highlights_title' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_homepage_highlights_title', array (
			'label' => esc_html__ ( 'Title' ),
			'section' => 'loungeact_homepage_highlights_option',
			'settings' => 'loungeact[homepage_highlights_title]',
			'priority' => 30
	) );
	// Subtitle
	$wp_customize->add_setting ( 'loungeact[homepage_highlights_subtitle]', array (
			'default' => $loungeact->get_setting ( 'homepage_highlights_subtitle' ),
			'type' => 'option'
	) );
	$wp_customize->add_control ( 'loungeact_homepage_highlights_subtitle', array (
			'label' => esc_html__ ( 'Description' ),
			'section' => 'loungeact_homepage_highlights_option',
			'settings' => 'loungeact[homepage_highlights_subtitle]',
			'priority' => 30
	) );
}
add_action ( 'customize_register', 'loungeact_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function loungeact_customize_preview_js() {
	wp_enqueue_script ( 'loungeact_customizer', get_template_directory_uri () . '/assets/admin/js/customizer.js', array (
			'customize-preview' 
	), '20130508', true );
}
add_action ( 'customize_preview_init', 'loungeact_customize_preview_js' );

/**
 * Binds JS handlers to Theme Customizer control.
 */
function loungeact_customize_control_init_js() {
	wp_enqueue_script ( 'loungeact_customizer_control_init', get_template_directory_uri () . '/assets/admin/js/customizer-init.js', array (
			'jquery' 
	), '20130508', true );
}
add_action ( 'customize_controls_enqueue_scripts', 'loungeact_customize_control_init_js' );

/**
 *
 * @param string $value        	
 * @return string
 */
function loungeact_sanitize_css_number($value) {
	str_replace ( ",", ".", $value );
	if (is_numeric ( $value )) {
		return $value . "px";
	}
	return $value;
}

/**
 * A function that check if a slider exist
 *
 * @return boolean
 */
function loungeact_slider_exist() {
	$posts_array = get_posts ( array (
			'post_type' => 'loungeact_slide' 
	) );
	if (count ( $posts_array ) > 0) {
		return true;
	} else {
		return false;
	}
}
function loungeact_slider_selected($control) {
	if ($control->manager->get_setting ( 'loungeact[slider]' )->value () != '') {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if slider fullscreen is not active
 *
 * @return boolean
 */
function is_loungeact_slider_not_fullscreen($control) {
	if (loungeact_slider_selected ( $control )) {
		if ($control->manager->get_setting ( 'loungeact[slider_layout]' )->value () == 'loungeact-fullscreen-banner') {
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

/**
 * Check if slider fullscreen is not active
 *
 * @return boolean
 */
function is_container_not_fluid($control) {
	if ($control->manager->get_setting ( 'loungeact[container_class]' )->value () == 'container') {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if header fixed top is selected
 *
 * @return boolean
 */
function is_header_fixed_top($control) {
	if ($control->manager->get_setting ( 'loungeact[header_fixed_top]' )->value () == '') {
		return false;
	} else {
		return true;
	}
}


