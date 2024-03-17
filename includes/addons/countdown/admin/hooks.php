<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin;
use Rika_Woo_Solutions\Addons\Countdown\Admin\Countdown;

if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Create a class to handle essential hooks for WooCommerce Product Countdown.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Hooks {
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
     * Create a constuctor for own class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function __construct() {
        // add tab into product add/edit panel
        add_filter( 'woocommerce_product_data_tabs', array( Countdown::instance(), 'add_countdown_tab_to_product' ) );
        // insert markup into product add/edit panel
        add_action( 'woocommerce_product_data_panels', array( Countdown::instance(), 'insert_markup_for_countdown_tab' ) );
        add_action( 'woocommerce_admin_process_product_object', array( Countdown::instance(), 'insert_essential_product_object' ) );
    }
    
}