<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<?php $column_style = labb_get_column_class(intval($settings->per_line)); ?>

<div class="labb-testimonials labb-container">

    <?php foreach ($settings->testimonials as $testimonial) : ?>

        <?php if (!is_object($testimonial))
            continue; ?>

        <div class="labb-testimonial <?php echo $column_style; ?>">

            <div class="labb-testimonial-text">

                <?php echo do_shortcode(wp_kses_post($testimonial->author_text)); ?>

            </div>

            <div class="labb-testimonial-user">

                <div class="labb-image-wrapper">

                    <?php $author_image = $testimonial->author_image; ?>

                    <?php if (!empty($author_image)): ?>

                        <?php echo wp_get_attachment_image($author_image, 'thumbnail', false, array('class' => 'labb-image full')); ?>

                    <?php endif; ?>

                </div>

                <div class="labb-text">

                    <h4 class="labb-author-name"><?php echo esc_html($testimonial->author_name) ?></h4>

                    <div class="labb-author-credentials"><?php echo wp_kses_post($testimonial->credentials); ?></div>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>