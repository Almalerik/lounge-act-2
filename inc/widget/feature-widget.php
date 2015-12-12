<?php

// Block direct requests
if (! defined ( 'ABSPATH' ))
	die ( '-1' );

add_action ( 'widgets_init', function () {
	register_widget ( 'Lougeact_Feature_Widget' );
} );

/**
 * Adds Lougeact_Feature_Widget widget.
 */
class Lougeact_Feature_Widget extends WP_Widget {
	
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct ( 
				// Base ID of your widget
				'lougeact_feature_widget', 
				
				// Widget name will appear in UI
				__ ( 'Lougeact - Feature', 'lougeact' ), 
				
				// Widget description
				array (
						'description' => __ ( 'Add a feature ', 'lougeact' ) 
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
		
		if ( ! empty( $instance['title'] ) ) {
			$instance['title'] = $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		
		$args ['before_widget'] = str_replace('class="', 'class="col-sm-3 placeholder ', $args ['before_widget']);
		
		// use a template for the output so that it can easily be overridden by theme
		// check for template in active theme
		$template = locate_template ( array (
				'feature-widget-template.php' 
		) );
		
		// if none found use the default template
		if ($template == '')
			$template = 'feature-widget-template.php';
		
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
		$image = (isset ( $instance ['image'] )) ? $instance ['image'] : '';
		$font_icon = (isset ( $instance ['font_icon'] )) ? $instance ['font_icon'] : '';
		$title = (isset ( $instance ['title'] )) ? $instance ['title'] : '';
		$description = (isset ( $instance ['description'] )) ? $instance ['description'] : '';
		
		?>
		<div class="lougeact-feature-widget loungeact-cf-container">
			<div class="hide-if-no-js">
				<div class="loungeact-cf-option-button" style="display: <?php echo ( !empty($image) || !empty($font_icon)) ? 'none' : 'block'?>;">
					<input class="loungeact-cf-add-font-icon button" type="button" value="<?php _e('Add font icon', 'loungeact');?>" />
					<input class="loungeact-cf-add-image button" type="button" value="<?php _e('Add image', 'loungeact');?>" />
				</div>
				<div class="loungeact-cf-add-font-icon-container loungeact-cf-field-custom" style="display: <?php echo ( empty($font_icon) ) ? 'none' : 'block'?>;">
					<label for="<?php echo $this->get_field_id( 'font_icon' ); ?>"><?php esc_html_e( 'Icon: ', 'loungeact' ); ?></label>
					<select class="loungeact-cf-icon-select2 loungeact-cf-options-val regular-text" id="<?php echo $this->get_field_id( 'font_icon' ); ?>" name="<?php echo $this->get_field_name( 'font_icon' ); ?>" style="width: 70%;">
						<option value=""><?php _e( 'None' ); ?></option>
						<?php foreach (get_loungeact_fontawesome_list() as $label => $css_class): ?>
						<option value="<?php echo $css_class;?>" <?php echo $css_class == $font_icon ? 'selected' : ''; ?>><?php echo $label;?></option>
						<?php endforeach;?>
					</select>
					<a class="button loungeact-cf-option-reset" href="#">
						<i class="fa fa-trash loungeact-color-alert"></i>
					</a>
				</div>
				<div class="loungeact-cf-add-image-container loungeact-cf-field-custom" style="display: <?php echo ( empty($image) ) ? 'none' : 'block'?>;">
					<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Enter a URL or upload an image', 'loungeact' ); ?></label><br />
					<input class="loungeact-cf-options-val widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $image ?>" type="text" />
					<a class="button loungeact-cf-image-upload-button" href="#" onclick="loungeact_cf_media_button_click('<?php _e('Choose feature image', 'loungeact');?>','<?php _e('Select', 'loungeact');?>','image','loungeact-cf-image-preview-<?php echo $this->id; ?>','<?php echo $this->get_field_id( 'image' );  ?>');">
						<i class="fa fa-upload"></i>
					</a>
					<a class="button loungeact-cf-option-reset" href="#">
						<i class="fa fa-trash loungeact-color-alert"></i>
					</a>
					<div class="loungeact-cf-image-preview" id="loungeact-cf-image-preview-<?php echo $this->id;?>">
						<?php if ($image!='') echo '<img src="' . $image . '">'; ?>				
					</div>
				</div>
			</div>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e( 'Description:' ); ?></label>
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>
			</p>
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
		$instance ['font_icon'] = (! empty ( $new_instance ['font_icon'] )) ? strip_tags ( $new_instance ['font_icon'] ) : '';
		$instance ['image'] = (! empty ( $new_instance ['image'] )) ? strip_tags ( $new_instance ['image'] ) : '';
		$instance ['description'] = (! empty ( $new_instance ['title'] )) ? strip_tags ( $new_instance ['description'] ) : '';
		$instance ['title'] = (! empty ( $new_instance ['title'] )) ? strip_tags ( $new_instance ['title'] ) : '';
		return $instance;
	}
} // class Lougeact_Feature_Widget end
  

