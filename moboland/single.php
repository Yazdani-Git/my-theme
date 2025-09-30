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

            <?php while (have_posts()) : the_post(); ?>

                <article class="post-single">
                    <header>
                        <h1><?php the_title(); ?></h1>
                    </header>
                    <div class="box-pm">
                        <div class="post-meta">
                            <i class="fa-regular fa-clock"></i>
                            <span><?php the_time('d F Y'); ?></span>
                        </div>
                        <div class="post-meta">
                            <i class="fa-regular fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>
                        <div class="post-meta">
                            <i class="fa-regular fa-folder"></i>
                            <?php the_category(' , '); ?>
                        </div>
                    </div>
                    <figure>
                        <?php the_post_thumbnail(); ?>
                    </figure>
                    <div class="content-single">
                        <?php the_content(); ?>
                    </div>
                    <div class="post-tag">
                     <span>
                     <i class="fa-solid fa-tag"></i>
                     </span>
                        <?php the_tags(); ?>
                    </div>

                </article>
            <?php endwhile; ?>

            <?php if ($options['active_related_post']) { ?>
                <div class="post-single-related">
                    <div class="related-head">
                        <h4>مطالب مرتبط</h4>
                    </div>

                    <div class="owl-carousel owl-theme slider-articles-related">

                        <?php
                        global $post;

                        $related = get_posts(array(
                            'category__in' => wp_get_post_categories($post->ID),
                            'numberposts' => 5,
                            'post__not_in' => array($post->ID)
                        ));
                        if ($related) foreach ($related as $post) {
                            setup_postdata($post); ?>

                            <div class="item article-item-related">
                                <figure>
                                    <a href="<?php the_permalink(); ?>">   <?php
                                        if (has_post_thumbnail()) { ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                                            <?php
                                        } else {
                                            ?><img
                                            src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                        }
                                        ?></a>
                                    <div class="blog-tag">
                                        <?php the_category(); ?>
                                    </div>
                                    <i class="fa-regular fa-eye"></i>
                                </figure>
                                <h2><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h2>
                                <?php the_excerpt(); ?>
                                <div class="articles-detail">
                                    <span><?php the_time('d F Y'); ?></span>
                                    <span><?php the_author(); ?></span>
                                </div>
                            </div>
                        <?php }
                        wp_reset_postdata(); ?>

                    </div>

                </div>
            <?php } ?>

            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comment-box">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>

        </div>

        <?php if (is_active_sidebar('moboland_blog') && $options['sidebar_position_single'] != 'none') { ?>
            <aside class="side-single">
                <?php dynamic_sidebar('moboland_blog'); ?>
            </aside>
            <?php if ($options['sidebar_position_single'] == 'right') { ?>
                <style>
                    .hero-single {
                        flex-direction: row-reverse;
                    }
                </style>
            <?php } ?>
        <?php } else { ?>
            <style>
                .main-single {
                    width: 100% !important;
                }
            </style>
        <?php } ?>

    </section>
</div>

<?php get_footer(); ?>


