<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://chafalladas.com
 * @since      1.1.0
 *
 * @package    Styleselector
 * @subpackage Styleselector/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Styleselector
 * @subpackage Styleselector/admin
 * @author     Alfonso <alfonso@abelenda.es>
 */
class Styleselector_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Styleselector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Styleselector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/styleselector-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Styleselector_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Styleselector_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/styleselector-admin.js', array( 'jquery' ), $this->version, false );

	}




    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        $plugin_screen_hook_suffix = add_options_page( __('Style selector', $this->plugin_name ), 'Style selector', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
        );
    }




 /**
 * Add settings action link to the plugins page.
 *
 * @since    1.0.0
 */

public function add_action_links( $links ) {
    /*
    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
    */
   $settings_link = array(
    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
   );
   return array_merge(  $settings_link, $links );

	}

/**
 * Render the settings page for this plugin.
 *
 * @since    1.0.0
 */

public function display_plugin_setup_page() {
    include_once( 'partials/styleselector-admin-display.php' );
	}
/**
 * Validate fields.
 *
 * @since    1.0.0
 */

public function validate($input)
	{
	$valid = array();
    $ss_fieldTypes = array("ss_disp_head", "ss_select_style", "ss_select_sheet_div", "ss_select_sheet_sel", "ss_selected_theme", "ss_opt_name", "ss_theme_option_type","ss_element","ss_bg_colorPicker","ss_fn_colorPicker","ss_myRange","ss_myRangeFont","ss_option");
    for ($ss_tab = 1; $ss_tab < 6; $ss_tab++)
        {
        $ss_fieldId = $ss_fieldTypes[0]."_".$ss_tab;
		$valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
		$ss_fieldId = $ss_fieldTypes[1]."_".$ss_tab;
		$valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
		$ss_fieldId = $ss_fieldTypes[2]."_".$ss_tab;
		$valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
		$ss_fieldId = $ss_fieldTypes[3]."_".$ss_tab;
        $valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
		$ss_fieldId = $ss_fieldTypes[4]."_".$ss_tab;
        $valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
		for ($ss_count = 1; $ss_count < 11; $ss_count++)
			{
			for ($ss_fieldCount = 5; $ss_fieldCount < count($ss_fieldTypes); $ss_fieldCount++)
				{
				$ss_fieldId = $ss_fieldTypes[$ss_fieldCount]."_".$ss_tab."_".$ss_count;
				$valid[$ss_fieldId] =  wp_filter_nohtml_kses($input[$ss_fieldId]);
				}
			}
		}
	return $valid;
	}
 public function options_update() {
    register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
 }    
}