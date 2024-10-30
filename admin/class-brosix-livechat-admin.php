<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/admin
 * @author     Brosix Inc. <support@brosix.com>
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brosix_Livechat_Admin {

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
		 * defined in Brosix_Livechat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Brosix_Livechat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/brosix-livechat-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'brosix-roboto-css', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap', array(), $this->version, 'all' );

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
		 * defined in Brosix_Livechat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Brosix_Livechat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/brosix-livechat-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security'  => wp_create_nonce( 'brosix-ajax' )));        
	}

}
/**
 * Register a custom menu page.
 */
function brosix_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Live Chat by Brosix', 'brosix-livechat' ),
        'Live Chat',
        'manage_options',
        'brosix-live-chat/admin/partials/brosix-livechat-admin-display.php',
        '',
        plugins_url( 'brosix-live-chat/admin/images/brosix-chat-icon.png' ),
        36
    );
}
add_action( 'admin_menu', 'brosix_register_my_custom_menu_page' );