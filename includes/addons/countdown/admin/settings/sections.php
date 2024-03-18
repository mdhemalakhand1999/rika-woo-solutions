<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Settings;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Register all required sections are here.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Sections {
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
	 * Enable flash sale
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function fws_enable_flash_sale() {
		ob_start();
		echo 'fws_enable_flash_sale';
		echo ob_get_clean();
	}

	 /* Flash Sale Events
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function fws_flash_sale_events() {
		ob_start();
		echo 'fws_flash_sale_events';
		echo ob_get_clean();
	}
	
	/* Manage Price Label
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function fws_manage_price_label() {
		ob_start();
		echo 'fws_manage_price_label';
		echo ob_get_clean();
	}
	
	/* Override Sale Price
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function fws_override_sale_price() {
		ob_start();
		echo 'fws_override_sale_price';
		echo ob_get_clean();
	}
	
	/* Enable Countdown On Product Details
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function fws_show_countdown_on_product_details() {
		ob_start();
		echo 'fws_show_countdown_on_product_details';
		echo ob_get_clean();
	}
	
}