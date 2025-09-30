<section class="main-product">
    <div class="container">
        <header class="title-product">
            <h4><a href="#">جدیدترین محصولات موبولند</a></h4>
            <div class="show-all">
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                    مشاهده همه
                </a>
            </div>
        </header>
        <div class="owl-carousel owl-theme slider-product">

            <?php

            global $product;
            $new_product = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => 6,
                'no_found_rows' => true,
            ));
            if ($new_product->have_posts()) {
                while ($new_product->have_posts()) : $new_product->the_post(); ?>

                    <div class="item product-item">
                        <figure>
                            <a href="<?php the_permalink(); ?>"> <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                }
                                ?></a>
                        </figure>
                        <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h2>
                        <div class="color-dis">

                            <?php
                            global $product;

                            $attr_taxonomy = wc_get_attribute_taxonomies();
                            foreach ($attr_taxonomy as $item) {
                                $attr_name = $item->attribute_name;
                                $terms = get_the_terms($product->id, 'pa_' . $attr_name);
                                if (is_array($terms)) { ?>
                                    <div class="color-attr">
                                        <ul>
                                            <?php
                                            foreach ($terms as $term) {

                                                $tooltip = $term->name;
                                                $colors = get_term_meta($term->term_id, 'product_attribute_color', 1);
                                                ?>
                                                <?php if ($colors) { ?>
                                                    <li>
                                                        <span style="background: <?php echo $colors; ?>"><b><?php echo $tooltip; ?></b></span>
                                                    </li>
                                                <?php } ?>

                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            }

                            ?>


                            <?php
                            $discount = moboland_wooocmmerce_discount(get_the_ID());
                            if ($product->is_on_sale() && $discount > 0) { ?>
                                <div class="discount">
                                    <?php echo '%' . $discount; ?>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="down-product">

                            <?php if ($product->is_in_stock() && $product->get_price_html() ) { ?>

                                <div class="addtocart-button">
                                    <?php
                                    global $product;
                                    echo sprintf('<a href="%s" data-quantity="1" class="%s" %s><i class="fa-solid fa-circle-plus"></i></a>',
                                        esc_url($product->add_to_cart_url()),
                                        esc_attr(implode(' ', array_filter(array(
                                            'button', 'product_type_' . $product->get_type(),
                                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                            $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                        )))),
                                        wc_implode_html_attributes(array(
                                            'data-product_id' => $product->get_id(),
                                            'data-product_sku' => $product->get_sku(),
                                            'aria-label' => $product->add_to_cart_description(),
                                            'rel' => 'nofollow',
                                        )),
                                        esc_html($product->add_to_cart_text())
                                    );
                                    ?>
                                </div>
                                <div class="price">

                                    <?php echo $product->get_price_html(); ?>

                                </div>

                            <?php }
                            elseif (!$product->is_in_stock()){
                            echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                             }else{
                                echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                            } ?>


                        </div>
                    </div>

                <?php
                endwhile;
            }
            wp_reset_postdata();
            ?>

        </div>
    </div>
</section>