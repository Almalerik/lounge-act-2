<?php
/*
 * Template for the output of the Lougeact Feature Widget
 * Override by placing a file called highlight-widget-template.php in your active theme
 */
?>
<!-- Highlight post -->
	<div class="row vertical-align">
	<div class="col-sm-<?php echo $instance ["lc_width"];?> loungeact-col-left">
		<?php if ( $instance ["image_right"] ):?>
			<div class="loungeact-text">
				<h2><?php echo $instance ["title"];?></h2>
				<p><?php echo wp_trim_words( $instance ["description"], $num_words = 45, $more='&nbsp;&hellip;');?></p>
				<?php if ( $instance ["link_text"] ):?>
				<a href="#" class="btn btn-primary"><?php esc_html_e("Read more ...", "lougeact");?></a>
				<?php endif;?>
			</div>
		<?php else:?>
			<img src="<?php echo $instance ["image"];?>" style="max-width:100%; max-height: 100%;"/>
		<?php endif;?>
	</div>
	<div class="col-sm-<?php echo $instance ["rc_width"];?> loungeact-col-right">
		<?php if ( ! $instance ["image_right"] ):?>
			<div class="loungeact-text">
				<h2><?php echo $instance ["title"];?></h2>
				<p><?php echo wp_trim_words( $instance ["description"], $num_words = 45, $more='&nbsp;&hellip;');?></p>
				<?php if ( $instance ["link_text"] ):?>
				<a href="#" class="btn btn-primary"><?php esc_html_e("Read more ...", "lougeact");?></a>
				<?php endif;?>
			</div>
		<?php else:?>
			<img src="<?php echo $instance ["image"];?>" style="max-width:100%; max-height: 100%;"/>
		<?php endif;?>
	</div>
	</div>
