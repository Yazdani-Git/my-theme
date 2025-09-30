<?php


if (!defined('ABSPATH')) exit;

function moboland_render_compare_table($ids)
{
    if (empty($ids)) return;

    echo '<div class="moboland-compare-wrapper">';

    // دکمه پاک کردن همه
    echo '<div class="compare-header">';
    echo '<button class="clear-compare-btn" onclick="clearCompareList()">پاک کردن همه</button>';
    echo '</div>';

    echo '<div class="compare-table">';
    echo '<table>';
    echo '<tr>';

    // عناوین
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<th>';
        echo '<h3>' . esc_html($data['title']) . '</h3>';
        echo '<button class="remove-compare-item" onclick="removeCompareItem(' . $data['id'] . ')">حذف</button>';
        echo '</th>';
    }

    echo '</tr><tr>';

    // تصاویر
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<td>';
        echo '<img src="' . esc_url($data['image']) . '" alt="' . esc_attr($data['title']) . '">';
        echo '</td>';
    }

    echo '</tr><tr>';

    // قیمت
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<td>';
        echo $data['price_html'];
        echo '</td>';
    }

    echo '</tr><tr>';

    // دکمه افزودن به سبد
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<td>';
        echo $data['add_to_cart'];
        echo '</td>';
    }

    echo '</tr><tr>';

    // توضیحات کوتاه
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<td>';
        echo wp_kses_post($data['excerpt']);
        echo '</td>';
    }

    echo '</tr><tr>';

    // ویژگی‌ها
    foreach ($ids as $id) {
        $data = Moboland_Compare::get_product_data($id);
        if (!$data) continue;

        echo '<td>';
        if (!empty($data['attributes'])) {
            echo '<ul>';
            foreach ($data['attributes'] as $att) {
                echo '<li><strong>' . esc_html($att['name']) . ':</strong> ' . esc_html($att['value']) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<em>ویژگی‌ای ثبت نشده</em>';
        }
        echo '</td>';
    }

    echo '</tr>';
    echo '</table>';
    echo '</div></div>';
}

