<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Lounge_Act
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses loungeact_header_style()
 * @uses loungeact_admin_header_style()
 * @uses loungeact_admin_header_image()
 */
function loungeact_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'loungeact_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'loungeact_header_style',
		'admin-head-callback'    => 'loungeact_admin_header_style',
		'admin-preview-callback' => 'loungeact_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'loungeact_custom_header_setup' );

if ( ! function_exists( 'loungeact_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see loungeact_custom_header_setup().
 */
function loungeact_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="loungeact_custom_css">
	<?php
		// Has the text been hidden?
		$loungeact = new Lounge_Act_Theme ();
		if ( ! display_header_text() || ( is_front_page() && is_home() && $loungeact->get_setting("hide_title_in_homepage") )  ) :
	?>
		.site-title{
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // loungeact_header_style

if ( ! function_exists( 'loungeact_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see loungeact_custom_header_setup().
 */
function loungeact_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // loungeact_admin_header_style

if ( ! function_exists( 'loungeact_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see loungeact_custom_header_setup().
 */
function loungeact_admin_header_image() {
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // loungeact_admin_header_image

if (! function_exists ( 'loungeact_admin_header_template_list' )) :
/**
 * Return a list of custom template for the header section
*/
function loungeact_admin_header_template_list() {

	return array (
			'default.php' => 'Left logo',
			'center-logo.php' => 'Center logo',
			'right-logo.php' => 'Right logo',
	);

}

endif; // loungeact_admin_header_template_list
