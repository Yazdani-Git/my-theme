<?php


if (!defined('ABSPATH')) exit;

class Moboland_Compare
{

    public static function get_product_data($product_id)
    {
        $product = wc_get_product($product_id);

        if (!$product || !$product->is_type(['simple', 'variable'])) {
            return null;
        }

        // آماده‌سازی داده‌ها
        return [
            'id' => $product->get_id(),
            'title' => $product->get_name(),
            'image' => wp_get_attachment_image_url($product->get_image_id(), 'medium'),
            'price_html' => $product->get_price_html(),
            'add_to_cart' => do_shortcode('[add_to_cart id="' . $product->get_id() . '" show_price="false"]'),
            'excerpt' => apply_filters('woocommerce_short_description', $product->get_short_description()),
            'attributes' => self::get_product_attributes($product),
        ];
    }

    private static function get_product_attributes($product)
    {
        $attributes = [];

        foreach ($product->get_attributes() as $attribute) {
            if ($attribute->get_variation()) continue;

            $name = wc_attribute_label($attribute->get_name());
            $value = '';

            if ($attribute->is_taxonomy()) {
                $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), ['fields' => 'names']);
                $value = implode(', ', $terms);
            } else {
                $value = $attribute->get_options() ? implode(', ', $attribute->get_options()) : '';
            }

            $attributes[] = [
                'name' => $name,
                'value' => $value,
            ];
        }

        return $attributes;
    }

}

