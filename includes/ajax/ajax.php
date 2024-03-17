<?php
namespace Rika_Woo_Solutions\Ajax;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create a class for handle ajax request.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Ajax {
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
     * Create a constructor for ajax class
     * 
     * This will call automatically for handle ajax request
     * 
     * @since 1.0.0
     * 
     * @return void  this function will not return anything
     */
    public function __construct() {
        add_action( 'wp_ajax_rws_feature_activate_option', array( $this, 'feature_activate_option' ) );
        add_action( 'wp_ajax_nopriv_rws_feature_activate_option', array( $this, 'feature_activate_option' ) );
    }
    public function feature_activate_option() {
        // exit if nonce not exists
        if( !isset( $_POST['nonce'] ) ) {
            exit;
        }
        // exit if nonce are not verified
        if( !wp_verify_nonce( $_POST['nonce'], 'rws_ajax_nonce' ) ) {
            return wp_send_json_error(
                array(
                    'message' => __( 'Sorry! nonce validation failed', 'rika-woo-solutions' )
                )
            );
        }
        // if field value or field name not exits, then exit
        if( !isset( $_POST['field_value'] ) || !isset( $_POST['field_name'] ) ) {
            return wp_send_json_error(
                array(
                    'message' => __( 'Please insert field name and value first.', 'rika-woo-solutions' )
                )
            );
        }
        $field_name = sanitize_text_field( $_POST['field_name'] );
        $field_value = absint( $_POST['field_value'] );
        $update_option = update_option( $field_name, $field_value );
        if( $update_option ) {
            // if updated successfully
            return wp_send_json_success(
                array(
                    'message' => __( 'Option have been updated', 'rika-woo-solutions' )
                )
            );
        } else {
            // if update failed 
            return wp_send_json_error(
                array(
                    'message' => __( 'Sorry! Data update failed', 'rika-woo-solutions' )
                )
             );
        }
        exit;
    }
}