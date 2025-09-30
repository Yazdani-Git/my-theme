<?php

class moboland_product_category3 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'category_slider_widget_style3';
    }

    public function get_title()
    {
        return 'اسلایدر دسته بندی محصولات موبولند استایل سوم';
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['category'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'main_category_section_style3',
            [
                'label' => 'تنظیمات اسلایدر دسته بندی محصولات',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'main_category_list_3',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_main_category_3',
                        'label' => 'انتخاب تصویر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'text_main_category3',
                        'label' => 'عنوان دسته بندی را وارد کنید',
                        'type' => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'url_main_category3',
                        'label' => 'لینک دسته بندی محصولات مورد نظر',
                        'type' => \Elementor\Controls_Manager::URL,
                    ],
                ],
                'default' => [
                    [
                        'image_main_category' => esc_html__('اسلاید #1', 'textdomain'),
                        'url_main_category' => esc_html__('Item content. Click the edit button to change this text.', 'textdomain'),
                    ],
                ],
                'title_field' => 'اسلایدر دسته بندی',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'category_style_section3',
            [
                'label' => 'تنظیمات استایل',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_nav_category3',
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
            'autoplay3',
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
            'item_slide_cat_desktop3',
            [
                'label' => 'تعداد آیتم های اسلاید در دسکتاپ',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 4,
                'max' => 9,
                'step' => 1,
                'default' => 8,
            ]
        );

        $this->add_control(
            'item_slide_cat_tablet3',
            [
                'label' => 'تعداد آیتم های اسلاید در تبلت',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 3,
                'max' => 5,
                'step' => 1,
                'default' => 3,
            ]
        );


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $categories = $settings['main_category_list_3'];
        ?>


        <section class="product-cat-home">
            <div class="container">
                <div class="product-cat">
                    <div class="owl-carousel owl-theme product-cat-slider3">
                        <?php foreach ($categories as $category) { ?>
                            <div class="item product-cat-item">
                                <figure>
                                    <a href="<?php echo $category['url_main_category3']['url'] ?>"><img
                                            src="<?php echo $category['image_main_category_3']['url'] ?>"
                                            alt=""></a>
                                </figure>
                                <a href="<?php echo $category['url_main_category3']['url'] ?>" class="btn-text">
                                    <?php echo $category['text_main_category3'] ?>
                                </a>

                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>


        <script>
            var $ = jQuery;

            $(function () {
                $('.product-cat-slider3').owlCarousel({
                    loop: true,
                    stagePadding : 20,
                    autoplay:<?php if ($settings['autoplay3']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 10,
                    nav: <?php if ($settings['show_nav_category3']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    rtl: true,
                    navText: "",
                    dots: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        500: {
                            items: 2
                        },
                        576: {
                            items: 2
                        },
                        768: {
                            items: 4
                        },
                        992: {
                            items: <?php echo $settings['item_slide_cat_tablet3']; ?>
                        },
                        1000: {
                            items: 7
                        },
                        1400: {
                            items: <?php echo $settings['item_slide_cat_desktop3']; ?>
                        }
                    }
                })
            })

        </script>


        <?php
    }

}
