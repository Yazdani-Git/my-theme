<?php get_header(); ?>

<div class="page-not-found">
    <div class="container">
        <div class="btn404">
            <p>اوپس مسیر رو اشتباه اومدی!! اینجا خبری نیست!!</p>
            <a href="<?php echo get_home_url(); ?>" class="button">صفحه اصلی</a>
            <a href="<?php echo get_home_url() . '/shop'; ?>" class="button">صفحه فروشگاه</a>
        </div>
        <div class="wrapper">
            <img src="<?php echo get_template_directory_uri() . '/img/404-gif.gif' ?>" alt="">
        </div>
    </div>
</div>

<?php get_footer(); ?>
