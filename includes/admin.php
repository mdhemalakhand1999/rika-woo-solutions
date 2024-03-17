<?php
namespace Rika_Woo_Solutions;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Create an admin class which will include all necessary files.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Admin {
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
        $menu   = Admin\Menu::instance();
        $assets = Admin\Assets::instance();
        $ajax = Ajax\Ajax::instance();
        if( 1 === (int) get_option( 'rws_feature_active_countdown' ) ) {
            $countdown_hook = Addons\Countdown\Admin\Hooks::instance();
            $countdown_assets = Addons\Countdown\Assets::instance();
        }
    }
}