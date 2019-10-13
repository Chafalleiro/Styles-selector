<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://chafalladas.com
 * @since             1.0.0
 * @package           Styleselector
 *
 * @wordpress-plugin
 * Plugin Name:       Styles selector
 * Plugin URI:        https://github.com/Chafalleiro/Styles-selector
 * Description:       Changes the styles by classes dinamically. Needs some knowledge about the css styles of the templates to alter.
 * Version:           1.1.1
 * Author:            Alfonso
 * Author URI:        https://chafalladas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       styleselector
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'STYLESELECTOR_VERSION', '1.1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-styleselector-activator.php
 */
function activate_styleselector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-styleselector-activator.php';
	Styleselector_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-styleselector-deactivator.php
 */
function deactivate_styleselector() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-styleselector-deactivator.php';
	Styleselector_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_styleselector' );
register_deactivation_hook( __FILE__, 'deactivate_styleselector' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-styleselector.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_styleselector() {

	$plugin = new Styleselector();
	$plugin->run();

}
run_styleselector();
