<?php
// جلوگیری از دسترسی مستقیم
defined('ABSPATH') || exit;

/**
 * افزودن مبلغ به کیف پول کاربر پس از پرداخت موفق
 */
add_action('woocommerce_payment_complete', 'wallet_update_on_payment_success');

function wallet_update_on_payment_success($order_id) {
    $order = wc_get_order($order_id);

    // بررسی اینکه سفارش مربوط به شارژ کیف پوله
    if ( ! $order || ! $order->get_meta('is_wallet_topup') ) {
        return;
    }

    $user_id = $order->get_user_id();
    $amount  = floatval($order->get_meta('wallet_topup_amount'));

    if ( $user_id && $amount > 0 ) {
        global $wpdb;

        // جدول موجودی
        $wallet_table = $wpdb->prefix . 'user_wallet';

        // جدول تاریخچه تراکنش‌ها
        $transactions_table = $wpdb->prefix . 'user_wallet_transactions';

        // بررسی موجودی فعلی
        $existing = $wpdb->get_var( $wpdb->prepare(
            "SELECT balance FROM $wallet_table WHERE user_id = %d", $user_id
        ));

        if ( $existing !== null ) {
            // افزایش موجودی
            $wpdb->query( $wpdb->prepare(
                "UPDATE $wallet_table SET balance = balance + %f WHERE user_id = %d",
                $amount, $user_id
            ));
        } else {
            // ایجاد رکورد جدید
            $wpdb->insert($wallet_table, [
                'user_id' => $user_id,
                'balance' => $amount
            ]);
        }

        // 🟢 ثبت تراکنش در جدول تاریخچه
        $wpdb->insert(
            $transactions_table,
            [
                'user_id'    => $user_id,
                'amount'     => $amount,
                'type'       => 'topup',
                'status'     => 'success',
                'created_at' => current_time('mysql')
            ]
        );

        // یادداشت سفارش
        $order->add_order_note('مبلغ ' . number_format($amount) . ' تومان به کیف پول کاربر افزوده شد.');
        $order->save();

        // ✅ ریدایرکت به تب کیف پول در پنل کاربری با پیام موفقیت
        if ( is_user_logged_in() && ! wp_doing_ajax() ) {
            $redirect_url = add_query_arg([
                'wallet_status' => 'success',
                'amount'        => intval($amount),
            ], wc_get_account_endpoint_url('wallet'));

            wp_safe_redirect($redirect_url);
            exit;
        } 
    }
}



add_action('woocommerce_order_status_processing', 'auto_complete_wallet_topup_orders');
function auto_complete_wallet_topup_orders($order_id) {
    $order = wc_get_order($order_id);

    if ( ! $order || ! $order->get_meta('is_wallet_topup') ) {
        return;
    }

    // اگر سفارش برای شارژ کیف پوله، تکمیلش کن
    $order->update_status('completed');
}

add_action('init', 'wallet_register_account_endpoint');
function wallet_register_account_endpoint() {
    add_rewrite_endpoint('wallet', EP_ROOT | EP_PAGES);
}


add_action('woocommerce_account_wallet_endpoint', 'wallet_tab_content');
function wallet_tab_content() {
    include get_template_directory() . '/include/wallet/wallet-tab-content.php';
}



add_filter('woocommerce_account_menu_items', 'wallet_add_to_account_menu');
function wallet_add_to_account_menu($items) {
    $items['wallet'] = 'کیف پول من';
    return $items;
}


// نمایش موجودی کیف پول بالای درگاهها در صفحه تسویه حساب
add_action('woocommerce_review_order_before_payment', 'wallet_show_balance_before_payment_gateways');

