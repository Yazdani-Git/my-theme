<?php get_header(); ?>

    <div class="moboland-breadcrumb">
        <div class="container">
            <?php
            if (function_exists('moboland_breadcrumb')) {
                echo moboland_breadcrumb();
            }
            ?>
        </div>
    </div>

    <div class="container">
        <section class="hero-single">
            <div class="main-single">
                <div class="title-archive"> جستجو شده برای : <span><?php the_search_query(); ?></span></div>
                <div class="main-archive">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php
                        if ('product' === get_post_type()) {
                            global $product;
                            $product = wc_get_product(get_the_ID());
                            if ($product) {
                                ?>
                                <div class="product-item">
                                    <figure>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                $attachment_ids = $product->get_gallery_image_ids();
                                                $second_image = !empty($attachment_ids) ? wp_get_attachment_image_url($attachment_ids[0], 'full') : $main_image;
                                                ?>
                                                <img class="product-image-main" src="<?php echo esc_url($main_image); ?>" alt="<?php the_title(); ?>">
                                                <img class="product-image-hover" src="<?php echo esc_url($second_image); ?>" alt="<?php the_title(); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>" alt="No Image">
                                            <?php } ?>
                                        </a>
                                    </figure>
                                    <h2><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2>
                                    <div class="down-product">
                                        <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>
                                            <div class="addtocart-button">
                                                <?php
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
                                        <?php } elseif (!$product->is_in_stock()) { ?>
                                            <div class="not-stock"><i class="fa-solid fa-multiply"></i>محصول موجود نمی باشد!</div>
                                        <?php } else { ?>
                                            <div class="call-us"><i class="fa-solid fa-phone-flip"></i>تماس بگیرید</div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    <?php endwhile; ?>

                </div>

                <div class="pagination">
                    <?php echo paginate_links(array(
                        'next_text' => 'بعدی',
                        'prev_text' => 'قبلی',
                    )); ?>
                </div>


            </div>

            <?php if (is_active_sidebar('moboland_blog')) { ?>
                <aside class="side-single">
                    <?php dynamic_sidebar('moboland_blog'); ?>
                </aside>
            <?php } ?>

        </section>
    </div>
<?php get_footer(); ?>