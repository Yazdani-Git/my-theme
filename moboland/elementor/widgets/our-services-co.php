<?php

class moboland_our_services_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_our_services_co';
    }

    public function get_title()
    {
        return 'خدمات ما پیشرفته';
    }

    public function get_icon()
    {
        return 'eicon-info-box';
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
            'our_services_co',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_our_services_co',
                        'label' => 'انتخاب تصویر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'description' => 'عکس بزرگ در بخش سرویس های ما',
                        'default' => [
                            'url' => get_template_directory_uri() . '/img/service_1.jpeg',
                        ],
                    ],
                    [
                        'name' => 'icon_our_services_co',
                        'label' => 'انتخاب عکس آیکون',
                        'description' => 'پیشنهاد می شود از عکس بدون پس زمینه استفاده کنید طبق نمونه بارگزاری شده',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => get_template_directory_uri() . '/img/2-3.png',
                        ],
                    ],
                    [
                        'name' => 'url_our_services_co',
                        'label' => 'لینک به صفحه مربوطه',
                        'type' => \Elementor\Controls_Manager::URL,
                    ],
                    [
                        'name' => 'heading_our_services_co',
                        'label' => 'عنوان خدمت',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'منابع انسانی',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'text_our_services_co',
                        'label' => 'متن بدنه بخش خدمت',
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'default' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است',
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'image_main_slider' => esc_html__('اسلاید #1', 'textdomain'),
                        'url_main_slider' => esc_html__('برای تغییر کلیک کنید', 'textdomain'),
                    ],
                ],
                'title_field' => 'بخش خدمات',
            ]
        );


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $our_services_co = $settings['our_services_co'];
        ?>

        <section class="our-services-co">
            <div class="container">
                <div class="our-services-co-ch">

                    <?php foreach ($our_services_co as $our_service_co) { ?>
                        <div class="service-co">
                            <div class="title-service-co">
                                <figure><img src="<?php echo $our_service_co['icon_our_services_co']['url'] ?>" alt=""></figure>
                                <a href="<?php echo $our_service_co['url_our_services_co']['url'] ?>"><h2><?php echo $our_service_co['heading_our_services_co'] ?></h2></a>
                            </div>
                            <p><?php echo $our_service_co['text_our_services_co'] ?></p>
                            <figure>
                                <a href="<?php echo $our_service_co['url_our_services_co']['url'] ?>">
                                    <img src="<?php echo $our_service_co['image_our_services_co']['url'] ?>" alt="">
                                    <span><i class="fa-solid fa-arrow-left"></i></span>
                                </a>
                            </figure>
                        </div>
                    <?php } ?>

                </div>

            </div>
        </section>


        <?php
    }

}

