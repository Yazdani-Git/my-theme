<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;


global $product;
$options = get_option('options');

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="product-intro">
        <div class="summary entry-summary">

            <header>
                <h1><?php the_title(); ?></h1>
                <span><?php the_field('sub_name_product'); ?></span>
            </header>
            <?php if ($options['active_excerpt_content']) { ?>
                <?php woocommerce_template_single_excerpt(); ?>

            <?php } ?>
            <div class="show-rating"><?php woocommerce_template_single_rating(); ?></div>

            <?php if ($options['active_attr']) { ?>
                <?php do_action('woocommerce_product_additional_information', $product); ?>
            <?php } ?>
            <?php woocommerce_template_single_add_to_cart(); ?>


            <div class="product-delivery">
                <?php if (get_field('send_product')) { ?>
                    <span><i class="fa-solid fa-circle-dot"></i><?php the_field('send_product'); ?></span>
                <?php } ?>
                <?php if (get_field('post_product')) { ?>
                    <span><i class="fa-solid fa-circle-dot"></i><?php the_field('post_product'); ?></span>
                <?php } ?>
            </div>

            <div class="product-meta">
                <div>
                    <?php
                    $brands = get_the_terms(get_the_ID(), 'product_brand');
                    if ($brands && $options['active_brand']) { ?>
                        <div class="meta-pro">
                            <img src="<?php echo get_template_directory_uri() . '/img/brand-image.png' ?>" alt="">
                            <span>برند : </span>
                            <a href="<?php echo get_term_link($brands[0]->term_id) ?>"
                               target="_blank"><?php echo $brands[0]->name; ?></a>
                        </div>

                        <?php
                    }
                    ?>
                    <div class="meta-pro">
                        <?php $stock = $product->get_stock_status();
                        if ($options['active_stock']) {
                            if ($stock == 'instock') { ?>
                                <i class="fa-solid fa-circle-check"></i>
                                <span>موجود در انبار </span>
                            <?php } else { ?>
                                <i class="fa-solid fa-xmark" style="color: #E2324E!important;"></i>
                                <span>در انبار موجود نمی باشد!</span>
                            <?php }
                        }
                        ?>

                    </div>
                </div>
                <div>
                    <?php if ($options['active_category']) { ?>
                        <div class="meta-pro">
                            <img src="<?php echo get_template_directory_uri() . '/img/category.png' ?>" alt="">
                            <span>دسته : </span>
                            <?php
                            $cat = get_the_terms($product->id, 'product_cat');
                            ?>
                            <a href="<?php echo get_term_link($cat[0]->term_id); ?>"
                               target="_blank"><?php echo $cat[0]->name; ?></a>
                        </div>
                    <?php } ?>
                    <?php if (get_field('guaranty')) { ?>
                        <div class="meta-pro">
                            <img src="<?php echo get_template_directory_uri() . '/img/guarantee.png' ?>" alt="">
                            <span><?php the_field('guaranty'); ?></span>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             * @hooked WC_Structured_Data::generate_product_data() - 60
             */
            // do_action('woocommerce_single_product_summary');
            ?>
        </div>
        <?php
        /**
         * Hook: woocommerce_before_single_product_summary.
         *
         * @hooked woocommerce_show_product_sale_flash - 10
         * @hooked woocommerce_show_product_images - 20
         */
        do_action('woocommerce_before_single_product_summary');
        ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
    <?php if ($options['active_related_product']) { ?>
    <?php echo do_shortcode('[related_products]'); ?>
    <?php } ?>
</div>

<?php do_action('woocommerce_after_single_product'); ?>
