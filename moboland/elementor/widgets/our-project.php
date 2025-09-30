<?php

class moboland_our_project_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_our_project_co';
    }

    public function get_title()
    {
        return 'اسلایدر نمونه کارهای موبولند';
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
            'main_our_projects',
            [
                'label' => 'تنظیمات اسلایدر',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'first_title_our_projects',
            [
                'label' => 'عنوان اول',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'آخرین پروژه های ما',
                'placeholder' => 'عنوان اول را وارد کنید',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'second_title_our_projects',
            [
                'label' => 'عنوان دوم',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'نگاهی به پروژه های ما',
                'placeholder' => 'عنوان دوم را وارد کنید',
                'label_block' => true,
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
            'show_first_text_our_projects',
            [
                'label' => 'نمایش عنوان اول نمونه کارها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_second_text_our_projects',
            [
                'label' => 'نمایش عنوان دوم نمونه کارها',
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
            'show_nav_our_projects',
            [
                'label' => 'نمایش پیکانها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_bullet_our_projects',
            [
                'label' => 'نقطه های زیر اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_our_projects',
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
        ?>


        <section class="our-projects">

            <div class="container">
                <div class="our-project-title">
                    <p><?php echo $settings['first_title_our_projects']; ?></p>
                    <h2><?php echo $settings['second_title_our_projects']; ?></h2>
                </div>
            </div>

            <div class="owl-carousel owl-theme project-slider">
                <?php
                $post_args2 = array(
                    'post_type' => 'projects',
                    'posts_per_page' => 6,
                    'no_found_rows' => true,
                );
                $new_post2 = new WP_Query($post_args2);
                if ($new_post2->have_posts()) {
                    while ($new_post2->have_posts()) : $new_post2->the_post(); ?>


                        <div class="item">
                            <a href="<?php the_permalink(); ?>">
                                <div class="project-slider-item">
                                    <figure>
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } else {
                                            ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                        }
                                        ?>
                                        <h3> <?php the_title(); ?></h3>
                                    </figure>
                                    <div class="cover"></div>
                                </div>
                            </a>
                        </div>
                    <?php
                    endwhile;
                }
                wp_reset_postdata();
                ?>
            </div>

        </section>

        <script>

            var $ = jQuery;


            $(function () {
                $('.project-slider').owlCarousel({
                    loop: true,
                    autoplay:<?php if ($settings['autoplay_our_projects']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    margin: 0,
                    nav: <?php if ($settings['show_nav_our_projects']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    dots: <?php if ($settings['show_bullet_our_projects']) {
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
                            items: 3
                        },
                        1000: {
                            items: 5
                        }
                    }
                })
            })


        </script>


        <?php
    }

}

