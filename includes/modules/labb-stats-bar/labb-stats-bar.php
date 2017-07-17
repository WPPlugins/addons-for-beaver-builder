<?php

/*
Widget Name: Livemesh Stats Bars
Description: Display multiple stats bars that talk about skills or other percentage stats.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBStatsBarsModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Stats Bars', 'livemesh-bb-addons'),
            'description' => __('Display multiple stats bars that talk about skills or other percentage stats.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-stats-bar/',
            'url' => LABB_ADDONS_URL . 'labb-stats-bar/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('jquery-waypoints');

    }
}

FLBuilder::register_module('LABBStatsBarsModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'form_section' => array(
                    'title' => __('Stats Bars', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'stats_bars' => array(
                                'type' => 'form',
                                'label' => __('Stats Bar', 'livemesh-bb-addons'),
                                'form' => 'stats_bars_form',
                                'preview_text' => 'stats_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        )
    )
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('stats_bars_form', array(
    'title' => __('Stats Bar', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Stats Bar Data',

                    'fields' => array(
                        'stats_title' => array(
                            'type' => 'text',
                            'label' => __('Stats Title', 'livemesh-bb-addons'),
                            'description' => __('The title for the stats bar', 'livemesh-bb-addons'),
                        ),

                        'percentage' => array(
                            'type' => 'labb-number',
                            'label' => __('Percentage Value', 'livemesh-bb-addons'),
                            'description' => __('The percentage value for the stats.', 'livemesh-bb-addons'),
                            'min' => 1,
                            'max' => 100,
                            'default' => 80
                        ),

                        'bar_color' => array(
                            'type' => 'color',
                            'label' => __('Bar color', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));