<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/public
 * @author     Brosix Inc. <support@brosix.com>
 */
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Brosix_Livechat_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Brosix_Livechat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Brosix_Livechat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/brosix-livechat-public.css', array(), $this->version, 'all' );
		$brosixCSSPath= 'https://box-n2.brosix.com/livechat/widget/css/?nid='.get_brosix_chat_id();

		wp_enqueue_style( 'brosix-chat', $brosixCSSPath, array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Brosix_Livechat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Brosix_Livechat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$chatStatus = get_brosix_chat_status();
		$homeStatus = get_brosix_home_status();
		
		if($chatStatus!=0){
			if(is_front_page()== true && $homeStatus==1){}
			else{
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/brosix-livechat-public.js', array('jquery'), $this->version, false );

		$brosixScriptPath= 'https://box-n2.brosix.com/livechat/widget/js/?nid='.get_brosix_chat_id();
		wp_enqueue_script( 'brosix-chat', $brosixScriptPath, $this->version, false );
			}
		}
	}

}
