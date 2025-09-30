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
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
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

            do_action('woocommerce_before_reset_password_form');
            ?>

            <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                <p><?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine ?>

                <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">

                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                           name="password_1" id="password_1" autocomplete="new-password" required aria-required="true" placeholder="گذرواژه جدید"/>
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">

                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                           name="password_2" id="password_2" autocomplete="new-password" required aria-required="true" placeholder="تکرار گذرواژه جدید"/>
                </p>

                <input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>"/>
                <input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>"/>

                <div class="clear"></div>

                <?php do_action('woocommerce_resetpassword_form'); ?>

                <p class="woocommerce-form-row form-row">
                    <input type="hidden" name="wc_reset_password" value="true"/>
                    <button type="submit"
                            class="woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                            value="<?php esc_attr_e('Save', 'woocommerce'); ?>"><?php esc_html_e('Save', 'woocommerce'); ?></button>
                </p>

                <?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

            </form>
            <?php
            do_action('woocommerce_after_reset_password_form');
            ?>
        </div>
    </div>
</div>
<?php

wp_footer(); ?>
</body>
</html>


