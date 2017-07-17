<?php

/*
Widget Name: Livemesh Testimonials Slider
Description: Display responsive touch friendly slider of testimonials from clients/customers.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBTestimonialsSliderModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Testimonials Slider', 'livemesh-bb-addons'),
            'description' => __('Display responsive touch friendly slider of testimonials from clients/customers.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-testimonials-slider/',
            'url' => LABB_ADDONS_URL . 'labb-testimonials-slider/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js( 'jquery-flexslider' );
        $this->add_css( 'flexslider' );

    }

}



FLBuilder::register_module('LABBTestimonialsSliderModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),

            'options_section' => array(
                'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                'fields' =>
                    array(

                        "class" => array(
                            "type" => "text",
                            "description" => __("Set a unique CSS class for the slider. (optional).", "livemesh-bb-addons"),
                            "label" => __("Class", "livemesh-bb-addons"),
                        ),
                    )
            ),
            'sections' => array(

                'form_section' => array(
                    'title' => __('Testimonials', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'testimonials' => array(
                                'type' => 'form',
                                'label' => __('Testimonial', 'livemesh-bb-addons'),
                                'form' => 'testimonials_slider_form',
                                'preview_text' => 'author_name',
                                'multiple' => true
                            ),
                        )
                )
            )
        ),
        'settings' => array(
            'title' => __('Settings', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Slider Settings', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'slide_animation' => array(
                                'type' => 'select',
                                'description' => __('Select your animation type.', 'livemesh-bb-addons'),
                                'label' => __('Animation', 'livemesh-bb-addons'),
                                'options' => array(
                                    'slide' => __('Slide', 'livemesh-bb-addons'),
                                    'fade' => __('Fade', 'livemesh-bb-addons'),
                                ),
                                'default' => 'slide',
                            ),
                            'direction' => array(
                                'type' => 'select',
                                'description' => __('Select the sliding direction.', 'livemesh-bb-addons'),
                                'label' => __('Sliding Direction', 'livemesh-bb-addons'),
                                'options' => array(
                                    'horizontal' => __('Horizontal', 'livemesh-bb-addons'),
                                    'vertical' => __('Vertical', 'livemesh-bb-addons'),
                                ),
                                'default' => 'horizontal',
                            ),
                            'control_nav' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Create navigation for paging control of each slide?', 'livemesh-bb-addons'),
                                'label' => __('Control navigation?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'direction_nav' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Create navigation for previous/next navigation?', 'livemesh-bb-addons'),
                                'label' => __('Direction navigation?', 'livemesh-bb-addons'),
                                'default' => 'no',
                            ),
                            'randomize' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Randomize slide order?', 'livemesh-bb-addons'),
                                'label' => __('Randomize slides?', 'livemesh-bb-addons'),
                                'default' => 'no',
                            ),
                            'pause_on_hover' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Pause the slideshow when hovering over slider, then resume when no longer hovering.', 'livemesh-bb-addons'),
                                'label' => __('Pause on hover?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'pause_on_action' => array(
                                'type' => 'labb-toggle-button',
                                'description' => __('Pause the slideshow when interacting with control elements.', 'livemesh-bb-addons'),
                                'label' => __('Pause on action?', 'livemesh-bb-addons'),
                                'default' => 'yes',
                            ),
                            'slideshow_speed' => array(
                                'type' => 'labb-number',
                                'description' => __('Set the speed of the slideshow cycling, in milliseconds', 'livemesh-bb-addons'),
                                'label' => __('Slideshow speed', 'livemesh-bb-addons'),
                                'default' => 5000,
                                'min' => 1000,
                                'max' => 20000,
                                'description' => 'ms',
                            ),
                            'animation_speed' => array(
                                'type' => 'labb-number',
                                'description' => __('Set the speed of animations, in milliseconds.', 'livemesh-bb-addons'),
                                'label' => __('Animation speed', 'livemesh-bb-addons'),
                                'default' => 600,
                                'min' => 100,
                                'max' => 2000,
                                'description' => 'ms',
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
FLBuilder::register_settings_form('testimonials_slider_form', array(
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