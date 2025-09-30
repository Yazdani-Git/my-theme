<?php

class moboland_about_us_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_about_us_co';
    }

    public function get_title()
    {
        return 'درباره ما پیشرفته';
    }

    public function get_icon()
    {
        return 'eicon-posts-group';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['aboutus'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'our_services_co_section',
            [
                'label' => 'تنظیمات اسلایدر',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_about_us_co',
            [
                'label' => 'انتخاب تصویر',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/img/project-banner.webp',
                ],
            ]
        );

        $this->add_control(
            'about_us_co_title',
            [
                'label' => 'عنوان بخش درباره ما',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'درباره ما',
                'label_block' => true,
                'placeholder' => esc_html__('عنوان را وارد کنید', 'textdomain'),
            ]
        );

        $this->add_control(
            'about_us_co_title_2',
            [
                'label' => 'عنوان دوم بخش درباره ما',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'با موبولند مسیر رشد خود را برای موفقیت آماده کنید.',
                'label_block' => true,
                'placeholder' => esc_html__('عنوان دوم را وارد کنید', 'textdomain'),
            ]
        );

        $this->add_control(
            'about_us_co_title_text',
            [
                'label' => 'متن بخش درباره ما',
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است',
                'label_block' => true,
                'placeholder' => esc_html__('متن بخش درباره ما را وارد کنید', 'textdomain'),
            ]
        );

        $this->add_control(
            'about_us_co_btn_text',
            [
                'label' => 'متن دکمه',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'درباره ما',
                'label_block' => true,
                'placeholder' => esc_html__('متن دکمه درباره ما', 'textdomain'),
            ]
        );

        $this->add_control(
            'about_us_co_btn_link',
            [
                'label' => 'لینک دکمه درباره ما',
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => 'https://mobowebs.ir/',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'video_link_home_co',
            [
                'label' => 'لینک ویدیوی درباره ما',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'https://digikala.arvanvod.ir/yPe610dO49/NR0pY0Vzl4/origin_xbCP169yMS9AGgg2SgeDsZFZ79JiI7iCyaBPigsK.mp4',
                'label_block' => true,
            ]
        );


        $this->add_control(
            'about_us_co',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'icon_about_us_co',
                        'label' => 'آیکون بخش خدمت',
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fa-regular fa-square-check',
                            'library' => 'fa-regular',
                        ],

                    ],
                    [
                        'name' => 'text_about_us_co_icons',
                        'label' => 'متن کنار آیکون بخش خدمت',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'تدوین نقشه راه',
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'text_about_us_co_icons' => esc_html__('متن آیکونها', 'textdomain'),
                    ],
                ],
                'title_field' => 'بخش آیکون های درباره ما',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'about_us_co_style_section',
            [
                'label' => 'تنظیمات استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_first_title_about_us_co',
            [
                'label' => 'نمایش عنوان اول',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_second_title_about_us_co',
            [
                'label' => 'نمایش عنوان دوم',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_text_about_us_co',
            [
                'label' => 'نمایش متن درباره ما',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_icon_about_us_co',
            [
                'label' => 'نمایش آیکونهای درباره ما',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_btn_about_us_co',
            [
                'label' => 'نمایش آیکونهای درباره ما',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_video_icon_co',
            [
                'label' => 'نمایش آیکون ویدیو',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('رنگ آیکون', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073aa',
                'selectors' => [
                    '{{WRAPPER}} .about-us-item i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'about_us_co_title_1_color',
            [
                'label' => esc_html__('رنگ عنوان اول', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073aa', // رنگ پیش‌فرض
                'selectors' => [
                    '{{WRAPPER}} .about-us .about-us-ch .about-us-left p.title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'about_us_co_title_2_color',
            [
                'label' => esc_html__('رنگ عنوان اول', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#303030', // رنگ پیش‌فرض
                'selectors' => [
                    '{{WRAPPER}} .about-us .about-us-ch .about-us-left h2' => 'color: {{VALUE}} !important;',
                ],
            ]
        );


        $this->end_controls_section();


    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $about_us_co = $settings['about_us_co'];
        ?>


        <section class="about-us">
            <div class="container">
                <div class="about-us-ch">
                    <div class="about-us-right">
                        <figure>
                            <img src="<?php echo $settings['image_about_us_co']['url']; ?>" alt="">
                            <?php if ($settings['show_video_icon_co']) { ?>
                                <span id="btn_modal_video_home_co"><i class="fa-solid fa-caret-right"></i></span>
                            <?php } ?>
                        </figure>
                    </div>
                    <div class="about-us-left">
                        <?php if ($settings['show_first_title_about_us_co']) { ?>
                            <p class="title"><?php echo $settings['about_us_co_title']; ?></p>
                        <?php } ?>
                        <?php if ($settings['show_second_title_about_us_co']) { ?>
                            <h2><?php echo $settings['about_us_co_title_2']; ?></h2>
                        <?php } ?>
                        <?php if ($settings['show_text_about_us_co']) { ?>
                            <p><?php echo $settings['about_us_co_title_text']; ?></p>
                        <?php } ?>
                        <?php if ($settings['show_icon_about_us_co']) { ?>
                            <div class="about-us-items">
                                <?php foreach ($about_us_co as $about) { ?>
                                    <div class="about-us-item">
                                        <i class="<?php echo esc_attr($about['icon_about_us_co']['value']); ?>"></i>
                                        <span><?php echo $about['text_about_us_co_icons']; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        <?php if ($settings['show_btn_about_us_co']) { ?>
                            <a href="<?php echo $settings['about_us_co_btn_link']['url']; ?>"><?php echo $settings['about_us_co_btn_text']; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>


        <div id="modal_video_home_co" class="modal">
            <!-- Modal content -->
            <div class="modal-content">

                <div class="modal-header">
                    <i class="fas fa-xmark close_video_home_co"></i>
                </div>
                <div class="modal-body">
                    <video controls>
                        <source src="<?php echo $settings['video_link_home_co']; ?>" type="video/mp4">
                    </video>
                </div>


            </div>
        </div>


        <script>
                var $ = jQuery;

            $(document).ready(function () {
                var modal_video = document.getElementById("modal_video_home_co");
                var btn_modal_video = document.getElementById("btn_modal_video_home_co");
                var close_video = document.getElementsByClassName("close_video_home_co")[0];
                btn_modal_video.onclick = function () {
                    modal_video.style.display = "block";
                }
                close_video.onclick = function () {
                    modal_video.style.display = "none";
                }
            })
        </script>


        <?php
    }

}

