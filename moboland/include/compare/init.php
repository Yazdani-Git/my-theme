<?php


// جلوگیری از دسترسی مستقیم
if (!defined('ABSPATH')) {
    exit;
}

// لود فایل‌های اصلی
require_once __DIR__ . '/class-compare.php';
require_once __DIR__ . '/compare-rest-api.php';
require_once __DIR__ . '/compare-functions.php';
require_once __DIR__ . '/compare-template.php';

// بارگذاری استایل و اسکریپت‌ها
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('moboland-compare-style', get_template_directory_uri() . '/include/compare/assets/compare.css', [], '1.0');
    wp_enqueue_script('moboland-compare-script', get_template_directory_uri() . '/include/compare/assets/compare.js', ['jquery'], '1.0', true);

    // انتقال متغیرهای لازم به جاوااسکریپت
    wp_localize_script('moboland-compare-script', 'mobolandCompareData', [
        'rest_url' => esc_url_raw(rest_url('moboland/v1/compare')),
    ]);
});

