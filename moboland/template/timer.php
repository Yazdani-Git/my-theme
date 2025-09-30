<?php
$start_date = get_post_meta($product->id, 'event_start_date', true);
$end_date = get_post_meta($product->id, 'event_end_date', true);

$today = date("Y-m-d");

$year = date("Y", strtotime($end_date));
$month = date("m", strtotime($end_date));
$day = date("d", strtotime($end_date));

if ($today >= $start_date) {
    ?>

    <div class="box-timer" data-target-year="<?php echo $year; ?>" data-target-month="<?php echo $month; ?>"
         data-target-day="<?php echo $day; ?>"
         data-target-hour="23" data-target-minute="59" data-target-second="59">
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

    <?php
}
if ($today > $end_date && $end_date) {
    echo "<span class='end-sale'>تخفیف به اتمام رسیده است!</span>";
}
?>