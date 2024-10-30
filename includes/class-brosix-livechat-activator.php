<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 * @author     Brosix Inc. <support@brosix.com>
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brosix_Livechat_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if(!get_option('brosix-chat-id')){
add_option( 'brosix-chat-id', '0', '', 'yes' );
		}
		if(!get_option('brosix-chat-network')){
add_option( 'brosix-chat-network', '-', '', 'yes' );
		}
		if(!get_option('brosix-chat-status')){
add_option( 'brosix-chat-status', '0', '', 'yes' );
		}
	}

}
