<?php

global $options;
$options = get_option('options');


if ($options['login_with_mobile'] == 'smsir') {


    function include_smsir_library()
    {
        require_once get_template_directory() . '/include/SMSIRApp/otpsms/vendor/autoload.php';

    }

    add_action('after_setup_theme', 'include_smsir_library');


// فرم ثبت نام با شماره موبایل

    function send_otp_callback()
    {
        if (!isset($_POST['mobile'])) {
            wp_send_json_error("❌ شماره موبایل ارسال نشده است.");
        }

        $mobile = sanitize_text_field($_POST['mobile']);

        if (!preg_match('/^09[0-9]{9}$/', $mobile)) {
            wp_send_json_error("❌ شماره موبایل معتبر نیست.");
        }

        // تولید کد تصادفی ۶ رقمی
        $otp_code = rand(100000, 999999);

        // ذخیره کد تایید برای شماره موبایل (به مدت ۶۰ ثانیه)
        update_option("otp_code_{$mobile}", $otp_code, '', 60);

        // ارسال پیامک با `SmsIr`
        require_once get_template_directory() . '/include/SMSIRApp/otpsms/vendor/autoload.php';
        $api_key = get_option('sms_ir_info_api_key', '');
        $template_id = get_option('sms_ir_verification_template_id', '');
        $base_url = "https://api.sms.ir/v1/";

        $smsir = new \Ipe\Sdk\SmsIrService($api_key, $base_url);
        $parameters = [["name" => "Code", "value" => $otp_code]];
        $response = $smsir->verifySend($mobile, $template_id, $parameters);

        // بررسی موفقیت ارسال پیامک
        if (isset($response->status) && $response->status == 1) {
            wp_send_json_success("✅ کد تایید برای شماره {$mobile} ارسال شد.");
        } else {
            wp_send_json_error("❌ خطا در ارسال پیامک.");
        }
    }

    add_action("wp_ajax_send_otp", "send_otp_callback");
    add_action("wp_ajax_nopriv_send_otp", "send_otp_callback");


    function verify_otp_callback()
    {
        if (!isset($_POST['mobile']) || !isset($_POST['otp_code'])) {
            wp_send_json_error();
        }

        $mobile = sanitize_text_field($_POST['mobile']);
        $otp_code = sanitize_text_field($_POST['otp_code']);
        $stored_code = get_option("otp_code_{$mobile}");

        if ($otp_code != $stored_code) {
            wp_send_json_error();
        }

        delete_option("otp_code_{$mobile}");

        // بررسی وجود شماره موبایل در دیتابیس
        $user = get_user_by("login", $mobile);
        if (!$user) {
            // اگر شماره موبایل قبلاً ثبت نشده بود، کاربر جدید ایجاد کن
            $user_id = wp_insert_user([
                "user_login" => $mobile,
                "user_pass" => NULL,
                "user_email" => "",
                "role" => "customer"
            ]);

            if (is_wp_error($user_id)) {
                wp_send_json_error();
            }

            update_user_meta($user_id, "billing_phone", $mobile);
            $user = get_user_by("id", $user_id);
        }

        // ورود خودکار کاربر
        wp_set_auth_cookie($user->ID);
        wp_send_json_success();
    }

    add_action("wp_ajax_verify_otp", "verify_otp_callback");
    add_action("wp_ajax_nopriv_verify_otp", "verify_otp_callback");

    require_once get_template_directory() . '/include/SMSIRApp/SMSIRApp.php';

}