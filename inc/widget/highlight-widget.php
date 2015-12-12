<?php

// Block direct requests
if (! defined ( 'ABSPATH' ))
	die ( '-1' );

add_action ( 'widgets_init', function () {
	register_widget ( 'Lougeact_Highlight_Widget' );
} );

/**
 * Adds Lougeact_Highlight_Widget widget.
 */
class Lougeact_Highlight_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct ( 
				// Base ID of your widget
				'lougeact_highlight_widget', 
				
				// Widget name will appear in UI
				__ ( 'Lougeact - Highlight', 'lougeact' ), 
				
				// Widget description
				array (
						'description' => __ ( 'Highlight a post or a page or a fixed text.', 'lougeact' ) 
				) );
	}
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args
	 *        	Widget arguments.
	 * @param array $instance
	 *        	Saved values from database.
	 */
	public function widget($args, $instance) {
		
		// Check if show a post
		if (isset ( $instance ['post_id'] ) && $instance ['post_id'] != '') {
			$p = get_post ( $instance ['post_id'] );
			$instance ["title"] = $p->post_title;
			$instance ["description"] = $p->post_content;
			$post_thumbnail_id = get_post_thumbnail_id ( $instance ['post_id'] );
			$instance ["image"] = wp_get_attachment_image_src ( $post_thumbnail_id, 'full' ) [0];
		}
		
		if ( ! empty( $instance['title'] ) ) {
			$instance['title'] = $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		
		switch ($instance ["layout"]) {
			case "0" :
				$instance ["lc_width"] = "6";
				$instance ["rc_width"] = "6";
				$instance ["image_right"] = true;
				break;
			case "1" :
				$instance ["lc_width"] = "8";
				$instance ["rc_width"] = "4";
				$instance ["image_right"] = true;
				break;
			case "2" :
				$instance ["lc_width"] = "6";
				$instance ["rc_width"] = "6";
				$instance ["image_right"] = false;
				break;
			case "3" :
				$instance ["lc_width"] = "4";
				$instance ["rc_width"] = "8";
				$instance ["image_right"] = false;
				break;
		}
		
		// use a template for the output so that it can easily be overridden by theme
		// check for template in active theme
		$template = locate_template ( array (
				'highlight-widget-template.php' 
		) );
		
		// if none found use the default template
		if ($template == '')
			$template = 'highlight-widget-template.php';
		
		echo $args ['before_widget'];
		
		include ($template);
		
		echo $args ['after_widget'];
	}
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance
	 *        	Previously saved values from database.
	 */
	public function form($instance) {
		$post_id = (isset ( $instance ['post_id'] )) ? $instance ['post_id'] : '';
		$title = (isset ( $instance ['title'] )) ? $instance ['title'] : '';
		$description = (isset ( $instance ['description'] )) ? $instance ['description'] : '';
		$image = (isset ( $instance ['image'] )) ? $instance ['image'] : '';
		$bg_color = (isset ( $instance ['bg_color'] )) ? $instance ['bg_color'] : '';
		$title_color = (isset ( $instance ['title_color'] )) ? $instance ['title_color'] : '';
		$description_color = (isset ( $instance ['description_color'] )) ? $instance ['description_color'] : '';
		$layout = (isset ( $instance ['layout'] )) ? $instance ['layout'] : '';
		$link_text = (isset ( $instance ['link_text'] )) ? $instance ['link_text'] : __("Read more...", "lougeact");
		
		?>
<div class="lougeact-feature-widget loungeact-cf-container">
	<div class="hide-if-no-js">
		<div class="loungeact-cf-option-button" style="display: <?php echo ( !empty($post_id) ) ? 'none' : 'block'?>;">
			<input class="loungeact-cf-select-post button" type="button" value="<?php _e('Post or Page', 'loungeact');?>" /> <input class="loungeact-cf-add-custom button"
				type="button" value="<?php _e('Custom', 'loungeact');?>" />
		</div>

		<div class="loungeact-cf-select-post-container loungeact-cf-field-custom" style="display: <?php echo ( empty($post_id) ) ? 'none' : 'block'?>;">
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php esc_html_e( 'Select a post: ', 'loungeact' ); ?></label> <select
				class="loungeact-cf-post-select2 loungeact-cf-options-val regular-text" id="<?php echo $this->get_field_id( 'post_id' ); ?>"
				name="<?php echo $this->get_field_name( 'post_id' ); ?>" style="width: 70%;">
				<option value="<?php echo $post_id ; ?>" selected="selected"><?php echo $post_id != '' ? get_post($post_id) -> post_title : ''; ?></option>
			</select>
			<a class="button loungeact-cf-option-reset" href="#">
				<i class="fa fa-trash loungeact-color-alert"></i>
			</a>
		</div>

		<div class="loungeact-cf-add-custom-container loungeact-cf-field-custom loungeact-cf-container-bordered" style="display: <?php echo empty($title) && empty($description) && empty($image) ? 'none' : 'block'?>;">
			<a class="button loungeact-cf-option-reset" href="#">
				<i class="fa fa-trash loungeact-color-alert"></i>
			</a>

			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' ); ?></label> <input class="widefat"
				id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /> <br> <label
				for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" class="widefat loungeact-cf-options-val" rows="3" cols="20"
				name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
			<br> <label for="<?php echo $this->get_field_id( 'image' );?>"><?php _e( 'Enter a URL or upload an image', 'loungeact' ); ?></label><br /> <input
				class="loungeact-cf-options-val widefat" id="<?php echo $this->get_field_id( 'image' );?>" name="<?php echo $this->get_field_name( 'image' );?>"
				value="<?php echo esc_attr( $image ); ?>" type="text" />
			<a class="button loungeact-cf-image-upload-button" href="#"
				onclick="loungeact_cf_media_button_click('<?php _e('Choose an image');?>','<?php _e('Select');?>','image','preview-<?php echo $this->get_field_id( 'image' );?>','<?php echo $this->get_field_id( 'image' );?>');">
				<i class="fa fa-upload"></i>
			</a>
			<div class="loungeact-cf-image-preview" id="preview-<?php echo $this->get_field_id( 'image' );?>">
				<?php if ($image!='') echo '<img src="' . $image . '" />'; ?>				
			</div>

		</div>
		<div class="loungeact-accordion">
			<h4>
				<?php _e('Advanced options')?>
			</h4>
			<div class="lougeact-accordion-content" id="#lougeact-accordion-content-<?php echo $this->id;?>">
				<p>
					<label for="<?php echo $this->get_field_id( 'bg_color' ); ?>"><?php esc_html_e( 'Background color:', 'loungeact' ); ?></label><br /> <input type="text"
						value="<?php echo esc_attr( $bg_color ); ?>" class="lougeact-colorpicker" data-default-color="#ffffff" id="<?php echo $this->get_field_id( 'bg_color' );?>"
						name="<?php echo $this->get_field_name( 'bg_color' );?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php esc_html_e( 'Title color:', 'loungeact' ); ?></label><br /> <input type="text"
						value="<?php echo esc_attr( $title_color ); ?>" class="lougeact-colorpicker" data-default-color="#000000" id="<?php echo $this->get_field_id( 'title_color' );?>"
						name="<?php echo $this->get_field_name( 'title_color' );?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'description_color' ); ?>"><?php esc_html_e( 'Description color:', 'loungeact' ); ?></label><br /> <input type="text"
						value="<?php echo esc_attr( $description_color ); ?>" class="lougeact-colorpicker" data-default-color="#555555"
						id="<?php echo $this->get_field_id( 'description_color' );?>" name="<?php echo $this->get_field_name( 'description_color' );?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php esc_html_e( 'Layout:', 'loungeact' ); ?></label><br /> <select id="<?php echo $this->get_field_id( 'layout' );?>"
						name="<?php echo $this->get_field_name( 'layout' );?>">
						<option value="0" <?php echo $layout == "0" ? "selected" : "";?>><?php _e('Right image - 1/2')?></option>
						<option value="1" <?php echo $layout == "1" ? "selected" : "";?>><?php _e('Right image - 1/3')?></option>
						<option value="2" <?php echo $layout == "2" ? "selected" : "";?>><?php _e('Left image - 1/2')?></option>
						<option value="3" <?php echo $layout == "3" ? "selected" : "";?>><?php _e('Left image - 1/3')?></option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'show_link' ); ?>">
					<?php esc_html_e( 'Show link button', 'loungeact' ); ?>
					<span class="howto"><?php esc_html_e('Empty value will be hide button','lougeact')?></span>
					<input type="text"
						value="<?php echo esc_attr( $link_text ); ?>" class="widefat"
						id="<?php echo $this->get_field_id( 'link_text' );?>" name="<?php echo $this->get_field_name( 'link_text' );?>" />				</p>
			</div>
		</div>
	</div>
</div>
<?php
	}
	
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance
	 *        	Values just sent to be saved.
	 * @param array $old_instance
	 *        	Previously saved values from database.
	 *        	
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array ();
		$instance ['post_id'] = (! empty ( $new_instance ['post_id'] )) ? strip_tags ( $new_instance ['post_id'] ) : '';
		$instance ['title'] = (! empty ( $new_instance ['title'] )) ? strip_tags ( $new_instance ['title'] ) : '';
		$instance ['description'] = (! empty ( $new_instance ['description'] )) ? strip_tags ( $new_instance ['description'] ) : '';
		$instance ['image'] = (! empty ( $new_instance ['image'] )) ? strip_tags ( $new_instance ['image'] ) : '';
		
		$instance ['bg_color'] = (! empty ( $new_instance ['bg_color'] )) ? strip_tags ( $new_instance ['bg_color'] ) : '#ffffff';
		$instance ['title_color'] = (! empty ( $new_instance ['title_color'] )) ? strip_tags ( $new_instance ['title_color'] ) : '#000000';
		$instance ['description_color'] = (! empty ( $new_instance ['description_color'] )) ? strip_tags ( $new_instance ['description_color'] ) : '#555555';
		$instance ['layout'] = (! empty ( $new_instance ['layout'] )) ? strip_tags ( $new_instance ['layout'] ) : '0';
		$instance ['link_text'] = (! empty ( $new_instance ['link_text'] )) ? strip_tags ( $new_instance ['link_text'] ) : '';
		return $instance;
	}
} // class Lougeact_Feature_Widget end
  

