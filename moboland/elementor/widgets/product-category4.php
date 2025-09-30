<?php

class moboland_product_category4 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_product_widget_style4';
    }

    public function get_title()
    {
        return 'دسته بندی محصولات استایل 4';
    }

    public function get_icon()
    {
        return 'eicon-posts-justified';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['product', 'products', 'category'];
    }

    function get_product_cats()
    {
        $cat_list = [];
        $product_cat = get_terms(
            array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,

            )
        );

        foreach ($product_cat as $cat) {
            $cat_list [$cat->term_id] = $cat->name;

        }
        return $cat_list;
    }

    function get_product_tags()
    {
        $tag_list = [];
        $product_tag = get_terms('product_tag');

        foreach ($product_tag as $tag) {
            $tag_list [$tag->term_id] = $tag->name;

        }
        return $tag_list;
    }

    function get_product_brands()
    {
        $brand_list = [];
        $product_brand = get_terms('product_brand');

        foreach ($product_brand as $brand) {
            $brand_list [$brand->term_id] = $brand->name;

        }
        return $brand_list;
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'product_carousel_style4',
            [
                'label' => 'تنظیمات دسته بندی محصولات',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'دسته بندی محصولات دیجیتال',
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
            'product_filter',
            [
                'label' => 'فیلتر محصولات',
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'all' => esc_html__('همه محصولات', 'textdomain'),
                    'category' => esc_html__('بر اساس دسته بندی', 'textdomain'),
                    'tag' => esc_html__('بر اساس برچسب', 'textdomain'),
                    'brand' => esc_html__('بر اساس برند', 'textdomain'),
                ],
                'default' => 'all',
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => 'دسته بندی',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_product_cats(),
                'condition' => [
                    'product_filter' => 'category',
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
                'options' => $this->get_product_tags(),
                'condition' => [
                    'product_filter' => 'tag',
                ],
            ]
        );

        $this->add_control(
            'brand',
            [
                'label' => 'برند',
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_product_brands(),
                'condition' => [
                    'product_filter' => 'brand',
                ],
            ]
        );

        $this->add_control(
            'stock',
            [
                'label' => 'حذف محصولات ناموجود',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('فعال', 'textdomain'),
                'label_off' => esc_html__('غیر فعال', 'textdomain'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => 'تصویر بنر دسته بندی ها',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/img/mobile-banner.webp',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <section class="single-cat-digikala">
            <header class="title-single-cat-digikala">
                <?php
                $target = $settings['link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
                ?>
                <?php if ($settings['title']) { ?>
                    <h4><a <?php echo $target, $nofollow; ?>
                                href="<?php echo $settings['link']['url'] ?>"><?php echo $settings['title'] ?></a>
                    </h4>
                <?php } ?>
            </header>
            <div class="single-cat-ch-digikala">

                <?php
                $product_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'no_found_rows' => true,
                );

                if ($settings['product_filter'] == 'category') {
                    $add_query = array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => $settings['cat'],
                        ),
                    );
                    $product_args['tax_query'] = $add_query;
                } elseif ($settings['product_filter'] == 'tag') {
                    $add_query = array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'product_tag',
                            'field' => 'term_id',
                            'terms' => $settings['tag'],
                        ),
                    );
                    $product_args['tax_query'] = $add_query;
                } elseif ($settings['product_filter'] == 'brand') {
                    $add_query = array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'product_brand',
                            'field' => 'term_id',
                            'terms' => $settings['brand'],
                        ),
                    );
                    $product_args['tax_query'] = $add_query;
                }

                if ($settings['stock']) {
                    $add_query = array(
                        array(
                            'key' => '_stock_status',
                            'value' => 'instock',
                            'compare' => '=',
                        ),
                    );
                    $product_args['meta_query'] = $add_query;
                }

                global $product;
                $new_product = new WP_Query($product_args);

                global $product;
                if ($new_product->have_posts()) {
                    while ($new_product->have_posts()) : $new_product->the_post(); ?>

                        <div class="single-cat-item-digikala">
                            <figure>
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        ?><img
                                        src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                    }
                                    ?>
                                </a>
                                <i class="fa-regular fa-eye"></i>
                            </figure>
                        </div>


                    <?php
                    endwhile;
                }
                wp_reset_postdata();
                ?>


            </div>
            <?php if ($settings['link']['url']) { ?>
                <div class="show-all-digikala">
                    <a <?php echo $target, $nofollow; ?> href="<?php echo $settings['link']['url'] ?>">
                        <i class="fa-solid fa-circle-chevron-left"></i>
                        مشاهده همه
                    </a>
                </div>
            <?php } ?>
        </section>

        <?php
    }

}


