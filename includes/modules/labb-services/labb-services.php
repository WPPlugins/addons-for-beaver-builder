<?php

/*
Widget Name: Livemesh Services
Description: Capture services in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBServicesModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Services', 'livemesh-bb-addons'),
            'description' => __('Capture services in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-services/',
            'url' => LABB_ADDONS_URL . 'labb-services/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}

FLBuilder::register_module('LABBServicesModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(
                            'style' => array(
                                'type' => 'select',
                                'label' => __('Choose Style', 'livemesh-bb-addons'),
                                'state_emitter' => array(
                                    'callback' => 'select',
                                    'args' => array('style')
                                ),
                                'default' => 'style1',
                                'options' => array(
                                    'style1' => __('Style 1', 'livemesh-bb-addons'),
                                    'style2' => __('Style 2', 'livemesh-bb-addons'),
                                    'style3' => __('Style 3', 'livemesh-bb-addons'),
                                )
                            ),

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Columns per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 3,
                                'description' => 'columns (max: 5)',
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Services', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'services' => array(
                                'type' => 'form',
                                'label' => __('Service', 'livemesh-bb-addons'),
                                'form' => 'services_form',
                                'preview_text' => 'service_title',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),
    )
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('services_form', array(
    'title' => __('Service', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Service Data',

                    'fields' => array(
                        'service_title' => array(
                            'type' => 'text',
                            'label' => __('Service Title', 'livemesh-bb-addons'),
                            'description' => __('Title of the service.', 'livemesh-bb-addons'),
                        ),

                        'service_excerpt' => array(
                            'type' => 'textarea',
                            'label' => __('Short description', 'livemesh-bb-addons'),
                            'description' => __('Provide a short description for the service', 'livemesh-bb-addons'),
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
                                    'tabs' => array('styling'),
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
                            'label' => __('Service Image.', 'livemesh-bb-addons'),
                        ),

                        'font_icon' => array(
                            'type' => 'icon',
                            'label' => __('Service Icon.', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));