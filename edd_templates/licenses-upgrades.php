<?php
if ( ! is_user_logged_in() ) {
    return;
}
$payment_id  = absint( $_GET['payment_id'] );
$license_id  = absint( $_GET['license_id'] );
$download_id = absint( edd_software_licensing()->get_download_id( $license_id ) );
$upgrades    = edd_sl_get_license_upgrades( $license_id );
$user_id     = edd_software_licensing()->get_user_id( $license_id );
if ( ! current_user_can( 'manage_licenses' ) && $user_id != get_current_user_id() ) {
    return;
}
$color = edd_get_option( 'checkout_color', 'gray' );
$color = ( $color == 'inherit' ) ? '' : $color;

$is_lifetime_license = (int) edd_software_licensing()->is_lifetime_license( $license_id );
// upgrade possible for this specific plan
$upgrade_possible    = 0;
?>
<div class="table-responsive tab_table_content">
    <p><a href="<?php echo esc_url( remove_query_arg( array( 'action', 'payment_id', 'view', 'license_id', 'edd_sl_error', '_wpnonce' ) ) ); ?>" class="edd-manage-license-back edd-submit button <?php echo esc_attr( $color ); ?> back_button site_cta"><?php _e( 'Go back', 'edd_sl' ); ?></a></p>
    <?php edd_sl_show_errors(); ?>
    <table id="edd_sl_license_upgrades" class="edd_sl_table edd-table table">
        <thead>
        <tr class="edd_sl_license_row">
            <?php do_action( 'edd_sl_license_upgrades_header_before' ); ?>
            <th class="edd_sl_url"><?php _e( 'Plugins', 'abcd' ) ?></th>
            <th class="edd_sl_actions"><?php _e( 'Upgrade Cost', 'abcd' ); ?></th>
            <th class="edd_sl_actions"><?php _e( 'Actions', 'abcd' ); ?></th>
            <?php do_action( 'edd_sl_license_upgrades_header_after' ); ?>
        </tr>
        </thead>
        <tbody>
        <?php if ( $upgrades ) : ?>
            <?php foreach ( $upgrades as $upgrade_id => $upgrade ) : ?>
                <?php if ( isset( $upgrade['price_id'] ) && edd_has_variable_prices( $upgrade['download_id'] ) ) : ?>
                    <?php if ( method_exists( edd_software_licensing(), 'get_price_is_lifetime' ) && $is_lifetime_license == (int) edd_software_licensing()->get_price_is_lifetime( $upgrade['download_id'], $upgrade['price_id'] ) ) :
                        $upgrade_possible = 1;
                        ?>
                        <tr class="edd_sl_license_row">
                            <?php do_action( 'edd_sl_license_upgrades_row_start', $license_id ); ?>
                            <td>
                                <div class="plugin_info">
                                    <div class="plugin_img">
                                        <?php
                                        $icons    = get_field( 'icons', $upgrade['download_id'] );
                                        $icon_url = $icons['url'];
                                        ?>
                                        <img src="<?php echo $icon_url ? $icon_url : get_template_directory_uri() . '/assets/img/plugin.png' ?>" alt="plugin thumbnail" class="plugin_small_icon">
                                    </div>
                                    <!-- /.plugin_img -->
                                    <div class="plugin_details">
                                        <h4><?php echo get_the_title( $upgrade['download_id'] ); ?></h4>
                                        <?php if ( isset( $upgrade['price_id'] ) && edd_has_variable_prices( $upgrade['download_id'] ) ) :
                                            if ( method_exists( edd_software_licensing(), 'get_price_is_lifetime' ) && edd_software_licensing()->get_price_is_lifetime( $upgrade['download_id'], $upgrade['price_id'] ) ) :
                                                $lifetime = __( 'Lifetime', 'abcd' );
                                            else:
                                                $lifetime = __( 'Yearly', 'abcd' );
                                            endif; ?>
                                            <p><?php echo edd_get_price_option_name( $upgrade['download_id'], $upgrade['price_id'] ) . ' / ' . $lifetime; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- /.plugin_details -->
                                </div>
                                <!-- /.plugin_info -->
                            </td>
                            <td><span class="edd-currency-code"><?php echo edd_currency_symbol() ?></span><?php echo edd_sanitize_amount( edd_sl_get_license_upgrade_cost( $license_id, $upgrade_id ) ); ?></td>
                            <td>
                                <div class="table_action">
                                    <a href="<?php echo esc_url( edd_sl_get_license_upgrade_url( $license_id, $upgrade_id ) ); ?>" title="<?php esc_attr_e( 'Upgrade License', 'abcd' ); ?>" class="site_cta"><?php _e( 'Upgrade', 'abcd' ); ?></a>
                                </div>
                                <!-- /.table_action -->
                            </td>
                            <?php do_action( 'edd_sl_license_upgrades_row_end', $license_id ); ?>
                        </tr>
                    <?php endif; endif; endforeach; ?>
                    <?php
                        // check if upgrade available for this plan. If it is either yearly or lifetime
                        if(!$upgrade_possible):?>
                        <tr class="edd_sl_license_row">
                            <?php do_action( 'edd_sl_license_upgrades_row_start', $license_id ); ?>
                            <td colspan="3"><?php _e( 'No upgrades available for this license', 'abcd' ); ?></td>
                            <?php do_action( 'edd_sl_license_upgrades_row_end', $license_id ); ?>
                        </tr>
                    <?php endif;?>
        <?php else: ?>
            <tr class="edd_sl_license_row">
                <?php do_action( 'edd_sl_license_upgrades_row_start', $license_id ); ?>
                <td colspan="3"><?php _e( 'No upgrades available for this license', 'abcd' ); ?></td>
                <?php do_action( 'edd_sl_license_upgrades_row_end', $license_id ); ?>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
