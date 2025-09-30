<?php

if (!defined('ABSPATH')) exit;

// شورت‌کد افزودن به مقایسه
add_shortcode('compare_button', 'moboland_compare_button_shortcode');

function moboland_compare_button_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => 0,
    ], $atts);

    $product_id = absint($atts['id']);
    if (!$product_id || !get_post($product_id)) return '';

    ob_start();
    ?>
    <button class="moboland-compare-btn" onclick="addToCompare(<?php echo $product_id; ?>)">
        <i class="fa-regular fa-hand-peace"></i>
        <span class="add">افزودن به مقایسه</span>
        <span class="added" style="display:none;">به مقایسه اضافه شد</span>
    </button>
    <?php
    return ob_get_clean();
}

