<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<?php $column_style = labb_get_column_class(intval($settings->per_line)); ?>

<div class="labb-services labb-<?php echo $settings->style; ?> labb-container">

    <?php foreach ($settings->services as $service): ?>

        <?php if (!is_object($service))
            continue; ?>

        <div class="labb-service-wrapper <?php echo $column_style; ?>">

            <div class="labb-service">

                <?php if ($service->icon_type == 'icon_image') : ?>

                    <?php $icon_image = $service->icon_image; ?>

                    <?php if (!empty($icon_image)): ?>

                        <div class="labb-image-wrapper">

                            <?php echo wp_get_attachment_image($icon_image, 'full', false, array('class' => 'labb-image full')); ?>

                        </div>

                    <?php endif; ?>

                <?php else : ?>

                    <div class="labb-icon-wrapper">

                        <span class="<?php echo esc_attr($service->font_icon); ?>"></span>

                    </div>

                <?php endif; ?>

                <div class="labb-service-text">

                    <h3 class="labb-title"><?php echo esc_html($service->service_title) ?></h3>

                    <div class="labb-service-details"><?php echo do_shortcode(wp_kses_post($service->service_excerpt)); ?></div>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>