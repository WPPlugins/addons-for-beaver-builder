<?php

/*
Widget Name: Livemesh Posts Carousel
Description: Display blog posts or custom post types as a carousel.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBPostsCarouselModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Posts Carousel', 'livemesh-bb-addons'),
            'description' => __('Display blog posts or custom post types as a carousel.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-posts-carousel/',
            'url' => LABB_ADDONS_URL . 'labb-posts-carousel/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js( 'slick' );
        $this->add_css( 'slick' );

    }

}


FLBuilder::register_module('LABBPostsCarouselModule', array(
        'post_loop_settings' => array(
            'title' => __('Loop Query', 'fl-builder'),
            'file' => FL_BUILDER_DIR . 'includes/loop-settings.php',
        ),

        'post_content' => array(
            'title' => __('Grid Options', 'livemesh-bb-addons'),
            'sections' => array(
                'general_section' => array(
                    'fields' =>
                        array(

                            'posts_per_page' => array(
                                'type' => 'labb-number',
                                'label' => __('Number of posts to be displayed.', 'livemesh-bb-addons'),
                                'default' => 6,
                            ),
                            'taxonomy_chosen' => array(
                                'type' => 'select',
                                'label' => __('Choose the taxonomy to display info.', 'livemesh-bb-addons'),
                                'description' => __('Choose the taxonomy to use for display of taxonomy information for posts/custom post types.', 'livemesh-bb-addons'),
                                'options' => labb_get_taxonomies_map(),
                                'default' => 'category',
                            ),

                            'image_linkable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Link Images to Posts?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),
                        )
                ),
                'content_section' => array(
                    'title' => __('Post Content', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'display_title' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display project title below the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'display_summary' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display project excerpt/summary below the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),
                        )
                ),
                'post_meta_section' => array(
                    'title' => __('Post Meta', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'display_author' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post author info below the post item?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),

                            'display_post_date' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display post date info below the post item?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),

                            'display_taxonomy' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Display taxonomy info below the post item?', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),

                        )
                ),
            )
        ),

        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Carousel Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'arrows' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Prev/Next Arrows?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'dots' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Show dot indicators for navigation?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'pause_on_hover' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Pause on mouse hover?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'autoplay' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Autoplay?', 'livemesh-bb-addons'),
                                'description' => __('Should the carousel autoplay as in a slideshow.', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'autoplay_speed' => array(
                                'type' => 'labb-number',
                                'label' => __('Autoplay speed in ms', 'livemesh-bb-addons'),
                                'default' => 3000,
                                'min' => 1000,
                                'max' => 20000,
                                'description' => 'ms',
                            ),

                            'animation_speed' => array(
                                'type' => 'labb-number',
                                'label' => __('Autoplay animation speed in ms', 'livemesh-bb-addons'),
                                'default' => 600,
                                'min' => 100,
                                'max' => 2000,
                                'description' => 'ms',
                            ),
                        )
                ),
            )
        ),

        'layout' => array(
            'title' => __('Responsive', 'livemesh-bb-addons'),
            'sections' => array(
                'desktop_section' => array(
                    'title' => __('Desktop Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'description' => 'columns (max: 5)',
                            ),

                            'scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'maxlength' => '1',
                                'size' => '3',
                                'description' => 'columns (max: 5)',
                            ),

                            'gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                        )
                ),
                'tablet_section' => array(
                    'title' => __('Tablet Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'tablet_display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 2,
                                'description' => 'columns (max: 3)',
                            ),
                            'tablet_scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 3,
                                'default' => 2,
                                'description' => 'columns (max: 3)',
                            ),
                            'tablet_gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                            'tablet_width' => array(
                                'type' => 'text',
                                'label' => __('Resolution', 'livemesh-bb-addons'),
                                'description' => __('The resolution to treat as a tablet resolution.', 'livemesh-bb-addons'),
                                'default' => '800',
                                'maxlength' => '4',
                                'size' => '5',
                                'description' => 'px',
                            )
                        )
                ),

                'mobile_section' => array(
                    'title' => __('Mobile Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'mobile_display_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 2,
                                'integer' => true,
                                'default' => 1,
                                'description' => 'columns (max: 2)',
                            ),
                            'mobile_scroll_columns' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns to scroll', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 2,
                                'integer' => true,
                                'default' => 1,
                                'description' => 'columns (max: 2)',
                            ),
                            'mobile_gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns.', 'livemesh-bb-addons'),
                                'default' => '10',
                                'maxlength' => '2',
                                'size' => '4',
                                'description' => 'px',
                            ),
                            'mobile_width' => array(
                                'type' => 'text',
                                'label' => __('Resolution', 'livemesh-bb-addons'),
                                'description' => __('The resolution to treat as a mobile resolution.', 'livemesh-bb-addons'),
                                'default' => '480',
                                'maxlength' => '4',
                                'size' => '5',
                                'description' => 'px',
                            )
                        )
                )
            )
        )
    )
);