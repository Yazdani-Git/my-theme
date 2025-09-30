<?php

class moboland_blog_slider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_blog_widget';
    }

    public function get_title()
    {
        return 'کروسل وبلاگ';
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['blog', 'slider'];
    }

    function get_post_cats()
    {
        $post_cat_list = [];
        $post_cats = get_terms(
            array(
                'taxonomy' => 'category',
                'hide_empty' => true,

            )
        );

        foreach ($post_cats as $post_cat) {
            $post_cat_list [$post_cat->term_id] = $post_cat->name;

        }
        return $post_cat_list;
    }

    function get_post_tags()
    {
        $post_tag_list = [];
        $post_tags = get_terms('post_tag');

        foreach ($post_tags as $post_tag) {
            $post_tag_list [$post_tag->term_id] = $post_tag->name;

        }
        return $post_tag_list;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'post_carousel',
            [
                'label' => 'تنظیمات اسلایدر بلاگ',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'وبلاگ موبولند',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'لینک',
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'blog_style',
            [
                'label' => 'سبک نمایش',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('سبک 1', 'textdomain'),
                    'style2' => esc_html__('سبک 2', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'blog_filter',
            [
                'label' => 'فیلتر محصولات',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__('همه نوشته ها', 'textdomain'),
                    'category' => esc_html__('بر اساس دسته بندی', 'textdomain'),
                    'tag' => esc_html__('بر اساس برچسب', 'textdomain'),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => 'دسته بندی نوشته ها',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_post_cats(),
                'condition' => [
                    'blog_filter' => 'category',
                ],
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => 'برچسب',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_post_tags(),
                'condition' => [
                    'blog_filter' => 'tag',
                ],
            ]
        );

        $this->add_control(
            'post_number',
            [
                'label' => 'تعداد نوشته',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'item_slide',
            [
                'label' => 'تعداد آیتم های اسلاید در دسکتاپ',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 3,
                'max' => 6,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label' => 'نمایش پیکان ها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => 'نمایش نقطه های اسلایدر',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
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
        <section class="home-articles">

            <header class="title-articles">
                <?php
                $target = $settings['link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
                ?>
                <?php if ($settings['title']) { ?>
                    <h4><a <?php echo $target, $nofollow; ?>
                                href="<?php echo $settings['link']['url'] ?>"><?php echo $settings['title'] ?></a>
                    </h4>
                <?php } ?>
                <?php if ($settings['link']['url']) { ?>
                    <div class="show-all">
                        <a <?php echo $target, $nofollow; ?> href="<?php echo $settings['link']['url'] ?>">
                            <i class="fa-solid fa-circle-chevron-left"></i>
                            مشاهده همه
                        </a>
                    </div>
                <?php } ?>
            </header>
            <div class="owl-carousel owl-theme slider-articles">

                <?php
                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $settings['post_number'],
                    'no_found_rows' => true,
                );

                if ($settings['blog_filter'] == 'category') {
                    $add_query = array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'category',
                            'field' => 'term_id',
                            'terms' => $settings['cat'],
                        ),
                    );
                    $post_args['tax_query'] = $add_query;
                } elseif ($settings['blog_filter'] == 'tag') {
                    $add_query = array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'post_tag',
                            'field' => 'term_id',
                            'terms' => $settings['tag'],
                        ),
                    );
                    $post_args['tax_query'] = $add_query;
                }


                global $post;
                $new_post = new WP_Query($post_args);
                if ($new_post->have_posts()) {
                    while ($new_post->have_posts()) : $new_post->the_post(); ?>
                    <?php global $post; ?>
                        <?php if ($settings['blog_style'] == 'style1') { ?>
                        <div class="item article-item">
                            <figure>
                                <a href="<?php the_permalink(); ?>"> <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                    }
                                    ?></a>
                                <div class="blog-tag">
                                    <?php the_category(); ?>
                                </div>
                                <i class="fa-regular fa-eye"></i>
                            </figure>
                            <h2><a href="<?php the_permalink(); ?>" target="_blank">  <?php echo custom_title(); ?> </a></h2>

                            <?php the_excerpt(); ?>

                            <div class="articles-detail">
                                <span><?php the_time('d F Y'); ?></span>
                                <span><?php the_author(); ?></span>
                            </div>
                        </div>
                        <?php } else { ?>


                            <div class="item blog-item-co">
                                <a href="<?php the_permalink(); ?>"><?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                    }
                                    ?></a>
                                <div class="describe-blog-item-co">
                                    <div class="describe-blog-item-co-items">
                                        <i class="fa-solid fa-user"></i>
                                        <span><?php the_author(); ?></span>
                                    </div>
                                    <div class="describe-blog-item-co-items">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span><?php the_time('d F Y'); ?></span>
                                    </div>
                                    <div class="describe-blog-item-co-items">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span><?php the_category(); ?></span>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>"><h2><?php echo custom_title(); ?></h2></a>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="blog-item-co-btn">
                                    ادامه مطلب
                                    <i class="fa-solid fa-caret-left"></i>
                                </a>
                            </div>


                            <?php } ?>

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


                $('.slider-articles').owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: <?php if ($settings['show_nav']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    rtl: true,
                    navText: "",
                    dots: <?php if ($settings['show_dots']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    responsive: {
                        0: {
                            items: 1
                        },
                        576: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1000: {
                            items: <?php echo $settings['item_slide']; ?>
                        }
                    }
                });

                $('.blog-co-slider').owlCarousel({
                    loop:false,
                    margin:20,
                    nav: <?php if ($settings['show_nav']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    rtl: true,
                    dots: <?php if ($settings['show_dots']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    navText: "",
                    responsive:{
                        0: {
                            items: 1
                        },
                        576: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1000: {
                            items: <?php echo $settings['item_slide']; ?>
                        }
                    }
                })






            })
        </script>


        <?php
    }

}





