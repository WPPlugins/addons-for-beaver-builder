<?php

/*
Widget Name: Livemesh Piecharts
Description: Display one or more piecharts depicting a percentage value in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBPiechartsModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Piecharts', 'livemesh-bb-addons'),
            'description' => __('Display one or more piecharts depicting a percentage value in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-piecharts/',
            'url' => LABB_ADDONS_URL . 'labb-piecharts/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_js('jquery-stats');

    }
}


FLBuilder::register_module('LABBPiechartsModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(

                'form_section' => array(
                    'title' => __('Piecharts', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'piecharts' => array(
                                'type' => 'form',
                                'label' => __('Piechart', 'livemesh-bb-addons'),
                                'form' => 'piecharts_form',
                                'preview_text' => 'stats_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),
        'options' => array(
            'title' => __('Options', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('General', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(
                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Piecharts per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 4,
                                'description' => 'columns (max: 5)',
                            ),
                            'bar_color' => array(
                                'type' => 'color',
                                'label' => __('Bar color', 'livemesh-bb-addons'),
                                'default' => '#f94213'
                            ),

                            'track_color' => array(
                                'type' => 'color',
                                'label' => __('Track color', 'livemesh-bb-addons'),
                                'default' => '#dddddd'
                            ),
                        )
                ),
            )
        ),
    )
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('piecharts_form', array(
    'title' => __('Piechart', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Piechart Data',

                    'fields' => array(
                        'stats_title' => array(
                            'type' => 'text',
                            'label' => __('Stats Title', 'livemesh-bb-addons'),
                            'description' => __('The title for the piechart', 'livemesh-bb-addons'),
                        ),

                        'percentage' => array(
                            'type' => 'labb-number',
                            'label' => __('Percentage Value', 'livemesh-bb-addons'),
                            'description' => __('The percentage value for the stats.', 'livemesh-bb-addons'),
                            'min' => 1,
                            'max' => 100,
                            'default' => 23
                        ),
                    )
                )
            )
        ),
    )
));