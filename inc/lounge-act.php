<?php

/**
 * Loungeact class.
 *
 * @since 1.0.0
 * @package loungeact
 */
class Lounge_Act_Theme {
	const SLUG = 'loungeact';
	
	/**
	 * All default settings.
	 *
	 * @access public
	 * @var array
	 */
	private $defaults = array (
			'container_class' => 'container-fluid',
			'container_max_width' => '1170px',
			"page_layout" => "full",
			"sidebar_width" => "3",
			"gridsystem_class" => "md",
			'hide_title_in_homepage' => false,
			'logo' => '',
			'logo_max_height' => '100px',
			'header_template' => 'default.php',
			'header_background_color' => '#ffffff',
			'header_background_opacity' => '1',
			'header_background_opacity_inside_slider' => '0',
			"header_fixed_top" => "",
			'site_title_color' => '#337ab7',
			'blogdescription_color' => '#777777',
			'slider' => '',
			'slider_height' => '400px',
			'slide_overlay_opacity' => '0',
			'slider_layout' => '',
			'slider_only_in_homepage' => true,
			'font_family_title' => 'Poiret One:regular',
			'font_family_default' => 'Open Sans:regular',
			'font_family_h1' => 'Open Sans:regular',
			'font_family_h2' => 'Open Sans:regular',
			'menu_slide' => '',
			'menu_font_color' => '#777777',
			'menu_font_color_hover' => '#333333',
			
			'homepage_features_show' => true,
			
			// TODO: DA VERIFICARE
			
			"header_margin_bottom" => "0px",
			"header_image_show" => "homepage-only",
			"header_image_parallax" => TRUE,
			"header_image_height" => "250px",
			"header_image_text" => "Alcor",
			"header_image_text_color" => "#ffffff",
			"header_slider_show" => TRUE,
			
			"hide_homepage_sidebar" => TRUE,
			"sidebar_width" => "3" 
	);
	
	/**
	 *
	 * @var array
	 */
	private $theme_options;
	
	/**
	 * Default constructor
	 *
	 * @param string $version
	 *        	Theme version
	 */
	public function __construct() {
		$this->theme_options = get_option ( self::SLUG );
	}
	
	/**
	 * If exist theme_options[key] return this otherwise return the default value
	 *
	 * @param String $key        	
	 */
	function get_setting($key) {
		if (isset ( $this->theme_options [$key] )) {
			return $this->theme_options [$key];
		} else if (isset ( $this->defaults [$key] )) {
			return $this->defaults [$key];
		} else {
			return '';
		}
	}
	
	/**
	 * This will output the logo url.
	 */
	public function get_logo() {
		$logo = $this->get_setting ( 'logo' );
		
		if (isset ( $logo ) && $logo != "") {
			return $logo;
		} else {
			if (file_exists ( get_stylesheet_directory () . "/assets/images/logo.png" )) {
				return get_stylesheet_directory_uri () . "/assets/images/logo.png";
			} else {
				return get_template_directory_uri () . "/assets/images/logo.png";
			}
		}
	}
	
