<?php get_header(); ?>

<div class="container">
    <section class="hero-single">
        <div class="main-single">
            <div class="title-archive">
                <?php echo get_the_archive_title(); ?>
            </div>

            <div class="main-archive">
                <?php while (have_posts()) : the_post(); ?>

                    <div class="archive-item">
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
                        <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h2>
                        <?php the_excerpt(); ?>
                        <div class="articles-detail">
                            <span><?php the_time('d F Y'); ?></span>
                            <span><?php the_author(); ?></span>
                        </div>
                    </div>

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
