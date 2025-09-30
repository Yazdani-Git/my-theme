<?php
/**
 *
 * @category  Plugins
 * @package   Wordpress
 * @author    IPdev.ir
 * @copyright 2022 The Ideh Pardazan (ipe.ir). All rights reserved.
 * @license   https://sms.ir/ ipe license
 * @version   IPE: 1.0.3
 * @link      https://app.sms.ir
 *
 */

/*
Plugin Name:   افزونه وردپرس پنل پیامکی sms.ir
Plugin URI:    https://app.sms.ir
Description:   افزونه وردپرسی ارسال پیامک sms.ir به همراه قابلیت مدیریت پیشرفته پیامک ها با استفاده از پنل قدرتمند sms.ir. این افزونه امکان اتصال به GravityFrom, Contact7 و Woocommerce را داشته و شما می توانید به راحتی نسبت به ثبت و مدیریت پیامک های مختلف اقدام فرمایید.
Version:       1.0.27
Author:        sms.ir
Author URI:    https://www.sms.ir
Support Email: tech@ipdev.ir
*/

if (!function_exists('SMSIRApp_activate_plugin')) {
    /**
     * ایجاد جداول دیتابیس
     *
     * @return void
     */
    function SMSIRApp_activate_plugin()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sms_ir_app_notifications';

        // ایجاد جدول در صورت عدم وجود
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $sql = "CREATE TABLE $table_name (
                id INT NOT NULL AUTO_INCREMENT,
                product_id INT(11) NOT NULL,
                type ENUM('promotion', 'inventory') NOT NULL,
                name VARCHAR(100) NOT NULL,
                mobile BIGINT NOT NULL,
                PRIMARY KEY(id),
                UNIQUE KEY product (product_id, type, mobile)
            ) {$wpdb->get_charset_collate()};";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }
}

if (!function_exists('SMSIRApp_deactivation_plugin')) {
    /**
     * حذف جداول دیتابیس
     *
     * @return void
     */
    function SMSIRApp_deactivation_plugin()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'sms_ir_app_notifications';

        // حذف جدول در صورت غیرفعال شدن
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
            $wpdb->query("DROP TABLE $table_name");
        }
    }
}

/**
 * ایجاد منوهای مدیریت
 *
 * @return void
 */
function SMSIRAppAdmin()
{
    add_menu_page(
        'SMSIRApp',
        'پنل سامانه پیامکی SMS.ir',
        'manage_options',
        'SMSIRApp',
        'SMSIRAppAdminMain',
        get_template_directory_uri() . '/include/SMSIRApp/includes/templates/assets/img/icon.png'
    );
    add_submenu_page(
        'SMSIRApp',
        'تنظیمات',
        'تنظیمات',
        "administrator",
        'SMSIRApp-setting',
        'SMSIRAppAdminSetting'
    );
    add_submenu_page(
        'SMSIRApp',
        'ارسال پیامک',
        'ارسال پیامک',
        "administrator",
        'SMSIRApp-test',
        'SMSIRAppAdminTest'
    );
    add_submenu_page(
        'SMSIRApp',
        'پیامک های ارسالی',
        'پیامک های ارسالی',
        "administrator",
        'SMSIRApp-send',
        'SMSIRAppAdminSend'
    );
    add_submenu_page(
        'SMSIRApp',
        'پیامک های دریافتی',
        'پیامک های دریافتی',
        "administrator",
        'SMSIRApp-receive',
        'SMSIRAppAdminReceive'
    );
}

// بارگذاری فایل‌های ضروری
require_once(dirname(__FILE__) . '/includes/functions.php');
require_once dirname(__FILE__) . '/includes/action.php';

// جایگزینی هوک‌های نصب و حذف
add_action('after_setup_theme', 'SMSIRApp_activate_plugin');
add_action('switch_theme', 'SMSIRApp_deactivation_plugin');
