<?php

class moboland_product_amazing extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_product_amazing';
    }

    public function get_title()
    {
        return 'اسلایدر محصولات ویژه';
    }

    public function get_icon()
    {
        return 'eicon-rating';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['product', 'products', 'carousel'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'product_amazing_carousel',
            [
                'label' => 'تنظیمات اسلایدر محصولات ویژه',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'amazing_style',
            [
                'label' => 'سبک نمایش',
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style11',
                'options' => [
                    'style11' => esc_html__('سبک 1', 'textdomain'),
                    'style22' => esc_html__('سبک 2', 'textdomain'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => 'تصویر اول شگفت انگیزها',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/img/amazings.svg',
                ],
            ]
        );

        $this->add_control(
            'image2',
            [
                'label' => 'تصویر دوم شگفت انگیزها',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/img/amazing.svg',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'عنوان دکمه',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مشاهده همه',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'لینک دکمه',
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'item_slide',
            [
                'label' => 'تعداد آیتم های اسلاید',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 6,
                'step' => 1,
                'default' => 5,
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .amazing-product',
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
                <div class="amazing-product">
                    <div class="owl-carousel owl-theme amazing-slider">
                        <div class="item amazing-pic-item">
                            <figure class="amazing-thumbnail">
                                <?php if ($settings['image']['url']) { ?>
                                    <img src="<?php echo $settings['image']['url']; ?>" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo get_template_directory_uri() . '/img/amazings.svg' ?>" alt="">
                                <?php } ?>
                            </figure>
                            <figure class="amazing-thumbnail">
                                <?php if ($settings['image2']['url']) { ?>
                                    <img src="<?php echo $settings['image2']['url']; ?>" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo get_template_directory_uri() . '/img/amazing.svg' ?>" alt="">
                                <?php } ?>
                            </figure>
                            <?php if ($settings['title']) { ?>
                                <div class="amazing-btn">
                                    <a href="<?php echo $settings['link']['url']; ?>" target="_blank">
                                        <?php echo $settings['title']; ?>
                                        <i class="fa-regular fa-circle-left"></i>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                        <?php




                        $new_product = new WP_Query(array(
                            'post_type'      => 'product',
                            'posts_per_page' => -1,
                            'no_found_rows'  => true,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'product_type',
                                    'field'    => 'slug',
                                    'terms'    => array( 'simple', 'variable' ),
                                ),
                            ),
                        ));



                        if ( $new_product->have_posts() ) {
                            while ( $new_product->have_posts() ) : $new_product->the_post();

                                global $product;

                                // --------------------------
                                // فقط محصولات دارای تخفیف
                                // --------------------------
                                $sale_to_timestamp = null;

// قبل از شروع، متغیرهای تاریخ ریست شوند
                                $year = $month = $day = $hour = $min = $sec = null;

                                if ( $product->is_type( 'simple' ) ) {
                                    $sale_price = $product->get_sale_price();
                                    if ( ! $sale_price ) {
                                        continue; // ساده بدون تخفیف => رد
                                    }

                                    $sale_to_timestamp = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );

                                } elseif ( $product->is_type( 'variable' ) ) {
                                    $min_sale    = $product->get_variation_sale_price( 'min', true );
                                    $min_regular = $product->get_variation_regular_price( 'min', true );

                                    if ( ! $min_sale || $min_sale >= $min_regular ) {
                                        continue; // متغیر بدون تخفیف => رد
                                    }

                                    // پیدا کردن واریانت با کمترین قیمت فروش
                                    $children_ids = $product->get_children();
                                    foreach ( $children_ids as $child_id ) {
                                        $variation = wc_get_product( $child_id );
                                        if ( $variation->get_sale_price() == $min_sale ) {
                                            $sale_to_timestamp = get_post_meta( $variation->get_id(), '_sale_price_dates_to', true );
                                            break;
                                        }
                                    }
                                }

                                if ( !$sale_to_timestamp ) {
                                    continue; // => رد محصولاتی که زمان‌بندی ندارند
                                }

                                // --------------------------

                                // تبدیل تایم‌استمپ به تاریخ
                                if ( $sale_to_timestamp ) {
                                    $year  = date('Y', $sale_to_timestamp);
                                    $month = date('n', $sale_to_timestamp);
                                    $day   = date('j', $sale_to_timestamp);
                                    $hour  = date('G', $sale_to_timestamp);
                                    $min   = date('i', $sale_to_timestamp);
                                    $sec   = date('s', $sale_to_timestamp);
                                }

                                ?>



                                <?php if ($settings['amazing_style'] == 'style11') { ?>

                                    <div class="item product-item">
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

                                        <!-- تایمر -->
                                        <?php if ( $sale_to_timestamp ) { ?>
                                            <div class="box-timer"
                                                 data-target-year="<?php echo esc_attr($year); ?>"
                                                 data-target-month="<?php echo esc_attr($month); ?>"
                                                 data-target-day="<?php echo esc_attr($day); ?>"
                                                 data-target-hour="<?php echo esc_attr($hour); ?>"
                                                 data-target-minute="<?php echo esc_attr($min); ?>"
                                                 data-target-second="<?php echo esc_attr($sec); ?>">
                                                <div class="countdown-timer massages-heddin">
                                                    <div class="number days-section">
                                                        <span class="timer-value days-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number hours-section">
                                                        <span class="timer-value hours-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number minutes-section">
                                                        <span class="timer-value minutes-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number seconds-section">
                                                        <span class="timer-value seconds-value"></span>
                                                    </div>
                                                </div>
                                                <div class="timer-message"><span class="timer-message-text"></span></div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="not-time">تخفیف شگفت انگیز تمام شده!</div>
                                        <?php } ?>

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
                                <?php } elseif ($settings['amazing_style'] == 'style22') {
                                    global $product;
                                    ?>

                                    <div class="item product-item-digikala">
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

                                        <!-- تایمر -->
                                        <?php if ( $sale_to_timestamp ) { ?>
                                            <div class="box-timer"
                                                 data-target-year="<?php echo esc_attr($year); ?>"
                                                 data-target-month="<?php echo esc_attr($month); ?>"
                                                 data-target-day="<?php echo esc_attr($day); ?>"
                                                 data-target-hour="<?php echo esc_attr($hour); ?>"
                                                 data-target-minute="<?php echo esc_attr($min); ?>"
                                                 data-target-second="<?php echo esc_attr($sec); ?>">
                                                <div class="countdown-timer massages-heddin">
                                                    <div class="number days-section">
                                                        <span class="timer-value days-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number hours-section">
                                                        <span class="timer-value hours-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number minutes-section">
                                                        <span class="timer-value minutes-value"></span>
                                                    </div>
                                                    <span class="dot">:</span>
                                                    <div class="number seconds-section">
                                                        <span class="timer-value seconds-value"></span>
                                                    </div>
                                                </div>
                                                <div class="timer-message"><span class="timer-message-text"></span></div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="not-time">تخفیف شگفت انگیز تمام شده!</div>
                                        <?php } ?>

                                        <div class="down-product">

                                            <div class="color-dis">

                                                <?php
                                                $discount = moboland_wooocmmerce_discount(get_the_ID());
                                                if ($discount > 0) {
                                                    echo '<div class="discount">%' . $discount . '</div>';
                                                }
                                                ?>

                                            </div>

                                            <div class="price">
                                                <?php echo $product->get_price_html(); ?>
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
            </div>
        </section>

        <script>
            var $ = jQuery;

            $(function () {
                $('.amazing-slider').owlCarousel({
                    loop: false,
                    margin: 10,
                    nav: true,
                    rtl: true,
                    navText: "",
                    dots: false,
                    responsive: {
                        0: {
                            items: 1
                        },
                        360: {
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

            /***********timer Amazing***********/
            $(document).ready(function () {
                function countdownTimer() {
                    var countdownElements = document.querySelectorAll('.box-timer');
                    countdownElements.forEach(function (countdownElement) {
                        var daysElements = countdownElement.querySelectorAll('.days-value');
                        var hoursElements = countdownElement.querySelectorAll('.hours-value');
                        var minutesElements = countdownElement.querySelectorAll('.minutes-value');
                        var secondsElements = countdownElement.querySelectorAll('.seconds-value');
                        var messageElement = countdownElement.querySelector('.timer-message');
                        var messagesElement = countdownElement.querySelector('.massages-heddin');
                        var targetYear = parseInt(countdownElement.dataset.targetYear);
                        var targetMonth = parseInt(countdownElement.dataset.targetMonth) - 1;
                        var targetDay = parseInt(countdownElement.dataset.targetDay);
                        var targetHour = parseInt(countdownElement.dataset.targetHour);
                        var targetMinute = parseInt(countdownElement.dataset.targetMinute);
                        var targetSecond = parseInt(countdownElement.dataset.targetSecond);
                        var targetDate = new Date(targetYear, targetMonth, targetDay, targetHour, targetMinute, targetSecond);

                        function updateTimer() {
                            var now = new Date().getTime();
                            var timeRemaining = targetDate - now;
                            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
                            for (var i = 0; i < daysElements.length; i++) {
                                daysElements[i].innerHTML = days;
                            }
                            for (var i = 0; i < hoursElements.length; i++) {
                                hoursElements[i].innerHTML = hours;
                            }
                            for (var i = 0; i < minutesElements.length; i++) {
                                minutesElements[i].innerHTML = minutes;
                            }
                            for (var i = 0; i < secondsElements.length; i++) {
                                secondsElements[i].innerHTML = seconds;
                            }
                            if (timeRemaining > 0) {
                                setTimeout(updateTimer, 1000);
                            } else {
                                messagesElement.style.display = 'none';
                                /*messageElement.style.display = 'block';
                                var messageTextElement = messageElement.querySelector('.timer-message-text');
                                messageTextElement.innerHTML = 'تایمر به پایان رسیده است';*/
                            }
                        }

                        updateTimer();
                    });
                }

                countdownTimer();
            });




        </script>


        <?php
    }

}
