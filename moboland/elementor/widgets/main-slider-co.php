<?php

class moboland_main_slider_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_main_slider_co';
    }

    public function get_title()
    {
        return 'اسلایدر پیشرفته موبولند';
    }

    public function get_icon()
    {
        return 'eicon-image-before-after';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['slide', 'slider', 'slideshow'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'main_slider_section',
            [
                'label' => 'تنظیمات اسلایدر',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'main_slider_list_co',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_main_slider_co',
                        'label' => 'انتخاب تصویر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'url_main_slider_co',
                        'label' => 'لینک دکمه اسلایدر',
                        'type' => \Elementor\Controls_Manager::URL,
                    ],
                    [
                        'name' => 'text_p_main_slider_co',
                        'label' => 'متن بالایی اسلایدر',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'بهترین انتخاب برای وب سایت های شرکتی' ,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'text_h1_main_slider_co',
                        'label' => 'متن بالایی اسلایدر',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'موبولند قالب اختصاصی شرکتی' ,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'text_btn_main_slider_co',
                        'label' => 'متن بالایی اسلایدر',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'بیشتر بدانید' ,
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'image_main_slider' => esc_html__('اسلاید #1', 'textdomain'),
                        'url_main_slider' => esc_html__('برای تغییر کلیک کنید', 'textdomain'),
                    ],
                ],
                'title_field' => 'اسلایدر',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'slider_style_section_co_text',
            [
                'label' => 'تنظیمات اجزای اسلایدر',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_text_slider_co',
            [
                'label' => 'نمایش متن بالای اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_h1_slider_co',
            [
                'label' => 'نمایش متن هدینگ اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_btn_slider_co',
            [
                'label' => 'نمایش دکمه اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'slider_style_section_co',
            [
                'label' => 'تنظیمات استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_nav_slider_co',
            [
                'label' => 'نمایش پیکانها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_bullet_slider_co',
            [
                'label' => 'نقطه های زیر اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_co',
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
        $sliders_co = $settings['main_slider_list_co'];
        ?>

        <section class="main-slider-co">
            <div class="owl-carousel owl-theme mm-slider-co">
                <?php foreach ($sliders_co as $slide_co) { ?>
                <div class="item">
                    <a href="<?php echo $slide_co['url_main_slider_co']['url'] ?>"><img src="<?php echo $slide_co['image_main_slider_co']['url'] ?>" alt=""></a>
                    <div class="text-main-slider-co">
                        <div class="container">
                            <?php if ($settings['show_text_slider_co']) { ?>
                                <p><?php echo $slide_co['text_p_main_slider_co'] ?></p>
                            <?php } ?>
                            <?php if ($settings['show_h1_slider_co']) { ?>
                            <h1><?php echo $slide_co['text_h1_main_slider_co'] ?></h1>
                            <?php } ?>
                            <?php if ($settings['show_btn_slider_co']) { ?>
                            <a href="<?php echo $slide_co['url_main_slider_co']['url'] ?>"><?php echo $slide_co['text_btn_main_slider_co'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </section>

        <script>
            var $ = jQuery;

            $(function () {
                $('.mm-slider-co').owlCarousel({
                    loop: true,
                    autoplay:<?php if ($settings['autoplay_co']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 0,
                    nav: <?php if ($settings['show_nav_slider_co']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    dots: <?php if ($settings['show_bullet_slider_co']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    rtl: true,
                    navText: "",
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        1000: {
                            items: 1
                        }
                    }
                })
            })

        </script>




        <?php
    }

}

