.fl-node-<?php echo $id; ?> .labb-portfolio-wrap .labb-load-more  {
    background: <?php echo $module->get_theme_color(); ?>;
    }

.fl-node-<?php echo $id; ?> .labb-portfolio {
    margin-left: -<?php echo $settings->gutter; ?>px;
    margin-right: -<?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-portfolio {
        margin-left: -<?php echo $settings->tablet_gutter; ?>px;
        margin-right: -<?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-portfolio {
        margin-left: -<?php echo $settings->mobile_gutter; ?>px;
        margin-right: -<?php echo $settings->mobile_gutter; ?>px;
        }
    }

.fl-node-<?php echo $id; ?> .labb-portfolio .labb-portfolio-item {
    padding: <?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-portfolio .labb-portfolio-item {
        padding: <?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-portfolio .labb-portfolio-item {
        padding: <?php echo $settings->mobile_gutter; ?>px;
        }
    }

