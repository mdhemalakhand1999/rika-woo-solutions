<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Create countdown if countdown are set.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Create_Countdown {
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
      * create own class constructor
      * 
      * @since 1.0.0
      * 
      * @return void
      */
      public function __construct() {
        add_action( 'admin_init', array( $this, 'fetch_campaign_data_from_db' ) );
      }
      /**
       * Fetch Onsell campaign data from database
       * 
       * @since 1.0.0
       * 
       * @return void
       */
    public function fetch_campaign_data_from_db() {
        global $wpdb;
        $table_name = $wpdb->prefix. 'flash_sale_campaign';
        $query = "SELECT * from {$table_name} WHERE enable_sale_event = 1";
        $results = $wpdb->get_results( $query );
    }
}