<section class="main-sell">
    <div class="container">
        <header class="title-product">
            <h4><a href="#">پرفروشترین محصولات موبولند</a></h4>
        </header>

        <div class="box-sell">

            <?php

            global $product;
            $best_sell = new WP_Query(array(
                'post_type' => 'product',
                'posts_per_page' => 1,
                'no_found_rows' => true,
                'meta_key' =>  'total_sales',
                'orderby' => 'meta_value_num',
            ));
            if ($best_sell->have_posts()) {
            while ($best_sell->have_posts()) : $best_sell->the_post(); ?>

            <div class="best-sell">
                <div class="head-best-sell">
                    <div>
                        <i class="fa-solid fa-trophy"></i>
                        <p>پرفروش ترین محصول</p>
                    </div>
                    <span>رتبه 1</span>
                </div>
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

                <?php if ($product->is_in_stock() && $product->get_price_html() ) { ?>

                    <div class="price">

                        <?php echo $product->get_price_html(); ?>

                    </div>

                <?php }
                elseif (!$product->is_in_stock()){
                    echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                }else{
                    echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                } ?>


                <div class="add-cart">
                    <a href="<?php the_permalink(); ?>">
                        <i class="fa-solid fa-circle-plus"></i>
                    </a>
                </div>
            </div>

            <?php
            endwhile;
            }
            wp_reset_postdata();
            ?>




            <div class="other-sell">

                <?php

                global $product;
                $n = 1;
                $other_sell = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 9,
                    'no_found_rows' => true,
                    'meta_key' =>  'total_sales',
                    'orderby' => 'meta_value_num',
                    'offset' => 1,
                ));
                if ($other_sell->have_posts()) {
                while ($other_sell->have_posts()) : $other_sell->the_post(); ?>


                <div class="product-item">
                    <figure>

                        <a href="<?php the_permalink(); ?>"> <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                            }
                            ?><i class="fa-regular fa-eye"></i></a>
                    </figure>
                    <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h2>

                    <div class="down-product">
                        <span class="number">
                            <?php
                            $n = $n + 1 ;
                            echo $n;
                            ?>
                        </span>
                        <?php if ($product->is_in_stock() && $product->get_price_html() ) { ?>

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

    </div>
</section>