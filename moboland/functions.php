<?php

global $options;
$options = get_option('options');

require_once __DIR__ . '/activatezhk/validate-locked.php';


add_action('wp_enqueue_scripts', 'add_theme_scripts');
function add_theme_scripts()
{
    wp_enqueue_style('all', get_template_directory_uri() . '/css/all.min.css', array(), false, 'all');
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), false, 'all');
    wp_enqueue_style('owl.theme', get_template_directory_uri() . '/css/owl.theme.default.min.css', array(), false, 'all');
    wp_enqueue_style('zuck', get_template_directory_uri() . '/css/zuck.css', array(), false, 'all');
    wp_enqueue_style('snapgram', get_template_directory_uri() . '/css/snapgram.css', array(), false, 'all');
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), false, 'all');

    wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('wallet', get_template_directory_uri() . '/include/wallet/wallet.js', array('jquery'), false, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true);

    wp_localize_script('main', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}


function load_login_scripts()
{
    wp_enqueue_script('login-ajax', get_template_directory_uri() . '/js/login.js', array('jquery'), null, true);
    wp_localize_script('login-ajax', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'load_login_scripts');


add_action('admin_enqueue_scripts', 'admin_custom_style');
function admin_custom_style()
{
    wp_enqueue_style('admin_style', get_template_directory_uri() . '/css/admin-style.css', array(), false, 'all');
}

add_action('elementor/editor/before_enqueue_styles', 'elementor_costum_styles');
function elementor_costum_styles()
{

    wp_register_style('elementor-custom', get_stylesheet_directory_uri() . '/css/elementor-custom.css');
    wp_enqueue_style('elementor-custom');
}


add_action('after_setup_theme', 'moboland_setup_theme');
function moboland_setup_theme()
{
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');


    register_nav_menus(
        array(
            'main-menu' => __('جایگاه نمایش منوی اصلی'),
            'mega-menu' => __('جایگاه نمایش منوی دسته بندی')
        )
    );
}


add_action('widgets_init', 'moboland_sidebar');
function moboland_sidebar()
{
    register_sidebar(array(
        'name' => __('ناحیه کناری پست ها '),
        'id' => 'moboland_blog',
        'description' => __('ابزارک های این ناحیه در قسمت سایدبار نوشته ها نمایش داده می شود'),
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="widget-header"><h3>',
        'after_title' => '</h3></div>',
    ));

    register_sidebar(array(
        'name' => __('ناحیه کناری صفحه آرشیو فروشگاه '),
        'id' => 'moboland_shop',
        'description' => __('ابزارک های این ناحیه در قسمت سایدبار صفحه فروشگاه نمایش داده می شود'),
        'before_widget' => '<div id="%1$s" class="%2$s widget "><div class="widget-shop">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="widget-header"><h3>',
        'after_title' => '</h3></div>',
    ));

    register_sidebar(array(
        'name' => __('فوتر شماره 1'),
        'id' => 'moboland_footer_one',
        'description' => __('ابزارک های این ناحیه در قسمت فوتر در تاحیه اول سمت راست نمایش داده می شود'),
        'before_widget' => '<div class="f-w-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('فوتر شماره 2'),
        'id' => 'moboland_footer_two',
        'description' => __('ابزارک های این ناحیه در قسمت فوتر در تاحیه دوم سمت راست نمایش داده می شود'),
        'before_widget' => '<div class="f-w-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('فوتر شماره 3'),
        'id' => 'moboland_footer_three',
        'description' => __('ابزارک های این ناحیه در قسمت فوتر در تاحیه سوم سمت راست نمایش داده می شود'),
        'before_widget' => '<div class="f-w-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('فوتر شماره 4'),
        'id' => 'moboland_footer_four',
        'description' => __('ابزارک های این ناحیه در قسمت فوتر در تاحیه چهارم سمت راست نمایش داده می شود'),
        'before_widget' => '<div class="f-w-content">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));

}

function custom_excerpt_length()
{
    return 35;
}

add_action('excerpt_length', 'custom_excerpt_length');


//ajax add-to-cart
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <span class="cart-btn-num">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php $fragments['.cart-btn-num'] = ob_get_clean();
    return $fragments;
});
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <div class="cart-content">
        <?php woocommerce_mini_cart(); ?>
    </div>
    <?php $fragments['.cart-content'] = ob_get_clean();
    return $fragments;
});


