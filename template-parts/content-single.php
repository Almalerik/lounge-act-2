<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lounge_Act
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-12">
			<header class="entry-header">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php lounge_act_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content">
				<?php if (has_post_thumbnail(get_the_ID())):?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail();?>
					</div>
				<?php endif;?>
				<?php 
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lounge-act' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );
		
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lounge-act' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		
			<footer class="entry-footer">
				<?php lounge_act_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
