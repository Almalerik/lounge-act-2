<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lounge_Act
 */
$loungeact = get_loungeact_theme ();

get_header ();
?>
<div id="primary" class="content-area">
	
	<?php if ($loungeact -> get_setting("homepage_features_show") ):?>
		<!-- lougeact-features-sidebar -->
		<div class="row lougeact-features-sidebar">
			<div class="col-md-12">
				<?php if ($loungeact -> get_setting("homepage_features_title") ):?>
				<h2 class="lougeact-features-title">
					<?php echo $loungeact -> get_setting("homepage_features_title");?>
					<span class="lougeact-decoration-line">
						<span>
							<?php echo $loungeact -> get_setting("homepage_features_subtitle");?>
						</span>
					</span>
				</h2>
				<?php endif;?>
				<ul class="list-inline text-center">
					<?php dynamic_sidebar('homepage-features'); ?>
				</ul>
			</div>
		</div>
		<!-- #lougeact-features-sidebar -->
	<?php endif;?>
	
	<?php if ($loungeact -> get_setting("homepage_highlights_show") ):?>
		<!-- lougeact-highlights-sidebar -->
		<div class="lougeact-highlights-sidebar">
			<?php if ($loungeact -> get_setting("homepage_highlights_title") ):?>
			<h2 class="lougeact-highlights-title">
				<?php echo $loungeact -> get_setting("homepage_highlights_title");?>
				<span class="lougeact-decoration-line">
					<span>
						<?php echo $loungeact -> get_setting("homepage_highlights_subtitle");?>
					</span>
				</span>
			</h2>
			<?php endif;?>
			<?php dynamic_sidebar('homepage-highlights'); ?>
		</div>
		<!-- #lougeact-highlights-sidebar -->
	<?php endif;?>	
		
	<main id="main" class="site-main" role="main" style="max-width: <?php echo $loungeact -> get_setting("blog_container_max_width"); ?>; margin: 0 auto;">
	
				<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :
			
		echo '<div style="max-width: '. $loungeact -> get_setting("blog_container_max_width") . '; margin: 0 auto;">';
			get_template_part( 'template-parts/content', 'none' );
			echo '</div>';
		endif; ?>
		
	</main>
</div>

<?php get_footer(); ?>
