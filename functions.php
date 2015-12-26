<?php
/**
 * Lounge Act functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lounge_Act
 */
global $loungeact_db_version;
global $loungeact_fa_version;
$loungeact_db_version = '1.0.0';
$loungeact_fa_version = '4.5.1';
$version = '1.0.0';

// TODO: filter what used
/**
 * Enqueue public scripts and styles.
 */
if (! function_exists ( 'loungeact_public_scripts' )) :
	function loungeact_public_scripts() {
		
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
		

		

		wp_enqueue_style ( 'wp-color-picker' );
		

		
		// Theme admin styles and scripts
		// TODO:REMOVE
		wp_register_style ( 'loungeact-admin-css', get_template_directory_uri () . '/assets/admin/css/loungeact-admin.css' );
		wp_enqueue_style ( 'loungeact-admin-css' );


		wp_localize_script ( 'loungeact-admin-script', 'ajax_object', array (
				'ajax_url' => admin_url ( 'admin-ajax.php' ) 
		) );
	}
}
add_action ( 'admin_enqueue_scripts', 'loungeact_admin_scripts' );

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
 * Load Staff
 */
require get_template_directory () . '/inc/post/staff.php';



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


/*
//Create the table to store FontAwesome fonts
function loungeact_fa_table() {
	global $wpdb;
	global $loungeact_db_version;
	
	$table_name = $wpdb->prefix . 'loungeact_fa';
	
	$charset_collate = $wpdb->get_charset_collate ();
	
	$sql = "CREATE TABLE $table_name (
	id mediumint(9) NOT NULL AUTO_INCREMENT,
	time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	fa_class tinytext NOT NULL,
	label tinytext NOT NULL,
	UNIQUE KEY id (id)
	) $charset_collate;";
	
	require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta ( $sql );
	
	add_option ( 'loungeact_db_version', $loungeact_db_version );
}


//Add FontAwesome fonts to the table
function loungeact_fa_install_data() {
	global $wpdb;
	global $loungeact_fa_version;
	
	$table_name = $wpdb->prefix . 'loungeact_fa';
	
	$installed_ver = get_option ( 'loungeact_fa_version' );
	
	if (! $installed_ver || $installed_ver != $loungeact_fa_version) {
		$wpdb->query('TRUNCATE TABLE ' . $table_name);
		foreach ( get_loungeact_fontawesome_list () as $label => $css_class ) {
			error_log ( "execute insert " . $label );
			$wpdb->insert ( $table_name, array (
					'time' => current_time ( 'mysql' ),
					'fa_class' => $css_class,
					'label' => $label 
			) );
		}
		
		update_option ( 'loungeact_fa_version', $loungeact_fa_version );
	}
}

function loungeact_update_db_check() {
	global $loungeact_db_version;
	global $loungeact_fa_version;
	if ( get_site_option( 'loungeact_db_version' ) != $loungeact_db_version ) {
		loungeact_fa_table();
	}
	
	if ( get_site_option( 'loungeact_fa_version' ) != $loungeact_fa_version ) {
		loungeact_fa_install_data();
	}
}
add_action( 'after_switch_theme', 'loungeact_update_db_check' );
*/


add_image_size( 'loungeact-medium-cropped', 330, 275, true );
