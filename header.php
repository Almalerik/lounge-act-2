<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lounge_Act
 */
$loungeact = get_loungeact_theme ();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<?php $loungeact -> custom_head();?>

</head>

<body <?php body_class(); ?>>
	<div id="page" class="site lougeact-wrapper <?php echo $loungeact -> get_page_class();?>">
	
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lounge-act' ); ?></a>
		
		<div class="row lougeact-header <?php echo $loungeact -> get_setting("header_fixed_top");?>">
			
		</div>
		
		<?php if ($loungeact->get_setting ( 'slider' ) != "") : ?>
			<?php if ((is_home() || is_front_page()) || ( ! $loungeact->get_setting ( 'slider_only_in_homepage' ) && ! (is_home() || is_front_page()))) : ?>
				<div class="loungeact-banner row">
					<?php include(locate_template('template-parts/header-slider-swiper.php'));?>
				</div>
			<?php endif;?>
		<?php endif;?>
		
		<!-- 
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
			<?php
			if (is_front_page () && is_home ()) :
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
			<?php else : ?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</p>
			
			<?phpendif;
			
			$description = get_bloginfo ( 'description', 'display' );
			if ($description || is_customize_preview ()) :
				?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			
			<?php
			endif;
			?>
		</div>
			

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'lounge-act' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav>
			
		</header>
		-->
		<!-- #masthead -->

		<div id="content" class="site-content row">
			
			<?php $loungeact -> get_sidebar('left');?>
			
			<div class="<?php echo $loungeact -> get_content_class(); ?>">