<?php

class moboland_main_slider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'main_slider_widget';
    }

    public function get_title()
    {
        return 'اسلایدر اصلی موبولند';
    }

    public function get_icon()
    {
        return 'eicon-slider-3d';
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
            'main_slider_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_main_slider',
                        'label' => 'انتخاب تصویر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'url_main_slider',
                        'label' => 'لینک اسلایدر',
                        'type' => \Elementor\Controls_Manager::URL,
                    ],

                ],
                'default' => [
                    [
                        'image_main_slider' => esc_html__('اسلاید #1', 'textdomain'),
                        'url_main_slider' => esc_html__('Item content. Click the edit button to change this text.', 'textdomain'),
                    ],
                ],
                'title_field' => 'اسلایدر',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'slider_style_section',
            [
                'label' => 'تنظیمات استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_nav_slider',
            [
                'label' => 'نمایش پیکانها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_bullet_slider',
            [
                'label' => 'نقطه های زیر اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => 'حرکت خودکار',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('فعال', 'textdomain'),
                'label_off' => esc_html__('غیر فعال', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'radius_slider',
            [
                'label' => 'گردی گوشه های اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('فعال', 'textdomain'),
                'label_off' => esc_html__('غیر فعال', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $sliders = $settings['main_slider_list'];
        ?>
        <section class="main-slider">
            <div class="owl-carousel owl-theme mm-slider">
                <?php foreach ($sliders as $slide) { ?>
                    <div class="item"><a href="<?php echo $slide['url_main_slider']['url'] ?>"><img
                                    src="<?php echo $slide['image_main_slider']['url'] ?>" alt=""></a>
                    </div>
                <?php } ?>
        </section>

        <script>
            var $ = jQuery;

            $(function () {
                $('.mm-slider').owlCarousel({
                    loop: true,
                    autoplay:<?php if ($settings['autoplay']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 0,
                    nav: <?php if ($settings['show_nav_slider']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    dots: <?php if ($settings['show_bullet_slider']) {
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
        if ($settings['radius_slider']) { ?>
            <style>
                .mm-slider .owl-stage-outer {
                    border-radius: 20px;
                }
            </style>


        <?php }  ?>

        <?php
    }

}
