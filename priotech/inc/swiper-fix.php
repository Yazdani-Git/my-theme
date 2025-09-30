<?php
if (!defined('ABSPATH')) {
    exit;
}

class ElementorSwiperFix {
    public function __construct() {
        add_action('elementor/frontend/after_register_styles', [$this, 'register_swiper_styles']);
        add_action('elementor/frontend/before_enqueue_scripts', [$this, 'enqueue_swiper_styles']);
        add_action('wp_head', [$this, 'add_custom_css']);
    }

    public function register_swiper_styles() {
        wp_register_style(
            'elementor-swiper-fix',
            plugins_url('/elementor/assets/lib/swiper/v8/css/swiper.min.css', 'elementor'),
            [],
            '8.4.5'
        );
    }

    public function enqueue_swiper_styles() {
        if (!Elementor\Plugin::$instance->preview->is_preview_mode()) {
            wp_enqueue_style('elementor-swiper-fix');
        }
    }

    public function add_custom_css() {
        ?>
        <style>
            .elementor-swiper-button {
                position: absolute;
                display: inline-flex;
                z-index: 1;
                cursor: pointer;
                font-size: 25px;
                color: rgba(238, 238, 238, 0.9);
                top: 50%;
                transform: translateY(-50%);
            }

            .elementor-swiper-button-prev {
                left: 10px;
            }

            .elementor-swiper-button-next {
                right: 10px;
            }

            .swiper-container .elementor-swiper-button,
            .swiper .elementor-swiper-button {
                position: absolute;
            }
        </style>
        <?php
    }
}

new ElementorSwiperFix();
