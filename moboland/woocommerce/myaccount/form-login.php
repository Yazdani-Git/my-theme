<?php
global $options;
$options = get_option('options');
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
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$options = get_option('options');

do_action('woocommerce_before_customer_login_form'); ?>

<div class="back-register">
    <div class="login-page">

        <?php if ($options['login_with_mobile'] == 'woocommerce') { ?>
            <div class="form-login-moboland">

                <div class="logo">
                    <?php if ($options['login_logo']['url']) { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo $options['login_logo']['url']; ?>"
                                    alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                    alt="لوگوی اصلی وب سایت"></a>
                    <?php } ?>
                </div>


                <form method="post"
                      class="woocommerce-form woocommerce-form-register register register-form" <?php do_action('woocommerce_register_form_tag'); ?> >

                    <?php do_action('woocommerce_register_form_start'); ?>

                    <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="username"
                                   id="reg_username" autocomplete="username"
                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"
                                   required aria-required="true"
                                   placeholder="نام کاربری"/><?php // @codingStandardsIgnoreLine ?>
                        </p>

                    <?php endif; ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
                               id="reg_email" autocomplete="email"
                               value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>"
                               required aria-required="true"
                               placeholder="آدرس ایمیل"/><?php // @codingStandardsIgnoreLine ?>
                    </p>

                    <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="password"
                                   id="reg_password" autocomplete="new-password" required aria-required="true"
                                   placeholder="رمز عبور"/>
                        </p>

                    <?php else : ?>

                        <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>

                    <?php endif; ?>

                    <?php do_action('woocommerce_register_form'); ?>

                    <p class="woocommerce-form-row form-row">
                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <button type="submit"
                                class="woocommerce-Button woocommerce-button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> woocommerce-form-register__submit"
                                name="register"
                                value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                    </p>

                    <?php do_action('woocommerce_register_form_end'); ?>
                    <p class="message">حساب کاربری دارید؟ <a href="#">وارد شوید</a></p>
                </form>

                <form class="woocommerce-form woocommerce-form-login login login-form" method="post">

                    <?php do_action('woocommerce_login_form_start'); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                               id="username" autocomplete="username"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>"
                               required aria-required="true"
                               placeholder="آدرس ایمیل"/><?php // @codingStandardsIgnoreLine ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">

                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                               name="password"
                               id="password" autocomplete="current-password" required aria-required="true"
                               placeholder="رمز عبور"/>
                    </p>

                    <?php do_action('woocommerce_login_form'); ?>

                    <p class="form-row">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                   type="checkbox" id="rememberme" value="forever"/>
                            <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                        </label>
                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <button type="submit"
                                class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                                name="login"
                                value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
                    </p>
                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
                    </p>

                    <?php do_action('woocommerce_login_form_end'); ?>
                    <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                        <p class="message">کاربر جدید هستید؟ <a href="#">ثبت نام</a></p>
                    <?php endif; ?>

                </form>


            </div>
        <?php } elseif ($options['login_with_mobile'] == 'smsir') { ?>

            <div class="form-login-moboland">
                <div class="logo">
                    <?php if ($options['login_logo']['url']) { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo $options['login_logo']['url']; ?>"
                                    alt="لوگوی اصلی وب سایت"></a>
                    <?php } else { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                    alt="لوگوی اصلی وب سایت"></a>
                    <?php } ?>
                </div>

                <div id="mobile-login-form">
                    <!-- فرم دریافت شماره موبایل -->
                    <form id="send-otp-form" method="post">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="mobile" id="mobile" required aria-required="true"
                                   placeholder="شماره موبایل را وارد کنید">
                        </p>
                        <button type="button" id="send-otp-btn" class="woocommerce-button button">
                            دریافت کد تأیید
                        </button>
                        <p id="otp-sent-message" style="display: none; color: green;">کد تأیید ارسال شد</p>
                    </form>

                    <!-- فرم وارد کردن کد تایید -->
                    <form id="verify-otp-form" method="post" style="display: none;">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="otp_code" id="otp_code" required aria-required="true"
                                   placeholder="کد تأیید را وارد کنید">
                        </p>
                        <button type="button" id="verify-otp-btn" class="woocommerce-button button">
                            تأیید و ورود
                        </button>
                        <p id="timer-message" style="color: red;">ارسال مجدد کد تا <span id="countdown">60</span> ثانیه
                            دیگر
                        </p>
                        <button type="button" id="resend-otp-btn" class="woocommerce-button button"
                                style="display: none;">ارسال مجدد کد
                        </button>
                    </form>
                </div>

            </div>


        <?php } elseif ($options['login_with_mobile'] == 'mellipayamak') { ?>

            <div class="form-login-moboland">
                <div class="logo">
                    <?php if ($options['login_logo']['url']) { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo $options['login_logo']['url']; ?>"
                                    alt="لوگوی اصلی وب سایت"></a>
                    <?php } else { ?>
                        <a href="<?php echo get_home_url(); ?>"><img
                                    src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                    alt="لوگوی اصلی وب سایت"></a>
                    <?php } ?>
                </div>

                <div id="mobile-login-form_mellipayamak">
                    <!-- فرم دریافت شماره موبایل -->
                    <form id="send-otp-form_mellipayamak" method="post">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="mobile" id="mobile_mellipayamak" required aria-required="true"
                                   placeholder="شماره موبایل را وارد کنید">
                        </p>
                        <button type="button" id="send-otp-btn_mellipayamak" class="woocommerce-button button">
                            دریافت کد تأیید
                        </button>
                        <p id="otp-sent-message_mellipayamak" style="display: none; color: green;">کد تأیید ارسال شد</p>
                    </form>

                    <!-- فرم وارد کردن کد تایید -->
                    <form id="verify-otp-form_mellipayamak" method="post" style="display: none;">
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="otp_code" id="otp_code_mellipayamak" required aria-required="true"
                                   placeholder="کد تأیید را وارد کنید">
                        </p>
                        <button type="button" id="verify-otp-btn_mellipayamak" class="woocommerce-button button">
                            تأیید و ورود
                        </button>
                        <p id="timer-message" style="color: red;">ارسال مجدد کد تا <span id="countdown">60</span> ثانیه
                            دیگر</p>
                        <button type="button" id="resend-otp-btn_mellipayamak" class="woocommerce-button button"
                                style="display: none;">ارسال مجدد کد
                        </button>
                    </form>
                </div>

            </div>


        <?php } ?>

    </div>
</div>


<?php do_action('woocommerce_after_customer_login_form'); ?>

<?php wp_footer(); ?>
</body>
</html>
