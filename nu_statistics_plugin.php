<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bitbucket.org/northunicorn
 * @since             1.0.0
 * @package           Nu_statistics_plugin
 *
 * @wordpress-plugin
 * Plugin Name:       NU Statistic
 * Plugin URI:        https://bitbucket.org/northunicorn/nu_statistics_plugin/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            NU Team
 * Author URI:        https://bitbucket.org/northunicorn
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nu_statistics_plugin
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'NU_STAT_PATH', plugin_dir_path(__FILE__) );

require_once( NU_STAT_PATH . 'vendor/autoload.php');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
use NU_Stat\Plugin;
use NU_Stat\Activator;
use NU_Stat\Deactivator;

use NU_Stat\App\Controllers\TimeStatController;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nu_statistics_plugin-activator.php
 */
function activate_nu_statistics_plugin() {
//    require_once NU_STAT_PATH . 'includes/class-nu_statistics_plugin-activator.php';
    Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nu_statistics_plugin-deactivator.php
 */
function deactivate_nu_statistics_plugin() {
//	require_once NU_STAT_PATH . 'includes/class-nu_statistics_plugin-deactivator.php';
	Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nu_statistics_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_nu_statistics_plugin' );


// require NU_STAT_PATH . 'includes/Plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nu_statistics_plugin() {

//	$plugin = new \NU_Stat\Plugin();
//	$plugin->run();

//    new NU_Stat\App\Controllers\TimeStatController();
}

run_nu_statistics_plugin();


$rest = new \NU_Stat\Rest\RestAPI();
// add_action( 'rest_api_init', function () {
// 	$rest->register_api();
// });

// add_action( 'rest_api_init', function () {
// 	register_rest_route( 'nu_stat/v1', '/author/(?P<id>\d+)', array(
// 		'methods' => 'GET',
// 		'callback' => function(){
// 			return "lol";
// 		},
// 	) );
// } );