<?php

class moboland_our_team_co extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'moboland_our_team_co';
    }

    public function get_title()
    {
        return 'بخش تیم ما موبولند';
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['our-team'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'main_our_team_co',
            [
                'label' => 'تنظیمات بخش راست نظرات کاربران',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'main_list_our_team_co',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'image_main_our_team_co',
                        'label' => 'انتخاب تصویر کاربر',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'name_main_our_team_co',
                        'label' => 'نام نمایشی کارمند',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'سیامک افراشته',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'job_main_our_team_co',
                        'label' => 'عنوان شغلی کارمند',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'طراح وب سایت',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link_our_team_co_instagram',
                        'label' => 'لینک صفحه اینستاگرام کارمند',
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => 'https://mobowebs.ir/',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link_our_team_co_facebook',
                        'label' => 'لینک صفحه فیس بوک کارمند',
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => 'https://mobowebs.ir/',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link_our_team_co_linkdin',
                        'label' => 'لینک صفحه لینکدین کارمند',
                        'type' => \Elementor\Controls_Manager::URL,
                        'options' => ['url', 'is_external', 'nofollow'],
                        'default' => [
                            'url' => 'https://mobowebs.ir/',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'label_block' => true,
                    ],

                ],
                'default' => [
                    [
                        'image_main_our_team_co' => esc_html__('کارمند #1', 'textdomain'),
                    ],
                ],
                'title_field' => 'اسلایدر',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'our_team_co_style',
            [
                'label' => 'تنظیمات اجزای تیم ما',
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'show_icon_our_team',
            [
                'label' => 'نمایش آیکونهای اجتماعی',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_name_our_team',
            [
                'label' => 'نمایش نام کارمند',
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('نمایش', 'textdomain'),
                'label_off' => esc_html__('مخفی', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_job_our_team',
            [
                'label' => 'نمایش شغل کارمند',
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
        $teams = $settings['main_list_our_team_co'];
        ?>


        <div class="our-team">
            <div class="container">
                <div class="our-team-ch">

                    <?php foreach ($teams as $team) { ?>
                        <div class="our-team-item">
                            <figure>
                                <img src="<?php echo $team['image_main_our_team_co']['url']; ?>" alt="">

                                <?php if ($settings['show_icon_our_team']) { ?>
                                    <div class="our-team-icons">
                                        <?php if ($team['link_our_team_co_instagram']['url']) { ?>
                                            <a href="<?php echo $team['link_our_team_co_instagram']['url']; ?>">
                                                <i class="fa-brands fa-square-instagram"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($team['link_our_team_co_facebook']['url']) { ?>
                                            <a href="<?php echo $team['link_our_team_co_facebook']['url']; ?>">
                                                <i class="fa-brands fa-square-facebook"></i>
                                            </a>
                                        <?php } ?>
                                        <?php if ($team['link_our_team_co_linkdin']['url']) { ?>
                                            <a href="<?php echo $team['link_our_team_co_linkdin']['url']; ?>">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>

                            </figure>
                            <div class="our-team-caption">
                                <?php if ($settings['show_name_our_team']) { ?>
                                <h3><?php echo $team['name_main_our_team_co']; ?></h3>
                                <?php } ?>
                                <?php if ($settings['show_job_our_team']) { ?>
                                <span><?php echo $team['job_main_our_team_co']; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>


        <?php
    }

}

