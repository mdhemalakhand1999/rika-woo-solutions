<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Schedule;
use WP_Query;
use WC_Product;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Schedule flash sale
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Schedule_Flash_Sale {
    // instance of current class
    private static $_instance;
    private $all_campaigns = array();
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
        // get all schedule products
        add_action( 'wp_loaded', array( $this, 'get_all_schedule_products' ) );
        // setup schedule hook for each categories
        add_action( 'wp_loaded', array( $this, 'setup_flash_event_for_categories' ) );
        // flash sale product schedule
        add_action( 'schedule_flash_product', array( $this, 'flash_sale_product_based_on_category', 10, 6 ) );
        error_log(print_r(wp_get_schedules(  ), true));
    }
    /**
     * Flash sale product based on category
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function flash_sale_product_based_on_category($product_id, $date_from, $date_to, $discount_type, $discount_value, $countdown_on_product_details=true) {
        $args = array(
            'product_id' => 31,
            'date_from' => '2024-03-07',
            'date_to' => '2024-05-09',
            'discount_type' => 'percentage-discount',
            'discount_value' => '32',
            'countdown_on_product_details' => '1',
        );
        extract($args);
        $product = new WC_Product( $product_id );
        $product_regular_price = $product->get_regular_price();
        // convert discount to decimal
        $discount_percentage_decimal = $discount_value / 100;
        // final discount product price
        $product_price = null;
        switch( $discount_type ) {
            case 'percentage-discount':
                $product_price = $discount_percentage_decimal * $product_regular_price;
                break;
            case 'fixed-discount':
                $product_price = $product_regular_price - $discount_value;
                break;
            case 'fixed-price':
                $product_price = $discount_value;
                break;
        }
        // if product is not in sale
        $product_metadata = sanitize_text_field( get_post_meta( $product_id, 'rws_product_objects', true ) );
        $product_metadata_array = unserialize($product_metadata);
        $product_metadata_array['_enable_single_product_countdown'] = 'yes';
        if( !$product->is_on_sale() ) {
            update_post_meta( $product_id, 'rws_product_objects', serialize( $product_metadata_array ) );
            $product->set_date_on_sale_from(strtotime( $date_from ));
            $product->set_date_on_sale_to(strtotime( $date_to ));
            $product->set_sale_price( $product_price );
            if( $product->save() ) {
                error_log('product saved');
            }
        }
        // all are done. now close schedule
        wp_clear_scheduled_hook( 'flash_sale_product_based_on_category', $args );
    }
    /**
     * Setup sale product campaign based on category
     * 
     * @since 1.0.0
     * 
     * @return void 
     */
    public function setup_flash_event_for_categories() {
        $all_campaigns = $this->get_sale_campaign();
        // if campaign are not exists, then we will not do anything
        if( 0 === absint( $all_campaigns ) ) {
            return;
        }
        foreach( $all_campaigns as $campaign ) {
            $campaign_categories          = isset( $campaign->selected_categories ) ? sanitize_text_field( $campaign->selected_categories ) : null;
            $campaign_categories_array    = isset( $campaign_categories ) && !empty( $campaign_categories ) ? unserialize( $campaign_categories ) : array();
            $enable_sale_event            = isset( $campaign->enable_sale_event ) ? absint( $campaign->enable_sale_event ) : 0;
            $date_from                    = isset( $campaign->date_from ) ? sanitize_text_field( $campaign->date_from ) : '';
            $date_to                      = isset( $campaign->date_to ) ? sanitize_text_field( $campaign->date_to ) : '';
            $discount_type                = isset( $campaign->discount_type ) ? sanitize_text_field( $campaign->discount_type ) : '';
            $discount_value               = isset( $campaign->discount_value ) ? absint( $campaign->discount_value ) : '';
            $countdown_on_product_details = isset( $campaign->countdown_on_product_details ) ? absint( $campaign->countdown_on_product_details ) : '';
            /**
             * Fetch all products based on product categories
             */
            $args = array(
                'post_status'    => 'publish',
                'post_type'      => 'product',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'id',
                        'terms'    => $campaign_categories_array,
                        'operator' => 'IN'
                    )
                )
            );
            $query = new WP_Query( $args );
            while( $query->have_posts() ) {
                $query->the_post();
                /**
                 * Create a schedule event for flash sale product
                 */
                $args = array(
                    'product_id'                   => get_the_ID(),
                    'date_from'                    => $date_from,
                    'date_to'                      => $date_to,
                    'discount_type'                => $discount_type,
                    'discount_value'               => $discount_value,
                    'countdown_on_product_details' =>  $countdown_on_product_details,
                );
                if( !wp_next_scheduled( 'schedule_flash_product', $args ) ) {
                    wp_schedule_single_event( time(), 'schedule_flash_product', $args);
                }
            }
       }
    }
    /**
     * Get all products from prefix_flash_sale_campaign table
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function get_all_schedule_products() {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table = $prefix. 'flash_sale_campaign';
        $query = "SELECT enable_sale_event, sale_event, date_from, date_to, selected_categories, selected_product_ids, discount_type, discount_value, countdown_on_product_details from {$table}";
        $this->all_campaigns = $wpdb->get_results( $query );
    }
    /**
     * Get flash sale campaign
     * 
     * @since 1.0.0
     * 
     * @return array $all_campaign
     */
    public function get_sale_campaign() {
        return $this->all_campaigns;
    }
}