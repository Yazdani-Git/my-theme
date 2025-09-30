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
    <link rel="icon" type="image/x-icon" href="<?php echo $options['favicon_option']['url']; ?>">

    <script>
        var $ = jQuery;
    </script>

</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>

<div id="compare-popup" style="display: none;">
    <button onclick="document.getElementById('compare-popup').style.display='none'" class="close-compare-popup">×</button>
    <div id="compare-popup-content"></div>
</div>

<div id="compare-toast" class="compare-toast" style="display: none;">
    محصول به لیست مقایسه اضافه شد.
</div>

<div id="compare-loader" class="compare-loader" style="display: none;">
    <div class="compare-spinner"></div>
</div>

<div id="compare-toast-remove" class="compare-toast compare-toast-remove"></div>







<div id="modal_add_to_cart" class="modal">
    <div class="modal-content modal-add-to-cart">
        <i class="fa-solid fa-check"></i>
        محصول به سبد خرید اضافه شد
    </div>
</div>

<div id="modal_login" class="modal">
    <!-- Modal content -->
    <div class="modal-content">


        <?php if ($options['login_with_mobile'] == 'woocommerce') { ?>
            <div class="form-login-moboland">
                <span class="close_login"><i class="fa-solid fa-xmark"></i></span>

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
                <span class="close_login"><i class="fa-solid fa-xmark"></i></span>

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
                            دیگر</p>
                        <button type="button" id="resend-otp-btn" class="woocommerce-button button"
                                style="display: none;">ارسال مجدد کد
                        </button>
                    </form>
                </div>

            </div>


        <?php } elseif ($options['login_with_mobile'] == 'mellipayamak') { ?>


            <div class="form-login-moboland">
                <span class="close_login"><i class="fa-solid fa-xmark"></i></span>

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


      <?php  }  ?>


    </div>
</div>

<div class="overlay"></div>

