<?php

class moboland_special_product extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_special_product_widget';
    }

    public function get_title()
    {
        return 'بخش محصولات ویژه موبولند';
    }

    public function get_icon()
    {
        return 'eicon-product-rating';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['product', 'slider'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'special_sell_section',
            [
                'label' => 'بخش محصولات ویژه',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_section',
            [
                'label' => 'عنوان بخش',
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'محصولات ویژه',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => 'تصویر بنر محصولات ویژه',
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/img/banner-v.png',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => 'لینک عکس برا هدایت',
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'post_id',
            [
                'label' => 'آی دی محصولات',
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '35, 25, 7',
                'label_block' => true,
                'description' => 'برای اینکه بدانید آیدی محصولات را چطور باید بدست بیاورید به ویدیو های آموزشی بخش آموزش کار با محصولات ویژه مراجعه کنید. (فقط 3 محصول نمایش داده می شود)',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'special_style_section',
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

        $this->add_control(
            'speed_slider',
            [
                'label' => 'سرعت حرکت',
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 2000,
                'max' => 10000,
                'step' => 1000,
                'default' => 4000,
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $array = explode(',' , $settings['post_id']);
        ?>

        <section class="main-special">

            <h4 class="main-special-title"><?php echo $settings['title_section']; ?></h4>


            <div class="container ch-main-special">


                <div class="box-banner-special">
                    <?php
                    $target = $settings['link']['is_external'] ? 'target="_blank"' : '';
                    $nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
                    ?>
                    <?php if ($settings['image']['url']) { ?>
                        <a <?php echo $target, $nofollow; ?> href="<?php echo $settings['link']['url'] ?>"><img src="<?php echo $settings['image']['url']; ?>" alt=""></a>
                    <?php } ?>
                </div>
                <div class="special-box">
                    <div class="owl-carousel owl-theme special-slider">

                        <?php

                        global $product;
                        $new_product = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'no_found_rows' => true,
                            'post__in' => $array,

                        ));
                        if ($new_product->have_posts()) {
                            while ($new_product->have_posts()) : $new_product->the_post(); ?>
                                <?php global $product; ?>

                                <div class="item special-item" data-dot="<button><div class='list-slider-special'>
                        <figure><img src='<?php echo get_the_post_thumbnail_url(); ?>' alt=''></figure>
                     </div></button>">

                                    <?php
                                    $discount = moboland_wooocmmerce_discount(get_the_ID());
                                    if ($discount > 0) { ?>
                                        <div class="discount-special">
                                            <b><?php echo '%' . $discount; ?></b>
                                            <span>تخفیف ویژه</span>
                                        </div>
                                    <?php } ?>

                                    <figure>
                                        <a href="<?php the_permalink(); ?>"> <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail();
                                            } else {
                                                ?><img
                                                src="<?php echo get_template_directory_uri() . '/img/0.jpg'; ?>"><?php
                                            }
                                            ?></a>
                                    </figure>

                                    <div class="detail-special">
                                        <h2>
                                            <a href="<?php the_permalink(); ?>"
                                               target="_blank"> <?php the_title(); ?></a>
                                        </h2>
                                        <?php do_action('woocommerce_product_additional_information', $product); ?>
                                        <div class="down-special">
                                            <a href="<?php the_permalink(); ?>" target="_blank">مشاهده محصول</a>
                                            <div class="price">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>

                                            <?php include get_template_directory() . '/template/timer.php'; ?>


                                        </div>
                                    </div>

                                </div>

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
                $('.special-slider').owlCarousel({
                    loop:true,
                    autoplay:<?php if ($settings['autoplay']) {
                        echo "true";
                    } else {
                        echo "false";
                    } ?>,
                    autoplayTimeout: <?php echo $settings['speed_slider']; ?>,
                    margin:0,
                    nav:false,
                    rtl: true,
                    dots: true,
                    dotsData: true,
                    navText: "",
                    responsive:{
                        0:{
                            items:1
                        },
                        600:{
                            items:1
                        },
                        1000:{
                            items:1
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