function wallet_show_balance_before_payment_gateways() {
    if ( ! is_user_logged_in() ) return;

    global $wpdb;
    $user_id = get_current_user_id();
    $table = $wpdb->prefix . 'user_wallet';

    $balance = $wpdb->get_var( $wpdb->prepare(
        "SELECT balance FROM $table WHERE user_id = %d", $user_id
    ));

    $balance = $balance ? floatval($balance) : 0;

    echo '<div class="wallet-checkout-info" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">';
    echo '<strong>موجودی کیف پول شما: </strong>';
    echo '<span style="color:#007cba; font-weight:bold;" id="wallet-balance">' . number_format($balance) . ' تومان</span>';

     if ( $balance > 0 ) : ?>
        <br><br>
        <button type="button" class="button alt" id="use-wallet-btn" data-balance="<?php echo esc_attr($balance); ?>">
            استفاده از اعتبار کیف پول
        </button>

         <!-- دکمه بازگشت اعتبار کیف پول (مخفی به طور پیش‌فرض) -->
         <button type="button" class="button alt" id="refund-wallet-btn" style="display: none; background-color: red; color: white;">
             بازگشت اعتبار کیف پول
         </button>

        <!-- لودر -->
        <div id="wallet-loader" style="display:none; margin-top:10px;">
            <span class="loading-text">در حال اعمال اعتبار کیف پول...</span>
        </div>

        <!-- نمایش مبلغ مابه‌التفاوت -->
        <div id="wallet-deduction-result" style="margin-top:10px; font-weight:bold; display: none;"></div>

        <!-- پیام موفقیت‌آمیز -->
        <div id="wallet-success-message" style="margin-top:10px; font-weight:bold; color: green; display: none;"></div>
    <?php endif;



    echo '<input type="hidden" name="wallet_used_amount" id="wallet_used_amount_field" value="0">';

    echo '</div>';
}



//درسافت مقدار در php
// ذخیره مقدار استفاده‌شده از کیف پول در سشن از طریق Ajax
add_action('wp_ajax_set_wallet_usage', 'set_wallet_usage_ajax');
add_action('wp_ajax_nopriv_set_wallet_usage', '__return_false');

function set_wallet_usage_ajax() {
    // فقط کاربران وارد شده اجازه دارند
    if ( ! is_user_logged_in() ) {
        wp_send_json_error(['message' => 'دسترسی غیرمجاز']);
    }

    // بررسی و اعتبارسنجی مقدار
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

    if ( $amount <= 0 ) {
        wp_send_json_error(['message' => 'مقدار نامعتبر است']);
    }

    // ذخیره در سشن ووکامرس
    WC()->session->set('wallet_used_amount', $amount);

    // پاسخ موفق
    wp_send_json_success([
        'stored_amount' => $amount,
        'message' => 'مقدار با موفقیت ذخیره شد'
    ]);
}







//اعمال این مبلغ در فاکتور
add_action('woocommerce_cart_calculate_fees', 'wallet_apply_discount_fee', 20, 1);

function wallet_apply_discount_fee($cart) {
    if ( is_admin() && ! defined('DOING_AJAX') ) return; // جلوگیری از اجرا در صفحه مدیریت

    if ( ! is_user_logged_in() ) return; // فقط برای کاربرانی که وارد شده‌اند

    $used_wallet = WC()->session->get('wallet_used_amount');

    // اگر در ادمین بودیم و سشن نبود، از meta سفارش بگیر
    if ( ! $used_wallet && is_admin() && isset($_GET['post']) ) {
        $order = wc_get_order( absint($_GET['post']) );
        if ( $order ) {
            $used_wallet = $order->get_meta('wallet_used_amount');
        }
    }

    if ( $used_wallet && $used_wallet > 0 ) {

        // بررسی اینکه قبلاً این fee اضافه شده باشه
        $fee_applied = false;
        foreach ( $cart->get_fees() as $fee ) {
            if ( $fee->name === 'کسر از اعتبار کیف پول' ) {
                $fee_applied = true;
                break;
            }
        }

        // فقط اگر fee قبلاً اعمال نشده باشه، مقدار جدید رو اضافه کن
        if ( ! $fee_applied ) {
            $cart->add_fee('کسر از اعتبار کیف پول', -$used_wallet, false);
        }
    }
}




add_action('woocommerce_checkout_create_order', 'adjust_order_total_with_wallet', 20, 2);

