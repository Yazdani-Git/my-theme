<?php

class moboland_comments_user_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_comments_user_co';
    }

    public function get_title()
    {
        return 'اسلایدر نظرات کاربران موبولند';
    }

    public function get_icon()
    {
        return 'eicon-review';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['comment'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'main_comments_user_co',
            [
                'label' => 'تنظیمات بخش راست نظرات کاربران',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_title_comment_user',
            [
                'label' => 'عنوان اول',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'نظرات شما',
                'placeholder' => 'عنوان اول را وارد کنید',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'second_title_comment_user',
            [
                'label' => 'عنوان دوم',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مشتریان سابق درباره ما چه گفته اند؟',
                'placeholder' => 'عنوان دوم را وارد کنید',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_right_comment_user',
            [
                'label' => 'متن قسمت سمت راست نظرات',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'از آنجایی که نظرات شما برای ما بسیار مهم است این بخش را برای شما تولید کردیم تا از نظرات مشتریان سابق ما نیز بهره ببرید.',
                'placeholder' => 'عنوان دوم را وارد کنید',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'main_slider_comments_user_co',
            [
                'label' => 'تنظیمات بخش راست نظرات کاربران',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_slider_list_comments_user_co',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_main_comments_user_co',
                        'label' => 'انتخاب تصویر کاربر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'text_p_main_comments_user_co',
                        'label' => 'متن نظرات کاربران اسلایدر',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'rows' => 10,
                        'default' => 'متن نظرات کاربران شرکت موبولند.',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'name_main_comments_user_co',
                        'label' => 'نام نمایشی کاربر',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'سیامک افراشته',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'job_main_comments_user_co',
                        'label' => 'عنوان شغلی کاربر',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'طراح وب سایت',
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'image_main_comments_user_co' => esc_html__('اسلاید #1', 'textdomain'),
                        'text_p_main_comments_user_co' => esc_html__('برای تغییر کلیک کنید', 'textdomain'),
                    ],
                ],
                'title_field' => 'اسلایدر',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'main_our_projects_style',
            [
                'label' => 'تنظیمات اجزای نمونه کارها',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_first_title_comment_user',
            [
                'label' => 'نمایش عنوان اول نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_second_title_comment_user',
            [
                'label' => 'نمایش عنوان دوم نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_text_right_comment_user',
            [
                'label' => 'نمایش متن سمت راست نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_img_comment_user',
            [
                'label' => 'نمایش عکس کاربر در اسلایدر نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_text_comment_user',
            [
                'label' => 'نمایش متن نظر کاربر در اسلایدر نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_name_comment_user',
            [
                'label' => 'نمایش نام کاربر در اسلایدر نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_job_comment_user',
            [
                'label' => 'نمایش عنوان شغلی در اسلایدر نظرات',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'main_our_projects_style',
            [
                'label' => 'تنظیمات استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_nav_comments_user',
            [
                'label' => 'نمایش پیکانها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_bullet_comments_user',
            [
                'label' => 'نقطه های زیر اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_comments_user',
            [
                'label' => 'حرکت خودکار',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('فعال', 'textdomain'),
                'label_off' => esc_html__('غیر فعال', 'textdomain'),
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $comments = $settings['main_slider_list_comments_user_co'];
        ?>


        <section class="comment-users">
            <div class="container">
                <div class="ch-comment-users">
                    <div class="text-slider-comments">
                        <?php if ($settings['show_first_title_comment_user']) { ?>
                        <p><?php echo $settings['first_title_comment_user']; ?></p>
                        <?php } ?>
                        <?php if ($settings['show_second_title_comment_user']) { ?>
                        <h2><?php echo $settings['second_title_comment_user']; ?></h2>
                        <?php } ?>
                        <?php if ($settings['show_text_right_comment_user']) { ?>
                        <p><?php echo $settings['text_right_comment_user']; ?></p>
                        <?php } ?>
                    </div>
                    <div class="slider-comments">
                        <div class="owl-carousel owl-theme comment-slider">


                            <?php foreach ($comments as $comment) { ?>
                            <div class="item">
                                <div class="item-comment-slider">
                                    <?php if ($settings['show_img_comment_user']) { ?>
                                    <figure><img src="<?php echo $comment['image_main_comments_user_co']['url'] ?>" alt=""></figure>
                                    <?php } ?>
                                    <?php if ($settings['show_text_comment_user']) { ?>
                                    <p><?php echo $comment['text_p_main_comments_user_co']; ?></p>
                                    <?php } ?>
                                    <?php if ($settings['show_name_comment_user']) { ?>
                                    <h3><?php echo $comment['name_main_comments_user_co']; ?></h3>
                                    <?php } ?>
                                    <?php if ($settings['show_job_comment_user']) { ?>
                                    <span><?php echo $comment['job_main_comments_user_co']; ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>




                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>

            var $ = jQuery;


            $(function () {
                $('.comment-slider').owlCarousel({
                    loop:true,
                    autoplay:<?php if ($settings['autoplay_comments_user']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin:0,
                    nav: <?php if ($settings['show_nav_comments_user']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    rtl: true,
                    dots: <?php if ($settings['show_bullet_comments_user']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    navText: "",
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:2
                        },
                        1000:{
                            items:2
                        }
                    }
                })

            })



        </script>


        <?php
    }

}

