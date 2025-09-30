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