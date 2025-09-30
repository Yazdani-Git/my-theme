<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {

    //
    // Set a unique slug-like ID
    $prefix = 'options';

    //
    // Create options
    CSF::createOptions($prefix, array(
        'menu_title' => 'تنظیمات قالب موبولند',
        'menu_slug' => 'moboland-options',
        'framework_title' => 'تنظیمات موبولند',
        'menu_position' => 20,
        'footer_text' => 'توسعه دهنده سیامک افراشته',
    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'title' => 'تنظیمات عمومی',
        'id' => 'common_options',
        'icon' => 'fas fa-home',

    ));
    CSF::createSection($prefix, array(
        'title' => 'همگانی',
        'parent' => 'common_options',
        'fields' => array(
            array(
                'type' => 'subheading',
                'content' => 'تنظیمات عمومی',
            ),
            array(
                'id' => 'logo_width',
                'type' => 'slider',
                'title' => 'بیشترین پهنای لوگوی اصلی (px)',
                'desc' => 'بیشترین عرض برای تصویر لوگو را تنظیم کنید. واحد پیکسل',
                'min' => 50,
                'max' => 450,
                'unit' => 'px',
                'default' => '200'
            ),
            array(
                'id' => 'favicon_option',
                'type' => 'media',
                'title' => 'تصویر فاوآیکون',
                'subtitle' => 'پسوندهای مجاز: png, webp , jpg , gif',
                'default' => array(
                    'url' => get_template_directory_uri() . '/img/fav.png',
                ),
                'preview_size' => 'full',
            ),
            array(
                'id' => 'container_width',
                'type' => 'slider',
                'title' => 'اندازه محدوده محتوای وب سایت',
                'desc' => 'محدوده طراحی وب سایت به صورت پیش فرض 1440 پیکسل است. برای تغییر آن این مقدار را تنظیم کنید',
                'min' => 1200,
                'max' => 1600,
                'unit' => 'px',
                'default' => '1440'
            ),
            array(
                'id' => 'main_color',
                'type' => 'color',
                'title' => 'رنگ اصلی قالب',
                'subtitle' => 'رنگ اصلی قالب را انتخاب کنید',
                'default' => '#2980b9'
            ),
            array(
                'id' => 'second_color',
                'type' => 'color',
                'title' => 'رنگ مکمل قالب',
                'subtitle' => 'رنگ مکمل قالب را انتخاب کنید',
                'default' => '#3498db'
            ),
            array(
                'id' => 'background_color',
                'type' => 'background',
                'title' => 'پس زمینه وب سایت',
                'subtitle' => 'رنگ پس زمینه وب سایت را انتخاب کنید. دقت داشته باشید که عکس هم می توانید انتخاب کنید.',
                'default' => array(
                    'background-color' => '#ecf0f1'
                ),
                'output' => array('body'),
            ),


        )

    ));

    //
    // Create a section
    CSF::createSection($prefix, array(
        'title' => 'سربرگ',
        'id' => 'header_options',
        'icon' => 'fas fa-th-large',
    ));
    CSF::createSection($prefix, array(
        'title' => 'سربرگ',
        'parent' => 'header_options',
        'fields' => array(
            array(
                'id' => 'bg_header',
                'type' => 'background',
                'title' => 'پس زمینه کلی هدر',
                'default' => array(
                    'background-color' => '#ffffff'
                ),
                'output' => array('.header'),
            ),
            array(
                'id' => 'active_top_menu',
                'type' => 'switcher',
                'title' => 'نوار بالا',
                'subtitle' => 'نمایش و عدم نمایش نوار بالای هدر وب سایت',
                'text_on' => 'فعال',
                'text_off' => 'غیر فعال',
                'text_width' => 80,
                'default' => true,
            ),
            array(
                'id' => 'bg_top_header',
                'type' => 'background',
                'title' => 'پس زمینه نوار بالا',
                'default' => array(
                    'background-color' => '#ffffff'
                ),
                'output' => array('.main-header'),
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id' => 'color_top_header',
                'type' => 'color',
                'title' => 'رنگ متن نوار بالا',
                'default' => '#7e7e7e',
                'output' => array('.top-header'),
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id'    => 'custom_top_topmenu_right',
                'type'  => 'wp_editor',
                'title' => 'متن دلخواه سمت راست',
                'default' => 'گوشی آیفون 16 توسط شرکت اپل به صورت رسمی رونمایی شد.',
                'height' => '80px',
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id'    => 'custom_top_topmenu_left',
                'type'  => 'wp_editor',
                'title' => 'متن دلخواه سمت چپ',
                'default' => 'اگر سوالی دارید با پشتیبانی در تماس باشید',
                'height' => '80px',
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id'      => 'contact_top_menu_left',
                'type'    => 'text',
                'title'   => 'شماره تماس پشتیبانی',
                'default' => '09031234567',
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id'    => 'active_contact_us_btn_co',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه ارتباط با ما در هدر',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'      => 'contact_us_btn_co',
                'type'    => 'text',
                'title'   => 'متن دلخواه دکمه ارتباط با ما',
                'default' => 'ارتباط با ما',
                'dependency' => array( 'active_contact_us_btn_co', '==', 'true' ),
            ),
            array(
                'id'      => 'contact_us_btn_co_link',
                'type'    => 'text',
                'title'   => 'لینک صفحه ارتباط با ما',
                'default' => '#',
                'dependency' => array( 'active_contact_us_btn_co', '==', 'true' ),
            ),
            array(
                'id'      => 'icon_top_menu_left',
                'type'    => 'icon',
                'title'   => 'آیکون پشتیبانی در تاپ هدر',
                'default' => 'fas fa-headset',
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),
            array(
                'id' => 'active_top_menu_mobile',
                'type' => 'switcher',
                'title' => 'نوار بالای موبایل',
                'subtitle' => 'نمایش و عدم نمایش نوار بالا در موبایل',
                'text_on' => 'فعال',
                'text_off' => 'غیر فعال',
                'text_width' => 80,
                'default' => false,
                'dependency' => array( 'active_top_menu', '==', 'true' ),
            ),

        )
    ));

    CSF::createSection($prefix , array(
        'title'  => 'تنظیمات سربرگ',
        'parent' => 'header_options',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات سربرگ ',
            ),
            array(
                'id'          => 'select_header',
                'type'        => 'select',
                'title'       => 'انتخاب سربرگ',
                'subtitle' => 'انتخاب کنید کدام نوع سربرگ می خواهید نمایش داده شود',
                'options'     => array(
                    'one_header'  => 'سربرگ اول',
                    'two_header'  => 'سربرگ دوم',
                    'one_header_co'  => 'سربرگ شرکتی 1',
                ),
                'default'     => 'one_header',
            ),
            array(
                'id'    => 'logo_option',
                'type'  => 'media',
                'title'    => 'تصویر لوگو',
                'subtitle' => 'آپلود تصویر:png, jpg or gif file',
                'default'  => array(
                    'url'=>get_template_directory_uri().'/img/logo-web.webp'
                ),
                'preview_size'  => 'full',
            ),
            array(
                'id'    => 'logo_mobile_option',
                'type'  => 'media',
                'title'    => 'لوگو موبایل',
                'subtitle' => 'آپلود تصویر:png, jpg or gif file',
                'default'  => array(
                    'url'=>get_template_directory_uri().'/img/logo-web.webp'
                ),
                'preview_size'  => 'full',
            ),
            array(
                'id'    => 'active_cart',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه سبدخرید',
                'subtitle' => 'نمایش/عدم نمایش نوار بالا',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_megamenu',
                'type'  => 'switcher',
                'title'    => 'نمایش مگامنو',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'      => 'title_megamenu',
                'type'    => 'text',
                'title'    => 'عنوان مگامنو',
                'default'    => 'دسته بندی محصول',
                'dependency' => array( 'active_megamenu', '==', 'true' ),
            ),
            array(
                'id'    => 'active_wishlist',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه علاقه مندی ها',
                'subtitle'    => 'درصورتی که افزونه علاقه مندها را فعال کرده باشید میتوانید این دکمه را نمایش دهید',
                'description'    => 'اگر این دکمه را غیرفعال کنید میتوانید دکمه دلخواه داشته باشید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'      => 'title_custom_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_wishlist', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_wishlist', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_wishlist', '==', 'false' ),
            ),
            array(
                'id'    => 'active_register_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه ورود و ثبت نام پیش فرض',
                'subtitle'    => 'این دکمه اگر فعال باشد دکمه ورود و ثبت نام پیش فرض قالب نمایش داده می شود',
                'description'    => 'اگر این دکمه را غیرفعال کنید میتوانید دکمه دلخواه داشته باشید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'      => 'title_custom_btn_register',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_register_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_btn_register',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_register_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_btn_register',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-circle-user',
                'dependency' => array( 'active_register_btn', '==', 'false' ),
            ),
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات زیر منوط به انتخاب سربرگ دوم هستند ',
                'dependency' => array( 'select_header', '==', 'two_header' ),
            ),
            array(
                'id'    => 'active_search',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه جستجو',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'select_header', '==', 'two_header' ),
            ),
            array(
                'id'    => 'active_account',
                'type'  => 'switcher',
                'title'    => 'نمایش حساب کاربری',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'select_header', '==', 'two_header' ),
            ),
            array(
                'id'    => 'bg_header_two',
                'type'  => 'background',
                'title'    => 'رنگ پس زمینه هدر' ,
                'subtitle' => 'پیشفرض سفید است',
                'default'                         => array(
                    'background-color'              => '#fff',
                ),
                'output'    => array('.header-two'),
                'background_size'               => false,
                'background_position'           => false,
                'background_repeat'             => false,
                'background_image'             => false,
                'background_attachment'             => false,
                'dependency' => array( 'select_header', '==', 'two_header' ),
            ),
            array(
                'id'    => 'main_colorcolor_header_two',
                'type'  => 'color',
                'title'    => 'رنگ متن های هدر' ,
                'subtitle' => 'پیشفرض تیره است',
                'default'  => '#303030',
                'output'    => array('.megamenu-box span.title-megamenu','.megamenu-box','.menu-header > ul > li > a','.m-h-left i','#hamberger','.account-btn label'),
                'dependency' => array( 'select_header', '==', 'two_header' ),
            ),
        )
    ));

    CSF::createSection($prefix, array(
        'title' => 'منوی پایین در حالت موبایل',
        'id' => 'menu_mobile_bottom',
        'icon' => 'fas fa-caret-square-down',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات منوی پایین موبایلی ',
            ),
            array(
                'id'    => 'active_menu_mobile_bottom',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی موبایلی',
                'subtitle'    => 'مخفی کردن یا نمایش منوی نسخه موبایلی',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'type'    => 'subheading',
                'content' => 'هرکدام از موارد زیر که فعال باشد نمایش داده می شود',
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'    => 'active_home_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی خانه',
                'subtitle'    => 'اگر نمایش منوی خانه را غیر فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_home_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_home_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_home_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_home_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_home_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_home_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'active_search_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی جستجو',
                'subtitle'    => 'اگر نمایش منوی جستجو را غیر فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_search_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_search_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_search_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_search_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_search_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_search_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'active_shop_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی فروشگاه',
                'subtitle'    => 'اگر نمایش منوی فروشگاه را غیر فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_shop_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_shop_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_shop_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_shop_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_shop_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_shop_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'active_wishlist_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی علاقمندی ها',
                'subtitle'    => 'اگر نمایش منوی علاقمندی ها را غیر فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_wishlist_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_wishlist_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_wishlist_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_wishlist_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_wishlist_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_wishlist_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'active_cart_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'نمایش منوی سبد خرید',
                'subtitle'    => 'اگر نمایش منوی سبد خرید را غیر فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_cart_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_cart_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'      => 'link_custom_cart_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_cart_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'icon_custom_cart_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_cart_menu_mobile_btn', '==', 'false' ),
            ),
            array(
                'id'    => 'active_add_menu_mobile_btn',
                'type'  => 'switcher',
                'title'    => 'افزودن یک دکمه جدید به منوی موبایل',
                'subtitle'    => 'اگر افزودن یک دکمه جدید به منوی موبایل را فعال کنید می توانید در صورت تمایل عنوان، آیکون و لینک صفحه مورد نظر خود را جانمایی کنید',
                'default'  => false,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
                'dependency' => array( 'active_menu_mobile_bottom', '==', 'true' ),
            ),
            array(
                'id'      => 'title_custom_add_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'عنوان دکمه دلخواه',
                'dependency' => array( 'active_add_menu_mobile_btn', '==', 'true' ),
            ),
            array(
                'id'      => 'link_custom_add_menu_mobile_btn',
                'type'    => 'text',
                'title'    => 'لینک دکمه دلخواه',
                'dependency' => array( 'active_add_menu_mobile_btn', '==', 'true' ),
            ),
            array(
                'id'    => 'icon_custom_add_menu_mobile_btn',
                'type'  => 'icon',
                'title'    => 'آیکون دکمه دلخواه',
                'default'          => 'far fa-play-circle',
                'dependency' => array( 'active_add_menu_mobile_btn', '==', 'true' ),
            ),
        )

    ));

    CSF::createSection($prefix, array(
        'title' => 'کیف پول و سیستم کش بک',
        'id' => 'wallet_cash_back',
        'icon' => 'fas fa-th-large',
    ));

    CSF::createSection($prefix , array(
        'title'  => 'تنظیمات سربرگ',
        'parent' => 'wallet_cash_back',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات سیستم کش بک و کیف پول ',
            ),
            array(
                'id'    => 'active_wallet_cash_back',
                'type'  => 'switcher',
                'title'    => 'فعال سازی سیستم کش بک و کیف پول',
                'subtitle'    => 'اگر این سیستم فعال باشد هم زمان سیستم کش بک و کیف پول برای شما فعال میشود',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),

        )
    ));


    CSF::createSection($prefix,array(
        'title' => 'آیکون های شبکه های اجتماعی سربرگ شرکتی',
        'icon'   => 'fas fa-headphones-alt',
        'id'    => 'social_icons_co',

        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات آیکون های شبکه های اجتماعی در سربرگ شرکتی ',
            ),
            array(
                'id'    => 'social_icons_co',
                'type'  => 'switcher',
                'title'    => 'نمایش آیکون ها',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'type'    => 'subheading',
                'content' => 'هرکدام از موارد زیر را پر کنید نمایش داده میشود',
            ),
            array(
                'id'      => 'twitter_co',
                'type'    => 'text',
                'title'    => 'توییتر',
            ),
            array(
                'id'          => 'youtube_co',
                'type'        => 'text',
                'title'    => 'لینک یوتیوب',
            ),
            array(
                'id'          => 'linkdin_co',
                'type'        => 'text',
                'title'    => 'لینک لینکدین',
            ),
            array(
                'id'          => 'facebook_co',
                'type'        => 'text',
                'title'    => 'لینک فیسبوک',
            ),
            array(
                'id'          => 'instagram_co',
                'type'        => 'text',
                'title'    => 'آیدی اینستاگرام',
            ),
        )
    ));

    CSF::createSection($prefix , array(
        'title'  => 'تایپوگرافی',
        'icon'   => 'fas fa-font',
        'id'    => 'typography_options',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات تایپوگرافی ',
            ),
            array(
                'id'          => 'font_body',
                'type'        => 'select',
                'title'       => 'انتخاب فونت سراسری وب سایت',
                'subtitle' => 'نوع فونت سراسری وب سایت را انتخاب کنید',
                'options'     => array(
                    'yekanbakh'  => 'یکان بخ',
                    'iransans'  => 'ایران سنس',
                    'iranyekan'  => 'ایران یکان',
                ),
                'default' => array(
                    'font-family' => 'yekanbakh',
                ),
            ),

            array(
                'id'          => 'font_size',
                'type'        => 'select',
                'title'       => 'انتخاب اندازه فونت',
                'subtitle' => 'سایز فونت سراسری وب سایت',
                'options'     => array(
                    '12'  => '12 پیکسل',
                    '14'  => '14 پیکسل',
                    '16'  => '16 پیکسل',
                    '18'  => '18 پیکسل',
                    '20'  => '20 پیکسل',
                ),
                'default' => array(
                    'font-size'   => '14',
                ),
            ),
            array(
                'id'      => 'font_color',
                'type'    => 'color',
                'title'   => 'رنگ فونت سراسری',
                'default' => '#303030'
            ),
        )
    ));


    CSF::createSection($prefix , array(
        'title'  => 'نوشته ها',
        'icon'   => 'fas fa-pencil-alt',
        'id'    => 'blog_options',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات صفحه داخلی مقالات ',
            ),
            array(
                'id'        => 'sidebar_position_single',
                'type'      => 'image_select',
                'title'     => 'موقعیت سایدبار صفحه نوشته ها',
                'subtitle'     => 'میتوانید سایدبار را سمت چپ/راست قرار دهید یا مخفی کنید',
                'options'   => array(
                    'right' => get_template_directory_uri().'/img/panel/right.png',
                    'none' => get_template_directory_uri().'/img/panel/none.png',
                    'left' => get_template_directory_uri().'/img/panel/left.png',
                ),
                'default'   => 'left'
            ),
            array(
                'id'    => 'active_related_post',
                'type'  => 'switcher',
                'title'    => 'نمایش مطالب مرتبط',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
        )
    ));

    CSF::createSection($prefix,array(
        'title' => 'تنظیمات محصول',
        'icon'   => 'fas fa-dumpster',
        'id'    => 'product_options',
    ));

    CSF::createSection($prefix,array(
        'title' => 'صفحه محصول',
        'id'    => 'section_product_options',
        'parent' => 'product_options',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات صفحه داخلی محصول ',
            ),
            array(
                'id'    => 'active_brand',
                'type'  => 'switcher',
                'title'    => 'نمایش برند محصول',
                'default'  => true,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_category',
                'type'  => 'switcher',
                'title'    => 'نمایش دسته بندی محصول',
                'default'  => true,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_stock',
                'type'  => 'switcher',
                'title'    => 'نمایش موجود در انبار',
                'default'  => true,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_excerpt_content',
                'type'  => 'switcher',
                'title'    => 'نمایش توضیحات کوتاه محصول',
                'default'  => false,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_attr',
                'type'  => 'switcher',
                'title'    => 'نمایش ویژگی های محصول',
                'default'  => true,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_related_product',
                'type'  => 'switcher',
                'title'    => 'نمایش محصولات مرتبط ',
                'default'  => true,
                'text_on'  => 'فعال',
                'text_off' => 'غیرفعال',
                'text_width' => 80,
            ),

            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات نظرات محصول ',
            ),
            array(
                'id'    => 'active_slider_reviews',
                'type'  => 'switcher',
                'title'    => 'نمایش آیتم های اسلایدر در نظرات ',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'      => 'review_but',
                'type'    => 'text',
                'title'    => 'عنوان آیتم اول',
                'default'    => 'زیبایی',
                'dependency' => array( 'active_slider_reviews', '==', 'true' ),
            ),
            array(
                'id'      => 'review_power',
                'type'    => 'text',
                'title'    => 'عنوان آیتم دوم',
                'default'    => 'قدرت',
                'dependency' => array( 'active_slider_reviews', '==', 'true' ),
            ),
            array(
                'id'      => 'review_quality',
                'type'    => 'text',
                'title'    => 'عنوان آیتم سوم',
                'default'    => 'کیفیت ساخت',
                'dependency' => array( 'active_slider_reviews', '==', 'true' ),
            ),
            array(
                'id'          => 'review_property',
                'type'        => 'text',
                'title'    => 'عنوان آیتم چهارم',
                'default'    => 'امکانات',
                'dependency' => array( 'active_slider_reviews', '==', 'true' ),
            ),
            array(
                'id'          => 'review_buy',
                'type'        => 'text',
                'title'    => 'عنوان آیتم پنجم',
                'default'    => 'ارزش خرید',
                'dependency' => array( 'active_slider_reviews', '==', 'true' ),
            ),
        )
    ));


    CSF::createSection($prefix,array(
        'title' => 'دکمه ارتباط باما',
        'icon'   => 'fas fa-headphones-alt',
        'id'    => 'contact_us',

        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'دکمه ارتباط با ما (شناور پایین سمت راست) ',
            ),
            array(
                'id'    => 'active_contact_us',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه در دسکتاپ',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_contact_us_mobile',
                'type'  => 'switcher',
                'title'    => 'نمایش دکمه در موبایل',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'    => 'background_contact_us',
                'type'  => 'background',
                'title'    => 'رنگ دکمه' ,
                'subtitle' => 'پیشفرض قرمز است',
                'default'                         => array(
                    'background-color'              => '#f93423',
                ),
                'output'    => array('.floating-contact .floating-button'),
                'background_size'               => false,
                'background_position'           => false,
                'background_repeat'             => false,
                'background_image'             => false,
                'background_attachment'             => false,
            ),
            array(
                'type'    => 'subheading',
                'content' => 'هرکدام از موارد زیر را پر کنید نمایش داده میشود',
            ),
            array(
                'id'      => 'contact_tell',
                'type'    => 'text',
                'title'    => 'شماره تماس',
            ),
            array(
                'id'          => 'contact_telegram',
                'type'        => 'text',
                'title'    => 'آیدی تلگرام',
            ),
            array(
                'id'          => 'contact_instagram',
                'type'        => 'text',
                'title'    => 'آیدی اینستاگرام',
            ),
            array(
                'id'          => 'contact_whatsup',
                'type'        => 'text',
                'title'    => 'شماره واتساپ',
                'subtitle'    => 'شماره را در فرمت بین المللی بنویسید ( مثال : 989101234567',
            ),
            array(
                'id'          => 'contact_bale',
                'type'        => 'text',
                'title'    => 'آدرس حساب پیام رسان بله',
            ),
            array(
                'id'          => 'contact_rubika',
                'type'        => 'text',
                'title'    => 'آدرس حساب پیام رسان روبیکا',
            ),
            array(
                'id'          => 'contact_soroush',
                'type'        => 'text',
                'title'    => 'آدرس حساب پیام رسان سروش',
            ),
            array(
                'id'          => 'contact_email',
                'type'        => 'text',
                'title'    => 'ادرس ایمیل',
            ),

        )
    ));

    CSF::createSection($prefix,array(
        'title' => 'تنظیمات فوتر',
        'icon'   => 'fas fa-pallet',
        'id'    => 'footer_options',
    ));
    CSF::createSection($prefix,array(
        'title' => ' فوتر',
        'id'    => 'footer',
        'parent' => 'footer_options',
        'fields' => array(
            array(
                'id' => 'bg_footer',
                'type' => 'background',
                'title' => 'پس زمینه فوتر',
                'default' => array(
                    'background-color' => '#ffffff'
                ),
                'output' => array('.footer'),
            ),
            array(
                'id' => 'color_head_footer',
                'type' => 'color',
                'title' => 'رنگ متن هدر ابزارک های فوتر',
                'default' => '#303030',
                'output' => array(
                    '.footer .footer-box .footer-widget h3'
                ),
            ),
            array(
                'id' => 'color_text_footer',
                'type' => 'color',
                'title' => 'رنگ متن بدنه فوتر',
                'default' => '#7a7a7a',
                'output' => array(
                    '.footer .footer-box .footer-widget .f-w-content' ,
                    '.footer .footer-box .footer-widget .f-w-content ul li a' ,
                ),
            ),
            array(
                'id'    => 'text_footer_line',
                'type'  => 'wp_editor',
                'title'    => 'محتوای دلخواه (بالای متن کپی رایت نمایش داده میشود)' ,
                'default'          => 'پاسخگویی همه روزه از ساعت 9:00 الی 21:00 به غیر از روزهای جمعه | شماره تماس پشتیبانی: 09033929255',
                'height' => '80px',
            ),
            array(
                'id' => 'color_text_footer_up_copyright',
                'type' => 'color',
                'title' => 'رنگ متن بالای کپی رایت',
                'default' => '#7a7a7a',
                'output' => array(
                    '.footer .footer-line' ,
                ),
            ),
            array(
                'id'    => 'text_copy_right',
                'type'  => 'wp_editor',
                'title'    => 'متن کپی رایت' ,
                'default'          => 'کلیه حقوق این وب سایت متعلق به فروشگاه موبولند می باشد',
                'height' => '80px',
            ),
            array(
                'id' => 'color_text_footer_copyright',
                'type' => 'color',
                'title' => 'رنگ متن کپی رایت',
                'default' => '#7a7a7a',
                'output' => array(
                    '.footer .footer-down' ,
                ),
            ),
            array(
                'type'    => 'subheading',
                'content' => 'لینک صفحات اجتماعی  ',
            ),
            array(
                'id'        => 'social_group',
                'type'      => 'group',
                'title'     => 'افزودن شبکه اجتماعی',
                'button_title' => 'افزودن جدید',
                'fields'    => array(
                    array(
                        'id'    => 'text_social',
                        'type'  => 'text',
                        'title' => 'عنوان',
                    ),
                    array(
                        'id'    => 'icon_social',
                        'type'  => 'icon',
                        'title'    => 'آیکون',
                    ),
                    array(
                        'id'    => 'link_social',
                        'type'  => 'text',
                        'title' => 'لینک صفحه',
                    ),
                ),
            ),
        )
    ));
    CSF::createSection($prefix,array(
        'title' => 'اپلیکیشن',
        'id' => 'application',
        'parent' => 'footer_options',
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => 'تنظیمات نمایش اپلیکیشن در فوتر ',
            ),
            array(
                'id'    => 'active_application',
                'type'  => 'switcher',
                'title'    => 'نمایش دانلود اپلیکیشن در فوتر ',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'    => 'background_application',
                'type'  => 'background',
                'title'    => 'رنگ پس زمینه' ,
                'subtitle' => 'پیشفرض طوسی است',
                'default'                         => array(
                    'background-color'              => '#f3f4f6',
                ),
                'output'    => array('.footer .application'),
                'background_size'               => false,
                'background_position'           => false,
                'background_repeat'             => false,
                'background_image'             => false,
                'background_attachment'             => false,
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'id'    => 'color_application_title',
                'type'  => 'color',
                'title' => 'رنگ متن ',
                'subtitle'    => 'پیشفرض تیره است' ,
                'default'  => '#303030',
                'output'    => array('.application .right-application'),
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'id'    => 'icon_application',
                'type'  => 'media',
                'title'    => 'آیکون اپلیکیشن',
                'subtitle' => 'آپلود تصویر:png, jpg or gif file',
                'default'  => array(
                    'url'=>get_template_directory_uri().'/img/icon-application.png'
                ),
                'preview_size'  => 'full',
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'type'    => 'subheading',
                'content' => 'هرکدام از موارد زیر را پر کنید نمایش داده میشود ',
            ),
            array(
                'id'          => 'application_play',
                'type'        => 'text',
                'title'    => 'لینک دانلود از گوگل پلی',
                'default'    => '#',
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'id'          => 'application_bazar',
                'type'        => 'text',
                'title'    => 'لینک دانلود ار کافه بازار',
                'default'    => '#',
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'id'          => 'application_myket',
                'type'        => 'text',
                'title'    => 'لینک دانلود از مایکت',
                'default'    => '#',
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
            array(
                'id'          => 'application_sibapp',
                'type'        => 'text',
                'title'    => 'لینک دانلود از سیب اپ',
                'default'    => '#',
                'dependency' => array( 'active_application', '==', 'true' ),
            ),
        )
    ));


    CSF::createSection($prefix,array(
        'title' => 'حساب کاربری',
        'icon'   => 'fas fa-user',
        'id'    => 'myaccount_options',
    ));
    CSF::createSection($prefix,array(
        'title' => 'پیشخوان ووکامرس',
        'icon'   => 'el el-instagram',
        'id'    => 'panel_woocommerece',
        'parent' => 'myaccount_options',
        'fields' => array(
            array(
                'id'    => 'active_register_time',
                'type'  => 'switcher',
                'title'    => 'نمایش تاریخ عضویت',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'    => 'active_total_comments',
                'type'  => 'switcher',
                'title'    => 'نمایش مجموع دیدگاه ها',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_total_payment',
                'type'     => 'switcher',
                'title'    => 'نمایش مجموع پرداخت ها',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_order_pending',
                'type'     => 'switcher',
                'title'    => 'نمایش سفارشات در انتظار',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_order_process',
                'type'     => 'switcher',
                'title'    => 'نمایش سفارشات درحال انجام',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_order_complete',
                'type'     => 'switcher',
                'title'    => 'نمایش سفارشات تحویل شده',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_order_return',
                'type'     => 'switcher',
                'title'    => 'نمایش سفارشات لغو شده',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'       => 'active_notif_myaccount',
                'type'     => 'switcher',
                'title'    => 'نمایش اطلاعیه',
                'default'  => true,
                'text_on'  => 'نمایش',
                'text_off' => 'مخفی',
                'text_width' => 80,
            ),
            array(
                'id'        => 'title_notif_myaccount',
                'type'             => 'text',
                'title'    => 'عنوان اطلاعیه' ,
                'placeholder'    => 'تخفیف خرید اول' ,
                'dependency' => array( 'active_notif_myaccount', '==', 'true' ),
            ),
            array(
                'id'        => 'content_notif_myaccount',
                'type'  => 'wp_editor',
                'title'    => 'متن اطلاعیه' ,
                'height' => '80px',
                'dependency' => array( 'active_notif_myaccount', '==', 'true' ),
            ),

        )
    ));
    CSF::createSection($prefix,array(
        'title' => 'ثبت نام / ورود',
        'icon'   => 'el el-instagram',
        'id'    => 'register_login_options',
        'parent' => 'myaccount_options',
        'fields' => array(
            array(
                'id'    => 'login_back',
                'type'  => 'background',
                'title'    => 'پس زمینه صفحه لاگین ' ,
                'output'    => array('.back-register'),
            ),
            array(
                'id'    => 'login_logo',
                'type'  => 'media',
                'title'    => 'لوگو فرم لاگین',
                'subtitle' => 'آپلود تصویر:png, jpg or gif file',
                'default'  => array(
                    'url'=>get_template_directory_uri().'/img/logo-web.webp'
                ),
                'preview_size'  => 'full',
            ),
        )
    ));

    CSF::createSection($prefix,array(
        'title' => 'تنظیمات ورود با موبایل',
        'icon'   => 'fas fa-user',
        'id'    => 'mobile_myaccount_options',
    ));

    CSF::createSection($prefix,array(
        'title' => 'تنظیمات ثبت نام با موبایل',
        'icon'   => 'el el-instagram',
        'id'    => 'mobile_login_options',
        'parent' => 'mobile_myaccount_options',
        'fields' => array(
            array(
                'id'          => 'login_with_mobile',
                'type'        => 'select',
                'title'       => 'انتخاب نوع ورود و ثبت نام کاربر',
                'subtitle' => 'انتخاب کنید کابر با پیش فرض ووکامرس یعنی ایمیل و رمز وارد شود یا با شماره تماس و ارسال پیامک تاییدیه',
                'options'     => array(
                    'woocommerce'  => 'صفحه پیش فرض ورود با ایمیل ووکامرس',
                    'smsir'  => 'ورود و ثبت نام با سامانه sms.ir',
                    'mellipayamak'  => 'ورود و ثبت نام با سامانه ملی پیامک',
                ),
                'default'     => 'woocommerce',
            ),
        )
    ));





}
