<?php

class moboland_product extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_product_widget';
    }

    public function get_title()
    {
        return 'کروسل محصولات';
    }

    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['product', 'products', 'carousel'];
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
            'product_carousel',
            [
                'label' => 'تنظیمات اسلایدر محصولات',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'جدیدترین محصولات موبولند',
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
            'product_style',
            [
                'label' => 'سبک نمایش',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('سبک 1', 'textdomain'),
                    'style2' => esc_html__('سبک 2', 'textdomain'),
                    'style3' => esc_html__('سبک پوشاک', 'textdomain'),
                    'style4' => esc_html__('سبک 4', 'textdomain'),
                ],
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
            'product_number',
            [
                'label' => 'تعداد محصولات',
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
                'label' => 'تعداد آیتم های اسلاید',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 4,
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

        $this->add_control(
            'attributes',
            [
                'label' => 'نمایش ویژگی ها',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
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


        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

        <section class="main-product">
            <div class="container">
                <header class="title-product">
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
                <div class="owl-carousel owl-theme slider-product">

                    <?php
                    $product_args = array(
                        'post_type' => 'product',
                        'posts_per_page' => $settings['product_number'],
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

                    $wallet_product_id = get_option('wallet_virtual_product_id');
                    if ($wallet_product_id) {
                        $product_args['post__not_in'][] = $wallet_product_id;
                    }


                    global $product;
                    $new_product = new WP_Query($product_args);
                    if ($new_product->have_posts()) {
                        while ($new_product->have_posts()) : $new_product->the_post(); ?>
                            <?php global $product; ?>

                            <?php if ($settings['product_style'] == 'style1') { ?>
                                <div class="item product-item">

                                    <figure>
                                        <a href="<?php the_permalink(); ?>">


                                            <?php
                                            if (has_post_thumbnail()) {
                                                $main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                $attachment_ids = $product->get_gallery_image_ids();
                                                $second_image = !empty($attachment_ids) ? wp_get_attachment_image_url($attachment_ids[0], 'full') : $main_image;
                                                ?>
                                                <img class="product-image-main"
                                                     src="<?php echo esc_url($main_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                                <img class="product-image-hover"
                                                     src="<?php echo esc_url($second_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"
                                                     alt="No Image">
                                            <?php } ?>

                                        </a>
                                    </figure>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           target="_blank"> <?php echo custom_title(); ?></a>
                                    </h2>
                                    <div class="color-dis">

                                        <?php
                                        global $product;
                                        if ($settings['attributes']) {
                                            $attr_taxonomy = wc_get_attribute_taxonomies();
                                            foreach ($attr_taxonomy as $item) {
                                                $attr_name = $item->attribute_name;
                                                $terms = get_the_terms($product->id, 'pa_' . $attr_name);
                                                if (is_array($terms)) { ?>
                                                    <div class="color-attr">
                                                        <ul>
                                                            <?php
                                                            foreach ($terms as $term) {

                                                                $tooltip = $term->name;
                                                                $colors = get_term_meta($term->term_id, 'product_attribute_color', 1);
                                                                ?>
                                                                <?php if ($colors) { ?>
                                                                    <li>
                                                                        <span style="background: <?php echo $colors; ?>"><b><?php echo $tooltip; ?></b></span>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>


                                        <?php
                                        $discount = moboland_wooocmmerce_discount(get_the_ID());
                                        if ($discount > 0) {
                                            echo '<div class="discount">%' . $discount . '</div>';
                                        }
                                        ?>

                                    </div>


                                    <div class="down-product">

                                        <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>

                                            <div class="addtocart-button">
                                                <?php
                                                global $product;
                                                echo sprintf('<a href="%s" data-quantity="1" class="%s" %s><i class="fa-solid fa-circle-plus"></i></a>',
                                                    esc_url($product->add_to_cart_url()),
                                                    esc_attr(implode(' ', array_filter(array(
                                                        'button', 'product_type_' . $product->get_type(),
                                                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                        $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                                    )))),
                                                    wc_implode_html_attributes(array(
                                                        'data-product_id' => $product->get_id(),
                                                        'data-product_sku' => $product->get_sku(),
                                                        'aria-label' => $product->add_to_cart_description(),
                                                        'rel' => 'nofollow',
                                                    )),
                                                    esc_html($product->add_to_cart_text())
                                                );
                                                ?>
                                            </div>
                                            <div class="price">

                                                <?php echo $product->get_price_html(); ?>

                                            </div>

                                        <?php } elseif (!$product->is_in_stock()) {
                                            echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                                        } else {
                                            echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                                        } ?>


                                    </div>


                                </div>
                            <?php } elseif ($settings['product_style'] == 'style2') { ?>

                                <div class="item product-item">

                                    <figure>
                                        <a href="<?php the_permalink(); ?>">


                                            <?php
                                            if (has_post_thumbnail()) {
                                                $main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                $attachment_ids = $product->get_gallery_image_ids();
                                                $second_image = !empty($attachment_ids) ? wp_get_attachment_image_url($attachment_ids[0], 'full') : $main_image;
                                                ?>
                                                <img class="product-image-main"
                                                     src="<?php echo esc_url($main_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                                <img class="product-image-hover"
                                                     src="<?php echo esc_url($second_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"
                                                     alt="No Image">
                                            <?php } ?>

                                        </a>
                                    </figure>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           target="_blank"> <?php echo custom_title(); ?></a>
                                    </h2>
                                    <div class="color-dis">

                                        <?php
                                        global $product;
                                        if ($settings['attributes']) {
                                            $attr_taxonomy = wc_get_attribute_taxonomies();
                                            foreach ($attr_taxonomy as $item) {
                                                $attr_name = $item->attribute_name;
                                                $terms = get_the_terms($product->id, 'pa_' . $attr_name);
                                                if (is_array($terms)) { ?>
                                                    <div class="color-attr">
                                                        <ul>
                                                            <?php
                                                            foreach ($terms as $term) {

                                                                $tooltip = $term->name;
                                                                $colors = get_term_meta($term->term_id, 'product_attribute_color', 1);
                                                                ?>
                                                                <?php if ($colors) { ?>
                                                                    <li>
                                                                        <span style="background: <?php echo $colors; ?>"><b><?php echo $tooltip; ?></b></span>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>


                                        <?php
                                        $discount = moboland_wooocmmerce_discount(get_the_ID());
                                        if ($discount > 0) {
                                            echo '<div class="discount">%' . $discount . '</div>';
                                        }
                                        ?>

                                    </div>


                                    <div class="down down-two">
                                        <?php
                                        if ($product->is_in_stock()) : ?>
                                            <?php if ($product->get_price_html()) : ?>
                                                <div class="price"><?php echo $product->get_price_html(); ?></div>
                                            <?php else : ?>
                                                <div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="not-stock"><i class="fa-solid fa-multiply"></i>موجود نیست !
                                            </div>
                                        <?php endif; ?>

                                        <div class="wish-add">
                                            <div class="add-to-cart">
                                                <?php
                                                echo sprintf('<a href="%s" data-quantity="1" class="%s" %s> %s</a>',
                                                    esc_url($product->add_to_cart_url()),
                                                    esc_attr(implode(' ', array_filter(array(
                                                        'button', 'product_type_' . $product->get_type(),
                                                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                        $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                                    )))),
                                                    wc_implode_html_attributes(array(
                                                        'data-product_id' => $product->get_id(),
                                                        'data-product_sku' => $product->get_sku(),
                                                        'aria-label' => $product->add_to_cart_description(),
                                                        'rel' => 'nofollow',
                                                    )),
                                                    esc_html($product->add_to_cart_text())
                                                );
                                                ?>
                                            </div>
                                            <div class="wishlist-button">
                                                <?php
                                                $id = $product->id;
                                                echo do_shortcode("[woosw id=$id]") ?>
                                            </div>
                                        </div>

                                    </div>


                                </div>


                            <?php } elseif ($settings['product_style'] == 'style3') { ?>

                                <div class="item product-item-style">

                                    <figure>
                                        <a href="<?php the_permalink(); ?>">

                                            <?php
                                            if (has_post_thumbnail()) {
                                                $main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                $attachment_ids = $product->get_gallery_image_ids();
                                                $second_image = !empty($attachment_ids) ? wp_get_attachment_image_url($attachment_ids[0], 'full') : $main_image;
                                                ?>
                                                <img class="product-image-main"
                                                     src="<?php echo esc_url($main_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                                <img class="product-image-hover"
                                                     src="<?php echo esc_url($second_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"
                                                     alt="No Image">
                                            <?php } ?>

                                        </a>
                                    </figure>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           target="_blank"> <?php echo custom_title(); ?></a>
                                    </h2>
                                    <div class="color-dis">

                                        <?php
                                        global $product;
                                        if ($settings['attributes']) {
                                            $attr_taxonomy = wc_get_attribute_taxonomies();
                                            foreach ($attr_taxonomy as $item) {
                                                $attr_name = $item->attribute_name;
                                                $terms = get_the_terms($product->id, 'pa_' . $attr_name);
                                                if (is_array($terms)) { ?>
                                                    <div class="color-attr">
                                                        <ul>
                                                            <?php
                                                            foreach ($terms as $term) {

                                                                $tooltip = $term->name;
                                                                $colors = get_term_meta($term->term_id, 'product_attribute_color', 1);
                                                                ?>
                                                                <?php if ($colors) { ?>
                                                                    <li>
                                                                        <span style="background: <?php echo $colors; ?>"><b><?php echo $tooltip; ?></b></span>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>


                                        <?php
                                        $discount = moboland_wooocmmerce_discount(get_the_ID());
                                        if ($discount > 0) {
                                            echo '<div class="discount">%' . $discount . '</div>';
                                        }
                                        ?>

                                    </div>


                                    <div class="down-product">

                                        <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>

                                            <div class="price">

                                                <?php echo $product->get_price_html(); ?>

                                            </div>

                                        <?php } elseif (!$product->is_in_stock()) {
                                            echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                                        } else {
                                            echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                                        } ?>


                                    </div>


                                </div>

                            <?php } elseif ($settings['product_style'] == 'style4') { ?>


                                <div class="item product-style-4">



                                        <?php
                                        $discount = moboland_wooocmmerce_discount(get_the_ID());
                                        if ($discount > 0) {
                                            echo '<div class="discount">%' . $discount . '</div>';
                                        }
                                        ?>




                                    <div class="product-detail-s4">

                                        <div class="btn-fav-s4">
                                            <div><?php
                                                $id = $product->id;
                                                echo do_shortcode("[woosw id=$id]") ?></div>

                                            <div class="name-of-btn">افزون به علاقمندی ها</div>
                                        </div>

                                        <div class="btn-comp-s4">
                                            <div>
                                                <?php echo do_shortcode('[compare_button id="' . get_the_ID() . '"]'); ?>
                                            </div>

                                            <div class="name-of-btn">مقایسه</div>
                                        </div>

                                        <div class="link-to-pro-s4">
                                            <a href="<?php the_permalink(); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                     viewBox="0 0 24 24" fill="none">
                                                    <path d="M14 4C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V13M10 4C6.22876 4 4.34315 4 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H13"
                                                          stroke="#303030" stroke-width="1.5" stroke-linecap="round"/>
                                                    <path d="M10 16H6" stroke="#303030" stroke-width="1.5"
                                                          stroke-linecap="round"/>
                                                    <circle cx="18" cy="17" r="3" stroke="#303030" stroke-width="1.5"/>
                                                    <path d="M20.5 19.5L21.5 20.5" stroke="#303030" stroke-width="1.5"
                                                          stroke-linecap="round"/>
                                                    <path d="M2 10L7 10M22 10L11 10" stroke="#303030" stroke-width="1.5"
                                                          stroke-linecap="round"/>
                                                </svg>
                                            </a>
                                            <div class="name-of-btn">دیدن محصول</div>

                                        </div>

                                    </div>

                                    <figure>
                                        <a href="<?php the_permalink(); ?>">

                                            <?php
                                            if (has_post_thumbnail()) {
                                                $main_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                                $attachment_ids = $product->get_gallery_image_ids();
                                                $second_image = !empty($attachment_ids) ? wp_get_attachment_image_url($attachment_ids[0], 'full') : $main_image;
                                                ?>
                                                <img class="product-image-main"
                                                     src="<?php echo esc_url($main_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                                <img class="product-image-hover"
                                                     src="<?php echo esc_url($second_image); ?>"
                                                     alt="<?php the_title(); ?>">
                                            <?php } else { ?>
                                                <img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"
                                                     alt="No Image">
                                            <?php } ?>

                                        </a>
                                    </figure>
                                    <h2><a href="<?php the_permalink(); ?>"
                                           target="_blank"> <?php echo custom_title(); ?></a>
                                    </h2>

                                    <div class="down-product">

                                        <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>

                                            <div class="price">

                                                <?php echo $product->get_price_html(); ?>

                                            </div>

                                        <?php } elseif (!$product->is_in_stock()) {
                                            echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                                        } else {
                                            echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                                        } ?>


                                    </div>

                                    <div class="add-to-cart-s4">
                                        <div class="add-to-cart">
                                            <?php
                                            echo sprintf('<a href="%s" data-quantity="1" class="%s" %s> 
            <span class="add-to-cart-text">%s</span>
            <span class="cart-icon"><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" fill="none">
<path d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H13M19 15.5H17" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
<path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" stroke="white" stroke-width="1.5"/>
<path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" stroke="white" stroke-width="1.5"/>
<path d="M5 6H8M5.5 13H16.0218C16.9812 13 17.4609 13 17.8366 12.7523C18.2123 12.5045 18.4013 12.0636 18.7792 11.1818L19.2078 10.1818C20.0173 8.29294 20.4221 7.34853 19.9775 6.67426C19.5328 6 18.5054 6 16.4504 6H12" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</svg></span>
            </a>',
                                                esc_url($product->add_to_cart_url()),
                                                esc_attr(implode(' ', array_filter(array(
                                                    'button', 'product_type_' . $product->get_type(),
                                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                    $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
                                                )))),
                                                wc_implode_html_attributes(array(
                                                    'data-product_id' => $product->get_id(),
                                                    'data-product_sku' => $product->get_sku(),
                                                    'aria-label' => $product->add_to_cart_description(),
                                                    'rel' => 'nofollow',
                                                )),
                                                esc_html($product->add_to_cart_text())
                                            );
                                            ?>
                                        </div>
                                    </div>

                                </div>


                            <?php } ?>

                        <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                </div>
            </div>
        </section>

        <script>
            var $ = jQuery;

            $(function () {
                $('.slider-product').owlCarousel({
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
                        768: {
                            items: 3
                        },
                        992: {
                            items: 4
                        },
                        1200: {
                            items: <?php echo $settings['item_slide']; ?>
                        }
                    }
                })
            })
        </script>

        <?php
    }

}


