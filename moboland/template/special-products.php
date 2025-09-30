<section class="main-special">
    <div class="container">
        <h4 class="main-special-title">محصولات ویژه</h4>
    </div>

    <div class="container ch-main-special">


        <div class="box-banner-special">
            <a href="#"><img src="<?php echo get_template_directory_uri() . '/img/banner-v.png' ?>" alt=""></a>
        </div>
        <div class="special-box">
            <div class="owl-carousel owl-theme special-slider">

                <?php

                global $product;
                $new_product = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'no_found_rows' => true,
                    'post__in' => array(128 , 144 , 153),

                ));
                if ($new_product->have_posts()) {
                while ($new_product->have_posts()) : $new_product->the_post(); ?>

                <div class="item special-item" data-dot="<button><div class='list-slider-special'>
                        <figure><img src='<?php echo get_the_post_thumbnail_url(); ?>' alt=''></figure>
                     </div></button>">

                    <?php
                    $discount = moboland_wooocmmerce_discount(get_the_ID());
                    if ($product->is_on_sale() && $discount > 0) { ?>
                    <div class="discount-special">
                        <b><?php echo '%' . $discount; ?></b>
                        <span>تخفیف ویژه</span>
                    </div>
                    <?php } ?>

                    <figure>
                        <a href="<?php the_permalink(); ?>"> <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                            }
                            ?></a>
                    </figure>

                    <div class="detail-special">
                        <h2>
                            <a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a>
                        </h2>
                        <?php do_action('woocommerce_product_additional_information', $product); ?>
                        <div class="down-special">
                            <a href="<?php the_permalink(); ?>" target="_blank">مشاهده محصول</a>
                            <div class="price">
                                <?php echo $product->get_price_html(); ?>
                            </div>

                            <?php include get_template_directory() .  '/template/timer.php'; ?>


                        </div>
                    </div>

                </div>

                <?php
                endwhile;
                }
                wp_reset_postdata();
                ?>


            </div>
        </div>
    </div>
</section>