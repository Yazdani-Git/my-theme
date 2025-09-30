<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart"
          action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
          method="post" enctype='multipart/form-data'>
        <div class="p-q">


            <?php do_action('woocommerce_before_add_to_cart_button'); ?>

            <?php
            do_action('woocommerce_before_add_to_cart_quantity');

            // بررسی موجودی محصول
            $stock_quantity = $product->get_stock_quantity();

            // اگر موجودی 1 باشد، فیلد تعداد را نمایش ندهیم
            if ($stock_quantity == 1) {
                // پیام موجودی 1 به جای فیلد تعداد نمایش داده می‌شود
                echo '<p class="single-product-stock-message">موجودی این محصول فقط یک عدد است.<br> برای خرید این محصول کافیست بر روی دکمه افزودن به سبد خرید بزنید.</p>';
            } else {
                // در صورتی که موجودی بیشتر از 1 باشد، فیلد تعداد را نمایش می‌دهیم
                woocommerce_quantity_input(
                    array(
                        'min_value' => 1, // حداقل تعداد قابل خرید 1
                        'max_value' => $stock_quantity, // حداکثر تعداد مطابق موجودی
                        'input_value' => 1, // مقدار پیش‌فرض 1
                    )
                );
            }

            ?>

            <div class="single-price">
            <p class="<?php echo esc_attr(apply_filters('woocommerce_product_price_class', 'price')); ?>"><?php echo $product->get_price_html(); ?></p>
                <?php
                $discount = moboland_wooocmmerce_discount(get_the_ID());
                if ($discount > 0) {
                    echo '<div class="discount">%' . $discount . '</div>';
                }
                ?>
            </div>

        </div>

        <?php

        do_action('woocommerce_after_add_to_cart_quantity');
        ?>

        		<button type="submit" name="add-to-cart" value="
        <?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt
        <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> single-add-to-cart "><i class="fa-solid fa-bag-shopping"></i>
        <?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>
