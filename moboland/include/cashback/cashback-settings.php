<?php
if (!defined('ABSPATH')) {
    exit;
}

// افزودن منوی کش بک به پیشخوان
function moboland_cashback_settings_menu() {
    add_menu_page(
        'تنظیمات کش بک',
        'کش بک',
        'manage_options',
        'moboland-cashback-settings',
        'moboland_render_cashback_settings_page',
        'dashicons-money-alt',
        56
    );
}
add_action('admin_menu', 'moboland_cashback_settings_menu');

// رندر کردن صفحه تنظیمات
function moboland_render_cashback_settings_page() {
    ?>
    <div class="wrap">
        <h1>تنظیمات کش بک</h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php
            settings_fields('moboland_cashback_settings');
            do_settings_sections('moboland_cashback_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// ثبت فیلدهای تنظیمات
function moboland_register_cashback_settings() {
    register_setting('moboland_cashback_settings', 'moboland_cashback_enabled');
    register_setting('moboland_cashback_settings', 'moboland_cashback_percentage');
    register_setting('moboland_cashback_settings', 'moboland_min_cart_total');
    register_setting('moboland_cashback_settings', 'moboland_max_cashback_amount');


    add_settings_section(
        'moboland_cashback_section',
        'تنظیمات اصلی',
        null,
        'moboland_cashback_settings'
    );

    add_settings_field(
        'moboland_cashback_enabled',
        'فعال‌سازی کش بک',
        'moboland_cashback_enabled_callback',
        'moboland_cashback_settings',
        'moboland_cashback_section'
    );

    add_settings_field(
        'moboland_cashback_percentage',
        'درصد کش بک (%)',
        'moboland_cashback_percentage_callback',
        'moboland_cashback_settings',
        'moboland_cashback_section'
    );

    add_settings_field(
        'moboland_min_cart_total',
        'حداقل مبلغ سبد خرید (تومان)',
        'moboland_min_cart_total_callback',
        'moboland_cashback_settings',
        'moboland_cashback_section'
    );

    add_settings_field(
        'moboland_max_cashback_amount',
        'حداکثر مبلغ کش بک (تومان)',
        'moboland_max_cashback_amount_callback',
        'moboland_cashback_settings',
        'moboland_cashback_section'
    );


}
add_action('admin_init', 'moboland_register_cashback_settings');

// توابع نمایش فیلدها
function moboland_cashback_enabled_callback() {
    $value = get_option('moboland_cashback_enabled', '');
    echo '<input type="checkbox" name="moboland_cashback_enabled" value="1"' . checked(1, $value, false) . '> فعال باشد';
}

function moboland_cashback_percentage_callback() {
    $value = get_option('moboland_cashback_percentage', '');
    echo '<input type="number" name="moboland_cashback_percentage" value="' . esc_attr($value) . '" min="0" max="100"> %';
}

function moboland_min_cart_total_callback() {
    $value = get_option('moboland_min_cart_total', '');
    echo '<input type="number" name="moboland_min_cart_total" value="' . esc_attr($value) . '" min="0"> تومان';
}

function moboland_max_cashback_amount_callback() {
    $value = get_option('moboland_max_cashback_amount', '');
    echo '<input type="number" name="moboland_max_cashback_amount" value="' . esc_attr($value) . '" min="0"> تومان';
}

