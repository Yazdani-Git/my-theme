<?php


/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */


$options = get_option('options');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
);
?>
<?php
global $current_user;
?>








    <section class="myaccount-detail">

        <?php if ($options['active_register_time']) { ?>
            <div class="item-detail">
                <i class="fa-regular fa-clock"></i>
                <div class="item-content">
                    <h6>عضویت شما</h6>
                    <div>
                        <?php
                        $register = $current_user->user_registered;
                        date_default_timezone_set("Asia/Tehran");
                        $now = time() - 3600;
                        $in = strtotime($register) + 12600;
                        echo '<span>' . human_time_diff($in, $now) . ' ' . __('قبل', 'moboland') . '</span>';
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($options['active_total_payment']) { ?>
            <div class="item-detail">
                <i class="fa-solid fa-cart-flatbed"></i>
                <div class="item-content">
                    <h6>مجموع سفارشات</h6>
                    <div>
                        <?php
                        $user_id = get_current_user_id();
                        $total_paid = wc_get_customer_total_spent($user_id) - '0.00';
                        echo '<span>' . $total_paid . "تومان" . '</span>';
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($options['active_total_comments']) { ?>
            <div class="item-detail">
                <i class="fa-regular fa-comments"></i>
                <div class="item-content">
                    <h6>دیدگاه های شما</h6>
                    <div>
                        <?php
                        global $wpdb;
                        $userId = $current_user->ID;
                        $where = 'WHERE comment_approved = 1 AND user_id = ' . $userId;
                        $comment_count = $wpdb->get_var("SELECT COUNT( * ) AS total 
                    FROM {$wpdb->comments}
                    {$where}");
                        echo '<span>' . $comment_count . "دیدگاه" . '</span>';
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($options['active_order_pending']) { ?>
            <div class="item-detail">
                <i class="fa-regular fa-credit-card"></i>
                <div class="item-content">
                    <h6>تعداد پرداخت ها</h6>
                    <div>
                        <?php
                        $user_id = get_current_user_id();
                        $order_count = wc_get_customer_order_count($user_id);
                        echo $order_count;
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <section class="myaccount-order">
        <?php
        $user_id = get_current_user_id();
        $pending = wc_get_orders(array(
            'status' => 'wc-pending',
            'customer_id' => $user_id,
        ));
        $process = wc_get_orders(array(
            'status' => 'wc-processing',
            'customer_id' => $user_id,
        ));
        $completed = wc_get_orders(array(
            'status' => 'wc-completed',
            'customer_id' => $user_id,
        ));
        $cancell = wc_get_orders(array(
            'status' => 'wc-cancelled',
            'customer_id' => $user_id,
        ));

        ?>

        <div class="item-order">
            <i class="fa-solid fa-plus"></i>
            <b> <?php echo count($pending); ?> سفارش </b>
            <span>در انتظار پرداخت</span>
        </div>
        <?php if ($options['active_order_process']) { ?>
            <div class="item-order">
                <i class="fa-solid fa-plus"></i>
                <b> <?php echo count($process); ?> سفارش </b>
                <span>در حال انجام</span>
            </div>
        <?php } ?>
        <?php if ($options['active_order_complete']) { ?>
            <div class="item-order">
                <i class="fa-solid fa-plus"></i>
                <b> <?php echo count($completed); ?> سفارش </b>
                <span>تحویل شده</span>
            </div>
        <?php } ?>
        <?php if ($options['active_order_return']) { ?>
            <div class="item-order">
                <i class="fa-solid fa-plus"></i>
                <b> <?php echo count($cancell); ?> سفارش </b>
                <span>لغو شده</span>
            </div>
        <?php } ?>
    </section>
<?php if ($options['active_notif_myaccount']) { ?>
    <section class="myaccount-notif">
        <h6><i class="fa-regular fa-bell"></i><?php echo $options['title_notif_myaccount']; ?></h6>
        <div>
            <?php echo $options['content_notif_myaccount']; ?>
        </div>
    </section>
<?php } ?>

    <p>
        <?php
        printf(
        /* translators: 1: user display name 2: logout url */
            wp_kses(__('Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce'), $allowed_html),
            '<strong>' . esc_html($current_user->display_name) . '</strong>',
            esc_url(wc_logout_url())
        );
        ?>
    </p>

    <p>
        <?php
        /* translators: 1: Orders URL 2: Address URL 3: Account URL. */
        $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
        if (wc_shipping_enabled()) {
            /* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
            $dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
        }
        printf(
            wp_kses($dashboard_desc, $allowed_html),
            esc_url(wc_get_endpoint_url('orders')),
            esc_url(wc_get_endpoint_url('edit-address')),
            esc_url(wc_get_endpoint_url('edit-account'))
        );
        ?>
    </p>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
