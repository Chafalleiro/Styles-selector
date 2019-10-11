<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Styleselector
 * @subpackage Styleselector/includes
 * @author     Alfonso <alfonso@abelenda.es>
 */
class Styleselector_Activator {

	/**
	 * Checks version, if needed then remake the database options fields.
	 *
	 * Long Description.
	 *
	 * @since    1.1.0
	 */
	public static function activate() {
		//Check if database is already updated.
		$options = get_option('styleselector');		
		if(!isset($options["ss_disp_head_1"]))
		{
			options_updatever();
		}
	}
}

// my $sanitize_callback function

function options_updatever() {
	$valid = array();
	$options = get_option('styleselector');
    $ss_fieldTypes = array("ss_disp_head", "ss_select_style", "ss_select_sheet_div", "ss_select_sheet_sel", "ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option");
    for ($ss_tab = 1; $ss_tab < 6; $ss_tab++)
        {
        $ss_fieldId = $ss_fieldTypes[0]."_".$ss_tab;
		$valid[$ss_fieldId] =  "1";
		$ss_fieldId = $ss_fieldTypes[1]."_".$ss_tab;
		$valid[$ss_fieldId] =  "Custom";
		$ss_fieldId = $ss_fieldTypes[2]."_".$ss_tab;
		$valid[$ss_fieldId] =    "font-family: 'IBM Plex Mono', monospace; font-size: 1.15em; width: 100%; box-sizing: border-box; padding: 10px 20px; border: none; border-radius: 10px; background-color: #00f1f1; -webkit-transition: width 0.4s ease-in-out; transition: width 0.4s ease-in-out";
		$ss_fieldId = $ss_fieldTypes[3]."_".$ss_tab;
		$valid[$ss_fieldId] =  "width: 100px; margin: auto; box-sizing: border-box; box-sizing: border-box; border: 2px solid #ccc; border-radius: 10px; padding: 12px 20px 12px 40px; background-color: #00f100; -webkit-transition: width 0.4s ease-in-out; transition: width 0.4s ease-in-out";
		$ss_fieldId = $ss_fieldTypes[4]."_".$ss_tab;
        $valid[$ss_fieldId] =  $options[$ss_fieldId];
		$valid = array_merge($valid,$options);
		for ($ss_count = 1; $ss_count < 11; $ss_count++)
			{
			for ($ss_fieldCount = 5; $ss_fieldCount < count($ss_fieldTypes); $ss_fieldCount++)
				{
				$ss_fieldId = $ss_fieldTypes[$ss_fieldCount]."_".$ss_tab."_".$ss_count;
				$valid[$ss_fieldId] =  $options[$ss_fieldId];
				}
			}
		}
	update_option('styleselector', $valid );
	$message = __('Options updated!.');
	$type = 'updated';
	// add_settings_error( $setting, $code, $message, $type )
	add_settings_error('styleselector', esc_attr( 'settings_updated' ), $message, $type);
 }
 