<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<?php $column_style = labb_get_column_class(intval($settings->per_line)); ?>

<div class="labb-pricing-table labb-container">

    <?php foreach ($settings->pricing_plans as $pricing_plan) : ?>

        <?php if (!is_object($pricing_plan))
            continue; ?>

        <?php

        $pricing_title = esc_html($pricing_plan->pricing_title);
        $tagline = esc_html($pricing_plan->tagline);
        $price_tag = htmlspecialchars_decode(wp_kses_post($pricing_plan->price_tag));
        $pricing_img = $pricing_plan->pricing_image;
        $pricing_url = (empty($pricing_plan->pricing_url)) ? '#' : esc_url($pricing_plan->pricing_url);
        $pricing_button_text = esc_html($pricing_plan->button_text);
        $new_window = ($pricing_plan->new_window == 'yes');
        $highlight = ($pricing_plan->highlight == 'yes');

        $price_tag = (empty($price_tag)) ? '' : $price_tag;

        ?>

        <div class="labb-pricing-plan <?php echo $highlight ? ' labb-highlight' : ''; ?> <?php echo $column_style; ?>">

            <div class="labb-top-header">

                <?php if (!empty($tagline))
                    echo '<p class="labb-tagline center">' . $tagline . '</p>'; ?>

                <h3 class="labb-center"><?php echo $pricing_title; ?></h3>

                <?php

                if (!empty($pricing_img)) :
                    echo wp_get_attachment_image($pricing_img, 'full', false, array('class' => 'labb-image full', 'alt' => $pricing_title));
                endif;

                ?>

            </div>

            <h4 class="labb-plan-price labb-plan-header labb-center">

                <span class="labb-text">

                    <?php echo wp_kses_post($price_tag); ?>

                </span>

            </h4>

            <div class="labb-plan-details">

                <?php echo do_shortcode(wp_kses_post($pricing_plan->pricing_content)) ?>

            </div><!-- .labb-plan-details -->

            <div class="labb-purchase">

                <a class="labb-button default" href="<?php echo esc_url($pricing_url); ?>"
                    <?php if ($new_window)
                        echo 'target="_blank"'; ?>><?php echo esc_html($pricing_button_text); ?></a>

            </div>

        </div>
        <!-- .labb-pricing-plan -->

        <?php

    endforeach;

    ?>

</div><!-- .labb-pricing-table -->

<div class="labb-clear"></div>
