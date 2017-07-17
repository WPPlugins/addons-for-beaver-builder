<?php

/*
Widget Name: Livemesh Pricing Table
Description: Display pricing plans in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBPricingTableModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Pricing Table', 'livemesh-bb-addons'),
            'description' => __('Display pricing plans in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-pricing-table/',
            'url' => LABB_ADDONS_URL . 'labb-pricing-table/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));

        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

        add_shortcode('labb_pricing_item', array($this, 'pricing_item_shortcode'));

    }

    public function pricing_item_shortcode($atts, $content = null, $tag) {

        $title = $value = '';

        extract(shortcode_atts(array(
            'title' => '',
            'value' => ''

        ), $atts));

        ob_start();

        ?>

        <div class="labb-pricing-item">

            <div class="labb-title">

                <?php echo htmlspecialchars_decode(wp_kses_post($title)); ?>

            </div>

            <div class="labb-value-wrap">

                <div class="labb-value">

                    <?php echo htmlspecialchars_decode(wp_kses_post($value)); ?>

                </div>

            </div>

        </div>

        <?php


        $output = ob_get_clean();

        return $output;
    }

}

FLBuilder::register_module('LABBPricingTableModule', array(
        'general' => array(
            'title' => __('General', 'livemesh-bb-addons'),
            'sections' => array(
                'options_section' => array(
                    'fields' =>
                        array(

                            'per_line' => array(
                                'type' => 'labb-number',
                                'label' => __('Pricing plans per row', 'livemesh-bb-addons'),
                                'min' => 1,
                                'max' => 5,
                                'default' => 4,
                                'description' => 'columns (max: 5)',
                            ),
                        )
                ),

                'form_section' => array(
                    'title' => __('Pricing Plans', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'pricing_plans' => array(
                                'type' => 'form',
                                'label' => __('Pricing Plan', 'livemesh-bb-addons'),
                                'form' => 'pricing_plans_form',
                                'preview_text' => 'pricing_title',
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
FLBuilder::register_settings_form('pricing_plans_form', array(
    'title' => __('Pricing Plan', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Pricing Plan',

                    'fields' => array(
                        'pricing_title' => array(
                            'type' => 'text',
                            'label' => __('Pricing Plan Title', 'livemesh-bb-addons'),
                            'description' => __('The title for the pricing plan', 'livemesh-bb-addons'),
                        ),

                        'tagline' => array(
                            'type' => 'text',
                            'label' => __('Tagline Text', 'livemesh-bb-addons'),
                            'description' => __('Provide any subtitle or taglines like "Most Popular", "Best Value", "Best Selling", "Most Flexible" etc. that you would like to use for this pricing plan.', 'livemesh-bb-addons'),
                        ),

                        'pricing_image' => array(
                            'type' => 'photo',
                            'label' => __('Image', 'livemesh-bb-addons'),
                        ),

                        'price_tag' => array(
                            'type' => 'text',
                            'label' => __('Price Tag', 'livemesh-bb-addons'),
                            'description' => __('Enter the price tag for the pricing plan. HTML is accepted.', 'livemesh-bb-addons'),
                        ),

                        'highlight' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Highlight Pricing Plan', 'livemesh-bb-addons'),
                            'description' => __('Specify if you want to highlight the pricing plan.', 'livemesh-bb-addons'),
                            'default' => 'no'
                        ),
                        'pricing_content' => array(
                            'type' => 'textarea',
                            'label' => __('Pricing Plan Details', 'livemesh-bb-addons'),
                            'description' => __('Enter the content for the pricing plan that include information about individual features of the pricing plan. For prebuilt styling, enter shortcodes content like - [labb_pricing_item title="Storage Space" value="50 GB"] [labb_pricing_item title="Video Uploads" value="50"][labb_pricing_item title="Portfolio Items" value="20"]', 'livemesh-bb-addons'),
                            'rows' => 6
                        ),

                    )
                )
            )
        ),
        'pricing_button' => array(
            'title' => __('Pricing Button', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Purchase Link',
                    'fields' => array(
                        'button_text' => array(
                            'type' => 'text',
                            'label' => __('Text for Pricing Link/Button', 'livemesh-bb-addons'),
                            'description' => __('Provide the text for the link or the button shown for this pricing plan.', 'livemesh-bb-addons'),
                        ),

                        'pricing_url' => array(
                            'type' => 'link',
                            'label' => __('URL for the Pricing link/button', 'livemesh-bb-addons'),
                            'description' => __('Provide the target URL for the link or the button shown for this pricing plan.', 'livemesh-bb-addons'),
                        ),

                        'new_window' => array(
                            'type' => 'labb-toggle-button',
                            'label' => __('Open Button URL in a new window', 'livemesh-bb-addons'),
                            'default' => 'no'
                        ),

                    )
                )
            )
        ),
    )
));