<?php if ($options['select_header'] == 'one_header') { ?>
    <header class="header desktop ">

        <?php if ($options['active_top_menu']) { ?>
            <section class="main-header">
                <div class="container">
                    <div class="top-header">
                        <div class="top-header-right">
                            <div class="alert"></div>
                            <span><?php echo $options['custom_top_topmenu_right']; ?></span>
                        </div>
                        <div class="top-header-left">
                            <span><?php echo $options['custom_top_topmenu_left']; ?></span>
                            <span class="contact-header">
                       <?php echo $options['contact_top_menu_left']; ?>
                        <i class="<?php echo $options['icon_top_menu_left']; ?>"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="mid-header">
            <div class="container">
                <div class="ch-mid-header">
                    <div class="mid-header-right">
                        <div class="logo">
                            <?php if ($options['logo_option']['url']) { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo $options['logo_option']['url']; ?>"
                                            alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                            alt="لوگوی اصلی وب سایت"></a>
                            <?php } ?>
                        </div>
                        <div class="search-main">
                            <form action="<?php home_url('/'); ?>">
                                <input type="search" class="ajax-search" name="s" placeholder="جستجو در محصولات" value="<?php the_search_query(); ?>">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                            <div class="loader-ajax-search">
                                <span class="loader"></span>
                            </div>
                            <div id="datafetch" class="content-ajax-search"></div>
                        </div>
                    </div>
                    <div class="mid-header-left">
                        <?php if ($options['active_wishlist']) { ?>
                            <div class="fav-btn">
                                <a href="<?php echo home_url('/wishlist') ?>" target="_blank">
                                    <i class="fa-regular fa-heart"></i>
                                    <span class="text-fav-btn">
                                 علاقمندی ها
                            </span>

                                </a>
                            </div>
                        <?php } ?>
                        <?php if (!$options['active_wishlist'] && $options['title_custom_btn']) { ?>
                            <div class="fav-btn">
                                <a href="<?php echo $options['link_custom_btn']; ?>" target="_blank">
                                    <i class="<?php echo $options['icon_custom_btn']; ?>"></i>
                                    <span class="text-fav-btn">
                                <?php echo $options['title_custom_btn']; ?>
                            </span>
                                </a>
                            </div>
                        <?php } ?>
                        <?php if ($options['active_cart']) { ?>
                            <div class="cart-btn">
                                <a href="<?php echo wc_get_cart_url(); ?>">
                            <span class="text-cart-btn">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>سبد خرید</span>
                            </span>
                                    <span class="cart-btn-num">
                                <?php echo wc()->cart->get_cart_contents_count(); ?>
                            </span>
                                </a>
                                <div class="cart-content">
                                    <?php woocommerce_mini_cart(); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="down-header">
            <div class="container">
                <div class="ch-down-header">
                    <nav class="main-menu-header">
                        <?php if ($options['active_megamenu']) { ?>
                            <div class="megamenu-box">
                                <?php

                                if (has_nav_menu('mega-menu')) { ?>
                                    <div class="t-m">
                                        <i class="fa-solid fa-bars"></i>
                                        <span><?php echo $options['title_megamenu']; ?></span>
                                    </div>
                                    <div class="moboland-megamenu">
                                        <?php wp_nav_menu(array('theme_location' => 'mega-menu', 'container' => '')); ?>
                                    </div>
                                    <?php

                                } else {
                                    echo "جایگاه مگا منو";
                                }
                                ?>
                            </div>
                        <?php } ?>
                        <div class="menu-header">
                            <?php
                            if (has_nav_menu('main-menu')) {
                                wp_nav_menu(array('theme_location' => 'main-menu', 'container' => ''));
                            } else {
                                echo "<p>لطفا اولین منو برای بخش منوی اصلی را ایجاد کنید</p>";
                            }
                            ?>
                        </div>
                    </nav>
                    <?php
                    global $current_user;


                    if (is_user_logged_in()) : ?>
                        <div class="account-btn">
                            <input type="checkbox" id="user_arrow" hidden>
                            <label for="user_arrow">
                                <?php echo $current_user->display_name; ?>
                                <i class="fas fa-chevron-down"></i>
                            </label>
                            <div class="ac-access">
                                <ul>
                                    <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                        <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                            <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                                                <?php echo esc_html($label); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php else : ?>


                        <?php if ($options['active_register_btn']) { ?>
                            <div class="register-btn" id="btn_modal_login">
                                <i class="far fa-circle-user"></i>
                                <span>ورود/ثبت نام</span>
                            </div>
                        <?php } else { ?>
                            <?php if (!$options['active_register_btn'] && $options['title_custom_btn_register']) { ?>
                                <div class="register-btn">
                                    <a href="<?php echo $options['link_custom_btn_register']; ?>" target="_blank">
                                        <i class="<?php echo $options['icon_custom_btn_register']; ?>"></i>
                                        <span><?php echo $options['title_custom_btn_register']; ?></span>
                                    </a>
                                </div>
                            <?php } ?>

                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </header>

<?php } elseif ($options['select_header'] == 'two_header') { ?>

    <header class="header desktop ">
        <?php if ($options['active_top_menu']) { ?>
            <section class="main-header">
                <div class="container">
                    <div class="top-header">
                        <div class="top-header-right">
                            <div class="alert"></div>
                            <span><?php echo $options['custom_top_topmenu_right']; ?></span>
                        </div>
                        <div class="top-header-left">
                            <span><?php echo $options['custom_top_topmenu_left']; ?></span>
                            <span class="contact-header">
                       <?php echo $options['contact_top_menu_left']; ?>
                        <i class="<?php echo $options['icon_top_menu_left']; ?>"></i>
                    </span>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>

        <section class="mid-header">
            <div class="container">
                <div class="ch-mid-header">
                    <div class="mid-header-right">
                        <div class="logo">
                            <?php if ($options['logo_option']['url']) { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo $options['logo_option']['url']; ?>"
                                            alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                                            alt="لوگوی اصلی وب سایت"></a>
                            <?php } ?>
                        </div>

                        <nav>
                            <div class="menu-header">
                                <?php
                                if (has_nav_menu('main-menu')) {
                                    wp_nav_menu(array('theme_location' => 'main-menu', 'container' => ''));
                                } else {
                                    echo "<p>لطفا اولین منو برای بخش منوی اصلی را ایجاد کنید</p>";
                                }
                                ?>
                            </div>
                        </nav>
                    </div>
                    <div class="mid-header-left">
                        <div class="search-main searchbox-two">
                            <i class="fa-brands fa-sistrix search-icon"></i>
                            <form method="get" action="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                                <input type="search" name="s" value="<?php the_search_query(); ?>" data-charaters="3"
                                       data-functiontype="both" class="search-input" placeholder="جستجو در محصولات..."
                                       id="keyword" onkeyup="if (this.value.length > 2) fetch()" autofocus>
                                <button class="fa-brands fa-sistrix" type="submit">
                                </button>
                            </form>
                            <div class="loader-ajax-search">
                                <span class="loader"></span>
                            </div>
                            <div id="datafetch" class="content-ajax-search"></div>
                        </div>
                        <?php
                        global $current_user;
                        if (is_user_logged_in()) : ?>
                            <div class="account-btn">
                                <input type="checkbox" id="user_arrow" hidden>
                                <label for="user_arrow">
                                    <?php echo $current_user->display_name; ?>
                                    <i class="fas fa-chevron-down"></i>
                                </label>
                                <div class="ac-access">
                                    <ul>
                                        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                                                    <?php echo esc_html($label); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php else : ?>
                            <?php if ($options['active_register_btn']) { ?>
                                <div class="register-btn" id="btn_modal_login">
                                    <i class="far fa-circle-user"></i>
                                    <span>ورود/ثبت نام</span>
                                </div>
                            <?php } else { ?>
                                <?php if (!$options['active_register_btn'] && $options['title_custom_btn_register']) { ?>
                                    <div class="register-btn">
                                        <a href="<?php echo $options['link_custom_btn_register']; ?>" target="_blank">
                                            <i class="<?php echo $options['icon_custom_btn_register']; ?>"></i>
                                            <span><?php echo $options['title_custom_btn_register']; ?></span>
                                        </a>
                                    </div>
                                <?php } ?>

                            <?php } ?>
                        <?php endif; ?>
                        <?php if ($options['active_cart']) { ?>
                            <div class="cart-btn">
                                <a href="<?php echo wc_get_cart_url(); ?>">
                            <span class="text-cart-btn">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                                    <span class="cart-btn-num">
                                <?php echo wc()->cart->get_cart_contents_count(); ?>
                            </span>
                                </a>
                                <div class="cart-content">
                                    <?php woocommerce_mini_cart(); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </header>

<?php } elseif ($options['select_header'] == 'one_header_co') { ?>

    <header class="header-co desktop ">

        <?php if ($options['active_top_menu']) { ?>

            <div class="top-header-co">
                <div class="container">
                    <div class="top-header-co-ch">
                        <div class="top-header-co-right">
                            <div class="top-header-co-right-info">
                                <i class="fa-solid fa-phone-flip"></i>
                                <span><a href="tel:<?php echo $options['contact_top_menu_left']; ?>"><?php echo $options['contact_top_menu_left']; ?></a></span>
                            </div>
                            <div class="top-header-co-right-info">
                                <i class="fa-solid fa-envelope"></i>
                                <span><?php echo $options['custom_top_topmenu_right']; ?></span>
                            </div>
                            <div class="top-header-co-right-info">
                                <i class="fa-solid fa-location-dot"></i>
                                <span><?php echo $options['custom_top_topmenu_left']; ?></span>
                            </div>
                        </div>
                        <div class="top-header-co-left">
                            <?php if ($options['social_icons_co']) { ?>
                                <div class="social-icon">
                                    <?php if ($options['instagram_co']) { ?>
                                        <a href="https://www.instagram.com/<?php echo $options['instagram_co']; ?>">
                                            <i class="fa-brands fa-square-instagram"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($options['facebook_co']) { ?>
                                        <a href="<?php echo $options['facebook_co']; ?>">
                                            <i class="fa-brands fa-square-facebook"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($options['linkdin_co']) { ?>
                                        <a href="<?php echo $options['linkdin_co']; ?>">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($options['youtube_co']) { ?>
                                        <a href="<?php echo $options['youtube_co']; ?>">
                                            <i class="fa-brands fa-square-youtube"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($options['twitter_co']) { ?>
                                        <a href="<?php echo $options['twitter_co']; ?>">
                                            <i class="fa-brands fa-square-twitter"></i>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>


        <div class="mid-header-co">
            <div class="container">
                <div class="mid-header-co-ch">
                    <div class="mid-header-co-ch-right">
                        <div class="logo"> <?php if ($options['logo_option']['url']) { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo $options['logo_option']['url']; ?>"
                                            alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                                <a href="<?php echo get_home_url(); ?>"><img
                                            src="<?php echo get_template_directory_uri() . '/img/logo-moboco.webp'; ?>"
                                            alt="لوگوی اصلی وب سایت"></a>
                            <?php } ?></div>
                    </div>
                    <div class="mid-header-co-ch-left">
                        <?php if ($options['active_contact_us_btn_co']) { ?>
                            <a href="<?php echo $options['contact_us_btn_co_link']; ?>"><?php echo $options['contact_us_btn_co']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="down-header-co">
            <div class="container">
                <div class="down-header-co-ch">
                    <div class="down-header-co-ch-right">
                        <nav class="main-menu">
                            <?php
                            if (has_nav_menu('main-menu')) {
                                wp_nav_menu(array('theme_location' => 'main-menu', 'container' => ''));
                            } else {
                                echo "<p>لطفا اولین منو برای بخش منوی اصلی را ایجاد کنید</p>";
                            }
                            ?>
                        </nav>
                    </div>
                    <div class="down-header-co-ch-left">
                        <div class="search-main searchbox-co">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <form method="get" action="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                                <input type="search" name="s" value="<?php the_search_query(); ?>" data-charaters="3"
                                       data-functiontype="both" class="search-input" placeholder="جستجو در محصولات..."
                                       id="keyword" onkeyup="if (this.value.length > 2) fetch()" autofocus>
                                <button class="fa-brands fa-sistrix" type="submit">
                                </button>
                                <div class="loader-ajax-search">
                                    <span class="loader"></span>
                                </div>
                                <div id="datafetch" class="content-ajax-search"></div>
                            </form>
                        </div>

                        <?php if ($options['active_wishlist']) { ?>
                        <div class="favorite-icon">
                            <a href="<?php echo home_url('/wishlist') ?>"><i class="fa-regular fa-heart"></i></a>
                        </div>
                        <?php } ?>

                        <?php if ($options['active_cart']) { ?>
                            <div class="basket">
                                <a href="<?php echo wc_get_cart_url(); ?>">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="cart-btn-num-co">
                                          <?php echo wc()->cart->get_cart_contents_count(); ?>
                                     </span>
                                </a>
                                <div class="cart-content">
                                    <?php woocommerce_mini_cart(); ?>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        global $current_user;

                        if (is_user_logged_in()) : ?>
                            <div class="account-btn">
                                <input type="checkbox" id="user_arrow" hidden>
                                <label for="user_arrow">
                                    <?php echo $current_user->display_name; ?>
                                    <i class="fas fa-chevron-down"></i>
                                </label>
                                <div class="ac-access">
                                    <ul>
                                        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                                            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                                                    <?php echo esc_html($label); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php else : ?>

                            <?php if ($options['active_register_btn']) { ?>
                                <div class="user-login" id="btn_modal_login">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                            <?php } else { ?>
                                <div class="register-btn">
                                    <a href="<?php echo $options['link_custom_btn_register']; ?>" target="_blank">
                                        <i class="fa-regular fa-user"></i>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </header>

<?php } ?>


<header class="header mobile">
    <?php if ($options['active_top_menu'] && $options['active_top_menu_mobile']) { ?>
        <section class="main-header">
            <div class="container">
                <div class="top-header">
                    <div class="top-header-right">
                        <div class="alert"></div>
                        <span><?php echo $options['custom_top_topmenu_right']; ?></span>
                    </div>
                    <div class="top-header-left">
                        <span><?php echo $options['custom_top_topmenu_left']; ?></span>
                        <span class="contact-header">
                       <?php echo $options['contact_top_menu_left']; ?>
                        <i class="<?php echo $options['icon_top_menu_left']; ?>"></i>
                    </span>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <section class="header-mobile">

        <div class="icon-menu-mobile" id="hamburger">
            <i class="fa-solid fa-bars"></i>
            <span>منو</span>
        </div>

        <div class="navigation" id="menu_mobile">
            <div class="navigation-content">
                <i class="fas fa-xmark close_menu"></i>

                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">منوی
                        اصلی
                    </button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')">دسته بندی محصولات</button>
                </div>

                <div id="London" class="tabcontent">
                    <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => '')); ?>
                </div>

                <div id="Paris" class="tabcontent">
                    <?php wp_nav_menu(array('theme_location' => 'mega-menu', 'container' => '')); ?>
                </div>

            </div>
        </div>

        <div class="logo">
            <?php if ($options['logo_mobile_option']['url']) { ?>
                <a href="<?php echo get_home_url(); ?>"><img
                            src="<?php echo $options['logo_mobile_option']['url']; ?>"
                            alt="لوگوی اصلی وب سایت"></a> <?php } else { ?>
                <a href="<?php echo get_home_url(); ?>"><img
                            src="<?php echo get_template_directory_uri() . '/img/logo-web.webp'; ?>"
                            alt="لوگوی اصلی وب سایت"></a>
            <?php } ?>
        </div>

        <?php
        global $current_user;
        if (is_user_logged_in()) : ?>
            <div class="account-btn">
                <input type="checkbox" id="user_arrow" hidden>
                <label for="user_arrow">
                    <?php echo $current_user->display_name; ?>
                    <i class="fas fa-chevron-down"></i>
                </label>
                <div class="ac-access">
                    <ul>
                        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
                            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" <?php echo wc_is_current_account_menu_item($endpoint) ? 'aria-current="page"' : ''; ?>>
                                    <?php echo esc_html($label); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php else : ?>

            <?php if ($options['active_register_btn']) { ?>
                <div class="register-btn" id="btn_modal_login2">
                    <i class="far fa-circle-user"></i>
                    <span>ورود/ثبت نام</span>
                </div>
            <?php } else { ?>
                <?php if (!$options['active_register_btn'] && $options['title_custom_btn_register']) { ?>
                    <div class="register-btn">
                        <a href="<?php echo $options['link_custom_btn_register']; ?>" target="_blank">
                            <i class="<?php echo $options['icon_custom_btn_register']; ?>"></i>
                            <span><?php echo $options['title_custom_btn_register']; ?></span>
                        </a>
                    </div>
                <?php } ?>

            <?php } ?>

        <?php endif; ?>


    </section>

    <?php if ($options['active_menu_mobile_bottom']) { ?>

    <section class="menu-bottom-mobile">
        <?php if ($options['active_home_menu_mobile_btn']) { ?>
        <div>
            <a href="<?php echo home_url(); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="22px" height="22px">
                    <path d="M 23.951172 4 A 1.50015 1.50015 0 0 0 23.072266 4.3222656 L 8.859375 15.519531 C 7.0554772 16.941163 6 19.113506 6 21.410156 L 6 40.5 C 6 41.863594 7.1364058 43 8.5 43 L 18.5 43 C 19.863594 43 21 41.863594 21 40.5 L 21 30.5 C 21 30.204955 21.204955 30 21.5 30 L 26.5 30 C 26.795045 30 27 30.204955 27 30.5 L 27 40.5 C 27 41.863594 28.136406 43 29.5 43 L 39.5 43 C 40.863594 43 42 41.863594 42 40.5 L 42 21.410156 C 42 19.113506 40.944523 16.941163 39.140625 15.519531 L 24.927734 4.3222656 A 1.50015 1.50015 0 0 0 23.951172 4 z M 24 7.4101562 L 37.285156 17.876953 C 38.369258 18.731322 39 20.030807 39 21.410156 L 39 40 L 30 40 L 30 30.5 C 30 28.585045 28.414955 27 26.5 27 L 21.5 27 C 19.585045 27 18 28.585045 18 30.5 L 18 40 L 9 40 L 9 21.410156 C 9 20.030807 9.6307412 18.731322 10.714844 17.876953 L 24 7.4101562 z"></path>
                </svg>
                <span>خانه</span>
            </a>
        </div>
        <?php } ?>
        <?php if (!$options['active_home_menu_mobile_btn'] && $options['title_custom_home_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_home_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_home_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_home_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if ($options['active_search_menu_mobile_btn']) { ?>
        <div class="search-menu-bottom-mobile">
            <a>
                <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.6725 16.6412L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                          stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span>جستجو</span>
            </a>
        </div>
        <?php } ?>
        <?php if (!$options['active_search_menu_mobile_btn'] && $options['title_custom_search_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_search_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_search_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_search_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if ($options['active_shop_menu_mobile_btn']) { ?>
        <div>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                <svg width="22px" height="22px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                     class="bi bi-shop-window">
                    <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                <span>فروشگاه</span>
            </a>
        </div>
        <?php } ?>
        <?php if (!$options['active_shop_menu_mobile_btn'] && $options['title_custom_shop_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_shop_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_shop_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_shop_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>

        <?php if ($options['active_wishlist_menu_mobile_btn']) { ?>
            <div>
                <a href="<?php echo home_url('wishlist'); ?>">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>علاقه مندی</span>
                </a>
            </div>
        <?php } ?>
        <?php if (!$options['active_wishlist_menu_mobile_btn'] && $options['title_custom_wishlist_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_wishlist_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_wishlist_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_wishlist_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if ($options['active_cart_menu_mobile_btn']) { ?>
        <div>
            <a href="<?php echo wc_get_cart_url(); ?>">
                <svg width="22px" height="22px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>.cls-1 {
                                fill: none;
                                stroke: #020202;
                                stroke-miterlimit: 10;
                                stroke-width: 1.91px;
                            }</style>
                    </defs>
                    <g id="handbag">
                        <path class="cls-1"
                              d="M3.41,7.23H20.59a0,0,0,0,1,0,0v12a3.23,3.23,0,0,1-3.23,3.23H6.64a3.23,3.23,0,0,1-3.23-3.23v-12A0,0,0,0,1,3.41,7.23Z"/>
                        <path class="cls-1"
                              d="M8.18,10.09V5.32A3.82,3.82,0,0,1,12,1.5h0a3.82,3.82,0,0,1,3.82,3.82v4.77"/>
                    </g>
                </svg>
                <span>سبد خرید</span>
            </a>
        </div>
        <?php } ?>
        <?php if (!$options['active_cart_menu_mobile_btn'] && $options['title_custom_cart_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_cart_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_cart_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_cart_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>
        <?php if ($options['active_add_menu_mobile_btn'] && $options['title_custom_add_menu_mobile_btn']) { ?>
            <div class="favorite-btn-header-mobile">
                <a href="<?php echo $options['link_custom_add_menu_mobile_btn'] ?>" target="_blank">
                    <i class="<?php echo $options['icon_custom_add_menu_mobile_btn']; ?>"></i>
                    <span><?php echo $options['title_custom_add_menu_mobile_btn']; ?></span>
                </a>
            </div>
        <?php } ?>


    </section>




        <div class="search-mobile">
            <header>
                <h4>جستجوی محصولات</h4>
                <span id="close_search_mobile"><i class="fa fa-multiply"></i>بازگشت</span>
            </header>

            <div class="search-mobile-inner">
                <form action="<?php echo home_url('/'); ?>" method="get" class="search-mobile-form">
                    <input class="search-input ajax-search" name="s" type="search" placeholder="جستجو در محصولات" value="<?php the_search_query(); ?>">
                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <div class="search-mobile-loader loader-ajax-search">
                    <span class="loader"></span>
                </div>

                <div id="datafetch" class="search-mobile-results content-ajax-search"></div>
            </div>

            <div class="search-text">
                <svg width="70px" height="70px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1 5C1 3.34315 2.34315 2 4 2H8.43845C9.81505 2 11.015 2.93689 11.3489 4.27239L11.7808 6H13.5H20C21.6569 6 23 7.34315 23 9V11C23 11.5523 22.5523 12 22 12C21.4477 12 21 11.5523 21 11V9C21 8.44772 20.5523 8 20 8H13.5H11.7808H4C3.44772 8 3 8.44772 3 9V10V19C3 19.5523 3.44772 20 4 20H9C9.55228 20 10 20.4477 10 21C10 21.5523 9.55228 22 9 22H4C2.34315 22 1 20.6569 1 19V10V9V5ZM3 6.17071C3.31278 6.06015 3.64936 6 4 6H9.71922L9.40859 4.75746C9.2973 4.3123 8.89732 4 8.43845 4H4C3.44772 4 3 4.44772 3 5V6.17071ZM20.1716 18.7574C20.6951 17.967 21 17.0191 21 16C21 13.2386 18.7614 11 16 11C13.2386 11 11 13.2386 11 16C11 18.7614 13.2386 21 16 21C17.0191 21 17.967 20.6951 18.7574 20.1716L21.2929 22.7071C21.6834 23.0976 22.3166 23.0976 22.7071 22.7071C23.0976 22.3166 23.0976 21.6834 22.7071 21.2929L20.1716 18.7574ZM13 16C13 14.3431 14.3431 13 16 13C17.6569 13 19 14.3431 19 16C19 17.6569 17.6569 19 16 19C14.3431 19 13 17.6569 13 16Z"
                          fill="#000000"/>
                </svg>
                <span>محصول مورد نظر خود را جستجو کنید</span>
            </div>
        </div>


    <?php } ?>




</header>



