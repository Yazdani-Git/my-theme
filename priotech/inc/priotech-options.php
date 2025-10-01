<?php
// Control core classes for avoid errors
if (class_exists('CSF')) {

    // Set a unique slug-like ID
    $prefix = 'priotech_options';

    // Create options
    CSF::createOptions($prefix, array(
        'menu_title' => 'Priotech Settings',
        'menu_slug' => 'priotech-options',
        'framework_title' => 'Priotech Settings',
        'menu_position' => 20,
        'footer_text' => 'Developed by Your Name',
    ));

    // Account Settings Section
    CSF::createSection($prefix, array(
        'id'    => 'account_settings',
        'title' => 'Account Settings',
        'icon'  => 'fas fa-user-cog',
    ));

    CSF::createSection($prefix, array(
        'parent' => 'account_settings',
        'title'  => 'Login System',
        'fields' => array(
            array(
                'id'          => 'login_system_select',
                'type'        => 'select',
                'title'       => 'Select Login System',
                'options'     => array(
                    'default' => 'Default WooCommerce',
                    'sms'     => 'SMS Login',
                ),
                'default'     => 'default',
            ),
        ),
    ));

    // SMS Settings Section
    CSF::createSection($prefix, array(
        'parent' => 'account_settings',
        'id'     => 'sms_settings',
        'title'  => 'SMS Settings',
        'dependency' => array('login_system_select', '==', 'sms'),
        'fields' => array(
            array(
                'id'      => 'sms_provider',
                'type'    => 'select',
                'title'   => 'Select SMS Provider',
                'options' => array(
                    'melipayamak' => 'MeliPayamak',
                    'smsir'       => 'SMS.ir',
                ),
                'default' => 'melipayamak',
            ),
            array(
                'id'         => 'melipayamak_username',
                'type'       => 'text',
                'title'      => 'MeliPayamak Username',
                'dependency' => array('sms_provider', '==', 'melipayamak'),
            ),
            array(
                'id'         => 'melipayamak_password',
                'type'       => 'text',
                'title'      => 'MeliPayamak Password',
                'dependency' => array('sms_provider', '==', 'melipayamak'),
            ),
            array(
                'id'         => 'melipayamak_bodyid',
                'type'       => 'text',
                'title'      => 'MeliPayamak Body ID',
                'dependency' => array('sms_provider', '==', 'melipayamak'),
            ),
            array(
                'id'         => 'smsir_api_key',
                'type'       => 'text',
                'title'      => 'SMS.ir API Key',
                'dependency' => array('sms_provider', '==', 'smsir'),
            ),
            array(
                'id'         => 'smsir_template_id',
                'type'       => 'text',
                'title'      => 'SMS.ir Template ID',
                'dependency' => array('sms_provider', '==', 'smsir'),
            ),
        ),
    ));
}