<?php

/*
Widget Name: Livemesh Heading
Description: Create heading for display on the top of a section.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBHeadingModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Heading', 'livemesh-bb-addons'),
            'description' => __('Create heading for display on the top of a section.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-heading/',
            'url' => LABB_ADDONS_URL . 'labb-heading/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}

FLBuilder::register_module('LABBHeadingModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(

                            'style' => array(
                                'type' => 'select',
                                'label' => __('Choose Style', 'livemesh-bb-addons'),
                                'default' => 'style1',
                                'options' => array(
                                    'style1' => __('Style 1', 'livemesh-bb-addons'),
                                    'style2' => __('Style 2', 'livemesh-bb-addons'),
                                    'style3' => __('Style 3', 'livemesh-bb-addons'),
                                ),
                                'toggle' => array(
                                    'style1' => array(
                                        'fields' => array('heading', 'short_text')
                                    ),
                                    'style2' => array(
                                        'fields' => array('heading', 'subtitle', 'short_text'),
                                    ),
                                    'style3' => array(
                                        'fields' => array('heading')
                                    )
                                ),

                            ),
                        )
                ),
                'content_section' => array(
                    'title' => __('Content', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'heading' => array(
                                'type' => 'text',
                                'label' => __('Heading Title', 'livemesh-bb-addons'),
                                'description' => __('Title for the heading.', 'livemesh-bb-addons'),
                            ),

                            'subtitle' => array(
                                'type' => 'text',
                                'label' => __('Subheading', 'livemesh-bb-addons'),
                                'description' => __('A subtitle displayed above the title heading.', 'livemesh-bb-addons'),
                                'state_handler' => array(
                                    'style[style2]' => array('show'),
                                    '_else[style]' => array('hide'),
                                ),
                            ),

                            'short_text' => array(
                                'type' => 'textarea',
                                'label' => __('Short Text', 'livemesh-bb-addons'),
                                'description' => __('Short text generally displayed below the heading title.', 'livemesh-bb-addons'),
                                'rows' => '4',
                                'state_handler' => array(
                                    'style[style3]' => array('hide'),
                                    '_else[style]' => array('show')
                                ),
                            ),
                        )
                ),
            )
        ),
        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(
                            'align' => array(
                                'type' => 'select',
                                'description' => __('Alignment of the heading.', 'livemesh-bb-addons'),
                                'label' => __('Align', 'livemesh-bb-addons'),
                                'options' => array(
                                    'center' => __('Center', 'livemesh-bb-addons'),
                                    'left' => __('Left', 'livemesh-bb-addons'),
                                    'right' => __('Right', 'livemesh-bb-addons'),
                                ),
                                'default' => 'center'
                            ),

                        )
                ),
            )
        ),
    )
);
