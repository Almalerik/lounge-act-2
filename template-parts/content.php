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
		<?php if (has_post_thumbnail(get_the_ID())):?>
			<div class="col-md-4">
				<?php the_post_thumbnail();?>
			</div>
			<div class="col-md-8">
		<?php else:?>
			<div class="col-md-12">
		<?php endif;?>
			<header class="entry-header">
				<?php
					if ( is_single() ) {
						the_title( '<h1 class="entry-title">', '</h1>' );
					} else {
						$sticky_icon = '';
						if (is_sticky()) {
							$sticky_icon = '<div class="sticky-icon-wrapper"><i class="fa fa-thumb-tack sticky-icon"></i></div>';
						}
						
						the_title( '<h2 class="entry-title">' . $sticky_icon . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					}
		
				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php lounge_act_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->
		
			<div class="entry-content">
				<?php 
				if (is_home() || is_front_page()):
					the_excerpt( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lounge-act' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				else:
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'lounge-act' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
						) );
				endif;
		
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
