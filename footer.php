<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lounge_Act
 */

$loungeact = get_loungeact_theme ();

?>
		</div>
		
		<?php $loungeact -> get_sidebar('right');?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'lounge-act' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'lounge-act' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'lounge-act' ), 'lounge-act', '<a href="http://underscores.me/" rel="designer">Almalerik</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
