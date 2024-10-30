<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 * @author     Brosix Inc. <support@brosix.com>
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brosix_Livechat_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'brosix-livechat',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
