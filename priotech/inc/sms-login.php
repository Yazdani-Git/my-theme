<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Get Priotech options
$priotech_options = get_option('priotech_options');

// Check if SMS login is enabled
if (isset($priotech_options['login_system_select']) && $priotech_options['login_system_select'] === 'sms') {

    // Send OTP handler
    add_action('wp_ajax_send_otp', 'priotech_send_otp');
    add_action('wp_ajax_nopriv_send_otp', 'priotech_send_otp');

    function priotech_send_otp() {
        if (!isset($_POST['mobile']) || empty($_POST['mobile'])) {
            wp_send_json_error(['message' => __('Please enter a mobile number.', 'priotech')]);
        }

        $mobile = sanitize_text_field($_POST['mobile']);
        if (!preg_match('/^09[0-9]{9}$/', $mobile)) {
            wp_send_json_error(['message' => __('Please enter a valid mobile number.', 'priotech')]);
        }

        $priotech_options = get_option('priotech_options');
        $provider = $priotech_options['sms_provider'];

        if ($provider === 'melipayamak') {
            priotech_send_melipayamak_otp($mobile);
        } elseif ($provider === 'smsir') {
            priotech_send_smsir_otp($mobile);
        } else {
            wp_send_json_error(['message' => __('No SMS provider is configured.', 'priotech')]);
        }
    }

    // Verify OTP handler
    add_action('wp_ajax_verify_otp', 'priotech_verify_otp');
    add_action('wp_ajax_nopriv_verify_otp', 'priotech_verify_otp');

    function priotech_verify_otp() {
        if (!isset($_POST['mobile']) || !isset($_POST['otp_code'])) {
            wp_send_json_error(['message' => __('Missing mobile or OTP code.', 'priotech')]);
        }

        $mobile = sanitize_text_field($_POST['mobile']);
        $otp_code = sanitize_text_field($_POST['otp_code']);
        $transient_name = 'otp_' . $mobile;
        $stored_otp = get_transient($transient_name);

        if (false === $stored_otp) {
            wp_send_json_error(['message' => __('OTP has expired. Please try again.', 'priotech')]);
        }

        if ($stored_otp != $otp_code) {
            wp_send_json_error(['message' => __('The entered code is incorrect.', 'priotech')]);
        }

        // Delete the transient
        delete_transient($transient_name);

        // Find or create user
        $user = get_user_by('login', $mobile);
        if (!$user) {
            $user_id = wp_create_user($mobile, wp_generate_password(), '');
            if (is_wp_error($user_id)) {
                wp_send_json_error(['message' => __('Could not create user account.', 'priotech')]);
            }
            update_user_meta($user_id, 'billing_phone', $mobile);
            $user = get_user_by('id', $user_id);
        }

        // Log the user in
        wp_set_auth_cookie($user->ID, true);
        wp_send_json_success(['message' => __('Login successful. Redirecting...', 'priotech')]);
    }

    // MeliPayamak OTP function using wp_remote_post
    function priotech_send_melipayamak_otp($mobile) {
        $priotech_options = get_option('priotech_options');
        $username = $priotech_options['melipayamak_username'];
        $password = $priotech_options['melipayamak_password'];
        $bodyId = $priotech_options['melipayamak_bodyid'];

        if(empty($username) || empty($password) || empty($bodyId)) {
            wp_send_json_error(['message' => __('MeliPayamak credentials are not configured.', 'priotech')]);
        }

        $randomCode = rand(1000, 9999);
        $transient_name = 'otp_' . $mobile;

        $response = wp_remote_post('https://rest.payamak-panel.com/api/SendSMS/SendByBaseNumber', [
            'method' => 'POST',
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'username' => $username,
                'password' => $password,
                'text' => (string)$randomCode,
                'to' => $mobile,
                'bodyId' => $bodyId
            ]),
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => __('Error connecting to MeliPayamak.', 'priotech')]);
        }

        $response_body = json_decode(wp_remote_retrieve_body($response));

        if (isset($response_body->Value) && is_numeric($response_body->Value) && $response_body->Value > 0) {
            set_transient($transient_name, $randomCode, 120); // 2-minute expiration
            wp_send_json_success(['message' => __('Verification code sent.', 'priotech')]);
        } else {
            wp_send_json_error(['message' => __('Failed to send OTP. Please check provider credentials.', 'priotech')]);
        }
    }

    // SMS.ir OTP function using wp_remote_post
    function priotech_send_smsir_otp($mobile) {
        $priotech_options = get_option('priotech_options');
        $apiKey = $priotech_options['smsir_api_key'];
        $templateId = $priotech_options['smsir_template_id'];

        if(empty($apiKey) || empty($templateId)) {
            wp_send_json_error(['message' => __('SMS.ir credentials are not configured.', 'priotech')]);
        }

        $randomCode = rand(100000, 999999);
        $transient_name = 'otp_' . $mobile;

        $body = [
            "mobile" => $mobile,
            "templateId" => (int)$templateId,
            "parameters" => [
                [
                    "name" => "Code",
                    "value" => (string)$randomCode
                ]
            ]
        ];

        $response = wp_remote_post('https://api.sms.ir/v1/send/verify', [
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json',
                'X-API-KEY' => $apiKey
            ],
            'body' => json_encode($body),
        ]);

        if (is_wp_error($response)) {
            wp_send_json_error(['message' => __('Failed to connect to SMS.ir.', 'priotech')]);
        }

        $response_body = json_decode(wp_remote_retrieve_body($response));

        if (isset($response_body->status) && $response_body->status == 1) {
            set_transient($transient_name, $randomCode, 120); // 2-minute expiration
            wp_send_json_success(['message' => __('Verification code sent.', 'priotech')]);
        } else {
            wp_send_json_error(['message' => __('Failed to send OTP via SMS.ir. Please check provider credentials.', 'priotech')]);
        }
    }
}