//دو تا تگ اول سفحه محصول حذف می شود
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//اضافه کردن تگ دیو کانترینر
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start()
{
    echo '<div class="container">';
}

function my_theme_wrapper_end()
{
    echo '</div>';
}

// حذف سایدبار صفحه تک محصول
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// حذف علامت تخفیف صفحه تک محصول
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// حذف محصولات مرتبط در صفحه تک محصول
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

//حذف قیمت و دکمه افزودن به سبد خرید در صفحه محصولات متغیر
remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 10);


//حذف محصولات پیشنهادی در سبد خرید
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);


// اضافه کردن دکمه کم و زیاد کردم تعداد محصولات در صفحه تک محصول
add_action('woocommerce_before_quantity_input_field', 'moboland_woocommerce_before_quantity_input_field');
add_action('woocommerce_after_quantity_input_field', 'moboland_woocommerce_after_quantity_input_field');
function moboland_woocommerce_before_quantity_input_field()
{
    echo '<button class="plus" type="button">+</button>';
}

function moboland_woocommerce_after_quantity_input_field()
{
    echo '<button class="minus" type="button">-</button>';
}

//حذف هدینگ تب توضیحات برگه محصول
add_filter('woocommerce_product_description_heading', '__return_null');
add_filter('woocommerce_product_additional_information_heading', '__return_null');

//اضافه کردن تب به صفحه داخلی محصول
add_filter('woocommerce_product_tabs', 'woocommerce_product_cross_sell_tab');
function woocommerce_product_cross_sell_tab($tabs)
{
    $cross_id = get_post_meta(get_the_ID(), '_crosssell_ids', true);
    if ($cross_id) {
        $tabs['cross_sell_tab'] = array(
            'title' => __('محصولات مکمل', 'woocommerce'), // TAB TITLE
            'priority' => 20, // TAB SORTING (DESC 10, ADD INFO 20, REVIEWS 30)
            'callback' => 'woocommerce_product_cross_sell_tab_content', // TAB CONTENT CALLBACK
        );

    }
    return $tabs;
}

function woocommerce_product_cross_sell_tab_content()
{

    $cross_id = get_post_meta(get_the_ID(), '_crosssell_ids', true);
    $cross_product = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => 6,
        'no_found_rows' => true,
        'post__in' => $cross_id,
    ));
    if ($cross_product->have_posts()) { ?>

        <div class="other-sell">
            <?php
            while ($cross_product->have_posts()) : $cross_product->the_post(); ?>

                <div class="product-item">
                    <figure>
                        <a href="<?php the_permalink(); ?>"> <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail();
                            } else {
                                ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                            }
                            ?></a>
                    </figure>
                    <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php the_title(); ?></a></h2>

                    <?php
                    global $product;
                    if ($product->is_in_stock() && $product->get_price_html()) { ?>

                        <div class="price">

                            <?php echo $product->get_price_html(); ?>

                        </div>

                    <?php } elseif (!$product->is_in_stock()) {
                        echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                    } else {
                        echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                    } ?>
                </div>

            <?php
            endwhile; ?>
        </div>
        <?php
    }
    wp_reset_postdata();

}


