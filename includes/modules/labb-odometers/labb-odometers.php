<?php

/*
Widget Name: Livemesh Odometers
Description: Display one or more animated odometer statistics in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBOdometersModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Odometers', 'livemesh-bb-addons'),
            'description' => __('Display one or more animated odometer statistics in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-odometers/',
            'url' => LABB_ADDONS_URL . 'labb-odometers/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js( 'jquery-waypoints' );
        $this->add_js( 'jquery-stats' );
    }
}

FLBuilder::register_module('LABBOdometersModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Odometers per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 4,
                                'description' => 'columns (max: 5)',
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Odometers', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'odometers' => array(
                                'type' => 'form',
                                'label' => __('Odometer', 'livemesh-bb-addons'),
                                'form' => 'odometers_form',
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
FLBuilder::register_settings_form('odometers_form', array(
    'title' => __('Odometer', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Odometer Data',

                    'fields' => array(
                        'stats_title' => array(
                            'type' => 'text',
                            'label' => __('Stats Title', 'livemesh-bb-addons'),
                            'description' => __('The title for the odometer stats', 'livemesh-bb-addons'),
                        ),

                        'start_value' => array(
                            'type' => 'labb-number',
                            'label' => __('Start Value', 'livemesh-bb-addons'),
                            'description' => __('The start value for the odometer stats.', 'livemesh-bb-addons'),
                            'default' => 0
                        ),

                        'stop_value' => array(
                            'type' => 'labb-number',
                            'label' => __('Stop Value', 'livemesh-bb-addons'),
                            'description' => __('The stop value for the odometer stats.', 'livemesh-bb-addons'),
                            'default' => 300
                        ),

                        'icon_type' => array(
                            'type' => 'select',
                            'label' => __('Choose Icon Type', 'livemesh-bb-addons'),
                            'default' => 'icon',
                            'toggle' => array(
                                'icon_image' => array(
                                    'fields' => array('icon_image')
                                ),
                                'icon' => array(
                                    'fields' => array('font_icon'),
                                ),
                            ),
                            'options' => array(
                                'icon' => __('Icon', 'livemesh-bb-addons'),
                                'icon_image' => __('Icon Image', 'livemesh-bb-addons'),
                            )
                        ),

                        'icon_image' => array(
                            'type' => 'photo',
                            'label' => __('Stats Image.', 'livemesh-bb-addons'),
                        ),

                        'font_icon' => array(
                            'type' => 'icon',
                            'label' => __('Stats Icon.', 'livemesh-bb-addons'),
                        ),

                        'prefix' => array(
                            'type' => 'text',
                            'label' => __('Prefix String', 'livemesh-bb-addons'),
                            'description' => __('Examples include currency symbols like $ to indicate a monetary value.', 'livemesh-bb-addons'),
                        ),

                        'suffix' => array(
                            'type' => 'text',
                            'label' => __('Suffix String', 'livemesh-bb-addons'),
                            'description' => __('Examples include strings like hr for hours or m for million.', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));