<?php

global $options;
$options = get_option('options');

if ($options['login_with_mobile'] == 'mellipayamak') {
// افزودن منو به پنل ادمین ملی پیامک
    add_action('admin_menu', 'mellipayamak_add_admin_menu');

    function mellipayamak_add_admin_menu()
    {
        add_menu_page(
            'تنظیمات سامانه پیامکی ملی پیامک',
            'سامانه ملی پیامک',
            'manage_options',
            'mellipayamak_settings',
            'mellipayamak_settings_page',
            get_template_directory_uri() . '/img/melli-payamak-logo.png', // 🔴 مسیر تصویر سفارشی
            20
        );
    }


// نمایش فرم تنظیمات ملی پیامک
    function mellipayamak_settings_page()
    {
        if (isset($_POST['submit'])) {
            update_option('mellipayamak_username', sanitize_text_field($_POST['mellipayamak_username']));
            update_option('mellipayamak_password', sanitize_text_field($_POST['mellipayamak_password']));
            update_option('mellipayamak_bodyid', sanitize_text_field($_POST['mellipayamak_bodyid']));
            echo '<div class="updated"><p>تنظیمات ذخیره شد!</p></div>';
        }

        $username = get_option('mellipayamak_username', '');
        $password = get_option('mellipayamak_password', '');
        $bodyid = get_option('mellipayamak_bodyid', '');

        ?>
        <div class="wrap">
            <h1>تنظیمات سامانه پیامکی ملی پیامک</h1>
            <form method="post">
                <table class="form-table">
                    <tr>
                        <th scope="row">نام کاربری</th>
                        <td><input type="text" name="mellipayamak_username" value="<?php echo esc_attr($username); ?>"
                                   required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row">رمز عبور</th>
                        <td><input type="password" name="mellipayamak_password"
                                   value="<?php echo esc_attr($password); ?>" required class="regular-text"></td>
                    </tr>
                    <tr>
                        <th scope="row">کد قالب تایید شده در سامانه</th>
                        <td><input type="text" name="mellipayamak_bodyid" value="<?php echo esc_attr($bodyid); ?>"
                                   required class="regular-text"></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

}