// کدهای مربوط به درصد تخفیف
function moboland_wooocmmerce_discount($product_id) {
    $product = wc_get_product($product_id);

    if (!$product) {
        return 0;
    }

    // ✅ محصولات ساده
    if ($product->is_type('simple')) {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = $product->get_sale_price();

        if ($regular_price > 0 && $sale_price !== '' && $sale_price !== null && $sale_price !== false && (float)$sale_price < $regular_price) {
            $discount = (($regular_price - (float)$sale_price) / $regular_price) * 100;
            return (int) ceil($discount);
        }

        // ✅ محصولات متغیر
    } elseif ($product->is_type('variable')) {
        $variations = $product->get_available_variations();
        $max_discount = 0;

        foreach ($variations as $variation_data) {
            $regular = floatval($variation_data['display_regular_price']);
            $sale    = floatval($variation_data['display_price']);

            if ($regular > 0 && $sale < $regular) {
                $discount = (($regular - $sale) / $regular) * 100;
                $discount = ceil($discount);
                if ($discount > $max_discount) {
                    $max_discount = $discount;
                }
            }
        }

        return $max_discount;
    }

    return 0;
}



// اضافه کردن تاکسونومی برند برای محصولات
add_action('init', 'create_brands_for_product');
function create_brands_for_product()
{
    $labels = array(
        'name' => _x('برندها', 'برندها'),
        'singular_name' => _x('برندها', 'برندها'),
        'search_items' => __('جستجویه برند'),
        'all_items' => __('تمام برندها'),
        'parent_item' => __('زیر برند'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item' => __('ویرایش برند'),
        'update_item' => __('بروزرسانی برند'),
        'add_new_item' => __('افزودن برند جدید'),
        'new_item_name' => __('نام جدید برند'),
        'menu_name' => __('برندها'),
    );

    $br = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    );

    register_taxonomy('product_brand', 'product', $br);
}

//حذف پیغامهای ووکامرس در بالای صفحه آرشیو محصولات
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
//اضافه کردن پیغامها زیر بردکرامپ صفحه آرشیو محصولات
add_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 10);


//اضافه کردن تک به قبل و بعد از دو المان داخل صفحه myaccount
add_action('woocommerce_before_account_navigation', 'my_div_add_myaccount_start');
add_action('woocommerce_account_content', 'my_div_add_myaccount_end');
function my_div_add_myaccount_start()
{
    echo '<div class="hero-myaccount">';
}

function my_div_add_myaccount_end()
{
    echo '</div>';
}


// add the ajax fetch js
add_action('wp_footer', 'fetch_ajax');
function fetch_ajax()
{
    ?>
    <script type="text/javascript">
        (function ($) {
            document.addEventListener('DOMContentLoaded', function () {
                const $inputs = $('.ajax-search');
                if (!$inputs.length) return;

                $inputs.each(function () {
                    const $input = $(this);
                    let typingTimer;
                    const doneTypingInterval = 300;

                    $input.on('keyup', function () {
                        clearTimeout(typingTimer);
                        const query = $input.val();
                        if (query.length > 2) {
                            typingTimer = setTimeout(function () {
                                $('.loader-ajax-search').addClass('show');
                                $('.content-ajax-search').addClass('show');
                                $.ajax({
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    type: 'post',
                                    data: {
                                        action: 'data_fetch',
                                        keyword: query
                                    },
                                    success: function (data) {
                                        $('#datafetch').html(data);
                                    }
                                });
                            }, doneTypingInterval);
                        } else {
                            $('#datafetch').empty().removeClass('show');
                            $('.loader-ajax-search').removeClass('show');
                        }
                    });
                });
            });
        })(jQuery);
    </script>
    <?php
}




// the ajax function
add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');
function data_fetch()
{
    $the_query = new WP_Query(array('posts_per_page' => 5, 's' => esc_attr($_POST['keyword']), 'post_type' => array('product')));
    if ($the_query->have_posts()) :?>
        <ul>
            <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        echo(has_post_thumbnail() ? get_the_post_thumbnail(get_the_id(), array(200, 200), array('class' => 'main-img')) : wc_placeholder_img('woocommerce_thumbnail'));
                        ?>
                        <div>
                            <h3><?php the_title(); ?></h3>
                            <?php global $product;
                            echo $product->get_price_html(); ?>
                        </div>
                    </a>

                </li>
            <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata();
    else: ?>
        <div class="not-fount-search">
            <img src="<?php echo get_template_directory_uri(); ?>/img/not-found-serach.png">
            <p>متاسفانه چیزی پیدا نکردم</p>
        </div>
    <?php endif;

    die();
}


