<?php


//حذف استار ریتینگ
remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);

//اضافه کردن تگ دیو کانترینر
add_action('woocommerce_review_before_comment_meta', 'moboland_before_comment_meta', 10);
add_action('woocommerce_review_before_comment_text', 'moboland_before_comment_text', 10);

function moboland_before_comment_meta()
{
    echo '<div class="right-review">';
    woocommerce_review_display_rating();

    global $comment;
    $recommend = get_comment_meta($comment->comment_ID, 'recommendstatus', true);
    if ($recommend == 1) {
        echo '<div class="show-recommend-status-yes">
        <span class="recommend-status-yes">خرید این محصول را پیشنهاد می دهم</span>
    </div>';
    }

    if ($recommend == 0) {
        echo '<div class="show-recommend-status-no">
        <span class="recommend-status-no">خرید این محصول را پیشنهاد نمی دهم</span>
    </div>';
    }


}

function moboland_before_comment_text()
{
    echo '</div>';
}

add_action('woocommerce_review_after_comment_text', 'moboland_after_comment_text', 10);

function moboland_after_comment_text()
{
    global $comment;
    $design = get_comment_meta($comment->comment_ID, 'range1', true);
    $karayi = get_comment_meta($comment->comment_ID, 'range2', true);
    $price_pr = get_comment_meta($comment->comment_ID, 'range3', true);
    $buy_pr = get_comment_meta($comment->comment_ID, 'range4', true);
    $beauty = get_comment_meta($comment->comment_ID, 'range5', true);
    ?>

    <?php
    $options = get_option('options');
    ?>
    <div class="show-my-rate">
        <div class="rate-item">
            <span><?php echo $options['review_but'] ?></span>
            <div CLASS="rate-content">
                <div class="rate-resulte" style="width: <?php echo $design; ?>%"></div>
            </div>
        </div>
        <div class="rate-item">
            <span><?php echo $options['review_power'] ?></span>
            <div CLASS="rate-content">
                <div class="rate-resulte" style="width: <?php echo $karayi; ?>%"></div>
            </div>
        </div>
        <div class="rate-item">
            <span><?php echo $options['review_quality'] ?></span>
            <div CLASS="rate-content">
                <div class="rate-resulte" style="width: <?php echo $price_pr; ?>%"></div>
            </div>
        </div>
        <div class="rate-item">
            <span><?php echo $options['review_property'] ?></span>
            <div CLASS="rate-content">
                <div class="rate-resulte" style="width: <?php echo $buy_pr; ?>%"></div>
            </div>
        </div>
        <div class="rate-item">
            <span><?php echo $options['review_buy'] ?></span>
            <div CLASS="rate-content">
                <div class="rate-resulte" style="width: <?php echo $beauty; ?>%"></div>
            </div>
        </div>
    </div>
    <?php
}

add_action('comment_form_top', 'ecommercehints_comment_form_top', 10);
function ecommercehints_comment_form_top()
{
    if (is_product()) { ?>
        <div class="custom-field-review">
        <div class="review-radio-question">
            <header>آیا خرید این محصول را پیشنهاد می دهید؟</header>
            <div class="radio-list">
                <div class="radio-item">
                    <input type="radio" id="yes_suggest" name="recommendstatus" checked value="1">
                    <label for="yes_suggest">بله پیشنهاد میکنم</label>
                </div>
                <div class="radio-item">
                    <input type="radio" id="no_suggest" name="recommendstatus" value="0">
                    <label for="no_suggest">خیر پیشنهاد نمیکنم</label>
                </div>
                <div class="radio-item">
                    <input type="radio" id="no_idea" name="recommendstatus" value="2">
                    <label for="no_idea">نظری ندارم</label>
                </div>
            </div>
        </div>
        <?php
        $options = get_option('options');
        if ($options['active_slider_reviews']) {
            ?>
            <div class="rate-list">
            <?php if ($options['review_but']) { ?>
                <div class="rate-item">
                    <b><?php echo $options['review_but'] ?></b>
                    <input type="range" name="range1" min="10" max="100" step="10" value="50">
                </div>
            <?php } ?>
            <?php if ($options['review_power']) { ?>
                <div class="rate-item">
                    <b><?php echo $options['review_power'] ?></b>
                    <input type="range" name="range2" min="10" max="100" step="10" value="50">
                </div>
            <?php } ?>
            <?php if ($options['review_quality']) { ?>
                <div class="rate-item">
                    <b><?php echo $options['review_quality'] ?></b>
                    <input type="range" name="range3" min="10" max="100" step="10" value="50">
                </div>
            <?php } ?>
            <?php if ($options['review_property']) { ?>
                <div class="rate-item">
                    <b><?php echo $options['review_property'] ?></b>
                    <input type="range" name="range4" min="10" max="100" step="10" value="50">
                </div>
            <?php } ?>
            <?php if ($options['review_buy']) { ?>
                <div class="rate-item">
                    <b><?php echo $options['review_buy'] ?></b>
                    <input type="range" name="range5" min="10" max="100" step="10" value="50">
                </div>
            <?php } ?>
                </div>

            <?php } ?>
            </div>

            <?php
        }
    }

//ذخیره کردن اطلاعات اضافی در دیتابیس
    add_action('comment_post', 'save_review_pros_and_cons');
    function save_review_pros_and_cons($comment_id)
    {
        if (isset($_POST['recommendstatus'])) {
            $recommendstatus = sanitize_text_field($_POST['recommendstatus']);
            add_comment_meta($comment_id, 'recommendstatus', $recommendstatus);
        }

        if (isset($_POST['range1'])) {
            $range1 = sanitize_text_field($_POST['range1']);
            add_comment_meta($comment_id, 'range1', $range1);
        }

        if (isset($_POST['range2'])) {
            $range2 = sanitize_text_field($_POST['range2']);
            add_comment_meta($comment_id, 'range2', $range2);
        }

        if (isset($_POST['range3'])) {
            $range3 = sanitize_text_field($_POST['range3']);
            add_comment_meta($comment_id, 'range3', $range3);
        }

        if (isset($_POST['range4'])) {
            $range4 = sanitize_text_field($_POST['range4']);
            add_comment_meta($comment_id, 'range4', $range4);
        }

        if (isset($_POST['range5'])) {
            $range5 = sanitize_text_field($_POST['range5']);
            add_comment_meta($comment_id, 'range5', $range5);
        }
    }

