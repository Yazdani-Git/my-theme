<?php

add_action( 'elementor/widgets/register', 'moboland_register_custom_widgets' );

if (!function_exists('moboland_register_custom_widgets')) {
    function moboland_register_custom_widgets( $widgets_manager ) {

        require_once( __DIR__ . '/widgets/main-slider.php' );
        $widgets_manager->register( new \moboland_main_slider() );

        require_once( __DIR__ . '/widgets/main-slider-co.php' );
        $widgets_manager->register( new \moboland_main_slider_co() );

        require_once( __DIR__ . '/widgets/our-services-co.php' );
        $widgets_manager->register( new \moboland_our_services_co() );

        require_once( __DIR__ . '/widgets/about-us-co.php' );
        $widgets_manager->register( new \moboland_about_us_co() );

        require_once( __DIR__ . '/widgets/our-project.php' );
        $widgets_manager->register( new \moboland_our_project_co() );

        require_once( __DIR__ . '/widgets/comment-user-co.php' );
        $widgets_manager->register( new \moboland_comments_user_co() );

        require_once( __DIR__ . '/widgets/our-team-co.php' );
        $widgets_manager->register( new \moboland_our_team_co() );

        require_once( __DIR__ . '/widgets/product.php' );
        $widgets_manager->register( new \moboland_product() );

        require_once( __DIR__ . '/widgets/product-category.php' );
        $widgets_manager->register( new \moboland_product_category() );

        require_once( __DIR__ . '/widgets/product-amazing.php' );
        $widgets_manager->register( new \moboland_product_amazing() );

        require_once( __DIR__ . '/widgets/product-category2.php' );
        $widgets_manager->register( new \moboland_product_category2() );

        require_once( __DIR__ . '/widgets/product-category3.php' );
        $widgets_manager->register( new \moboland_product_category3() );

        require_once( __DIR__ . '/widgets/product-category4.php' );
        $widgets_manager->register( new \moboland_product_category4() );

        require_once( __DIR__ . '/widgets/brand-slider.php' );
        $widgets_manager->register( new \moboland_brand_slider() );

        require_once( __DIR__ . '/widgets/blog.php' );
        $widgets_manager->register( new \moboland_blog_slider() );

        require_once( __DIR__ . '/widgets/best-sell.php' );
        $widgets_manager->register( new \moboland_best_sell() );

        require_once( __DIR__ . '/widgets/special-product.php' );
        $widgets_manager->register( new \moboland_special_product() );

        require_once( __DIR__ . '/widgets/stories.php' );
        $widgets_manager->register( new \moboland_stories() );

    }
}


//اضافه کردن دسته بندی به المنتور برای ویجت ها به عنوان مثال اختصاصی موبولند
if (!function_exists('add_elementor_widget_categories')) {
    function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'moboland_widgets',
            [
                'title' => esc_html__('المانهای اختصاصی موبولند', 'textdomain'),
                'icon' => 'fa fa-plug',
            ]
        );
    }
}

// مطمئن‌ترین روش
add_action('init', function () {
    if (did_action('elementor/loaded')) {
        add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');
    }
});
