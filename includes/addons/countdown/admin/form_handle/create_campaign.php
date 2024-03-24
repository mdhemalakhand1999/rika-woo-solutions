<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Form_Handle;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Insert data when create new campaign
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Create_Campaign {
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
     * Create a consructor of own class
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'admin_init', array( $this, 'rws_handle_create_campaign' ) );
    }
    /**
     * Create a campaign
     * 
     * Here we will write a function for create a campain
     * 
     * @since 1.0.0
     * 
     * @param POST $_POST['rws_countdown_sale_campaign'] this will retrive all data
     * 
     * @return void
     */
    public function rws_handle_create_campaign() {
        global $wpdb;
        $table_name = $wpdb->prefix. 'flash_sale_campaign';
        // if form submitted
        if( isset( $_POST['rws_create_flash_event'] ) ) {
            $nonce = sanitize_text_field( $_POST['rws_sale_campaign'] );
            // return if nonce are not verified
            if( !wp_verify_nonce( $nonce, 'rws_sale_campaign' ) ) {
                wp_die( __( 'Nonce is not verified!', 'rika-woo-solutions' ), __( 'Nonce Error', 'rika-woo-solutions' ) );
                return;
            }
            // return if event name are not entered.
            if( !isset( $_POST['rws_add_event_name'] ) || empty( sanitize_text_field( $_POST['rws_add_event_name'] ) ) ) {
                wp_die( __( 'Please insert a valid event name', 'rika-woo-solutions' ), __( 'Event Name Required', 'rika-woo-solutions' ) );
                return;
            }
            // return if from date not insert
            if( !isset( $_POST['rws_add_event_from'] ) || empty( sanitize_text_field( $_POST['rws_add_event_from'] ) ) ) {
                wp_die( __( 'Please insert event from', 'rika-woo-solutions' ), __( 'Date Required', 'rika-woo-solutions' ) );
                return;
            }
            // return if to  date not insert
            if( !isset( $_POST['rws_add_event_to'] ) || empty( sanitize_text_field( $_POST['rws_add_event_to'] ) ) ) {
                wp_die( __( 'Please insert event to', 'rika-woo-solutions' ), __( 'Date Required', 'rika-woo-solutions' ) );
                return;
            }
            error_log( print_r( $_POST['select_category_for_onsale'], true ) );
            $rws_countdown_enable_toggle = isset($_POST['rws_countdown_enable_toggle']) && 'on' === sanitize_text_field( $_POST['rws_countdown_enable_toggle'] ) ? 1 : 0;
            $rws_add_event_name = sanitize_text_field( $_POST['rws_add_event_name'] );
            $rws_add_event_from = sanitize_text_field( $_POST['rws_add_event_from'] );
            $rws_add_event_to = sanitize_text_field( $_POST['rws_add_event_to'] );
            $rws_apply_all_products = isset($_POST['rws_apply_all_products']) && 'on' === sanitize_text_field( $_POST['rws_apply_all_products'] ) ? 1 : 0;
            $select_category_for_onsale = isset($_POST['select_category_for_onsale']) ? sanitize_text_field( serialize( $_POST['select_category_for_onsale'] ) ) : '';
            $select_product_for_onsale = isset($_POST['select_product_for_onsale']) ? sanitize_text_field( serialize( $_POST['select_product_for_onsale'] ) ) : '';
            $rws_event_discount_type = isset($_POST['rws_event_discount_type']) ? sanitize_text_field( $_POST['rws_event_discount_type'] ) : '';
            $rws_event_discount_value = isset($_POST['rws_event_discount_value']) ? absint( $_POST['rws_event_discount_value'] ) : 0;
            $rws_apply_discount_for_registered_customer = isset($_POST['rws_apply_discount_for_registered_customer']) && 'on' === sanitize_text_field( $_POST['rws_apply_discount_for_registered_customer'] ) ? 1 : 0;
            $show_countdown_product_details             = isset($_POST['show_countdown_product_details']) && 'on' === sanitize_text_field( $_POST['show_countdown_product_details'] ) ? 1 : 0;
            
            /**
             * Insert data on database
             * 
             * Table name: wp_flash_sale_campaign
             */
            // data
            $data = array(
                'enable_sale_event'                      => $rws_countdown_enable_toggle,
                'sale_event'                             => $rws_add_event_name,
                'date_from'                              => $rws_add_event_from,
                'date_to'                                => $rws_add_event_to,
                'apply_all_product'                      => $rws_apply_all_products,
                'selected_categories'                    => $select_category_for_onsale,
                'selected_product_ids'                   => $select_product_for_onsale,
                'discount_type'                          => $rws_event_discount_type,
                'discount_value'                         => $rws_event_discount_value,
                'apply_discount_for_registered_customer' => $rws_apply_discount_for_registered_customer,
                'countdown_on_product_details'           => $show_countdown_product_details,
            );
            $data_for_table = apply_filters( 'rws_flash_event_db_data', $data );
            // format
            $format = array(
                '%d', //maps for enable_sale_event
                '%s', //maps for sale_event
                '%s', //maps for date_from
                '%s', //maps for date_to
                '%d', //maps for apply_all_product
                '%s', //maps for selected_categories
                '%s', //maps for selected_product_ids
                '%s', //maps for discount_type
                '%d', //maps for discount_value
                '%d', //maps for apply_discount_for_registered_customer
                '%d', //maps for countdown_on_product_details
            );
            $wpdb->insert(
                $table_name, //table name
                $data_for_table, //data
                $format //format
            );
        }
    }
}