<section class="single-cat">
    <div class="container">
        <header class="title-single-cat">
            <h4><a href="#">جدیترین موبایل ها</a></h4>
            <div class="show-all">
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                    مشاهده همه
                </a>
            </div>
        </header>
        <div class="single-cat-ch">
            <div class="single-cat-right">

                <?php

                global $product;
                $new_product = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'no_found_rows' => true,
                ));
                if ($new_product->have_posts()) {
                while ($new_product->have_posts()) : $new_product->the_post(); ?>

                <div class="item single-cat-item">
                    <div class="single-cat-item-img">
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                }
                                ?>
                            </a>
                            <i class="fa-regular fa-eye"></i>
                        </figure>
                    </div>
                    <div class="single-cat-item-detail">
                        <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h2>
                        <div class="price">

                            <?php echo $product->get_price_html(); ?>

                        </div>
                    </div>
                </div>

                <?php
                endwhile;
                }
                wp_reset_postdata();
                ?>

            </div>
            <div class="single-cat-left">
                <figure>
                    <img src="<?php echo get_template_directory_uri() . '/img/mobile-banner.webp' ?>" alt="">
                </figure>
            </div>
        </div>
    </div>
</section>