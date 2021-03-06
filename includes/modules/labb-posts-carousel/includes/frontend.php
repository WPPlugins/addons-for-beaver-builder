<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */


$carousel_settings = [
    'arrows' => ('yes' === $settings->arrows),
    'dots' => ('yes' === $settings->dots),
    'autoplay' => ('yes' === $settings->autoplay),
    'autoplay_speed' => absint($settings->autoplay_speed),
    'animation_speed' => absint($settings->animation_speed),
    'pause_on_hover' => ('yes' === $settings->pause_on_hover),
];

$responsive_settings = [
    'display_columns' => $settings->display_columns,
    'scroll_columns' => $settings->scroll_columns,
    'gutter' => $settings->gutter,
    'tablet_width' => $settings->tablet_width,
    'tablet_display_columns' => $settings->tablet_display_columns,
    'tablet_scroll_columns' => $settings->tablet_scroll_columns,
    'tablet_gutter' => $settings->tablet_gutter,
    'mobile_width' => $settings->mobile_width,
    'mobile_display_columns' => $settings->mobile_display_columns,
    'mobile_scroll_columns' => $settings->mobile_scroll_columns,
    'mobile_gutter' => $settings->mobile_gutter,

];

$carousel_settings = array_merge($carousel_settings, $responsive_settings);

$loop = FLBuilderLoop::query( $settings );

// Loop through the posts and do something with them.
if ($loop->have_posts()) : ?>

    <div id="labb-posts-carousel-<?php echo uniqid(); ?>"
         class="labb-posts-carousel labb-container"
         data-settings='<?php echo wp_json_encode($carousel_settings); ?>'>

        <?php $taxonomy = $settings->taxonomy_chosen; ?>

        <?php while ($loop->have_posts()) : $loop->the_post(); ?>

            <div data-id="id-<?php the_ID(); ?>" class="labb-posts-carousel-item">

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if ($thumbnail_exists = has_post_thumbnail()): ?>

                        <div class="labb-project-image">

                            <?php if ($settings->image_linkable == 'yes'): ?>

                                <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('large'); ?> </a>

                            <?php else: ?>

                                <?php the_post_thumbnail('large'); ?>

                            <?php endif; ?>

                            <div class="labb-image-info">

                                <div class="labb-entry-info">

                                    <?php the_title('<h3 class="labb-post-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '"
                                               rel="bookmark">', '</a></h3>'); ?>

                                    <?php echo labb_get_taxonomy_info($taxonomy); ?>

                                </div>

                            </div>

                            <div class="labb-image-overlay"></div>

                        </div>

                    <?php endif; ?>

                    <?php if (($settings->display_title == 'yes') || ($settings->display_summary == 'yes')) : ?>

                        <div class="labb-entry-text-wrap <?php echo($thumbnail_exists ? '' : ' nothumbnail'); ?>">

                            <?php if ($settings->display_title == 'yes') : ?>

                                <?php the_title('<h3 class="entry-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '"
                                               rel="bookmark">', '</a></h3>'); ?>

                            <?php endif; ?>

                            <?php if (($settings->display_post_date == 'yes') || ($settings->display_author == 'yes') || ($settings->display_taxonomy == 'yes')) : ?>

                                <div class="labb-entry-meta">

                                    <?php if ($settings->display_author == 'yes'): ?>

                                        <?php echo labb_entry_author(); ?>

                                    <?php endif; ?>

                                    <?php if ($settings->display_post_date == 'yes'): ?>

                                        <?php echo labb_entry_published(); ?>

                                    <?php endif; ?>

                                    <?php if ($settings->display_taxonomy == 'yes'): ?>

                                        <?php echo labb_get_taxonomy_info($taxonomy); ?>

                                    <?php endif; ?>

                                </div>

                            <?php endif; ?>

                            <?php if ($settings->display_summary == 'yes') : ?>

                                <div class="entry-summary">

                                    <?php the_excerpt(); ?>

                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                </article>
                <!-- .hentry -->

            </div><!--.labb-posts-carousel-item -->

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

    </div> <!-- .labb-posts-carousel -->

<?php endif; ?>
