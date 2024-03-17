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
     * Create a product single countdown
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function rws_product_countdown_single( $end_date ) {
        var_dump( $end_date );
        ob_start();
            echo <<<EOD
            <div class="rws-timer" data-date="$end_date">
                <div id="days"></div>
                <div id="hours"></div>
                <div id="minutes"></div>
                <div id="seconds"></div>
            </div>
            EOD;
        echo ob_get_clean();
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
        $product_object = sanitize_text_field( get_post_meta( $product_id, 'rws_product_objects' ) );
        $product_object_arr = isset( $product_object )  ? unserialize( $product_object[0] ): array();
        $rws_product_single_countdown_from = $product_object_arr['rws_product_single_countdown_from'] ? $product_object_arr['rws_product_single_countdown_from']: '';
        $rws_product_single_countdown_to = $product_object_arr['rws_product_single_countdown_to'] ? $product_object_arr['rws_product_single_countdown_to']: '';
        /**
         * Create a cron for handle schedule So that, timer shows only when date from started.
         */
        $arg = array(
            'emal' => $rws_product_single_countdown_to
        );
        $timestamp = strtotime($rws_product_single_countdown_from);
        if( !wp_next_scheduled( 'rws_show_product_countdown_single', $arg  ) ) {
            wp_schedule_single_event( $timestamp, 'rws_show_product_countdown_single', $arg ); 
        }
    }
}