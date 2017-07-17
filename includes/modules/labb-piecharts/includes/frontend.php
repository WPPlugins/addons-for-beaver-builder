<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<?php $column_style = labb_get_column_class(intval($settings->per_line)); ?>

<?php

$bar_color = ' data-bar-color="#' . esc_attr($settings->bar_color) . '"';
$track_color = ' data-track-color="#' . esc_attr($settings->track_color) . '"';

?>

<div class="labb-piecharts labb-container">

    <?php foreach ($settings->piecharts as $piechart): ?>

        <?php if (!is_object($piechart))
            continue; ?>

        <div class="labb-piechart <?php echo $column_style; ?>">

            <div class="labb-percentage" <?php echo $bar_color; ?> <?php echo $track_color; ?>
                 data-percent="<?php echo intval($piechart->percentage); ?>">

                <span><?php echo intval($piechart->percentage); ?><sup>%</sup></span>

            </div>

            <div class="labb-label"><?php echo esc_html($piechart->stats_title); ?></div>

        </div>

        <?php

    endforeach;

    ?>

</div>