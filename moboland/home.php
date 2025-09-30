<?php get_header(); ?>

<div class="container">
    <section class="hero-single">
        <div class="main-single">
            <div class="title-archive">
                <h1>وبلاگ</h1>
            </div>

            <?php if ( have_posts() ) : ?>
                <div class="main-archive">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part('template/content', 'blog'); ?>
                    <?php endwhile; ?>
                </div>

                <div class="pagination">
                    <?php echo paginate_links(array(
                        'next_text' => 'بعدی',
                        'prev_text' => 'قبلی',
                    )); ?>
                </div>

            <?php else : ?>
                <p>هیچ نوشته‌ای پیدا نشد.</p>
            <?php endif; ?>
        </div>

        <?php if (is_active_sidebar('moboland_blog')) { ?>
            <aside class="side-single">
                <?php dynamic_sidebar('moboland_blog'); ?>
            </aside>
        <?php } ?>


    </section>
</div>

<?php get_footer(); ?>
