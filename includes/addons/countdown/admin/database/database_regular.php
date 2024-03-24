<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Database;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Create campaign in database when form submission
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Database_Regular {
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
     * all database create functionality hook will define here
     * 
     * @since 1.0.0
     * 
     * @return void
     */
	public function __construct() {
		add_action( 'admin_init', array($this, 'rws_flash_sale_db') );
	}
	/**
	 * Create a database table for flash sale when activeate plugin
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function rws_flash_sale_db() {
		global $wpdb;
		// setup table name with prifix
		$table_name = $wpdb->prefix. 'flash_sale_campaign';
		$charset_collate = $wpdb->get_charset_collate();
		// create table query
		$query = "CREATE TABLE IF NOT EXISTS {$table_name} (
			id INT NOT NULL AUTO_INCREMENT,
			enable_sale_event INT,
			sale_event VARCHAR(250),
			date_from DATE,
			date_to DATE,
			apply_all_product INT,
			selected_categories VARCHAR(500),
			selected_product_ids VARCHAR(255),
			discount_type VARCHAR(255),
			discount_value INT,
			apply_discount_for_registered_customer INT,
			countdown_on_product_details INT,
			PRIMARY KEY (id)
		) $charset_collate";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta( $query );
	}
}