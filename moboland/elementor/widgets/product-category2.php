<?php

class moboland_product_category2 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_product_widget_style2';
    }

    public function get_title()
    {
        return 'دسته بندی محصولات استایل 2';
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
            'product_carousel_style2',
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

        <section class="single-cat">
            <header class="title-single-cat">
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
            <div class="single-cat-ch">
                <div class="single-cat-right">

                    <?php


                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,
                        'no_found_rows' => true,
                    );

                    // فیلتر بر اساس نوع
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

                    // فیلتر براساس موجودی
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

                    // ✅ حذف محصول شارژ کیف پول
                    $wallet_product_id = get_option('wallet_virtual_product_id');
                    if ($wallet_product_id) {
                        $product_args['post__not_in'][] = $wallet_product_id;
                    }

                    global $product;
                    $new_product = new WP_Query($product_args);

                    if ($new_product->have_posts()) {
                        while ($new_product->have_posts()) : $new_product->the_post(); ?>

                            <div class="item single-cat-item">
                                <div class="single-cat-item-img">
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
                                <div class="single-cat-item-detail">
                                    <h2><a href="<?php the_permalink(); ?>"
                                           target="_blank"> <?php the_title(); ?></a></h2>
                                    <div class="price">

                                        <?php
                                        global $product;
                                        echo $product->get_price_html();
                                        ?>

                                    </div>
                                </div>
                            </div>

                        <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                </div>
                <div class="single-cat-left">
                    <figure>

                        <?php if ($settings['image']['url']) { ?>
                            <img src="<?php echo $settings['image']['url']; ?>" alt="">
                        <?php } ?>
                    </figure>
                </div>
            </div>
        </section>

        <?php
    }

}


