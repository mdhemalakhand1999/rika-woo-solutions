<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Frontend;
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
    }
    
}