<?php
    global $thepostid;
    $product_object_info = get_post_meta( $thepostid, 'rws_product_objects' );
    if( isset( $product_object_info ) && is_array( $product_object_info ) ) {
        $product_object_info = isset( $product_object_info[0] ) ? unserialize( $product_object_info[0] ): array();
    }
?>
<div id="rws_product_countdown" class="panel woocommerce_options_panel hidden">
    <div class="options-group">
        <?php
            do_action( 'rws_before_countdown_update_panel_before' );
            echo '<div class="options_group">';
            woocommerce_wp_checkbox(
                array(
                    'id'            => '_enable_single_product_countdown',
                    'value'         => isset(  $product_object_info['_enable_single_product_countdown'] ) ? sanitize_text_field( $product_object_info['_enable_single_product_countdown'] ):  'no',
                    'name'          => 'rws_product_meta[_enable_single_product_countdown]',
                    'wrapper_class' => '',
                    'label'         => __( 'Enable Countdown', 'rika-woo-solutions' ),
                    'description'   => __( 'Enable/Disable Countdown', 'rika-woo-solutions' ),
                )
            );
            echo '</div>';

            echo '<div class="options_group">';
            woocommerce_wp_text_input(
                array(
                    'id'            => "rws_product_single_countdown_discountd_product",
                    'name'          => 'rws_product_meta[rws_product_single_countdown_discountd_product]',
                    'value'         => isset( $product_object_info['rws_product_single_countdown_discountd_product'] ) ? absint( $product_object_info['rws_product_single_countdown_discountd_product'] ): '',
                    'label'         => __( 'discounted Product', 'rika-woo-solutions' ),
                    'data_type'     => 'decimal',
                    'desc_tip'      => true,
                    'description'   => __( 'Set how much product you want to discount.', 'rika-woo-solutions' ),
                    'wrapper_class' => '',
                    'placeholder'   => __( 'discounted Product', 'rika-woo-solutions' ),
                )
            );
            echo '</div>';

            echo '<div class="options_group">';
            woocommerce_wp_text_input(
                array(
                    'id'            => "rws_product_single_countdown_already_sold_count",
                    'name'          => 'rws_product_meta[rws_product_single_countdown_already_sold_count]',
                    'value'         => isset( $product_object_info['rws_product_single_countdown_already_sold_count'] ) ? absint( $product_object_info['rws_product_single_countdown_already_sold_count'] ): '',
                    'label'         => __( 'Already Sold Products', 'rika-woo-solutions' ),
                    'data_type'     => 'decimal',
                    'desc_tip'      => true,
                    'description'   => __( 'Insert number of product that already have been sold.', 'rika-woo-solutions' ),
                    'wrapper_class' => '',
                    'placeholder'   => __( 'Already Sold', 'rika-woo-solutions' ),
                )
            );
            echo '</div>';
            do_action( 'rws_before_countdown_update_panel_after' );
        ?>
    </div>
</div>