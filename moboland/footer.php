<?php $options = get_option('options'); ?>
<footer class="footer">
    <div class="container">
        <div class="footer-box">
            <?php if (is_active_sidebar('moboland_footer_one')) { ?>
                <aside class="footer-widget first-ch">
                    <?php dynamic_sidebar('moboland_footer_one'); ?>
                </aside>
            <?php } ?>
            <?php if (is_active_sidebar('moboland_footer_two')) { ?>
                <aside class="footer-widget">
                    <?php dynamic_sidebar('moboland_footer_two'); ?>
                </aside>
            <?php } ?>
            <?php if (is_active_sidebar('moboland_footer_three')) { ?>
                <aside class="footer-widget">
                    <?php dynamic_sidebar('moboland_footer_three'); ?>
                </aside>
            <?php } ?>
            <?php if (is_active_sidebar('moboland_footer_four')) { ?>
                <aside class="footer-widget">
                    <?php dynamic_sidebar('moboland_footer_four'); ?>
                </aside>
            <?php } ?>
        </div>

        <?php if ($options['active_application']){ ?>
        <div class="application">
            <div class="right-application">
                <?php if ($options['icon_application']['url']){?>
                <img src="<?php echo $options['icon_application']['url'] ?>" alt="">
                <?php } else{ ?>
                    <img src="<?php echo get_template_directory_uri() . '/img/icon-application.png' ?>" alt="">
                <?php } ?>
                <p>دانلود اپلیکیشن</p>
            </div>
            <div class="left-application">
                <?php if ($options['application_sibapp']){ ?>
                <a href="<?php echo $options['application_sibapp'] ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/img/sibapp.svg' ?>" alt="">
                </a>
                <?php } ?>
                <?php if ($options['application_myket']){ ?>
                <a href="<?php echo $options['application_myket'] ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/img/myket.svg' ?>" alt="">
                </a>
                <?php } ?>
                <?php if ($options['application_bazar']){ ?>
                <a href="<?php echo $options['application_bazar'] ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/img/bazar.svg' ?>" alt="">
                </a>
                <?php } ?>
                <?php if ($options['application_play']){ ?>
                <a href="<?php echo $options['application_play'] ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri() . '/img/play.svg' ?>" alt="">
                </a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div class="footer-line">
            <div class="footer-line-right">
                <?php echo $options['text_footer_line']; ?>
            </div>
            <div class="footer-line-left">
                <span id="go-up">
                 <div class="text-go-up"> برو به بالا</div>
                    <i class="fas fa-chevron-up"></i>
                </span>
            </div>
        </div>
        <div class="footer-down">
            <div class="copyright">
                <p>
                    <?php echo $options['text_copy_right']; ?>
                </p>
            </div>
            <div class="social-media">
                <?php
                if ($options['social_group']) {
                    $social = $options['social_group'];
                    foreach ($social as $social_item) {
                        ?>
                        <a href="<?php echo $social_item['link_social']; ?>" target="_blank">
                            <i class="<?php echo $social_item['icon_social']; ?>"></i>
                        </a>
                    <?php }
                }
                ?>
            </div>
        </div>
    </div>
    <?php if ($options['active_contact_us']) { ?>
        <div class="floating-contact">
            <div class="contact-list">
                <?php if ($options['contact_tell']) { ?>
                    <a href="tel:<?php echo $options['contact_tell']; ?>">
                        <span>ارتباط از طریق تماس</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/contact.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_telegram']) { ?>
                    <a href="https://t.me/<?php echo $options['contact_telegram']; ?>">
                        <span>ارتباط از طریق تلگرام</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/telegram.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_instagram']) { ?>
                    <a href="https://www.instagram.com/<?php echo $options['contact_instagram']; ?>">
                        <span>ارتباط از طریق اینستاگرام</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/instagram.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_bale']) { ?>
                    <a href="<?php echo $options['contact_bale']; ?>">
                        <span>ارتباط از طریق بله</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/bale.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_email']) { ?>
                    <a href="mailto:<?php echo $options['contact_email']; ?>">
                        <span>ارتباط از طریق ایمیل</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/email.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_rubika']) { ?>
                    <a href="<?php echo $options['contact_rubika']; ?>">
                        <span>ارتباط از طریق روبیکا</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/rubika.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_soroush']) { ?>
                    <a href="<?php echo $options['contact_soroush']; ?>">
                        <span>ارتباط از طریق سروش</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/soroush.svg' ?>" alt="">
                    </a>
                <?php } ?>
                <?php if ($options['contact_whatsup']) { ?>
                    <a href="https://wa.me/<?php echo $options['contact_whatsup']; ?>">
                        <span>ارتباط از طریق واتس اپ</span>
                        <img src="<?php echo get_template_directory_uri() . '/img/contact/whatsup.svg' ?>" alt="">
                    </a>
                <?php } ?>
            </div>
            <div class="floating-button">
                <i class="fas fa-comment-dots"></i>
            </div>
        </div>
    <?php } ?>



</footer>

<?php wp_footer(); ?>

</body>
</html>