function adjust_order_total_with_wallet($order, $data) {
    if ( ! is_user_logged_in() ) return;

    $used_wallet = WC()->session->get('wallet_used_amount');
    if ( ! $used_wallet || $used_wallet <= 0 ) return;

    // فقط ذخیره در متا برای دسترسی بعدی
    $order->update_meta_data('wallet_used_amount', $used_wallet);

    // بررسی اینکه اگر کل سفارش با کیف پول پوشش داده شده، پرداخت نیاز نیست
    $total = $order->get_total(); // در این مرحله مقدار صحیح، بعد از fee اعمال شده
    if ( $total <= 0 ) {
        $order->set_payment_method_title('پرداخت با کیف پول');
        $order->set_payment_method( '' ); // بدون درگاه
    }
}




//ذخیره مقدار استفاده شده از کیف پول در جزئیات سفارش
add_action('woocommerce_checkout_create_order', 'save_wallet_usage_in_order', 20, 2);

function save_wallet_usage_in_order($order, $data) {
    $used_wallet = WC()->session->get('wallet_used_amount');
    if ($used_wallet > 0) {
        $order->update_meta_data('wallet_used_amount', $used_wallet);
    }
}





add_filter('woocommerce_admin_order_totals_after_total', 'admin_wallet_deduction_order_totals_row');

function admin_wallet_deduction_order_totals_row($order_id) {
    $order = wc_get_order($order_id);
    $used_wallet = $order->get_meta('wallet_used_amount');

    if ( $used_wallet && $used_wallet > 0 ) {
        ?>
        <tr>
            <td class="label">کسر از کیف پول:</td>
            <td width="1%"></td>
            <td class="total">
                <span class="woocommerce-Price-amount amount" style="color: red; font-weight: bold;">
                    <?php echo '-' . number_format($used_wallet) . ' تومان'; ?>
                </span>
            </td>
        </tr>
        <?php
    }
}




add_action('woocommerce_payment_complete', 'wallet_reduce_after_payment');
add_action('woocommerce_order_status_completed', 'wallet_reduce_after_payment');

function wallet_reduce_after_payment($order_id) {
    $order = wc_get_order($order_id);
    if ( ! $order ) return;

    $user_id = $order->get_user_id();
    $used_wallet = floatval($order->get_meta('wallet_used_amount'));

    if ( $user_id && $used_wallet > 0 ) {
        global $wpdb;

        $wallet_table = $wpdb->prefix . 'user_wallet';
        $history_table = $wpdb->prefix . 'user_wallet_transactions';

        // ✅ کسر از موجودی کیف پول
        $wpdb->query($wpdb->prepare(
            "UPDATE $wallet_table SET balance = balance - %f WHERE user_id = %d",
            $used_wallet, $user_id
        ));

        // ✅ ثبت تراکنش در جدول تاریخچه
        $wpdb->insert($history_table, [
            'user_id'    => $user_id,
            'amount'     => -$used_wallet, // منفی چون از کیف پول کسر شده
            'type'       => 'کسر بابت خرید',       // یا مثلاً 'purchase'
            'status'     => 'success',
            'created_at' => current_time('mysql'),
        ]);
    }

    // پاک‌سازی سشن
    if ( isset(WC()->session) && WC()->session instanceof WC_Session ) {
        WC()->session->__unset('wallet_used_amount');
    }
}







add_action('wp_ajax_refund_wallet_usage', 'refund_wallet_usage');
add_action('wp_ajax_nopriv_refund_wallet_usage', 'refund_wallet_usage');

function refund_wallet_usage() {
    // فقط کاربران وارد شده اجازه دارند
    if ( ! is_user_logged_in() ) {
        wp_send_json_error(['message' => 'دسترسی غیرمجاز']);
    }

    // پاک کردن اعتبار از سشن
    if ( isset(WC()->session) && WC()->session instanceof WC_Session ) {
        WC()->session->__unset('wallet_used_amount');
    }

    // ارسال پاسخ موفقیت
    wp_send_json_success(['message' => 'اعتبار با موفقیت بازگشت داده شد']);
}



