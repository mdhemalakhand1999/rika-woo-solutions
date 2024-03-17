<?php
/**
 * @package Rika_Woo_Solutions
 * @version 1.0.0
 */
/*
Plugin Name: Rika Woo Solutions
Plugin URI: http://wordpress.org/plugins/rika-woo-solutions/
Description: Rika Woo Solutions is a plugin which will bost your business.
Author: HR Foundation
Version: 1.0.0
Author URI: 
*/

// prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
final class Rika_Woo_Solutions {
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
        add_action( 'init', array( $this, 'define_constants' ) );
        add_action( 'init', array( $this, 'include_files' ) );
        add_action( 'init', array( $this, 'initialize_admin_class' ) );
        add_action( 'init', array( $this, 'initialize_frontend_class' ) );
        add_action( 'init', array( $this, 'load_textdomain' ) );
    }
    /**
     * Load textdomain
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'rika-woo-solutions', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
    /**
     * Define all requrie constant
     * 
     * Here we will define all our require constants for globally use.
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function define_constants() {
        define( 'RWS_VERSION', '1.0.0' );
        define( 'RWS_FILE', __FILE__ );
        define( 'RWS_AI_PLUGIN_SLUG', 'rika-woo-solutions' );
        define( 'RWS_AI_ROOT_DIR_PATH', plugin_dir_path( __FILE__ ) );
    }
    /**
     * Include necessary files
     */
    public function include_files() {
        require_once RWS_AI_ROOT_DIR_PATH . 'vendor/autoload.php';
    }
    /**
     * Initialize admin class
     * 
     * @since 1.0.0
     * 
     * @return void this function will not return anything
     */
    public function initialize_admin_class() {
        if( is_admin() ) {
            $admin = Rika_Woo_Solutions\Admin::instance();
        }
    }
    /**
     * Initialize frontend class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function initialize_frontend_class() {
        if( !is_admin() ) {
            $frontend = Rika_Woo_Solutions\Frontend::instance();
        }
    }
}
// initialize the class
Rika_Woo_Solutions::instance();