//اضافه کردن پلاگین لیست علاقمندی ها به قالب
\c824f44c901edf1412f2853bf0149b::b4109662b77214b650e69f17983b21fa();

function wishlist()
{
    if (!function_exists('woosw_init') && class_exists('WooCommerce')) {
        require_once 'include/classes/woo-smart-wishlist/wpc-smart-wishlist.php';
        woosw_init();
    }
}


////اضافه کردن پلاگین سوئیچ رنگ هاا به قالب
\c824f44c901edf1412f2853bf0149b::e53544cf00da9877bb72bd3ded84f();
function swatches_load()
{
    if (!class_exists('Woo_Variation_Swatches') && class_exists('WooCommerce')) {
        require_once 'include/classes/swatches/woo-variation-swatches.php';
        woo_variation_swatches();
    }

}

//اضافه کردن پلاگین acf به قالب
// Check if another plugin or theme has bundled ACF
if (defined('MY_ACF_PATH')) {
    return;
}

// Define path and URL to the ACF plugin.
define('MY_ACF_PATH', get_stylesheet_directory() . '/include/classes/acf/');
define('MY_ACF_URL', get_stylesheet_directory_uri() . '/include/classes/acf/');

// Include the ACF plugin.
include_once 'include/classes/acf/acf.php';

// Customize the URL setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url($url)
{
    return MY_ACF_URL;
}

// Check if ACF free is installed
if (!file_exists(WP_PLUGIN_DIR . '/advanced-custom-fields/acf.php')) {
    // Free plugin not installed
    // Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', '__return_false');
    // Hide the ACF Updates menu
    add_filter('acf/settings/show_updates', '__return_false', 100);
}

//اضافه کردن افزونه tgm plugins
require_once 'include/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'my_theme_register_required_plugins');

function my_theme_register_required_plugins()
{
    $plugins = array(
        array(
            'name' => 'المنتور', // The plugin name.
            'slug' => 'elementor', // The plugin slug (typically the folder name).
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name' => 'ووکامرس', // The plugin name.
            'slug' => 'woocommerce', // The plugin slug (typically the folder name).
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
        ),
        array(
            'name' => 'ووکامرس فارسی', // The plugin name.
            'slug' => 'persian-woocommerce', // The plugin slug (typically the folder name).
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
        ),
    );

    $config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}


// ثبت پست تایپ پروژه ها
add_action('init', 'post_type_project');
function post_type_project()
{
    $labels = array(
        'name' => __('نمونه کارها'),
        'singular_name' => __('نمونه کارها'),
        'menu_name' => __('نمونه کارها'),
        'name_admin_bar' => __('نمونه کارها'),
        'add_new' => __(' افزودن جدید'),
        'add_new_item' => __('افزودن پست نمونه کارها'),
        'new_item' => __('پست جدید'),
        'edit_item' => __('ویرایش پست'),
        'view_item' => __('مشاهده پست'),
        'all_items' => __('همه پست ها'),
        'search_items' => __('جستجو در بین پست ها'),
        'parent_item_colon' => __('مادر'),
        'not_found' => __('مطلب یافت نشد'),
        'not_found_in_trash' => __('مطلب در زباله دان یافت نشد')
    );
    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,

        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'taxonomies' => array('post_tag'),
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'excerpt'),
    );
    register_post_type('projects', $args);
}

// اضافه کردن تاکسونومی برای پست تایپ پروژه ها
add_action('init', 'create_taxonomies_for_projects');
function create_taxonomies_for_projects()
{
    $labels = array(
        'name' => _x('دسته بندی', 'دسته بندی'),
        'singular_name' => _x('دسته بندی پست ها ', 'دسته بندی'),
        'search_items' => __('جستجویه دسته'),
        'all_items' => __('تمام دسته ها'),
        'parent_item' => __('زیر دسته'),
        'parent_item_colon' => __('Parent Genre:'),
        'edit_item' => __('ویرایش دسته'),
        'update_item' => __('بروزرسانی دسته'),
        'add_new_item' => __('افزودن دسته جدید'),
        'new_item_name' => __('نام جدید دسته'),
        'menu_name' => __('دسته بندی'),
    );

    $ar = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
    );

    register_taxonomy('cat_moboland_projects', 'projects', $ar);
}


