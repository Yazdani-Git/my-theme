<?php
if (!defined('ABSPATH')) {
    exit;
}

// وقتی سفارش در حال انجام (processing)، کش‌بک بده
add_action('woocommerce_order_status_processing', 'moboland_apply_cashback_to_wallet');

function moboland_apply_cashback_to_wallet($order_id) {
    // بررسی فعال بودن کش بک
    if (!get_option('moboland_cashback_enabled')) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    $user_id = $order->get_user_id();
    if (!$user_id) {
        return;
    }

    // گرفتن تنظیمات کش بک
    $cashback_percentage = get_option('moboland_cashback_percentage', 0);
    $min_cart_total = get_option('moboland_min_cart_total', 0);
    $max_cashback = get_option('moboland_max_cashback_amount', 0);

    $subtotal = $order->get_subtotal();

    if ($subtotal < $min_cart_total) {
        return;
    }

    $cashback_amount = ($subtotal * $cashback_percentage) / 100;

    if ($max_cashback > 0 && $cashback_amount > $max_cashback) {
        $cashback_amount = $max_cashback;
    }

    // اجرای افزودن به کیف پول
    moboland_add_to_wallet($user_id, $cashback_amount, "کش بک سفارش #{$order_id}");
}
