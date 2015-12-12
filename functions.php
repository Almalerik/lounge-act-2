<?php
/**
 * Lounge Act functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lounge_Act
 */
$version = '1.0.0';

if (! function_exists ( 'loungeact_setup' )) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function loungeact_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Lounge Act, use a find and replace
		 * to change 'loungeact' to the name of your theme in all the template files.
		 */
		load_theme_textdomain ( 'loungeact', get_template_directory () . '/languages' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support ( 'automatic-feed-links' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support ( 'title-tag' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support ( 'post-thumbnails' );
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus ( array (
				'primary' => esc_html__ ( 'Primary Menu', 'loungeact' ) 
		) );
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support ( 'html5', array (
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption' 
		) );
		
		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support ( 'post-formats', array (
				'aside',
				'image',
				'video',
				'quote',
				'link' 
		) );
		
		// Set up the WordPress core custom background feature.
		add_theme_support ( 'custom-background', apply_filters ( 'loungeact_custom_background_args', array (
				'default-color' => 'ffffff',
				'default-image' => '' 
		) ) );
	}








endif; // loungeact_setup
add_action ( 'after_setup_theme', 'loungeact_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function loungeact_content_width() {
	$GLOBALS ['content_width'] = apply_filters ( 'loungeact_content_width', 640 );
}
add_action ( 'after_setup_theme', 'loungeact_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function loungeact_widgets_init() {
	register_sidebar ( array (
			'name' => esc_html__ ( 'Sidebar left', 'loungeact' ),
			'id' => 'sidebar-left',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' 
	) );
	register_sidebar ( array (
			'name' => esc_html__ ( 'Sidebar right', 'loungeact' ),
			'id' => 'sidebar-right',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' 
	) );
	register_sidebar ( array (
			'name' => esc_html__ ( 'Homepage features', 'loungeact' ),
			'id' => 'homepage-features',
			'description' => esc_html__ ( 'From the widgets list, select "Loungeact Feature".', 'loungeact' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' 
	) );
	register_sidebar ( array (
			'name' => esc_html__ ( 'Homepage highlights', 'loungeact' ),
			'id' => 'homepage-highlights',
			'description' => esc_html__ ( 'From the widgets list, select "Loungeact Highlights".', 'loungeact' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>' 
	) );
}
add_action ( 'widgets_init', 'loungeact_widgets_init' );

// TODO: filter what used
/**
 * Enqueue public scripts and styles.
 */
if (! function_exists ( 'loungeact_public_scripts' )) :
	function loungeact_public_scripts() {
		$loungeact = new Lounge_Act_Theme ();
		
		// FontAwesome
		wp_enqueue_style ( 'loungeact-fontawesome', get_template_directory_uri () . '/assets/font-awesome/4.4.0/css/font-awesome.min.css' );
		
		// Bootstrap
		wp_enqueue_style ( 'loungeact-bootstrap-style', get_template_directory_uri () . '/assets/bootstrap/3.3.6/css/bootstrap.css' );
		wp_enqueue_script ( 'loungeact-bootstrap-script', get_template_directory_uri () . '/assets/bootstrap/3.3.6/js/bootstrap.min.js', array (
				'jquery' 
		), '3.3.6', true );
		
		// FlexSlider
		// wp_enqueue_style ( 'loungeact-flexslider-style', get_template_directory_uri () . '/assets/flexslider/css/flexslider.css' );
		// wp_enqueue_script ( 'loungeact-flexslider-script', get_template_directory_uri () . '/assets/flexslider/js/jquery.flexslider-min.js', array (
		// 'jquery'
		// ), '3.3.5', true );
		
		wp_enqueue_style ( 'loungeact-swiper-style', get_template_directory_uri () . '/assets/swiper/css/swiper.css' );
		wp_enqueue_script ( 'loungeact-swiper-script', get_template_directory_uri () . '/assets/swiper/js/swiper.jquery.js', array (
				'jquery' 
		), '3.3.5', true );
		
		// TODO: use only style.css
		// Default style.css
		wp_enqueue_style ( 'loungeact-style', get_stylesheet_uri (), array (
				'loungeact-fontawesome',
				'loungeact-bootstrap-style',
				'loungeact-swiper-style' 
		) );
		
		wp_enqueue_style ( 'loungeact-css', get_template_directory_uri () . '/assets/public/css/loungeact.css', array () );
		
		wp_enqueue_script ( 'loungeact-js', get_template_directory_uri () . '/assets/public/js/loungeact.js', array (
				'jquery' 
		), '20120206', true );
		
		wp_enqueue_script ( 'loungeact-navigation', get_template_directory_uri () . '/js/navigation.js', array (), '20120206', true );
		
		wp_enqueue_script ( 'loungeact-skip-link-focus-fix', get_template_directory_uri () . '/js/skip-link-focus-fix.js', array (), '20130115', true );
		
		if (is_singular () && comments_open () && get_option ( 'thread_comments' )) {
			wp_enqueue_script ( 'comment-reply' );
		}
	}








endif;
add_action ( 'wp_enqueue_scripts', 'loungeact_public_scripts' );

// TODO: filter what used
/**
 * Enqueue admin scripts and styles.
 */
if (! function_exists ( 'loungeact_admin_scripts' )) {
	function loungeact_admin_scripts($hook) {
		
		// FontAwesome
		wp_enqueue_style ( 'loungeact-admin-fontawesome', get_template_directory_uri () . '/assets/font-awesome/4.4.0/css/font-awesome.min.css', array (
				'loungeact-admin-style' 
		) );
		
		// Select2
		wp_enqueue_style ( 'loungeact-select2-style', get_template_directory_uri () . '/assets/admin/select2/css/select2.min.css', array (
				'loungeact-admin-style' 
		) );
		wp_enqueue_script ( 'loungeact-select2-script', get_template_directory_uri () . '/assets/admin/select2/js/select2.full.min.js', array (
				'jquery' 
		), true );
		
		// Wp Media
		wp_enqueue_media ();
		wp_enqueue_style( 'wp-color-picker' );
		
		// Wp jQuery UI
		wp_enqueue_script ( 'jquery-ui-core' );
		wp_enqueue_script ( 'jquery-ui-accordion' );
		
		// Theme admin styles and scripts
		//TODO:REMOVE
		wp_register_style ( 'loungeact-admin-css', get_template_directory_uri () . '/assets/admin/css/loungeact-admin.css' );
		wp_enqueue_style ( 'loungeact-admin-css' );
		wp_register_style ( 'loungeact-admin-style', get_template_directory_uri () . '/assets/admin/css/admin.css' );
		wp_enqueue_style ( 'loungeact-admin-style' );
		wp_enqueue_script ( 'loungeact-admin-script', get_template_directory_uri () . '/assets/admin/js/loungeact-admin.js', array (
				'jquery',
				'loungeact-select2-script',
				'wp-color-picker'
		) );
		wp_localize_script ( 'loungeact-admin-script', 'ajax_object', array (
				'ajax_url' => admin_url ( 'admin-ajax.php' ) 
		) );
	}
}
add_action ( 'admin_enqueue_scripts', 'loungeact_admin_scripts' );

// FontAwesome List
if (! function_exists ( 'get_loungeact_fontawesome_list' )) :
	function get_loungeact_fontawesome_list() {
		// check for file in active theme
		$fa = locate_template ( array (
				'/inc/fontawesome-icons.php',
				'/fontawesome-icons.php' 
		) );
		
		// if none found use the default file
		if ($fa == '')
			$fa = '/inc/fontawesome-icons.php';
		
		include ($fa);
		
		return $fa_icon;
	}



endif;

// TODO: logo position like layerswp

if (! function_exists ( 'get_loungeact_theme' )) :
	function get_loungeact_theme() {
		return new Lounge_Act_Theme ();
	}
endif;

/**
 * Load Utilities
 */
require get_template_directory () . '/inc/utilities.php';

/**
 * Implement the theme class.
 */
require get_template_directory () . '/inc/lounge-act.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory () . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory () . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory () . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory () . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory () . '/inc/jetpack.php';

/**
 * Load Custom Nav
 */
// TODO: MEGAMENU and submenu
require get_template_directory () . '/inc/nav/nav.php';

/**
 * Load Slider
 */
require get_template_directory () . '/inc/post/slider.php';

/**
 * Load Staff
 */
require get_template_directory () . '/inc/post/staff.php';

/**
 * Load Feature Widget
 */
require get_template_directory () . '/inc/widget/feature-widget.php';

/**
 * Load Highlight Widget
 */
require get_template_directory () . '/inc/widget/highlight-widget.php';

// Change what's hidden by default for loungeact_staff
add_filter ( 'default_hidden_meta_boxes', 'hide_meta_lock', 10, 2 );
function hide_meta_lock($hidden, $screen) {
	if ('loungeact_staff' == $screen->post_type)
		$hidden = array (
				'postexcerpt',
				'slugdiv',
				'postcustom',
				'trackbacksdiv',
				'commentstatusdiv',
				'commentsdiv',
				'authordiv',
				'revisionsdiv'
		);
		// removed 'postexcerpt',
		return $hidden;
}

function wpse_footer_db_queries() {
	echo '<h2> ' . get_num_queries () . ' queries in ' . timer_stop ( 0 ) . ' seconds. </h2>' . PHP_EOL;
	
	global $wpdb;
	
	$list = '';
	if (! empty ( $wpdb->queries )) {
		$queries = array ();
		foreach ( $wpdb->queries as $query ) {
			$queries [] = sprintf ( '<li><pre>%1$s</pre>Time: %2$s sec<pre>%3$s</pre></li>', nl2br ( esc_html ( $query [0] ) ), number_format ( sprintf ( '%0.1f', $query [1] * 1000 ), 1, '.', ',' ), esc_html ( implode ( "\n", explode ( ', ', $query [2] ) ) ) );
		}
		
		$list = '<ol>' . implode ( '', $queries ) . '</ol>';
	}
	printf ( '<style>pre{white-space:pre-wrap !important}</style>
        <div class="%1$s"><p><b>%2$s Queries</b></p>%3$s</div>', __FUNCTION__, $wpdb->num_queries, $list );
}
add_action ( 'wp_footer', 'wpse_footer_db_queries' );


