<?php
namespace Rika_Woo_Solutions\Addons\Countdown;
use Rika_Woo_Solutions\Helper;

if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Create a class to configure countdown ( this will act like index of this countdown addon )
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
     * Create a constructor for this class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'countdown_enqueue_admin_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_scripts' ) );
    }
    /**
     * Register script in frontend
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function register_scripts() {
        wp_register_style(
            'rws-countdown-style',
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/css/style.css', // path
            array(), // dependency
            time(),
            false
        );
        wp_register_style(
            'rws-countdown-admin',
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/css/admin.css', // path
            array(), // dependency
            time(),
            false
        );
        wp_register_script(
            'rws-countdown-main', // handle
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/js/main.js', // path
            array('jquery'), // dependency
            time(), // version
            true // position in footer
        );
        wp_register_script(
            'rws-countdown-ajax', // handle
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/js/countdown-ajax.js', // path
            array('jquery'), // dependency
            time(), // version
            true // position in footer
        );
    }
    /**
     * Enqueue scripts in fronte4nd
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function frontend_enqueue_scripts() {
        // load countdown scripts
        wp_enqueue_style( 'rws-countdown-style' );
        wp_enqueue_script( 'rws-countdown-main' );
    }
    /**
     * List of pages where js/css will be enqueue
     * 
     * @since 1.0.0
     * 
     * @param array $pages this will store all pages
     * 
     * @return array $pages this function will return requried pages array
     */
    public function allowed_pages() {
        $pages = array(
            'post-new.php'
        );
        return $pages;
    }
    /**
     * Enqueue script for countdown addon
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function countdown_enqueue_admin_scripts(  ) {
        wp_enqueue_style( 'rws-countdown-admin' );
        wp_enqueue_script( 'rws-countdown-ajax' );
        wp_localize_script( 'rws-countdown-ajax', '_rws_object', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'rws_countdown_ajax_nonce' )
        ) ); // handle, object, arguments
    }
}