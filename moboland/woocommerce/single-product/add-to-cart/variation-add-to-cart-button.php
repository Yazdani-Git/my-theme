<?php
/**
 * Single variation cart button
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
    <div class="p-q">
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <?php
        do_action('woocommerce_before_add_to_cart_quantity');

        woocommerce_quantity_input(
            array(
                'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
            )
        );

        do_action('woocommerce_after_add_to_cart_quantity');

        ?>
          <div class="single-price">

            <?php
            $variations = $product->get_children();
            $variation_count = count( $variations );

            $all_prices_same = true;
            $first_price = $product->get_variation_price('regular', true);

            foreach ($variations as $variation_id) {
                $variation = wc_get_product($variation_id);
                if ($variation->get_price() !== $first_price) {
                    $all_prices_same = false;
                    break;
                }
            }

            if ($variation_count == 1 || $all_prices_same) {
                
                ?>
                <span class="price"><?php echo $product->get_price_html(); ?></span>
                <?php
            } else {
                woocommerce_single_variation();
            }
            ?>
        </div>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>

        <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>"/>
        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>"/>
        <input type="hidden" name="variation_id" class="variation_id" value="0"/>
    </div>
    <button type="submit"
            class="single_add_to_cart_button button alt
        <?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> single-add-to-cart "><i class="fa-solid fa-bag-shopping"></i>
        <?php echo esc_html($product->single_add_to_cart_text()); ?></button>
</div>
