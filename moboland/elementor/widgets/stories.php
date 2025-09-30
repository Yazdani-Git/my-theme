<?php

class moboland_stories extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'main_stories_widget';
    }

    public function get_title()
    {
        return 'بخش استوری موبولند';
    }

    public function get_icon()
    {
        return 'eicon-carousel';
    }

    public function get_categories()
    {
        return ['moboland_widgets'];
    }

    public function get_keywords()
    {
        return ['story'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'stories_section',
            [
                'label' => 'استوری',
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'main_story_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'story_title',
                        'label' => 'عنوان نمایه استوری',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'معرفی S24 Ultra',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image_main_story',
                        'label' => 'انتخاب تصویر نمایه استوری',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => get_template_directory_uri() . '/img/story.webp',
                        ],
                    ],
                    [
                        'name' => 'image_in_story',
                        'label' => 'انتخاب تصویر داخلی استوری',
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => get_template_directory_uri() . '/img/story-1.jpg',
                        ],
                    ],
                    [
                        'name' => 'story_length',
                        'label' => 'طول نمایش استوری به ثانیه',
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'min' => 2,
                        'max' => 10,
                        'step' => 1,
                        'default' => 3,
                    ],
                    [
                        'name' => 'link_title',
                        'label' => 'متن دکمه لینک',
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'کلیک کنید',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'url_story',
                        'label' => 'لینک استوری',
                        'type' => \Elementor\Controls_Manager::URL,
                    ],



                ],
                'default' => [
                    [
                        'image_main_story' => esc_html__('اسلاید #1', 'textdomain'),
                        'story_title' => esc_html__('Item content. Click the edit button to change this text.', 'textdomain'),
                    ],
                ],
                'title_field' => 'استوری',
            ]
        );

        $this->end_controls_section();



    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $stories = $settings['main_story_list'];
        ?>


        <section>

                <div id="stories" class="moboland-story"></div>



                <script src="<?php echo get_template_directory_uri() . '/js/zuck.js'; ?>"></script>
                <script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>

                <script>
                    var $ = jQuery;

                    var currentSkin = getCurrentSkin();
                    var stories = window.Zuck(document.querySelector('#stories'), {
                        backNative: true,
                        previousTap: true,
                        skin: currentSkin['name'],
                        autoFullScreen: currentSkin['params']['autoFullScreen'],
                        avatars: currentSkin['params']['avatars'],
                        paginationArrows: currentSkin['params']['paginationArrows'],
                        list: currentSkin['params']['list'],
                        cubeEffect: currentSkin['params']['cubeEffect'],
                        localStorage: true,
                        stories: [

                            <?php
                            $n2 = 1;
                            $n3 = 1;
                            foreach ($stories as $story) { ?>

                            {
                                id: "<?php $n2 = $n2 + 1;
                                echo $n2 . 'moboland';?>",
                                photo:
                                    '<?php echo $story['image_main_story']['url']; ?>',
                                name: '<?php echo $story['story_title']; ?>',
                                time: timestamp(),
                                items: [


                                    {
                                        id: "<?php $n3 = $n3 + 1;
                                            echo $n3 . 'moboland-story';?>",
                                        type: 'photo',
                                        length: <?php echo $story['story_length']; ?>,
                                        src: '<?php echo $story['image_in_story']['url']; ?>',
                                        preview: '<?php echo $story['image_in_story']['url']; ?>',
                                        link: '<?php echo $story['url_story']['url'] ?>',
                                        linkText: "<?php echo $story['link_title']; ?>",
                                        time: timestamp()
                                    },


                                ]
                            },

                            <?php } ?>

                        ]
                    });
                </script>
        </section>


<?php
    }


}

