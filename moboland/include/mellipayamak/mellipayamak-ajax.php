<?php
// امنیت: اطمینان از اجرای مستقیم نشدن این فایل
if (!defined('ABSPATH')) {
    exit; // خروج اگر به طور مستقیم اجرا شد
}

// ارسال OTP
add_action('wp_ajax_send_otp', 'send_otp_mellipayamak');
add_action('wp_ajax_nopriv_send_otp', 'send_otp_mellipayamak');

function send_otp_mellipayamak() {
    session_start();

    if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
        wp_send_json_error(['message' => 'شماره موبایل وارد نشده است!']);
    }

    $mobile = sanitize_text_field($_POST['mobile']);

    // ارسال OTP با استفاده از تابع ملی پیامک
    $response = sendMelliPayamakPattern($mobile);

    if (isset($response['result']) && is_numeric($response['result']) && $response['result'] > 0) {
        $_SESSION['otp_code'] = $response['code']; // ذخیره OTP در سشن
        $_SESSION['otp_expire'] = time() + 300; // اعتبار 5 دقیقه‌ای (300 ثانیه)
        wp_send_json_success(['message' => 'کد تأیید ارسال شد']);
    } else {
        wp_send_json_error(['message' => 'مشکلی در ارسال پیامک وجود دارد! لطفاً دوباره امتحان کنید.']);
    }
}



add_action('wp_ajax_verify_otp', 'verify_otp_mellipayamak');
add_action('wp_ajax_nopriv_verify_otp', 'verify_otp_mellipayamak');

function verify_otp_mellipayamak() {
    session_start();

    if (!isset($_POST['mobile']) || !isset($_POST['otp_code'])) {
        wp_send_json_error();
    }

    $mobile = sanitize_text_field($_POST['mobile']);
    $otp_code = sanitize_text_field($_POST['otp_code']);

    if (!isset($_SESSION['otp_code']) || !isset($_SESSION['otp_expire']) || time() > $_SESSION['otp_expire']) {
        unset($_SESSION['otp_code']);
        unset($_SESSION['otp_expire']);
        wp_send_json_error();
    }

    if ($otp_code != $_SESSION['otp_code']) {
        wp_send_json_error();
    }

    // حذف OTP از سشن
    unset($_SESSION['otp_code']);
    unset($_SESSION['otp_expire']);

    // بررسی یا ایجاد کاربر
    $user = get_users([
        'meta_key'   => 'billing_phone',
        'meta_value' => $mobile,
        'number'     => 1
    ]);

    if (!empty($user)) {
        $user = $user[0];
    } else {
        $random_password = wp_generate_password(12, false);
        $user_id = wp_insert_user([
            'user_login' => $mobile,
            'user_pass'  => $random_password,
            'user_email' => '',
            'role'       => 'customer'
        ]);

        if (is_wp_error($user_id)) {
            wp_send_json_error();
        }

        update_user_meta($user_id, 'billing_phone', $mobile);
        $user = get_user_by('id', $user_id);
    }

    // ورود خودکار کاربر
    wp_set_auth_cookie($user->ID);

    // فقط ارسال مقدار موفقیت بدون پیام متنی
    wp_send_json_success();
}
