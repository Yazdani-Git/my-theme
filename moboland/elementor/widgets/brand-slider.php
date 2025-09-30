<?php

class moboland_brand_slider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'brand_slider_widget';
    }

    public function get_title()
    {
        return 'اسلایدر برندهای موبولند';
    }

    public function get_icon()
    {
        return 'eicon-banner';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['slide', 'slider', 'brand'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'brand_slider_section',
            [
                'label' => 'تنظیمات اسلایدر',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'brand_title',
            [
                'label' => 'عنوان قسمت برندها',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'برندها',
            ]
        );

        $this->add_control(
            'brand_style',
            [
                'label' => 'سبک نمایش',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'brand1',
                'options' => [
                    'brand1' => esc_html__('سبک 1', 'textdomain'),
                    'brand2' => esc_html__('سبک 2', 'textdomain'),
                ],
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


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <?php if ($settings['brand_style'] == 'brand1') { ?>

        <section class="main-brand">
            <div class="title-brand">
                <h4><?php echo $settings['brand_title']; ?></h4>
            </div>
            <div class="box-brand">
                <div class="inner-brand">
                    <div class="owl-carousel owl-theme brand-slider">

                        <?php
                        $term_brand = get_terms(
                            array(
                                'taxonomy' => 'product_brand',
                                'hide_empty' => false,

                            )
                        );

                        foreach ($term_brand as $brand) {

                            ?>

                            <div class="item brand-item">
                                <figure>
                                    <a href="<?php echo get_term_link($brand->term_id) ?>">
                                        <?php
                                        $attach_id = get_term_meta($brand->term_id, 'brand_thumbnail', 1);
                                        echo wp_get_attachment_image($attach_id, 'full');
                                        ?>
                                    </a>
                                </figure>
                            </div>

                        <?php } ?>


                    </div>
                </div>
            </div>
        </section>

    <?php } elseif ($settings['brand_style'] == 'brand2') { ?>

        <section class="main-brand2">
            <div class="container">
                <div class="ch-main-brand2">
                    <div class="title-brand2">
                        <h4>
                            <i class="fa-regular fa-sun"></i>
                            <?php echo $settings['brand_title']; ?>
                        </h4>
                    </div>
                    <div class="box-brand2">
                        <div class="owl-carousel owl-theme brand-slider2">
                            <?php
                            $term_brand = get_terms(
                                array(
                                    'taxonomy' => 'product_brand',
                                    'hide_empty' => false,

                                )
                            );
                            foreach ($term_brand as $brand) {
                                ?>
                                <div class="item brand-item2">
                                    <figure>
                                        <a href="<?php echo get_term_link($brand->term_id) ?>">
                                            <?php
                                            $attach_id = get_term_meta($brand->term_id, 'brand_thumbnail', 1);
                                            echo wp_get_attachment_image($attach_id, 'full');
                                            ?>
                                        </a>
                                    </figure>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php } ?>


        <script>
            var $ = jQuery;

            $(function () {
                $('.brand-slider').owlCarousel({
                    loop: true,
                    autoplay:<?php if ($settings['autoplay']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 0,
                    nav: true,
                    rtl: true,
                    navText: "",
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 6
                        }
                    }
                })
            })

            $(function () {
                $('.brand-slider2').owlCarousel({
                    loop: true,
                    autoplay:<?php if ($settings['autoplay']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 10,
                    nav: true,
                    rtl: true,
                    navText: "",
                    dots: false,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 5
                        },
                        1000: {
                            items: 8
                        }
                    }
                })
            })

        </script>


        <?php
    }

}
