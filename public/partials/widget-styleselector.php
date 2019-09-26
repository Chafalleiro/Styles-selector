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
		parent::__construct('style_selector_widget',__( 'Style Selector Widget', 'text_domain' ),array('customize_selective_refresh' => true,));
	}
	public function Style_Selector_Widget() { // For compatibility reason
        self::__construct();
    }
	// The widget form (for the backend )
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'title'    => '',
			'select'   => '',
		);
		
		// Parse current settings with defaults
		extract( wp_parse_args( ( array ) $instance, $defaults ) ); ?>

		<?php // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Widget Title', 'text_domain' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>	

	<?php }

	// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		return $instance;
	}

	// Display the widget
	public function widget( $args, $instance ) {
		extract( $args );

		// Check the widget options
		$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		// WordPress core before_widget hook (always include )
		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box">';
		// Display widget title if defined
		if ( $title ) {
			echo $before_title . $title . $after_title;
			prepareOutput();
		}
		echo '</div>';

		// WordPress core after_widget hook (always include )
		echo $after_widget;

	}
}
function prepareOutput()
{
		$options = get_option('styleselector');
		$ss_fieldTypes = array("ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option");
		$ss_option_value = array("<select onchange='changeProps(this.value)' class='widget_sselector' disabled><option value='Restore'>Restore</option>");
		$ss_option_values = array("Restore");
		for ($ss_tab = 1; $ss_tab < 6; $ss_tab++)
		{
			$ss_fieldId = $ss_fieldTypes[0]."_".$ss_tab;
			if (get_stylesheet() == $options[$ss_fieldId])
			{
				for ($ss_count = 1; $ss_count < 11; $ss_count++)
				{
					if ($options["ss_option"."_".$ss_tab."_".$ss_count] == 1)
					{
						$str = "";
						if (!in_array($options["ss_opt_name"."_".$ss_tab."_".$ss_count], $ss_option_values))
						{

							array_push($ss_option_value,"<option value='".$options["ss_opt_name"."_".$ss_tab."_".$ss_count]."'>".$options["ss_opt_name"."_".$ss_tab."_".$ss_count]."</option>");
							array_push($ss_option_values,$options["ss_opt_name"."_".$ss_tab."_".$ss_count]);						
						}
						for ($ss_fieldCount = 1; $ss_fieldCount < count($ss_fieldTypes); $ss_fieldCount++)
						{
							$ss_fieldId = $ss_fieldTypes[$ss_fieldCount]."_".$ss_tab."_".$ss_count;
							if ($ss_fieldCount == 1)
							{$str = "'".$options[$ss_fieldId]."'";}
							else{$str = $str.",'".$options[$ss_fieldId]."'";}
						}
						echo "<script>addOption(".$str.");</script>";
					}
				}
			}
		}
		foreach ($ss_option_value as $key=>$item){echo "$item\n";}
		echo "</select>";
}

function short_func() {
	echo '<div align="center"><form>Select a style: ';
	prepareOutput();
	echo '</form></div>';
	}
function wpshout_action_example() { //Add restore values and enable the select input at the end of the page to prevent errors loading objects
    echo '<div style="background: green; color: white; text-align: right;" id="ss_selector_wait"><script>
	var k=0;for (k;k < eleArray.length;k++){saveValues(k);};document.getElementById("ss_selector_wait").style.display = "none";
	var x = document.getElementsByClassName("widget_sselector");
	for (i = 0; i < x.length; i++){x[i].disabled = false;}
	</script>Wait a sec, saving restore vars.</div>'; 
}

add_shortcode( 's_selector','short_func');
add_action('wp_footer', 'wpshout_action_example');
//Uncomment to add styles selectore form at the head section
add_action('wp_head', 'short_func');
