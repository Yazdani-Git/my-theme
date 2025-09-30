<section class="home-articles">
    <div class="container">
        <header class="title-articles">
            <h4><a href="#">وبلاگ</a></h4>
            <div class="show-all">
                <a href="#">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                    مشاهده همه
                </a>
            </div>
        </header>
        <div class="owl-carousel owl-theme slider-articles">

            <?php
            $small_post = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 6,
                'no_found_rows' => true,
            ));
            if ($small_post->have_posts()) {
                while ($small_post->have_posts()) : $small_post->the_post(); ?>
                    <div class="item article-item">
                        <figure>
                            <a href="<?php the_permalink(); ?>"> <?php
                                if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } else {
                                    ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                }
                                ?></a>
                            <div class="blog-tag">
                                <?php the_category(); ?>
                            </div>
                            <i class="fa-regular fa-eye"></i>
                        </figure>
                        <h2><a href="<?php the_permalink(); ?>" target="_blank">  <?php the_title(); ?> </a></h2>

                            <?php the_excerpt(); ?>

                        <div class="articles-detail">
                            <span><?php the_time('d F Y'); ?></span>
                            <span><?php the_author(); ?></span>
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