<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin;
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
     * Add countdown tab to add/edit product page
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function add_countdown_tab_to_product( $items ) {
        $items['rws_countdown'] = array(
            'label' => __( 'Product Countdown' ), // label
            'target' => 'rws_product_countdown', // target
            'class' => array(), // class
            'priority' => 71 // priority
        );
        return $items;
    }
	/**
	 * Insert markpup for countdown tab
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function insert_markup_for_countdown_tab() {
		ob_start();
			include( RWS_AI_ROOT_DIR_PATH.'includes/addons/countdown/views/product-countdown-panel.php' );
		echo ob_get_clean();
	}
    /**
     * Insert additional product object
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function insert_essential_product_object( $product ) {
        $sanitize_objects = isset( $_POST['rws_product_meta'] ) ? array_map( 'sanitize_text_field', $_POST['rws_product_meta'] ): array();
        $product->update_meta_data( 'rws_product_objects', serialize( $sanitize_objects ) );
    }
}