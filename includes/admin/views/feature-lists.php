<div class="wrap">
    <div class="rws-feature-list-boxes">
        <div class="rws-feature-list-items">
            <div class="rws-feature-list-item">
                <table class="wp-list-table widefat striped table-view-list">
                    <thead>
                        <tr>
                            <th><?php echo esc_attr__( 'Name', 'rika-woo-solutions' ); ?></th>
                            <th><?php echo esc_attr__( 'Description', 'rika-woo-solutions' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="rws-feature-list-toggle rws-feature-ajax-activate" for="rws-feature-countdown">
                                    <input <?php echo 1 === (int) get_option( 'rws_feature_active_countdown' ) ? esc_attr__('checked', 'rika-woo-solutions'): ''; ?> type="checkbox" name="rws_feature_active_countdown" id="rws-feature-countdown">
                                    <span><?php echo esc_html__( 'Countdown', 'rika-woo-solutions' ); ?></span>
                                </label>
                            </td>
                            <td>
                                <p><?php echo esc_html__( 'You can set your own coutndown functionality.', 'rika-woo-solutions' ); ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>