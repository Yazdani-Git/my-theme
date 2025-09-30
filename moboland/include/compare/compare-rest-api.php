<?php

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('rest_api_init', function () {
    register_rest_route('moboland/v1', '/compare', [
        'methods'  => 'GET',
        'callback' => 'moboland_compare_rest_callback',
        'permission_callback' => '__return_true',
    ]);
});

function moboland_compare_rest_callback($request) {
    $ids = isset($_GET['ids']) ? sanitize_text_field($_GET['ids']) : '';
    $ids = array_filter(array_map('absint', explode(',', $ids)));

    if (empty($ids)) {
        header('Content-Type: text/html; charset=UTF-8');
        echo '<p>محصولی برای مقایسه انتخاب نشده است.</p>';
        exit;
    }

    header('Content-Type: text/html; charset=UTF-8');
    ob_start();
    moboland_render_compare_table($ids);
    $html = ob_get_clean();
    echo $html;
    exit;
}
