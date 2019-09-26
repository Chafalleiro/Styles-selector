<?php
/*
Plugin Name: My Widget Plugin
Plugin URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
Description: This plugin adds a custom widget.
Version: 1.0
Author: AJ Clarke
Author URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
License: GPL2
*/

// The widget class
class Style_Selector_Widget extends WP_Widget {

	// Main constructor
	public function __construct() {
		parent::__construct(
			'style_selector_widget',
			__( 'Style_Selector_Widget', 'text_domain' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}

	// The widget form (for the backend )
	public function form( $instance ) {

		// Set widget defaults
		$defaults = array(
			'title'    => '',
			'text'     => '',
			'textarea' => '',
			'checkbox' => '',
			'select'   => '',
			'theme'   => '',			
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Text Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php _e( 'Text:', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
		</p>

		<?php // Textarea Field ?>
		<p>
            <?php echo '<footer class="renym-content-footer">Current active theme: '.get_stylesheet().'</footer>'; ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>"><?php _e( 'Textarea:', 'text_domain' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'textarea' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'textarea' ) ); ?>"><?php echo wp_kses_post( $textarea ); ?></textarea>
		</p>

		<?php // Checkbox ?>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'checkbox' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'checkbox' ) ); ?>"><?php _e( 'Checkbox', 'text_domain' ); ?></label>
		</p>

		<?php // Dropdown ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'select' ); ?>"><?php _e( 'Select', 'text_domain' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'select' ); ?>" id="<?php echo $this->get_field_id( 'select' ); ?>" class="widefat">
			<?php
			// Your options array
			$options = array(
				''        => __( 'Select', 'text_domain' ),
				'option_1' => __( 'Option 1', 'text_domain' ),
				'option_2' => __( 'Option 2', 'text_domain' ),
				'option_3' => __( 'Option 3', 'text_domain' ),
			);

			// Loop through options and add each one to the select dropdown
			foreach ( $options as $key => $name ) {
				echo '<option value="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" '. selected( $select, $key, false ) . '>'. $name . '</option>';

			} ?>
			</select>
		</p>
		<?php // Checkbox ?>
		<p>
			<input id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $theme ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>"><?php _e( 'Display active theme', 'text_domain' ); ?></label>
		</p>
		

	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['text']     = isset( $new_instance['text'] ) ? wp_strip_all_tags( $new_instance['text'] ) : '';
		$instance['textarea'] = isset( $new_instance['textarea'] ) ? wp_kses_post( $new_instance['textarea'] ) : '';
		$instance['checkbox'] = isset( $new_instance['checkbox'] ) ? 1 : false;
		$instance['select']   = isset( $new_instance['select'] ) ? wp_strip_all_tags( $new_instance['select'] ) : '';
		$instance['theme']   = isset( $new_instance['theme'] ) ? wp_strip_all_tags( $new_instance['theme'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {

		extract( $args );

		// Check the widget options
		$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$text     = isset( $instance['text'] ) ? $instance['text'] : '';
		$textarea = isset( $instance['textarea'] ) ?$instance['textarea'] : '';
		$select   = isset( $instance['select'] ) ? $instance['select'] : '';
		$checkbox = ! empty( $instance['checkbox'] ) ? $instance['checkbox'] : false;
		$theme   = isset( $instance['theme'] ) ? $instance['theme'] : '';

		// WordPress core before_widget hook (always include )
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';

			// Display widget title if defined
			if ( $title ) {
				echo $before_title . $title . $after_title;
			}

			// Display text field
			if ( $text ) {
				echo '<p>'.  $text . '</p>';
			}

			// Display textarea field
			if ( $textarea ) {
				echo '<p>'.$textarea. '</p>';
			}

			// Display select field
			if ( $select ) {
				echo '<p>' . $select . '</p>';
			}

			// Display something if checkbox is true
			if ( $checkbox ) {
				echo '<p>Something awesome</p>';
			}
			if ( $theme ) {
				$options = get_option('styleselector');
				$ss_fieldTypes = array("ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option");
				for ($ss_tab = 1; $ss_tab < 6; $ss_tab++)
				{
					$ss_fieldId = $ss_fieldTypes[0]."_".$ss_tab;
					echo $ss_fieldId.": ".$options[$ss_fieldId]."<br>";
					if (get_stylesheet() == $options[$ss_fieldId])
					{
						for ($ss_count = 1; $ss_count < 11; $ss_count++)
						{
							for ($ss_fieldCount = 1; $ss_fieldCount < count($ss_fieldTypes); $ss_fieldCount++)
							{
							$ss_fieldId = $ss_fieldTypes[$ss_fieldCount]."_".$ss_tab."_".$ss_count;
							echo $ss_fieldId.": ".$options[$ss_fieldId]."<br>";
							}
						}
					}
				}
				echo '<p>Current active theme: '.get_stylesheet().'Option: '.$options['ss_myRangeFont_1_1'].'</p>';
				//echo '<p>Current active theme: '.get_stylesheet().$options[ss_selected_theme].'</p>';
			}

		echo '</div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;

	}

}

// Register the widget
//function my_register_style_selector_widget() {
//	register_widget( 'Style_Selector_Widget' );
//}
//add_action( 'widgets_init', 'my_register_style_selector_widget' );