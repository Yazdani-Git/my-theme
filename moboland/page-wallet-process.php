<?php
/*
Template Name: Wallet Process
*/
defined('ABSPATH') || exit;

get_header();

// بررسی ورود کاربر
if ( !is_user_logged_in() ) {
    wp_redirect(home_url());
    exit;
}

// فقط برای درخواست POST
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $user_id     = get_current_user_id();
    $amount      = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    $gateway_id  = isset($_POST['gateway']) ? sanitize_text_field($_POST['gateway']) : '';

    // بررسی اعتبار مبلغ و درگاه
    if ( $amount >= 5000 && $gateway_id ) {

        // گرفتن ID محصول مجازی از تنظیمات
        $product_id = get_option('wallet_virtual_product_id');

        // اگر محصول مجازی وجود ندارد یا حذف شده است
        if ( empty($product_id) || get_post_status($product_id) !== 'publish' ) {
            wp_redirect(wc_get_account_endpoint_url('dashboard') . '?wallet_status=no_wallet_product');
            exit;
        }

        // گرفتن لیست درگاه‌های فعال ووکامرس
        $gateways = WC()->payment_gateways->get_available_payment_gateways();

        // بررسی درگاه انتخاب‌شده
        if ( ! isset($gateways[$gateway_id]) ) {
            wp_redirect(wc_get_account_endpoint_url('dashboard') . '?wallet_status=invalid_gateway');
            exit;
        }

        // ساخت سفارش ووکامرس
        $order = wc_create_order([
            'customer_id' => $user_id,
        ]);

        // افزودن محصول مجازی با مبلغ دلخواه
        $order->add_product(wc_get_product($product_id), 1, [
            'subtotal' => $amount,
            'total'    => $amount,
        ]);

        // تنظیم درگاه پرداخت
        $order->set_payment_method($gateways[$gateway_id]);

        // اضافه کردن متادیتاهای مخصوص شارژ کیف پول
        $order->set_created_via('wallet_topup');
        $order->update_meta_data('is_wallet_topup', true);
        $order->update_meta_data('wallet_topup_amount', $amount);

        // نهایی‌سازی سفارش
        $order->calculate_totals();
        $order->save();

        // هدایت کاربر به صفحه پرداخت درگاه
        wp_redirect($order->get_checkout_payment_url());
        exit;

    } else {
        wp_redirect(wc_get_account_endpoint_url('dashboard') . '?wallet_status=invalid_data');
        exit;
    }
}

get_footer();