// کوتاه کردن تیتر به 50 کاراکتر و اضافه کردن "..." در انتها
function custom_title($post_id = null)
{
    if (is_null($post_id)) {
        $post_id = get_the_ID();
    }

    $title = get_the_title($post_id);

    // تشخیص انکودینگ رشته
    $encoding = mb_detect_encoding($title, mb_list_encodings(), true);

    if ($encoding) {
        if (mb_strlen($title, $encoding) > 50) {

            $title = mb_substr($title, 0, 50, $encoding) . '...';
        }
    } else {
        if (mb_strlen($title, 'UTF-8') > 50) {
            $title = mb_substr($title, 0, 50, 'UTF-8') . '...';
        }
    }

    return $title;
}

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('product')) {
        if (isset($_GET['sale_filter']) && $_GET['sale_filter'] == 1) {

            // گرفتن شناسه تمام محصولات حراجی
            $sale_products_ids = wc_get_product_ids_on_sale();

            // اگر محصولی در حراج هست، فیلترش کن
            if (!empty($sale_products_ids)) {
                $query->set('post__in', $sale_products_ids);
            } else {
                // اگر هیچ محصولی در حراج نبود، خروجی رو خالی کن
                $query->set('post__in', array(0));
            }
        }
    }
});



// شورت‌کد [sale_products_link] برای تولید لینک داینامیک محصولات در حراج
add_shortcode('sale_products_link', function () {
    // تولید URL کامل برای /shop?sale_filter=1
    $url = home_url('/shop?sale_filter=1');
    // لینک HTML خروجی
    return '<a href="' . esc_url($url) . '">🛍️ محصولات در حراج</a>';
});



add_filter( 'woocommerce_pagination_args', 'custom_woocommerce_pagination_texts' );
function custom_woocommerce_pagination_texts( $args ) {
    $args['prev_text'] = '<span>قبلی</span>';
    $args['next_text'] = '<span>بعدی</span>';
    return $args;
}





//اضافه کردن فریم ورک استارکد
require_once get_theme_file_path() . '/include/codestar-framework/codestar-framework.php';
// اضافه کردن فایل تنظیمات برای فریم ورک استارکد
require_once 'include/moboland-options.php';
// اضافه کردن بردکرامپ به بالای مطالب
require_once 'include/breadcrumb.php';
// تغییرات فایل کامنت محصولات
require_once 'include/comments-pro-moboland.php';
// اضافه کردن فایل استایل شخصی سازی برای پنل تنظیمات قالب
require_once 'include/custom-style.php';
//اضافه کردن ویجت های شخصی المنتور به قالب
require_once 'elementor/moboland-elementor.php';
//اضافه کردن فیلدهای acf به قالب
require_once 'include/acf-fields.php';

//اضافه کردن تنظیمات منوی smsir به قالب
require_once 'include/SMSIRApp/smsir-settings-moboland.php';

// اضافه کردن ملی پیامک به قالب
require_once 'include/mellipayamak/mellipayamak.php';
require_once 'include/mellipayamak/mellipayamak-settings.php';
require_once 'include/mellipayamak/mellipayamak-ajax.php';

//اضافه کردن فیلد کد پیگیری به قالب
require_once 'include/order-tracking/order-tracking.php';


if ($options['active_wallet_cash_back']) {
    require_once 'include/wallet/wallet.php';
    require_once 'include/wallet/wallet-hooks.php';

    require_once get_template_directory() . '/include/cashback/cashback-settings.php';
    require_once get_template_directory() . '/include/cashback/cashback-hooks.php';
    require_once get_template_directory() . '/include/cashback/cashback-functions.php';
    require_once get_template_directory() . '/include/cashback/cart-hooks-cashback.php';
}


// اضافه کردن مقایسه به قالب
require_once get_template_directory() . '/include/compare/init.php';



































