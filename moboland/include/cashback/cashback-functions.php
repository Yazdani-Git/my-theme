<?php

function moboland_add_to_wallet($user_id, $amount, $description = '') {
    global $wpdb;

    if (!$user_id || $amount <= 0) {
        return;
    }

    $wallet_table = $wpdb->prefix . 'user_wallet';
    $transactions_table = $wpdb->prefix . 'user_wallet_transactions';

    // گرفتن موجودی فعلی
    $balance = $wpdb->get_var(
        $wpdb->prepare("SELECT balance FROM $wallet_table WHERE user_id = %d", $user_id)
    );

    if ($balance === null) {
        // اگر کاربر موجود نیست، ایجاد رکورد جدید
        $wpdb->insert($wallet_table, [
            'user_id' => $user_id,
            'balance' => $amount
        ]);
    } else {
        // بروزرسانی موجودی
        $new_balance = $balance + $amount;
        $wpdb->update(
            $wallet_table,
            ['balance' => $new_balance],
            ['user_id' => $user_id]
        );
    }

    // ثبت تراکنش
    $wpdb->insert($transactions_table, [
        'user_id' => $user_id,
        'amount' => $amount,
        'type' => 'کش بک',
        'status' => 'success',
        'created_at' => current_time('mysql')
    ]);
}
