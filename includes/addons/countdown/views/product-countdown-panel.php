<?php
    global $thepostid;
    $product_object_info = get_post_meta( $thepostid, 'rws_product_objects' );
    if( isset( $product_object_info ) && is_array( $product_object_info ) ) {
        $product_object_info = isset( $product_object_info[0] ) ? unserialize( $product_object_info[0] ): array();
    }
    error_log( print_r( $product_object_info, true ) );
?>
<div id="rws_product_countdown" class="panel woocommerce_options_panel hidden">
    <div class="options-group">
        <?php
            do_action( 'rws_before_countdown_product_panel_checkbox' );
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
            do_action( 'rws_after_countdown_product_panel_checkbox' );
            do_action( 'rws_before_countdown_product_panel_date_from' );
            echo '<div class="options_group">';
            woocommerce_wp_text_input(
                array(
                    'id'                => 'rws_product_single_countdown_from',
                    'value'             => isset( $product_object_info['rws_product_single_countdown_from'] ) ? sanitize_text_field( $product_object_info['rws_product_single_countdown_from'] ): '',
                    'name'              => 'rws_product_meta[rws_product_single_countdown_from]',
                    'label'             => __( 'From', 'rika-woo-solutions' ),
                    'placeholder'       => 'YYYY-MM-DD',
                    'description'       => __( 'Select date from when it will start coutdown.', 'rika-woo-solutions' ),
                    'desc_tip'          => true,
                    'class'             => 'date-picker',
                    'custom_attributes' => array(
                        'pattern'       => apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ),
                    ),
                )
            );
            echo '</div>';
            do_action( 'rws_after_countdown_product_panel_date_from' );
            do_action( 'rws_before_countdown_product_panel_date_to' );
            echo '<div class="options_group">';
            woocommerce_wp_text_input(
                array(
                    'id'                => 'rws_product_single_countdown_to',
                    'value'             => isset( $product_object_info['rws_product_single_countdown_to'] ) ? sanitize_text_field( $product_object_info['rws_product_single_countdown_to'] ): '',
                    'name'              => 'rws_product_meta[rws_product_single_countdown_to]',
                    'label'             => __( 'To', 'rika-woo-solutions' ),
                    'placeholder'       => 'YYYY-MM-DD',
                    'description'       => __( 'Select date to when it will end coutdown.', 'rika-woo-solutions' ),
                    'desc_tip'          => true,
                    'class'             => 'date-picker',
                    'custom_attributes' => array(
                        'pattern'       => apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ),
                    ),
                )
            );
            echo '</div>';
            do_action( 'rws_after_countdown_product_panel_date_to' );
            do_action( 'rws_before_countdown_product_panel_discountd_product' );
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
            do_action( 'rws_after_countdown_product_panel_discountd_product' );
            do_action( 'rws_before_countdown_product_panel_already_sold' );
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
            do_action( 'rws_after_countdown_product_panel_already_sold' );
        ?>
    </div>
</div>