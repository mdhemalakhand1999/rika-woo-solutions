<?php
namespace Rika_Woo_Solutions;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Create an frontend class which will include all necessary files.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Frontend {
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
     * Create constructor of own class
     * 
     * @since 1.0.0
     * 
     * @return void this constructor will not return anything
     */
    public function __construct() {
        if( 1 === (int) get_option( 'rws_feature_active_countdown' ) ) {
            $Countdown = Addons\Countdown\Frontend\Countdown::instance();
            $countdown_hook = Addons\Countdown\Frontend\Hooks::instance();
            $countdown_assets = Addons\Countdown\Assets::instance();
        }
    }
}