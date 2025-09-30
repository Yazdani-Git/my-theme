<?php
if (isset($_GET['reset-link-sent'])){
    get_template_part('woocommerce/myaccount/lost-password-confirmation');
}
elseif (isset($_GET['show-reset-form'])){
    get_template_part('woocommerce/myaccount/form-reset-password');
}
else{

?>

<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta <?php bloginfo('charset'); ?> >
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php wp_head(); ?>

    <script>
        var $ = jQuery;
    </script>

</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>

<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;
$options = get_option('options');
?>
<div class="back-register">
    <div class="login-page">
        <div class="form-login-moboland">

            <div class="logo">
                <?php if ($options['login_logo']['url']){ ?>
                    <a href="<?php echo get_home_url(); ?>"><img
                                src="<?php echo $options['login_logo']['url']; ?>"
                                alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                    <a href="<?php echo get_home_url(); ?>"><img
                                src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                alt="لوگوی اصلی وب سایت"></a>
                <?php } ?>
            </div>
            <?php
            do_action('woocommerce_before_lost_password_form');
            ?>

            <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                <p><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine ?>

                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">

                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login"
                           id="user_login" autocomplete="username" required aria-required="true" placeholder="کلمه کاربری یا ایمیل"/>
                </p>

                <div class="clear"></div>

                <?php do_action('woocommerce_lostpassword_form'); ?>

                <p class="woocommerce-form-row form-row">
                    <input type="hidden" name="wc_reset_password" value="true"/>
                    <button type="submit"
                            class="woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                            value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
                </p>

                <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

            </form>


            <?php
            do_action('woocommerce_after_lost_password_form');

            ?>
        </div>
    </div>
</div>
<?php

wp_footer(); ?>
</body>
</html>

<?php
}
?>

