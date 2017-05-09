<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.alexisvillegas.com
 * @since             1.0.0
 * @package           AJV_Testimonials
 *
 * @wordpress-plugin
 * Plugin Name:       AJV Testimonials
 * Plugin URI:        http://www.alexisvillegas.com/plugins/ajv-testimonials
 * Description:       Easily manage and display client testimonials on your website.
 * Version:           1.0.1
 * Author:            Alexis J. Villegas
 * Author URI:        http://www.alexisvillegas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ajv-testimonials
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ajv-testimonials.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ajv_testimonials() {

	$plugin = new AJV_Testimonials();
	$plugin->run();

}
run_ajv_testimonials();
