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
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="back-register">
    <div class="login-page">
        <div class="form-login-moboland">

            <div class="logo">
                <a href="<?php echo get_home_url(); ?>"><img
                            src="<?php echo get_template_directory_uri() . '/img/logo-web.webp' ?>"
                            alt="لوگوی اصلی وب سایت"></a>
            </div>
            <?php

wc_print_notice( esc_html__( 'Password reset email has been sent.', 'woocommerce' ) );
?>

<?php do_action( 'woocommerce_before_lost_password_confirmation_message' ); ?>

<p><?php echo esc_html( apply_filters( 'woocommerce_lost_password_confirmation_message', esc_html__( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ) ); ?></p>

<?php do_action( 'woocommerce_after_lost_password_confirmation_message' );
?>
        </div>
    </div>
</div>
<?php

wp_footer(); ?>
</body>
</html>
