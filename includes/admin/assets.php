<?php
namespace Rika_Woo_Solutions\Admin;
use Rika_Woo_Solutions\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Create a class which will include all required assets
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Assets {
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
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'localize_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }
    /**
     * 
     * @since 1.0.0
     * 
     * @param array allowed_pages this will store all allowed pages
     * 
     * @return array
     */
    public function allowed_pages() {
        $allowed_pages = array(
            'toplevel_page_rika-woo-solutions',
            'rws-solutions_page_add_countdown_event',
        );
        return $allowed_pages;
    }
    /**
     * Register scripts for plugin
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function register_scripts() {
        wp_register_script(
            'rws-ajax', // handle
            Helper::essential_assets()->url. 'assets/js/rws-ajax.js', // path
            array('jquery'), // dependency
            RWS_VERSION, // version
            true // position in footer
        );
        wp_register_script(
            'rws-main', // handle
            Helper::essential_assets()->url. 'assets/js/rws-main.js', // path
            array('jquery'), // dependency
            RWS_VERSION, // version
            true // position in footer
        );
    }
    /**
     * Enqueue css or js files
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function enqueue_scripts( $screen ) {
        if( in_array( $screen, $this->allowed_pages() ) ) {
            wp_enqueue_script( 'rws-ajax' );
            wp_enqueue_script( 'rws-main' );
        }
    }
    /**
     * Localize script for pass data from php to js
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function localize_scripts() {
        wp_localize_script( 'rws-ajax', '_rws_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'rws_ajax_nonce' )
        ) ); // handle, object, arguments
    }
}

