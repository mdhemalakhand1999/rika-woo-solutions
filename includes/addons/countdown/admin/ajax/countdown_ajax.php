<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Ajax;

if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Manage all required ajax requests for only admin area.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Countdown_Ajax {
	
	// instance of current class
    private static $_instance;
    
	/**
     * Create an own class instance
    * 
    * @since 1.0.0
    * 
    * @return object $_instance this function will return own class instance
    */
    public static function instance() {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new Self();
        }
        return self::$_instance;
    }

	/**
	 * Create a constructor of own class
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_ajax_rws_add_flash_event', array( $this, 'rws_add_flash_event' ) );
	}

	/**
	 * An ajax for create flash event sale
	 * 
	 * @since 1.0.0
	 */
	public function rws_add_flash_event() {
		
	}

}
new Countdown_Ajax();