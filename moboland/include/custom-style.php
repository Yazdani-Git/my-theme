<?php

add_action('wp_head', 'custom_style_moboland');
function custom_style_moboland()
{
    $options = get_option('options');
    ?>

    <style>

        body {
            font-family: "<?php echo $options['font_body']; ?>";
            font-size: <?php echo $options['font_size']; ?>px;
            color: <?php echo $options['font_color']; ?>;
            line-height: <?php echo $options['font_line_height']; ?>;
        }

        input, button {
            font-family: "<?php echo $options['font_body']; ?>";
        }

        input[type="date"],
        input[type="email"],
        input[type="number"],
        input[type="password"],
        input[type="search"],
        input[type="tel"],
        input[type="text"],
        input[type="time"],
        input[type="url"],
        textarea {
            font-family: "<?php echo $options['font_body']; ?>";
        }

        .button {
            font-family: "<?php echo $options['font_body']; ?>";
        }

        .mid-header-right .search-main form input[type="search"] {
            font-family: "<?php echo $options['font_body']; ?>";
        }

        .mid-header-right .logo {
            max-width: <?php echo $options['logo_width']; ?>px;
        }

        .header-co .mid-header-co .mid-header-co-ch .mid-header-co-ch-right .logo {
            max-width: <?php echo $options['logo_width']; ?>px;
        }

        .container {
            max-width: <?php echo $options['container_width']; ?>px;
        }

        :root {
            --main-color: <?php echo $options['main_color']; ?>;
            --second-color: <?php echo $options['second_color']; ?>;
        }
    </style>
    <?php
}



