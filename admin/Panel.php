<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bitbucket.org/northunicorn
 * @since      1.0.0
 *
 * @package    Nu_statistics_plugin
 * @subpackage Nu_statistics_plugin/admin
 */
namespace NU_Stat\AdminSpace;

use NU_Stat\AdminSpace\Models\MainTab;
use NU_Stat\AdminSpace\Models\SettingsTab;
use NU_Stat\AdminSpace\Models\DashboardTab;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nu_statistics_plugin
 * @subpackage Nu_statistics_plugin/admin
 * @author     NU Team <north@unicorn.mail>
 */

class Panel {

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
	private $tabs = [];

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

		$this->tabs = [
			new DashboardTab('dashboard', 'Dashboard'),
			new MainTab('main', 'title'),
			new SettingsTab('settings', 'settings title'),
		];


		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_styles'] );
		add_action( 'admin_enqueue_scripts', [$this, 'enqueue_scripts'] );

		// $settings = new \NU_Stat\AdminSpace\Lib\SettingLib\Settings('my_option_group', 'nu-user-statistic');

        add_action( 'admin_menu', [$this , 'nu_plugin_toolbar_menu'] );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nu_statistics_plugin-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nu_statistics_plugin-admin.js', array( 'jquery' ), $this->version, false );
//		wp_enqueue_script( $this->plugin_name . '-main', plugin_dir_url( __FILE__ ) . 'js/app/build/bundle.js',
//            array( 'react', 'react-dom','wp-blocks', 'wp-editor', 'wp-element', 'wp-i18n' ), $this->version, false );

        wp_enqueue_script( $this->plugin_name . '-main', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/main.js'
            , array( 'react', 'react-dom'), $this->version, false );
        wp_enqueue_script( $this->plugin_name . '-vendor', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/vendor.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name . '-2', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/2.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name . '-3', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/3.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name . '-4', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/4.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name . '-5', plugin_dir_url( __FILE__ ) . 'js/react-redux-boilerplate/build/5.js', array(), $this->version, false );


    }

    /**
     *  Function for adding submenu to admin tool menu.
     */
    public function nu_plugin_toolbar_menu() {
        add_management_page( 'NU User Statistic', 'NU User Statistic', 'manage_options', 'nu-user-statistic',
            array($this, 'nu_statistic_plugin_options') );
    }

    /**
     *  Callback function for option page
     */
    public function nu_statistic_plugin_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		// $tabs = [
		// 	new MainTab('main', 'title'),
		// 	new SettingsTab('settings', 'settings title'),
		// ];
		foreach($this->tabs as $tab){
			$tab->render();
		}
		
		require_once NU_STAT_PATH . 'admin/partials/nu_statistics_plugin-admin-display.php';

    }

}
