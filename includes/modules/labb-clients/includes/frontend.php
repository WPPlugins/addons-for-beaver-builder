<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


?>

<?php $num_of_columns = intval($settings->per_line); ?>

<?php $column_style = labb_get_column_class($num_of_columns); ?>

<div class="labb-clients labb-container">

    <?php foreach ($settings->clients as $client): ?>

        <?php if (!is_object($client))
            continue; ?>

        <div class="labb-client <?php echo $column_style; ?> labb-zero-margin">

            <?php if (!empty($client->client_image)): ?>

                <?php echo wp_get_attachment_image($client->client_image, 'full', false, array('class' => 'labb-image full', 'alt' => $client->client_name)); ?>

            <?php endif; ?>

            <?php if (!empty($client->client_link)): ?>

                <div class="labb-client-name">

                    <a href="<?php echo esc_url($client->client_link); ?>"
                       title="<?php echo esc_html($client->client_name); ?>"
                        target="_blank"><?php echo esc_html($client->client_name); ?></a>
                </div>

            <?php else: ?>

                <div class="labb-client-name"><?php echo esc_html($client->client_name); ?></div>

            <?php endif; ?>


            <div class="labb-image-overlay"></div>

        </div>

        <?php

    endforeach;

    ?>

</div>