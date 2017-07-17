<?php

/*
Widget Name: Livemesh Testimonials
Description: Display testimonials from your clients/customers in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBTestimonialsModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Testimonials', 'livemesh-bb-addons'),
            'description' => __('Display testimonials from your clients/customers in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-testimonials/',
            'url' => LABB_ADDONS_URL . 'labb-testimonials/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js( 'jquery-waypoints' );
        $this->add_css( 'animate' );

    }

}


FLBuilder::register_module('LABBTestimonialsModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
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
                        )
                ),

                'form_section' => array(
                    'title' => __('Testimonials', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'testimonials' => array(
                                'type' => 'form',
                                'label' => __('Testimonial', 'livemesh-bb-addons'),
                                'form' => 'testimonials_form',
                                'preview_text' => 'author_name',
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
FLBuilder::register_settings_form('testimonials_form', array(
    'title' => __('Testimonial', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Testimonial',

                    'fields' => array(
                        'author_name' => array(
                            'type' => 'text',
                            'label' => __('Name', 'livemesh-bb-addons'),
                            'description' => __('The author of the testimonial', 'livemesh-bb-addons'),
                        ),

                        'credentials' => array(
                            'type' => 'text',
                            'label' => __('Author Details', 'livemesh-bb-addons'),
                            'description' => __('The details of the author like company name, position held, company URL etc. HTML accepted.', 'livemesh-bb-addons'),
                        ),

                        'author_image' => array(
                            'type' => 'photo',
                            'label' => __('Image', 'livemesh-bb-addons'),
                        ),

                        'author_text' => array(
                            'type' => 'editor',
                            'label' => '',
                            'description' => __('What your customer had to say', 'livemesh-bb-addons'),
                            'default' => __('The testimonials text goes here', 'livemesh-bb-addons'),
                            'media_buttons' => true,
                            'rows' => 10
                        ),
                    )
                )
            )
        ),
    )
));
