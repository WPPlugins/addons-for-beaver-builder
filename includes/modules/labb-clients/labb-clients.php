<?php

/*
Widget Name: Livemesh Clients
Description: Display list of your clients in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBClientsModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Clients', 'livemesh-bb-addons'),
            'description' => __('Display one or more clients in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-clients/',
            'url' => LABB_ADDONS_URL . 'labb-clients/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

}


FLBuilder::register_module('LABBClientsModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'title' => __('Options', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Clients per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 4,
                                'description' => 'columns (max: 5)',
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Clients', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'clients' => array(
                                'type' => 'form',
                                'label' => __('Client', 'livemesh-bb-addons'),
                                'form' => 'clients_form',
                                'preview_text' => 'client_name',
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
FLBuilder::register_settings_form('clients_form', array(
    'title' => __('Add Client', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Client Information',

                    'fields' => array(

                        'client_name' => array(
                            'type' => 'text',
                            'label' => __('Client Name', 'livemesh-bb-addons'),
                            'description' => __('The name of the client/customer.', 'livemesh-bb-addons'),
                        ),
                        'client_link' => array(
                            'type' => 'link',
                            'label' => __('Client URL', 'livemesh-bb-addons'),
                            'description' => __('The website of the client/customer.', 'livemesh-bb-addons'),
                        ),
                        'client_image' => array(
                            'type' => 'photo',
                            'label' => __('Client Logo', 'livemesh-bb-addons'),
                            'description' => __('The logo image for the client/customer.', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));