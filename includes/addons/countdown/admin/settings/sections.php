<?php
namespace Rika_Woo_Solutions\Addons\Countdown\Admin\Settings;
use WP_Query;
if ( ! defined( 'ABSPATH' ) && !class_exists( 'WooCommerce' ) ) {
	exit;
}

/**
 * Register all required sections are here.
 * 
 * @package Rika_Woo_Solutions
 * 
 * @since 1.0.0
 */
class Sections {
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
	 * Enable flash sale
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function rws_enable_flash_sale() {
		ob_start();?>
			<div class="rws-switcher">
				<input type="checkbox" name="rws_countdown_enable_toggle" id="rws_countdown_enable_toggle">
				<label for="rws_countdown_enable_toggle"></label>
			</div>
		<?php echo ob_get_clean();
	}

	 /* Flash Sale Events
	 * 
	 * @since 1.0.0
	 * 
	 * @return void
	 */
	public function rws_flash_sale_events() {
		/**
		 * Fetch categories
		 */
		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = 0;
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty
		);
		$all_categories = get_categories( $args );
		/**
		 * Fetch products
		 */
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product',
			'post_status'    => 'publish'
		);
		$products = new WP_Query($args);
		ob_start();?>
			<div class="rws-add-sels-event-group">
				<div class="rws-event-flash-sale-wrapper">
					<?php do_action( 'rws_event_flash_sale_create_before_form' ); ?>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-group-label">
							<label for="rws_add_event_name"><?php echo esc_html__( 'Event Name', 'rika-woo-solutions' ); ?></label>
						</div>
						<div class="rws-group-input">
							<input class="rws-input-text" type="text" name="rws_add_event_name" id="rws_add_event_name" placeholder="<?php echo esc_attr__( 'Event Name', 'rika-woo-solutions' ); ?>">
						</div>
					</div>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-group-label">
							<label for="rws_add_event_from"><?php echo esc_html__( 'Valid From', 'rika-woo-solutions' ); ?></label>
						</div>
						<div class="rws-group-input">
							<input class="rws-input-text" type="date" name="rws_add_event_from" id="rws_add_event_from" >
							<span class="hint"><?php echo esc_html__( 'Please enter a valid date when flash sale campaign will start', 'rika-woo-solutions' ); ?></span>
						</div>
					</div>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-group-label">
							<label for="rws_add_event_to"><?php echo esc_html__( 'Valid To', 'rika-woo-solutions' ); ?></label>
						</div>
						<div class="rws-group-input">
							<input class="rws-input-text" type="date" name="rws_add_event_to" id="rws_add_event_to" >
							<span class="hint"><?php echo esc_html__( 'Please enter a valid date when flash sale campaign will end', 'rika-woo-solutions' ); ?></span>
						</div>
					</div>
					<div class="rws-event-flash-sale-group-single search_input_parent align-flex-column width-boxed-sm">
						<h4 class="rws-heading"><?php echo esc_html__( 'Select Categories', 'rika-woo-solutions' ); ?></h4>
						<input type="text" class="mb-10 mt-10 rws-input-text searchInput" placeholder="Search...">
						<?php if( !empty( $all_categories ) ) : ?>
						<select class="rws-input-text" name="select_category_for_onsale[]" id="select_category_for_onsale" multiple>
							<?php foreach( $all_categories as $index => $cat ) : ?>
								<option value="<?php echo esc_attr( $cat->term_id ); ?>"><?php echo esc_html( $cat->name ); ?></option>
							<?php endforeach; ?>
						</select>
						<?php endif; ?>
					</div>
					<?php if( $products->have_posts() ) : ?>
					<div class="rws-event-flash-sale-group-single search_input_parent align-flex-column width-boxed-sm">
						<h4 class="rws-heading"><?php echo esc_html__( 'Select Products', 'rika-woo-solutions' ); ?></h4>
						<input type="text" class="mb-10 mt-10 rws-input-text searchInput" placeholder="Search...">
						<select class="rws-input-text" name="select_product_for_onsale[]" id="select_product_for_onsale" multiple>
							<?php while( $products->have_posts() ) : $products->the_post(); ?>
								<option value="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<?php endif; ?>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-group-label">
							<label for="rws_event_discount_type"><?php echo esc_html__( 'Discount Type', 'rika-woo-solutions' ); ?></label>
						</div>
						<div class="rws-group-input">
							<select class="rws-input-text pt-0 pb-0" name="rws_event_discount_type" id="rws_event_discount_type">
								<option value="fixed-discount" ><?php echo esc_html__( 'Fixed Discount(percentage)', 'rika-woo-solutions' ); ?></option>
								<option value="percentage-discount" selected><?php echo esc_html__( 'Percentage Discount', 'rika-woo-solutions' ); ?></option>
								<option value="fixed-price"><?php echo esc_html__( 'Fixed Pice', 'rika-woo-solutions' ); ?></option>
							</select>
						</div>
					</div>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-group-label">
							<label for="rws_event_discount_value"><?php echo esc_html__( 'Discount Value', 'rika-woo-solutions' ); ?></label>
						</div>
						<div class="rws-group-input">
							<input class="rws-input-text" type="number" name="rws_event_discount_value" id="rws_event_discount_value" >
							<span class="hint"><?php echo esc_html__( 'Please enter your discount value', 'rika-woo-solutions' ); ?></span>
						</div>
					</div>
					<div class="rws-event-flash-sale-group-single">
						<div class="rws-switcher">
							<h4 class="rws-heading"><?php echo esc_html__( 'Show Countdown On Product Details Page', 'rika-woo-solutions' ); ?></h4>
							<input class="rws-input-text" type="checkbox" name="show_countdown_product_details" id="show_countdown_product_details">
							<label for="show_countdown_product_details" class="rws-has-switcher"></label>
						</div>
					</div>
					<button class="rws-btn rws-btn-sm" name="rws_create_flash_event" type="submit"><?php echo esc_html__( 'Create Event', 'rika-woo-solutions' ); ?></button>
					<?php do_action( 'rws_event_flash_sale_create_after_form' ); ?>
			</div>
		<?php echo ob_get_clean();
	}
}