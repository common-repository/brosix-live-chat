<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/includes
 * @author     Brosix Inc. <support@brosix.com>
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brosix_Livechat_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		if(get_option('brosix-chat-id')){
delete_option( 'brosix-chat-id');
		}
		if(get_option('brosix-chat-network')){
delete_option( 'brosix-chat-network');
		}
		if(get_option('brosix-chat-status')){
delete_option( 'brosix-chat-status');
		}
	}

}
