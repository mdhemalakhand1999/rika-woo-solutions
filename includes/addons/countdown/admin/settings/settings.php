<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Settings;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Register all required settings are here.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Settings {
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
	public function __construct() {
		add_action( 'admin_init', array( $this, 'initialize_settings_field' ) );
	}
	/**
	 * Create a class for store settings data for settings field
	 * 
	 * @since 1.0.0
	 * 
	 * @param array $options_arr this value will store all settings options
	 * 
	 * @return array $options_arr
	 */
	public function rws_settings_data() {
		$options_arr = array(
			'rws_settings' => array(
				// general settings
				'rws_general_settings' => array(
					'label'    => '', // no labels here
					'callback' => '', // no callback here
					'fields'   => array(
						array(
							'id'       => 'fws_enable_flash_sale', //id
							'label'    => __( 'Enable Flash Sale', 'rika-woo-solutions' ),
							'callback' => 'fws_enable_flash_sale'
						),
						array(
							'id'       => 'fws_flash_sale_events', //id
							'label'    => __( 'Sale Events', 'rika-woo-solutions' ),
							'callback' => 'fws_flash_sale_events'
						),
						array(
							'id'       => 'fws_manage_price_label', //id
							'label'    => __( 'Manage Price Label', 'rika-woo-solutions' ),
							'callback' => 'fws_manage_price_label'
						),
						array(
							'id'       => 'fws_override_sale_price', //id
							'label'    => __( 'Override Sale Price', 'rika-woo-solutions' ),
							'callback' => 'fws_override_sale_price'
						),
						array(
							'id'       => 'fws_show_countdown_on_product_details', //id
							'label'    => __( 'Show Countdown On Product Details Page', 'rika-woo-solutions' ),
							'callback' => 'fws_show_countdown_on_product_details'
						),
					)
				)
			)
		);
		return apply_filters( 'fws_settings_options', $options_arr, $this );
	}
	/**
	 * Initialize settings field here
	 * 
	 * Here we will initalize all our required settings and sections.
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function initialize_settings_field() {

		$options_arr = $this->rws_settings_data();
		if( isset( $options_arr ) && is_array( $options_arr ) ) {
			foreach( $options_arr as $option_group => $sections ) {
				
				// register option settings
				register_setting( $option_group, 'rws_general_settings' );

				// register sections
				foreach( $sections as $key => $section ) {
					// add settings section
					$section_callback = isset( $section['callback'] ) && !empty( $section['callback'] ) ? array( Sections::instance(), $section['callback'] ): '';
					add_settings_section(
						$key, // key
						'', // label
						$section_callback, // callback
						$option_group // option group
					);

					// add settings field
					if( isset( $section['fields'] ) && is_array( $section['fields'] ) ) {
						foreach( $section['fields'] as $field ) {
							add_settings_field(
								$field['id'], //id
								$field['label'], //title
								array( Sections::instance(), $field['callback'] ), //callback
								$option_group // option group
							);
						}
					}

				}
			}
		}
	}
}