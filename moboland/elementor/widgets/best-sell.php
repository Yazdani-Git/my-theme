<?php

class moboland_best_sell extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_best_sell_widget';
    }

    public function get_title()
    {
        return 'بخش بیشترین فروش محصولات';
    }

    public function get_icon()
    {
        return 'eicon-favorite';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['product'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'best_sell_section',
            [
                'label' => 'بخش بیشترین فروش محصولات',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_section',
            [
                'label' => 'عنوان بخش',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'پرفروشترین محصولات موبولند',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'لینک بخش',
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title_section_best_sell',
            [
                'label' => 'عنوان بخش پرفروشترین محصول',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'پرفروشترین محصول',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .box-sell .best-sell',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>


        <section class="main-sell">
            <header class="title-product">
                <?php
                $target = $settings['link']['is_external'] ? 'target="_blank"' : '';
                $nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
                ?>
                <?php if ($settings['title_section']) { ?>
                    <h4><a <?php echo $target, $nofollow; ?>
                                href="<?php echo $settings['link']['url'] ?>"><?php echo $settings['title_section']; ?></a>
                    </h4>
                <?php } ?>
            </header>

            <div class="box-sell">

                <?php

                global $product;
                $wallet_product_id = get_option('wallet_virtual_product_id');

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 1,
                    'no_found_rows' => true,
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                );

                if ($wallet_product_id) {
                    $args['post__not_in'] = [$wallet_product_id];
                }

                $best_sell = new WP_Query($args);
                if ($best_sell->have_posts()) {
                    while ($best_sell->have_posts()) : $best_sell->the_post(); ?>

                        <div class="best-sell">
                            <div class="head-best-sell">
                                <div>
                                    <i class="fa-solid fa-trophy"></i>
                                    <?php if ($settings['title_section']) { ?>
                                        <p><?php echo $settings['title_section_best_sell']; ?></p>
                                    <?php } ?>
                                </div>
                                <span>رتبه 1</span>
                            </div>
                            <figure>
                                <a href="<?php the_permalink(); ?>"> <?php
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } else {
                                        ?><img src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                    }
                                    ?></a>
                            </figure>
                            <h2><a href="<?php the_permalink(); ?>" target="_blank"> <?php echo custom_title(); ?></a>
                            </h2>
                            <?php global $product; ?>
                            <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>

                                <div class="price">

                                    <?php echo $product->get_price_html(); ?>

                                </div>

                            <?php } elseif (!$product->is_in_stock()) {
                                echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>محصول موجود نمی باشد!</div>";
                            } else {
                                echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                            } ?>


                            <div class="add-cart">
                                <a href="<?php the_permalink(); ?>">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </div>
                        </div>

                    <?php
                    endwhile;
                }
                wp_reset_postdata();
                ?>


                <div class="other-sell">

                    <?php

                    global $product;
                    $n = 1;

                    $wallet_product_id = get_option('wallet_virtual_product_id');

                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 9,
                        'no_found_rows' => true,
                        'meta_key' => 'total_sales',
                        'orderby' => 'meta_value_num',
                        'offset' => 1,
                    );

                    if ($wallet_product_id) {
                        $args['post__not_in'] = [$wallet_product_id];
                    }

                    $other_sell = new WP_Query($args);
                    if ($other_sell->have_posts()) {
                        while ($other_sell->have_posts()) : $other_sell->the_post();
                            ?>
                            <?php global $product; ?>


                            <div class="product-item">
                                <figure>

                                    <a href="<?php the_permalink(); ?>"> <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } else {
                                            ?><img
                                            src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                        }
                                        ?><i class="fa-regular fa-eye"></i></a>
                                </figure>
                                <h2><a href="<?php the_permalink(); ?>"
                                       target="_blank"> <?php echo custom_title(); ?></a></h2>

                                <div class="down-product">
                        <span class="number">
                            <?php
                            $n = $n + 1;
                            echo $n;
                            ?>
                        </span>
                                    <?php if ($product->is_in_stock() && $product->get_price_html()) { ?>

                                        <div class="price">

                                            <?php echo $product->get_price_html(); ?>

                                        </div>

                                    <?php } elseif (!$product->is_in_stock()) {
                                        echo "<div class='not-stock'><i class='fa-solid fa-multiply'></i>موجود نیست!</div>";
                                    } else {
                                        echo "<div class='call-us'><i class='fa-solid fa-phone-flip'></i>تماس بگیرید</div>";
                                    } ?>

                                </div>
                            </div>

                        <?php
                        endwhile;
                    }
                    wp_reset_postdata();
                    ?>

                </div>


            </div>

        </section>


        <?php
    }

}


