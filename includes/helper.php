<?php
namespace Rika_Woo_Solutions;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Create a class for retrive essential elements anywere.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Helper {
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
     * List of menu for admin area
     * 
     * @since 1.0.0
     * 
     * @param array $menu this will store all menu elements
     * 
     * @return array $menu this function will return menu array
     */
    public static function get_admin_menu_list() {
        $menu = array();
        $menu[ RWS_AI_PLUGIN_SLUG ] = array(
            'parent_slug'  => RWS_AI_PLUGIN_SLUG,
            'title'        => _x( 'Features', 'Administrator can activate/deactivate essential features as her needed.', 'rika-woo-solutions' ),
            'capability'   => 'manage_options',
            'display_func' => 'load_main_template'
        );
        if( 1 === (int) get_option( 'rws_feature_active_countdown' ) ) {
            $menu[ 'countdown_settings' ] = array(
                'parent_slug'  => RWS_AI_PLUGIN_SLUG,
                'title'        => _x( 'Countdown Settings', 'Here we will store all essential countdown settings', 'rika-woo-solutions' ),
                'capability'   => 'manage_options',
                'display_func' => 'load_countdown_settings_page'
            );
        }
        return apply_filters( 'rws/admin_menu_list', $menu );
    }
    public static function essential_assets() {
        if( isset( $GLOBALS[ 'essential_assets' ] ) ) {
            return $GLOBALS[ 'essential_assets' ];
        }
        $assets = array(
            'url' => plugin_dir_url( RWS_FILE )
        );
        $GLOBALS['essential_assets'] = (object) $assets;
        return $GLOBALS['essential_assets'];
    }
}