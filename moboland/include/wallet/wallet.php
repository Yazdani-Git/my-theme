<?php

function custom_wallet_activation() {
    global $wpdb;

    // جدول موجودی کیف پول
    $table_name = $wpdb->prefix . 'user_wallet';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            balance decimal(10,2) NOT NULL DEFAULT 0.00,
            PRIMARY KEY  (id),
            UNIQUE KEY user_id (user_id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    // جدول تاریخچه تراکنش‌ها
    $table_name2 = $wpdb->prefix . 'user_wallet_transactions';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name2'") != $table_name2) {
        $charset_collate = $wpdb->get_charset_collate();
        $sql2 = "CREATE TABLE $table_name2 (
            id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT(20) NOT NULL,
            amount DECIMAL(10,2) NOT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            type VARCHAR(50) DEFAULT 'topup',
            status VARCHAR(20) DEFAULT 'success',
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql2);
    }
}
add_action('after_setup_theme', 'custom_wallet_activation');

//ایجاد برگه تسویه حساب شارژ کیف پول
add_action('after_setup_theme', 'ensure_wallet_process_page_exists');

function ensure_wallet_process_page_exists() {
    $page_title = 'Wallet Process'; // عنوان برگه
    $page_slug  = 'wallet-process'; // slug برای URL
    $template   = 'page-wallet-process.php'; // نام فایل قالب

    // بررسی وجود برگه با این slug
    $existing = get_page_by_path($page_slug);

    // اگر برگه وجود ندارد یا در وضعیت trash باشد
    if ( ! $existing || $existing->post_status === 'trash' ) {

        // اگر برگه در trash باشد، پاکش کن
        if ( $existing && $existing->post_status === 'trash' ) {
            wp_delete_post($existing->ID, true); // حذف کامل
        }

        // ساخت برگه جدید
        $page_id = wp_insert_post([
            'post_title'     => $page_title,
            'post_name'      => $page_slug,
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '', // محتوای خاصی نمی‌خواد چون قالب اعمال میشه
            'page_template'  => $template,
        ]);

        // ذخیره شناسه برای مراجعات بعدی (اختیاری)
        if ( $page_id && ! is_wp_error($page_id) ) {
            update_option('wallet_process_page_id', $page_id);
        }
    }
}



// ایجاد محصول مجازی کیف پول
function create_wallet_product_on_theme_activation() {
    $product_id = get_option('wallet_virtual_product_id');

    if ( empty($product_id) || get_post_status($product_id) !== 'publish' ) {
        $product = new WC_Product_Simple();
        $product->set_name('شارژ کیف پول');
        $product->set_status('publish');
        $product->set_catalog_visibility('hidden');
        $product->set_price(1);
        $product->set_regular_price(1);
        $product->set_virtual(true);
        $product->set_downloadable(true);
        $product->save();

        update_option('wallet_virtual_product_id', $product->get_id());

    } else {
        $product = wc_get_product($product_id);

        if ( $product && is_a($product, 'WC_Product') ) {
            $product->set_catalog_visibility('hidden');
            $product->save();
        }
    }
}
add_action('init', 'create_wallet_product_on_theme_activation');


// مخفی کردن محصول شارژ کیف پول از فروشگاه
add_action('pre_get_posts', 'exclude_wallet_product_from_all_queries');
function exclude_wallet_product_from_all_queries($query) {
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive('product') && ! is_page() && ! is_front_page() && ! is_home() ) {
        return;
    }

    $wallet_product_id = get_option('wallet_virtual_product_id');
    if ( $wallet_product_id ) {
        $post__not_in = $query->get('post__not_in') ?: array();
        $post__not_in[] = $wallet_product_id;
        $query->set('post__not_in', $post__not_in);
    }
}





