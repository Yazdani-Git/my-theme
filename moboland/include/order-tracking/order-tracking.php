<?php




// افزودن فیلد "کد پیگیری" به پنل مدیریت سفارش
add_action('woocommerce_admin_order_data_after_shipping_address', 'add_tracking_code_field_to_admin_order', 10, 1);
function add_tracking_code_field_to_admin_order($order){
    woocommerce_wp_text_input( array(
        'id' => '_tracking_code',
        'label' => 'کد پیگیری پستی:',
        'placeholder' => 'مثال 123456',
        'description' => 'کد رهگیری پستی را در فیلد بالا وارد کنید.',
        'value' => get_post_meta($order->get_id(), '_tracking_code', true)
    ));
}

// ذخیره کردن کد پیگیری
add_action('woocommerce_process_shop_order_meta', 'save_tracking_code_field_in_order');
function save_tracking_code_field_in_order($post_id){
    $tracking_code = isset($_POST['_tracking_code']) ? sanitize_text_field($_POST['_tracking_code']) : '';
    update_post_meta($post_id, '_tracking_code', $tracking_code);
}


// نمایش کد پیگیری در صفحه سفارشات حساب کاربری
add_action('woocommerce_order_details_after_order_table', 'display_tracking_code_in_order_details', 10, 1);

function display_tracking_code_in_order_details($order){
    // دریافت کد پیگیری از متا داده سفارش
    $tracking_code = get_post_meta($order->get_id(), '_tracking_code', true);

    // اگر کد پیگیری وجود داشت، نمایش بده
    if (!empty($tracking_code)) {
        echo '<p class="peygiri"><strong>' . __('کد پیگیری پستی بسته شما:', 'text-domain') . '</strong> ' . esc_html($tracking_code) . '</p>';
    } else {
        echo '<p class="peygiri"><strong>((بسته شما هنوز تحویل پست نشده است))</strong>برای کسب اطلاعات بیشتر می توانید با پشتیبانی سایت تماس بگیرید</p>';
    }
}


