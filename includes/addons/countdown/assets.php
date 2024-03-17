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
        add_action( 'admin_enqueue_scripts', array( $this, 'countdown_register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'countdown_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_register_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue_scripts' ) );
    }
    /**
     * Register script in frontend
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function frontend_register_scripts() {
        // load countdown in frontend
        wp_register_style(
            'flipdown', // handle
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/vendors/css/flipdown.min.css', // url
            array(), // dependency
            RWS_VERSION, // version
            false // position in footer
        );
        wp_enqueue_script(
            'flipdown',
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/vendors/js/flipdown.min.js', // url
            array( 'jquery' ),
            RWS_VERSION,
            true  
        );
        wp_register_script(
            'rws-countdown-main', // handle
            Helper::essential_assets()->url. 'includes/addons/countdown/assets/js/main.js', // path
            array('jquery', 'flipdown'), // dependency
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
        // load countdown
        wp_enqueue_style( 'flipdown' );
        wp_enqueue_script( 'flipdown' );
        // only for product details
        if( is_single() && 'product' == get_post_type() ) {
            wp_enqueue_script(
                'rws-countdown-main' // handle
            );
        }
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
     * Register script for countdown addon
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function countdown_register_scripts($screen) {
       
    }
    /**
     * Enqueue script for countdown addon
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function countdown_enqueue_scripts( $screen ) {
        
    }
}