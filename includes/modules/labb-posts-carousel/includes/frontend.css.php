.fl-node-<?php echo $id; ?> .labb-posts-carousel .labb-posts-carousel-item {
    padding: <?php echo $settings->gutter; ?>px;
    }
@media screen and (max-width: <?php echo $settings->tablet_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-posts-carousel .labb-posts-carousel-item {
        padding: <?php echo $settings->tablet_gutter; ?>px;
        }
    }
@media screen and (max-width: <?php echo $settings->mobile_width; ?>px) {
    .fl-node-<?php echo $id; ?> .labb-posts-carousel .labb-posts-carousel-item {
        padding: <?php echo $settings->mobile_gutter; ?>px;
        }
    }