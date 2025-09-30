<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table">
    <div class="cart-left-box">
        <div class="cart-subtotal">
            <span><?php esc_html_e('کل سبد خرید', 'woocommerce'); ?></span>
            <span data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>"><?php wc_cart_totals_subtotal_html(); ?></span>
        </div>


        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
            <div class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                <span><?php wc_cart_totals_coupon_label($coupon); ?></span>
                <span><?php wc_cart_totals_coupon_html($coupon); ?></span>
            </div>
        <?php endforeach; ?>

        <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

            <?php do_action('woocommerce_review_order_before_shipping'); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action('woocommerce_review_order_after_shipping'); ?>

        <?php endif; ?>

        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
            <div class="fee">
                <span><?php echo esc_html($fee->name); ?></span>
                <span><?php wc_cart_totals_fee_html($fee); ?></span>
            </div>
        <?php endforeach; ?>

        <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
            <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                    <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                        <span><?php echo esc_html($tax->label); ?></span>
                        <span><?php echo wp_kses_post($tax->formatted_amount); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="tax-total">
                    <span><?php echo esc_html(WC()->countries->tax_or_vat()); ?></span>
                    <span><?php wc_cart_totals_taxes_total_html(); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <div class="order-total">
            <span><?php esc_html_e('مبلغ نهایی', 'woocommerce'); ?></span>
            <span><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <?php do_action('woocommerce_review_order_after_order_total'); ?>

    </div>
</div>
