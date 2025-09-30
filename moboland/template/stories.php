<section>
    <div class="container">
        <div id="stories" class="moboland-story"></div>

        <script src="<?php echo get_template_directory_uri() . '/js/zuck.js'; ?>"></script>
        <script src="<?php echo get_template_directory_uri() . '/js/script.js'; ?>"></script>

        <script>
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
                    {
                        id: 'ramon',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-1.jpg' ?>',
                        name: 'موبولند',
                        time: timestamp(),
                        items: [
                            {
                                id: 'ramon-1',
                                type: 'photo',
                                length: 3,
                                src: '<?php echo get_template_directory_uri() . '/img/2-1.jpg' ?>',
                                preview: 'img/2-1.jpg',
                                link: 'htpps://mobokade.com',
                                linkText: "کلیک کنید",
                                time: timestamp()
                            },
                            {
                                id: 'ramon-2',
                                type: 'video',
                                length: 0,
                                src: 'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/2.mp4',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/2.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            },
                            {
                                id: 'ramon-3',
                                type: 'photo',
                                length: 3,
                                src: 'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/3.png',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/3.png',
                                link: 'https://ramon.codes',
                                linkText: 'کلیک کنید',
                                time: timestamp()
                            }
                        ]
                    },
                    {
                        id: 'gorillaz',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-3.jpg' ?>',
                        name: 'قهوه',
                        time: timestamp(),
                        items: [
                            {
                                id: 'gorillaz-1',
                                type: 'video',
                                length: 0,
                                src: 'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/4.mp4',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/4.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            },
                            {
                                id: 'gorillaz-2',
                                type: 'photo',
                                length: 3,
                                src: '<?php echo get_template_directory_uri() . '/img/2-2.jpg' ?>',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/5.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            }
                        ]
                    },
                    {
                        id: 'ladygaga',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-4.jpg' ?>',
                        name: 'گوددی',
                        time: timestamp(),
                        items: [
                            {
                                id: 'ladygaga-1',
                                type: 'photo',
                                length: 5,
                                src: '<?php echo get_template_directory_uri() . '/img/2-5.png' ?>',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/6.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            },
                            {
                                id: 'ladygaga-2',
                                type: 'photo',
                                length: 3,
                                src: 'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/7.jpg',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/7.jpg',
                                link: 'http://ladygaga.com',
                                linkText: false,
                                time: timestamp()
                            }
                        ]
                    },
                    {
                        id: 'starboy',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-5.png' ?>',
                        name: 'کاپوچینو',
                        time: timestamp(),
                        items: [
                            {
                                id: 'starboy-1',
                                type: 'photo',
                                length: 5,
                                src: 'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/8.jpg',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/8.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            }
                        ]
                    },
                    {
                        id: 'riversquomo',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-6.png' ?>',
                        name: 'کافی شاپ',
                        time: timestamp(),
                        items: [
                            {
                                id: 'riverscuomo-1',
                                type: 'photo',
                                length: 10,
                                src: '<?php echo get_template_directory_uri() . '/img/2-5.png' ?>',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/9.jpg',
                                link: '',
                                linkText: false,
                                time: timestamp()
                            }
                        ]
                    },
                    {
                        id: 'pishro-1',
                        photo:
                            '<?php echo get_template_directory_uri() . '/img/1-2.jpg' ?>',
                        name: 'جدید',
                        time: timestamp(),
                        items: [
                            {
                                id: 'pishro-1-2',
                                type: 'photo',
                                length: 5,
                                src: '<?php echo get_template_directory_uri() . '/img/2-3.jpg' ?>',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/9.jpg',
                                link: '#',
                                linkText: "کلیک کنید",
                                time: timestamp()
                            },
                            {
                                id: 'pishro-1-3',
                                type: 'photo',
                                length: 5,
                                src: '<?php echo get_template_directory_uri() . '/img/2-4.png' ?>',
                                preview:
                                    'https://raw.githubusercontent.com/ramonszo/assets/master/zuck.js/stories/9.jpg',
                                link: '#',
                                linkText: "کلیک کنید",
                                time: timestamp()
                            }
                        ]
                    },
                ]
            });
        </script>
    </div>
</section>