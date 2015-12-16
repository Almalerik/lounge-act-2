<?php
$slider = get_post_meta ( $loungeact->get_setting ( 'slider' ), '_loungeact_slides', true );
if (! empty ( $slider ) && is_array ( $slider )) : ?>
<div class="swiper-container loungeact-slider">
	<div class="swiper-wrapper">
        <?php foreach ( $slider as $slide ): ?>
        <div class="swiper-slide" style="background-image: url('<?php echo wp_get_attachment_url( $slide['image_id']); ?>');">
			<div class="swiper-slide-caption-table">
				<div class="swiper-slide-caption-table-cell loungeact-slider-overlay">
					<div class="lougeact-slide-caption">
						<?php if ($slide["title"]) : ?>
						<h2 class="lougeact-slide-title">
							<span><?php echo esc_html($slide["title"]);?></span>
						</h2>
						<?php endif;?>
						<?php if ($slide["subtitle"]) : ?>
						<p class="lougeact-slide-subtitle">
							<span><?php echo esc_html($slide["subtitle"]);?></span>
						</p>
						<?php endif;?>
						<p class="lougeact-slide-link">
							<?php if ($slide["first_button_text"]) : ?>
							<a href="#" class="lougeact-slide-btn1"><?php esc_html_e($slide["first_button_text"]);?></a>
							<?php endif;?>
							<?php if ($slide["second_button_text"]) : ?>
							<a href="#" class="lougeact-slide-btn2"><?php esc_html_e($slide["second_button_text"]);?></a>
							<?php endif;?>
						</p>
						
					</div>
				</div>
			</div>
		</div>
	        		<?php endforeach;?>
				</div>
</div>

<script type="text/javascript">
<!--
jQuery(document).ready(function($) {
	 var swiper = new Swiper('.swiper-container');
  });

//-->
</script>
<?php 
endif;