	/**
	 * This will generate a line of CSS for use in header output.
	 * If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector
	 *        	CSS selector
	 * @param string $style
	 *        	The name of the CSS *property* to modify
	 * @param string $mod_name
	 *        	The name of the 'theme_mod' option to fetch
	 * @param string $prefix
	 *        	Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix
	 *        	Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo
	 *        	Optional. Whether to print directly to the page (default: TRUE).
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since Lounge_Act_Theme 1.0
	 */
	public function generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = TRUE) {
		$return = '';
		$mod = $this->get_setting ( $mod_name );
		// If $mod is false and $style contain the word 'color', set color as transparent;
		if ($mod == '' && strpos ( $style, 'color' ) !== false) {
			$mod = "transparent";
		}
		
		// The value saved is equal to the default, skip
		if ($mod != '' && $mod != $this->defaults [$mod_name]) {
			$return = sprintf ( "%s { %s:%s; }\n", $selector, $style, $prefix . $mod . $postfix );
			if ($echo) {
				echo $return;
			}
		}
		return $return;
	}
	
	/**
	 * This will output custom css
	 */
	private function custom_css() {
		$result = '';
		$result .= '<!-- Lounge Act Custom CSS -->' . "\n";
		$result .= '<style type="text/css" id="loungeact-custom-css">' . "\n";
		
		// HEADER
		// Simulate header height when fixed-top
		//if ($this->get_setting ( "header_fixed_top" ) && !$this->get_setting ( "slider_fullscreen" )) {
			//$result .= $this->generate_css ( ".lougeact-wrapper.loungeact-header-fixed-top", "padding-top", "header_margin_bottom", '', '', false );
		//}
		
		
		// logo
		$result .= $this->generate_css ( ".lougeact-header .site-logo", "max-height", "logo_max_height", '', '', false );
		
		//SLIDER
		$result .= $this->generate_css ( ".loungeact-banner", "height", "slider_height", '', '', false );
		$result .= $this->generate_css ( ".loungeact-banner .loungeact-slider-overlay", "background-color", "slide_overlay_opacity", 'rgba(0 , 0 , 0, ', ')', false );
		
		//if ($this->get_setting ( "slider_header_inside" )) {
			//$result .= '.lougeact-header {position: absolute;}';
		//}
		
		if ((is_front_page () && is_home () && $this->get_setting ( "hide_title_in_homepage" ))) {
			$result .= '.site-title {position: absolute;clip: rect(1px, 1px, 1px, 1px);}';
		}
		if ($this->get_setting ( "container_class" ) == "container") {
			$result .= $this->generate_css ( ".loungeact-container.container", "max-width", "container_max_width", '', '', false );
		}
		
		if ($this->get_setting ( "header_background_color" )) {
			$result .= ".lougeact-header .navbar-default { background-color: rgba(" . implode ( ", ", hex2rgba ( $this->get_setting ( "header_background_color" ), $this->get_setting ( "header_background_opacity" ) ) ) . ");}\n";
			$result .= ".loungeact-fullscreen-banner.lougeact-scrolling .navbar-default { background-color: rgba(" . implode ( ", ", hex2rgba ( $this->get_setting ( "header_background_color" ), $this->get_setting ( "header_background_opacity" ) ) ) . ");}\n";
			$result .= ".loungeact-header-inside-banner.lougeact-scrolling .lougeact-header .navbar-default { background-color: rgba(" . implode ( ", ", hex2rgba ( $this->get_setting ( "header_background_color" ), $this->get_setting ( "header_background_opacity" ) ) ) . ");}\n";
		} else {
			$result .= ".lougeact-header .navbar-default { background-color: transparent;}";
			$result .= ".loungeact-fullscreen-banner.lougeact-scrolling .navbar-default { background-color: transparent;}";
			$result .= ".loungeact-header-inside-banner.lougeact-scrolling .navbar-default { background-color: transparent;}";
		}
		
		if ($this->get_setting ( "header_background_opacity_inside_slider" )) {
			$result .= ".loungeact-header-inside-banner .lougeact-header .navbar-default { background-color: rgba(" . implode ( ", ", hex2rgba ( $this->get_setting ( "header_background_color" ), $this->get_setting ( "header_background_opacity_inside_slider" ) ) ) . ");}\n";
			$result .= ".loungeact-fullscreen-banner .lougeact-header .navbar-default { background-color: rgba(" . implode ( ", ", hex2rgba ( $this->get_setting ( "header_background_color" ), $this->get_setting ( "header_background_opacity_inside_slider" ) ) ) . ");}\n";
			
		} else {
			$result .= ".loungeact-header-inside-banner .lougeact-header .navbar-default { background-color: transparent;}";
			$result .= ".loungeact-fullscreen-banner .lougeact-header .navbar-default { background-color: transparent;}";
		}
		
		// Main Menu
		$result .= $this->generate_css ( ".navbar-default .loungeact-navbar .navbar-nav > li > a", "color", "menu_font_color", '', '', false );
		$result .= $this->generate_css ( ".navbar-default .loungeact-navbar .navbar-nav > li > a:hover", "color", "menu_font_color_hover", '', '', false );
		
		
		
		
		
		$result .= $this->generate_css ( ".site-title a", "color", "site_title_color", '', '', false );
		$result .= $this->generate_css ( ".site-description", "color", "blogdescription_color", '', '', false );
		
		if ($this->get_setting ( "font_family_title" )) {
			$result .= "h1.site-title { font-family: '" . explode ( ":", $this->get_setting ( "font_family_title" ) ) [0] . "'}\n";
		}
		if ($this->get_setting ( "font_family_default" )) {
			$result .= "body { font-family: '" . explode ( ":", $this->get_setting ( "font_family_default" ) ) [0] . "'}\n";
		}
		if ($this->get_setting ( "font_family_h1" )) {
			$result .= "h1 { font-family: '" . explode ( ":", $this->get_setting ( "font_family_h1" ) ) [0] . "'}\n";
		}
		if ($this->get_setting ( "font_family_h2" )) {
			$result .= "h2 { font-family: '" . explode ( ":", $this->get_setting ( "font_family_h2" ) ) [0] . "'}\n";
		}
		$result .= '</style>' . "\n";
		;
		$result .= '<!-- /Lounge Act Custom CSS -->' . "\n";
		;
		return $result;
	}
	/*
	 * private function get_css_color($mod_name) {
	 * if (! $this->get_setting ( $mod_name )) {
	 * return 'trasparent';
	 * }
	 * return $color;
	 * }
	 */
	private function get_google_font() {
		$protocol = "http";
		if (is_ssl ()) {
			$protocol = "https";
		}
		$google = '<link rel="stylesheet" type="text/css" href="' . $protocol . '://fonts.googleapis.com/css?family=';
		$result = array ();
		$items = array (
				"font_family_title",
				"font_family_default",
				"font_family_h1",
				"font_family_h2" 
		);
		foreach ( $items as $item ) {
			$f = str_replace ( " ", "+", $this->get_setting ( $item ) );
			if ($this->get_setting ( $item ) && ! in_array ( $f, $result )) {
				$result [] = $f;
			}
		}
		if (count ( $result ) > 0) {
			return $google . implode ( "|", $result ) . '">';
		}
		return '';
	}
	public function custom_head() {
		echo $this->get_google_font ();
		echo $this->custom_css ();
	}
	public function get_sidebar_class($col) {
		if ($col == 'sidebar-left' && ($this->get_setting ( 'page_layout' ) == 'all' || $this->get_setting ( 'page_layout' ) == 'left')) {
			return "col-md-" . $this->get_setting ( 'sidebar_width' );
		} elseif ($col == 'sidebar-right' && ($this->get_setting ( 'page_layout' ) == 'all' || $this->get_setting ( 'page_layout' ) == 'right')) {
			return "col-md-" . $this->get_setting ( 'sidebar_width' );
		}
		return '';
	}
	public function get_content_class() {
		$page_layout = $this->get_setting ( 'page_layout' );
		$sidebar_width = $this->get_setting ( 'sidebar_width' );
		
		switch ($page_layout) {
			case "left" :
			case "right" :
				return 'col-md-' . (12 - intval ( $sidebar_width ));
				break;
			case "all" :
				return 'col-md-' . (12 - (intval ( $this->get_setting ( 'sidebar_width' ) * 2 )));
				break;
			case "full" :
				return 'col-md-12';
				break;
		}
	}
	
	/**
	 * Return classes to add to the main page div
	 *
	 * @access public
	 * @return string classes
	 */
	public function get_page_class() {
		$classes = array (
				$this->get_setting ( 'container_class' )
		);
		if ($this->get_setting ( 'header_fixed_top' ) != '') {
			$classes [] = 'loungeact-header-fixed-top';
		}
		// If a slider is selected, add class layout
		if ($this->get_setting ( "slider" ) != '' ) {
			if (is_home() || is_front_page()) {
				$classes [] = $this->get_setting ( 'slider_layout' );
			} else {
				// if not in home and slider_only_in_homepage == false, add class
				if ( ! $this->get_setting ( 'slider_only_in_homepage' ) ) {
					$classes [] = $this->get_setting ( 'slider_layout' );
				}
			}
		}
		
		
		return implode ( " ", $classes );
	}
}












