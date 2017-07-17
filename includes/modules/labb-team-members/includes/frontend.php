<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

?>

<?php $column_style = ''; ?>

<?php if ($settings->style == 'style1'): ?>

    <?php $column_style = labb_get_column_class(intval($settings->per_line)); ?>

<?php endif; ?>

<div class="labb-team-members labb-<?php echo $settings->style; ?> labb-container">

    <?php foreach ($settings->team_members as $team_member): ?>

        <?php if (!is_object($team_member))
            continue; ?>

        <div class="labb-team-member-wrapper <?php echo $column_style; ?>">

            <div class="labb-team-member">

                <div class="labb-image-wrapper">

                    <?php $member_image = $team_member->member_image; ?>

                    <?php if (!empty($member_image)): ?>

                        <?php echo wp_get_attachment_image($member_image, 'full', false, array('class' => 'labb-image full')); ?>

                    <?php endif; ?>

                    <?php if ($settings->style == 'style1'): ?>

                        <?php $module->social_profile($team_member) ?>

                    <?php endif; ?>

                </div>

                <div class="labb-team-member-text">

                    <h3 class="labb-title"><?php echo esc_html($team_member->member_name) ?></h3>

                    <div class="labb-team-member-position">

                        <?php echo do_shortcode($team_member->member_position) ?>

                    </div>

                    <div class="labb-team-member-details">

                        <?php echo do_shortcode($team_member->member_details) ?>

                    </div>

                    <?php if ($settings->style == 'style2'): ?>

                        <?php $module->social_profile($team_member) ?>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php

    endforeach;

    ?>

</div>