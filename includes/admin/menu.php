<?php
namespace Rika_Woo_Solutions\Admin;
use Rika_Woo_Solutions\Helper;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Create a class which will create menu on admin area
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Menu {
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
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }
    /**
     * Define admin menu
     * 
     * @since 1.0.0
     * 
     * @param array $menu_args this will store menu items array from Helper class
     * 
     * @param string $pate_title this will store page title
     * 
     * @return void
     */
    public function admin_menu() {
        $menu_args = Helper::get_admin_menu_list();
        $page_title = $this->get_toplevel_menu_title();
        // add menu page
        add_menu_page( $page_title, $page_title, 'manage_options', RWS_AI_PLUGIN_SLUG, array( $this, 'load_main_template' ), 'dashicons-chart-area', 3 );
        // add submenu page
        foreach( $menu_args as $item_key => $item ) {
            add_submenu_page(
                $item['parent_slug'], // parent slug
                $item['title'], // page title
                $item['title'], // menu title
                $item['capability'], // capability
                $item_key, // menu slug
                array( $this, $item['display_func'] ) // callback
            );
        };
    }
    /**
     * Load main template of class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function load_main_template() {
        ob_start();
        include( 'views/feature-lists.php' );
        echo ob_get_clean();
    }
    /**
     * Load countdown settings page
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function load_countdown_settings_page() {
        ob_start();
        settings_fields( 'rws_settings' );
        do_settings_sections( 'rws_settings' );
        echo ob_get_clean();
    }
    /**
     * Get toplevel menu title
     */
    public function get_toplevel_menu_title() {
        return apply_filters( 'rws/admin/toplevel_menu_title', __( 'RWS Solutions', 'rika-woo-solutions' ) );
    }
}