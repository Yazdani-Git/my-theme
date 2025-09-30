<?php
if (!defined('ABSPATH')) {
    exit;
}

// نمایش اطلاعیه کش بک در سبد خرید
add_action('woocommerce_before_cart_totals', 'moboland_show_cart_cashback_notice');

// نمایش اطلاعیه کش بک در صفحه پرداخت
add_action('woocommerce_review_order_before_payment', 'moboland_show_checkout_cashback_notice');

function moboland_show_cart_cashback_notice() {
    moboland_render_cashback_notice();
}

function moboland_show_checkout_cashback_notice() {
    moboland_render_cashback_notice();
}

function moboland_render_cashback_notice() {
    if (!get_option('moboland_cashback_enabled')) return;

    $cashback_percentage = get_option('moboland_cashback_percentage', 0);
    $min_cart_total = get_option('moboland_min_cart_total', 0);
    $max_cashback = get_option('moboland_max_cashback_amount', 0);

    $cart_subtotal = WC()->cart->get_subtotal();

    // محاسبه مبلغ کش بک بر اساس مجموع فعلی
    $cashback = ($cart_subtotal * $cashback_percentage) / 100;
    if ($max_cashback > 0 && $cashback > $max_cashback) {
        $cashback = $max_cashback;
    }

    echo '<div style="background:#fff8e1;border:1px solid #fbc02d;padding:15px;margin-bottom:15px;color:#795548;border-radius:6px;">';

    if ($cart_subtotal >= $min_cart_total) {
        echo 'کاربر عزیز، در صورت نهایی کردن سفارش خود، <strong>' . number_format($cashback, 0) . ' تومان</strong> به کیف پول شما اضافه خواهد شد.<br>';
    } else {
        $diff = $min_cart_total - $cart_subtotal;
        $potential_cashback = ($min_cart_total * $cashback_percentage) / 100;
        if ($max_cashback > 0 && $potential_cashback > $max_cashback) {
            $potential_cashback = $max_cashback;
        }

        echo 'اگر <strong>' . number_format($diff, 0) . ' تومان</strong> به سبد خرید خود اضافه کنید، <strong>' . number_format($potential_cashback, 0) . ' تومان</strong> کش بک دریافت خواهید کرد!<br>';
        echo 'حداقل مبلغ سبد خرید برای دریافت کش بک: <strong>' . number_format($min_cart_total, 0) . ' تومان</strong>';
    }

    echo '</div>';
}
