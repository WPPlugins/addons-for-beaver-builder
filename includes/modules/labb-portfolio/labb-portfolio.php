<?php

/*
Widget Name: Livemesh Grid
Description: Display posts or custom post types in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBPortfolioModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Grid', 'livemesh-bb-addons'),
            'description' => __('Display posts or custom post types in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-portfolio/',
            'url' => LABB_ADDONS_URL . 'labb-portfolio/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('isotope.pkgd');
        $this->add_js('imagesloaded.pkgd');

        add_action('wp_enqueue_scripts', array($this, 'localize_scripts'), 999999);

    }

    public function localize_scripts() {

        /* Do not attach to widget scripts since they are enqueued really late for some reason */
        wp_localize_script('labb-frontend-scripts', 'labb_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

    }

    function get_theme_color() {

        return labb_get_theme_color();

    }

}


FLBuilder::register_module('LABBPortfolioModule', array(
        'post_loop_settings' => array(
            'title' => __('Loop Query', 'fl-builder'),
            'file' => FL_BUILDER_DIR . 'includes/loop-settings.php',
        ),
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Grid Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'heading' => array(
                                'type' => 'text',
                                'label' => __('Heading for the grid', 'livemesh-bb-addons'),
                            ),

                            'filterable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Filterable?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                            'posts_per_page' => array(
                                'type' => 'labb-number',
                                'label' => __('Number of items to be displayed.', 'livemesh-bb-addons'),
                                'default' => 6,
                            ),

                            'taxonomy_filter' => array(
                                'type' => 'select',
                                'label' => __('Choose the taxonomy to display and filter on.', 'livemesh-bb-addons'),
                                'description' => __('Choose the taxonomy information to display for posts/portfolio and the taxonomy that is used to filter the portfolio/post. Takes effect only if no taxonomy filters are specified when building query.', 'livemesh-bb-addons'),
                                'options' => labb_get_taxonomies_map(),
                                'default' => 'category',
                            ),

                            'image_linkable' => array(
                                'type' => 'labb-toggle-button',
                                'label' => __('Link the image to the post/portfolio?', 'livemesh-bb-addons'),
                                'default' => 'yes'
                            ),

                        )
                ),
            )
        ),

        'post_content' => array(
            'title' => __('Post Content', 'livemesh-bb-addons'),
            'sections' => array(
                'content_section' => array(
                    'title' => __('Post Content Settings', 'livemesh-bb-addons'), // Section Title
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
                    'title' => __('Post Meta Settings', 'livemesh-bb-addons'), // Section Title
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
                                'label' => __('Display taxonomy info below the post item? Choose the right taxonomy in Grid Settings section.', 'livemesh-bb-addons'),
                                'default' => 'no'
                            ),
                            'layout_mode' => array(
                                'type' => 'select',
                                'label' => __('Choose a layout for the grid', 'livemesh-bb-addons'),
                                'default' => 'fitRows',
                                'options' => array(
                                    'fitRows' => __('Fit Rows', 'livemesh-bb-addons'),
                                    'masonry' => __('Masonry', 'livemesh-bb-addons'),
                                )
                            ),

                        )
                ),
            )
        ),

        'layout' => array(
            'title' => __('Layout', 'livemesh-bb-addons'),
            'sections' => array(

                'desktop_section' => array(
                    'title' => __('Desktop Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'description' => 'columns (max: 5)',
                            ),

                            'gutter' => array(
                                'type' => 'text',
                                'label' => __('Gutter', 'livemesh-bb-addons'),
                                'description' => __('Space between columns in masonry grid.', 'livemesh-bb-addons'),
                                'default' => '20',
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
                                'description' => __('The resolution in pixels to treat as a mobile resolution.', 'livemesh-bb-addons'),
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