<?php

/**
 * Fired during plugin activation
 *
 * @link       https://bitbucket.org/northunicorn
 * @since      1.0.0
 *
 * @package    Nu_statistics_plugin
 * @subpackage Nu_statistics_plugin/includes
 */

namespace NU_Stat;
use NU_Stat\Database\TimeStatTable;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nu_statistics_plugin
 * @subpackage Nu_statistics_plugin/includes
 * @author     NU Team <north@unicorn.mail>
 */

class Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		TimeStatTable::install();
		TimeStatTable::install_data();
//        register_activation_hook( __FILE__, array( TimeStatTable::class , 'install' ) );
//        register_activation_hook( __FILE__, array( TimeStatTable::class , 'install_data' ) );
	}

}
