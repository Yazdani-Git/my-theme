<?php
$current_user_id = get_current_user_id();
$wallet_balance = 0;

if ( $current_user_id ) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_wallet';
    $balance = $wpdb->get_var( $wpdb->prepare(
        "SELECT balance FROM $table_name WHERE user_id = %d",
        $current_user_id
    ));
    if ( $balance !== null ) {
        $wallet_balance = $balance;
    }
}
?>

<h2>کیف پول من</h2>

<div class="wallet-my-account">
    <div class="wallet-charge">
        <i class="fa-solid fa-wallet"></i>
        <span>شارژ کیف پول</span>
    </div>
    <div class="wallet-amount">
        <span>موجودی کیف پول شما:</span>
        <span class="wallet-am"><?php echo number_format($wallet_balance, 0); ?> تومان</span>
    </div>
</div>

<?php $available_gateways = WC()->payment_gateways()->get_available_payment_gateways(); ?>

<div class="wallet-form-container">
    <div class="wallet-form">
        <span class="close-form">&times;</span>
        <h3>شارژ کیف پول</h3>

        <form id="wallet-charge-form" method="post" action="<?php echo esc_url( site_url('/wallet-process') ); ?>">
            <label for="charge-amount">مبلغ مورد نظر (تومان):</label>
            <input
                    type="number"
                    id="charge-amount"
                    name="amount"
                    required
                    min="5000"
                    step="1000"
                    value="5000"
            >

            <?php if ( ! empty( $available_gateways ) ) : ?>
                <label for="wallet-gateway">انتخاب درگاه پرداخت:</label>
                <select id="wallet-gateway" name="gateway" required>
                    <?php foreach ( $available_gateways as $gateway_id => $gateway ) : ?>
                        <option value="<?php echo esc_attr( $gateway_id ); ?>">
                            <?php echo esc_html( $gateway->get_title() ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php else : ?>
                <p class="no-gateway-message">هیچ درگاه پرداخت فعالی ندارید.</p>
            <?php endif; ?>

            <button type="submit" <?php echo empty( $available_gateways ) ? 'disabled' : ''; ?>>
                پرداخت و شارژ
            </button>
        </form>
    </div>
</div>

<?php if ( isset($_GET['wallet_status']) ) : ?>
    <div class="wallet-message <?php echo $_GET['wallet_status'] === 'success' ? 'wallet-success' : 'wallet-error'; ?>">
        <?php if ($_GET['wallet_status'] === 'success' && isset($_GET['amount'])) : ?>
            مبلغ <?php echo number_format(intval($_GET['amount']), 0); ?> تومان با موفقیت به کیف پول شما اضافه شد.
        <?php else : ?>
            تراکنش ناموفق بود. لطفاً دوباره تلاش کنید.
        <?php endif; ?>
    </div>
<?php endif; ?>




<?php
global $wpdb;
$current_user_id = get_current_user_id();

$transactions = $wpdb->get_results( $wpdb->prepare(
    "SELECT * FROM {$wpdb->prefix}user_wallet_transactions WHERE user_id = %d ORDER BY created_at DESC",
    $current_user_id
) );

if ( $transactions && count($transactions) > 0 ) :
    ?>
    <div class="wallet-transactions">
        <h3>تاریخچه تراکنش‌های کیف پول</h3>
        <table class="wallet-transaction-table">
            <thead>
            <tr>
                <th>تاریخ</th>
                <th>مبلغ</th>
                <th>نوع</th>
                <th>وضعیت</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ( $transactions as $txn ) :
                // بررسی اینکه مبلغ منفی است
                $amount_class = $txn->amount < 0 ? 'class="negative-amount"' : '';
                ?>
                <tr>
                    <td><?php echo wp_date('Y/m/d H:i', strtotime($txn->created_at)); ?></td>

                    <!-- اگر مبلغ منفی بود، علامت منفی را به قبل از عدد منتقل کن -->
                    <td <?php echo $amount_class; ?>>
                        <?php
                        if ($txn->amount < 0) {
                            echo '-' . number_format(abs($txn->amount)); // برای اطمینان از اینکه علامت منفی در ابتدا نمایش داده شود
                        } else {
                            echo number_format($txn->amount);
                        }
                        ?> تومان
                    </td>
                    <td><?php echo ($txn->type === 'topup') ? 'شارژ کیف پول' : esc_html($txn->type); ?></td>
                    <td><?php echo ($txn->status === 'success') ? 'موفق' : 'ناموفق'; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <p class="no-wallet-transactions">هیچ تراکنشی برای کیف پول ثبت نشده است.</p>
<?php endif; ?>
