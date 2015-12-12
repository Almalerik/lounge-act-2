
<div id='loungeact-edit-slides-wrapper' class='hide-if-no-js'>
	<a href="javascript:void(0);" id="loungeact-edit-slide-add" class="button">
		<i class="fa fa-plus"></i> <?php esc_html_e('Add slide', 'loungeact')?>
	</a>
	<input type="hidden" id="loungeact-slide-thumbnail-delete-msg" value="<?php esc_html_e("Are you sure?", "loungeact")?>" />
	<ul class="lougeact-sortable">
		<?php $i = 0;?>
		<?php foreach ( $slides as $slide ) : ?>
		<li <?php echo $i== 0 ? 'id="loungeact-edit-slide-template" class="hidden"': ''; ?>>
			<div class="loungeact-accordion">
				<h4>
					<span class="loungeact-action-move">
						<i class="fa fa-arrows-v"></i>
					</span>
					<span class="loungeact-accordion-title"><?php echo esc_attr( $slide['title'] );?></span>
				</h4>
				<div class="lougeact-accordion-content" id="#lougeact-accordion-content-<?php echo $i;?>">
					<div class="loungeact-slide-thumbnail">
						<input type="hidden" name="_loungeact_slide[<?php echo $i;?>][image_id]" id="loungeact_slide-<?php echo $i;?>-image_id" value="<?php echo $slide['image_id'];?>" />
						<a title="<?php esc_html_e('Select image', 'loungeact')?>" href="javascript:void(0);" class="loungeact-slide-thumbnail-add button" onclick="loungeact_cf_media_button_click('<?php _e('Choose an image', 'loungeact');?>','<?php _e('Select', 'loungeact');?>','image','loungeact_slide-<?php echo $i;?>-preview','loungeact_slide-<?php echo $i;?>-image_id');">
							<i class="fa fa-image"></i> <?php _e('Select image', 'loungeact')?>
						</a>
						<div class="loungeact-cf-image-preview" id="loungeact_slide-<?php echo $i;?>-preview">
							<?php echo wp_get_attachment_image( $slide['image_id'], 'thumbnail' ); ?>
						</div>
					</div>
					<div class="loungeact-slide-meta">
						<p>
							<label for="_loungeact_slide[<?php echo $i;?>][title]">
								<?php _e('Title', 'loungeact')?>
							</label>
							<input type="text" class="large-text loungeact-slide-title" id="_loungeact_slide[<?php echo $i;?>][title]" name="_loungeact_slide[<?php echo $i;?>][title]" value="<?php echo esc_attr( $slide['title'] );?>" />
						</p>
						<p>
							<label for="_loungeact_slide[<?php echo $i;?>][subtitle]">
								<?php _e('Subtitle', 'loungeact')?>
							</label>
							<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][subtitle]" name="_loungeact_slide[<?php echo $i;?>][subtitle]" value="<?php echo esc_attr( $slide['subtitle'] );?>" />
						</p>
						<p>
							<label for="_loungeact_slide[<?php echo $i;?>][link]">
								<?php _e('Link', 'loungeact')?>
							</label>
							<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][link]" name="_loungeact_slide[<?php echo $i;?>][link]" value="<?php echo esc_attr( $slide['link'] );?>" />
						</p>
						<div class="loungeact-accordion">
							<h4>
								<?php _e("First button", "loungeact");?>
							</h4>
							<div class="lougeact-accordion-content" id="lougeact-accordion-content-button1-<?php echo $i;?>">
								<p>
									<label for="_loungeact_slide[<?php echo $i;?>][first_button_text]"><?php _e('Text', 'loungeact')?></label>
									<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][first_button_text]" name="_loungeact_slide[<?php echo $i;?>][first_button_text]" value="<?php echo esc_attr( $slide['first_button_text'] );?>" />
								</p>
								<p>
									<label for="_loungeact_slide[<?php echo $i;?>][first_button_url]"><?php _e('Url', 'loungeact')?></label>
									<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][first_button_url]" name="_loungeact_slide[<?php echo $i;?>][first_button_url]" value="<?php echo esc_attr( $slide['first_button_url'] );?>" />
								</p>
							</div>
							<h4>
								<?php _e("Second button", "loungeact");?>
							</h4>
							<div class="lougeact-accordion-content" id="lougeact-accordion-content-button2-<?php echo $i;?>">
								<p>
									<label for="_loungeact_slide[<?php echo $i;?>][second_button_text]"><?php _e('Text', 'loungeact')?></label>
									<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][second_button_text]" name="_loungeact_slide[<?php echo $i;?>][second_button_text]" value="<?php echo esc_attr( $slide['second_button_text'] );?>" />
								</p>
								<p>
									<label for="_loungeact_slide[<?php echo $i;?>][second_button_url]"><?php _e('Url', 'loungeact')?></label>
									<input type="text" class="large-text" id="_loungeact_slide[<?php echo $i;?>][second_button_url]" name="_loungeact_slide[<?php echo $i;?>][second_button_url]" value="<?php echo esc_attr( $slide['second_button_url'] );?>" />
								</p>
							</div>
						</div>
					</div>
					<div class="clear">
						<a href="#" class="button loungeact-edit-slide-delete">
							<i class="fa fa-trash"></i> <?php esc_html_e('Delete slide', 'loungeact')?>
						</a>
					</div>
				</div>
			</div>
		</li>
		<?php $i++;?>
		<?php endforeach; ?>	
	</ul>
</div>
