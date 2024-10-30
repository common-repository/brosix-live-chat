<?php

/**
 *
 * @link              https://www.brosix.com
 * @since             1.0.1
 * @package           Brosix_Livechat
 *
 * @wordpress-plugin
 * Plugin Name:       Brosix Live Chat 
 * Plugin URI:        https://www.brosix.com/live-chat/
 * Description:       Chat directly with website guests and take advantage of Brosix collaboration features for the ultimate customer service!
 * Version:           1.1.0
 * Author:            Brosix Inc.
 * Author URI:        https://www.brosix.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       brosix-livechat
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
define( 'BROSIX_LIVECHAT_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-brosix-livechat-activator.php
 */
function activate_brosix_livechat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-brosix-livechat-activator.php';
	Brosix_Livechat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-brosix-livechat-deactivator.php
 */
function deactivate_brosix_livechat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-brosix-livechat-deactivator.php';
	Brosix_Livechat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_brosix_livechat' );
register_deactivation_hook( __FILE__, 'deactivate_brosix_livechat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-brosix-livechat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_brosix_livechat() {

	$plugin = new Brosix_Livechat();
	$plugin->run();

}
run_brosix_livechat();

/*Setup the brosix chat API key */
 $apiURL ="https://box-n2.brosix.com/net/wordpress-livechat-plugin/";


 function get_brosix_chat_api_key(){
	if(get_option('brosix-chat-api-key') !=null){
		$chatAPI= get_option('brosix-chat-api-key');
		return $chatAPI;
	}else {
		return '';
	}
}

 function update_brosix_chat_api_key($chatAPI){
	 	if(get_option('brosix-chat-api-key') !=null){
	 update_option('brosix-chat-api-key',$chatAPI, 'yes');
	}else {
add_option( 'brosix-chat-api-key', $chatAPI, '', 'yes' );
		}
}

/*Setup the brosix chat ID */
 function get_brosix_chat_id(){
	if(get_option('brosix-chat-id') !=null){
		$chatID= get_option('brosix-chat-id');
		return $chatID;
	}else {
		return 'no ID';
	}
}

 function update_brosix_chat_id($chatID){
	 	if(get_option('brosix-chat-id') !=null){
	 update_option('brosix-chat-id',$chatID, 'yes');
	}else {
add_option( 'brosix-chat-id', $chatID, '', 'yes' );
		}
}

/*Setup the Brosix chat status */
 function get_brosix_chat_status(){
	if(get_option('brosix-chat-status') !=null){
		$chatStatus= get_option('brosix-chat-status');
		return $chatStatus;
	}else {
		return 'not set';
	}
}

 function update_brosix_chat_status($chatStatus){
	 	if(get_option('brosix-chat-status') !=null){
	 update_option('brosix-chat-status',$chatStatus, 'yes');
	}else {
add_option( 'brosix-chat-status', $chatStatus, '', 'yes' );
		}
}

/*Setup the Brosix home status */
 function get_brosix_home_status(){
	if(get_option('brosix-home-status') !=null){
		$homeStatus= get_option('brosix-home-status');
		return $homeStatus;
	}else {
		return 'not set';
	}
}

 function update_brosix_home_status($homeStatus){
	 	if(get_option('brosix-home-status') !=null){
	 update_option('brosix-home-status',$homeStatus, 'yes');
	}else {
add_option( 'brosix-home-status', $homeStatus, '', 'yes' );
		}
}

/*Setup the Brosix chat network */
 function get_brosix_chat_network(){
	if(get_option('brosix-chat-network') !=null){
		$chatNetwork= get_option('brosix-chat-network');
		return $chatNetwork;
	}else {
		return 0;
	}
}

 function update_brosix_chat_network($chatNetwork){
	 	if(get_option('brosix-chat-network') !=null){
	 update_option('brosix-chat-network',$chatNetwork, 'yes');
	}else {
add_option( 'brosix-chat-network', $chatNetwork, '', 'yes' );
		}
}

/* Setup ajax functions to update brosix chat id, network and status options */
function aj_brosix_get_data_from_api(){
		check_ajax_referer( 'brosix-ajax', 'security' );
$api_key = sanitize_text_field($_POST["api_key"]);
	if($api_key){
	$apikeyURL = 'https://box-n2.brosix.com/net/wordpress-livechat-plugin/check/?key='.$api_key;
	$brosix_request = wp_remote_get($apikeyURL,
             array( 'headers' => array( 
                          'Accept' => 'application/json')));
	$brosix_r_body = wp_remote_retrieve_body( $brosix_request );
	$data_api = json_decode($brosix_r_body, true);
		if($data_api['result']==1){
	update_brosix_chat_api_key($api_key);
	$chat_id =$data_api['network_id'];
	$chat_network=$data_api['network_name'];
	$chat_status=$data_api['livechat_status'];
	$valid_key= $data_api['result'];
	}
	if($chat_id != null && $chat_id != 0){
	$result= array("chat_id"=>$chat_id,"chat_network"=>$chat_network,"chat_status"=>$chat_status,"valid_key"=>$valid_key);
		}else {
		$result= array("chat_id"=>0,"chat_network"=>"None","chat_status"=>0,"valid_key"=>2);
	}
	echo json_encode($result);
		
}
	wp_die();
}
add_action("wp_ajax_brosix_get_data_from_api", "aj_brosix_get_data_from_api");
add_action("wp_ajax_nopriv_brosix_get_data_from_api","aj_brosix_get_data_from_api");

function aj_update_brosix_chat_id(){
	check_ajax_referer( 'brosix-ajax', 'security' );
	$chatID = intval($_POST["chat_id"]);
	$chatNetwork = sanitize_text_field($_POST["chat_network"]);
	if((int)$chatID == $chatID){
	 update_option('brosix-chat-id',$chatID, 'yes');
	}
	 update_option('brosix-chat-network',$chatNetwork, 'yes');
	echo 'success';
	wp_die();
}
add_action("wp_ajax_update_brosix_chat_id", "aj_update_brosix_chat_id");
add_action("wp_ajax_nopriv_update_brosix_chat_id","aj_update_brosix_chat_id");

function aj_update_brosix_chat_status(){
	check_ajax_referer( 'brosix-ajax', 'security' );
	$chatStatus = intval($_POST["chat_status"]);
	if((int)$chatStatus == $chatStatus){
	 update_option('brosix-chat-status',$chatStatus, 'yes');
	echo $chatStatus.'success'.get_brosix_chat_status();
	}
	wp_die();
}
add_action("wp_ajax_update_brosix_chat_status", "aj_update_brosix_chat_status");
add_action("wp_ajax_nopriv_update_brosix_chat_status","aj_update_brosix_chat_status");


function aj_update_brosix_home_status(){
	check_ajax_referer( 'brosix-ajax', 'security' );
	$homeStatus = intval($_POST["home_status"]);
	if((int)$homeStatus == $homeStatus){
	 update_option('brosix-home-status',$homeStatus, 'yes');
	echo $homeStatus.'success'.get_brosix_home_status();
	}
	wp_die();
}
add_action("wp_ajax_update_brosix_home_status", "aj_update_brosix_home_status");
add_action("wp_ajax_nopriv_update_brosix_home_status","aj_update_brosix_home_status");

/*add settings page link to the plugins page*/
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'brosix_add_plugin_page_settings_link');
function brosix_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=brosix-live-chat/admin/partials/brosix-livechat-admin-display.php' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}