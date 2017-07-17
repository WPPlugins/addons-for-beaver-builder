<?php
/**
 * @var $module
 * @var $settings
 * @var $id
 */

// Use the processed post selector query to find posts.
$loop = FLBuilderLoop::query($settings);

// Loop through the posts and do something with them.
if ($loop->have_posts()) :

    // Check if any taxonomy filter has been applied
    list($chosen_terms, $taxonomy) = labb_get_chosen_terms($loop->query);
    if (empty($chosen_terms))
        $taxonomy = $settings->taxonomy_filter;

    ?>

    <div class="labb-portfolio-wrap labb-container">

        <?php if (!empty($settings->heading) || $settings->filterable == 'yes'): ?>

            <div class="labb-portfolio-header">

                <?php if (!empty($settings->heading)) : ?>

                    <h3 class="labb-heading"><?php echo wp_kses_post($settings->heading); ?></h3>

                <?php endif; ?>

                <?php

                if ($settings->filterable == 'yes')
                    echo labb_get_taxonomy_terms_filter($taxonomy, $chosen_terms);

                ?>

            </div>

        <?php endif; ?>

        <div id="labb-portfolio-<?php echo uniqid(); ?>"
             class="labb-portfolio js-isotope labb-<?php echo esc_attr($settings->layout_mode); ?>"
             data-isotope-options='{ "itemSelector": ".labb-portfolio-item", "layoutMode": "<?php echo esc_attr($settings->layout_mode); ?>" }'>

            <?php

            $column_style = labb_get_column_class(intval($settings->per_line)); ?>

            <?php $current_page = get_queried_object_id(); ?>

            <?php while ($loop->have_posts()) : $loop->the_post(); ?>

                <?php $post_id = get_the_ID(); ?>

                <?php
                if ($post_id === $current_page)
                    continue; // skip current page since we can run into infinite loop when users choose All option in build query
                ?>

                <?php
                $style = '';
                $terms = get_the_terms($post_id, $taxonomy);
                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $style .= ' term-' . $term->term_id;
                    }
                }
                ?>

                <div data-id="id-<?php echo $post_id; ?>"
                     class="labb-portfolio-item <?php echo $style; ?> <?php echo $column_style; ?> labb-zero-margin">

                    <article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>

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

                            <div
                                    class="labb-entry-text-wrap <?php echo($thumbnail_exists ? '' : ' nothumbnail'); ?>">

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

                    </article><!-- .hentry -->

                </div>

            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

        </div><!-- Isotope items -->

    </div>

    <?php

endif;