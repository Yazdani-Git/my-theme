<?php
if (is_lost_password_page()){
    get_template_part('woocommerce/myaccount/form-lost-password');
}
elseif (is_account_page() && !is_user_logged_in()){
    get_template_part('woocommerce/myaccount/form-login');
}else{

?>

<?php get_header(); ?>

<?php
if (is_cart() || is_checkout() || is_account_page()){ ?>

    <div class="container"> <?php
        the_content();
   ?> </div>
    <?php
} else {

?>

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
        <div class="main-single-page">
            <?php while (have_posts()) : the_post(); ?>
            <article class="post-single">
                <header>
                    <h1><?php the_title(); ?></h1>
                </header>
                <div class="content-single">
                    <?php the_content(); ?>
                </div>

            </article>
            <?php endwhile; ?>

        </div>
    </section>
</div>

<?php } ?>
<?php get_footer(); } ?>
