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

class Countdown {
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
     * Create a constructor of own class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'rws_show_product_countdown_single', array( $this, 'rws_product_countdown_single' ) );
    }
    /**
     * Create a function for show countdown in product details page
     * 
     * This functionality will be available when admin will set date from ( woocommerce is first priority and rws plugin is 2nd priority)
     * 
     * @since 1.0.0
     * 
     * @param int $product_id this is id of current product.
     * 
     * @param string $product_object this is an serialize string of product object
     * 
     * @param array $product_object_arr this is an unserialize array of $product_object.
     * 
     * @return void
     */
    public function add_countdown_to_product_details() {
        $product_id = get_the_ID();
        $product_object = array_map( 'sanitize_text_field', get_post_meta( $product_id, 'rws_product_objects' ));
        $product_object_arr = isset( $product_object[0] )  ? unserialize( $product_object[0] ): array();
        $schedule_date_start = get_post_meta($product_id, '_sale_price_dates_from', true);
        $schedule_date_end = get_post_meta($product_id, '_sale_price_dates_to', true);
        $date_end = date( 'Y-m-d', $schedule_date_end );
        /**
         * Create a cron for handle schedule So that, timer shows only when date from started.
         */
        if( ( time() >= $schedule_date_start ) && ( time() <= $schedule_date_end ) ) {
            ob_start();
                echo <<<EOD
                <div class="rws-timer" data-date="$date_end">
                    <div id="days"></div>
                    <div id="hours"></div>
                    <div id="minutes"></div>
                    <div id="seconds"></div>
                </div>
                EOD;
            echo ob_get_clean();
        }
    }
}