<?php

/*
Widget Name: Livemesh Team Members
Description: Display a list of your team members optionally in a multi-column grid.
Author: LiveMesh
Author URI: https://www.livemeshthemes.com
*/

class LABBTeamModule extends FLBuilderModule {

    function __construct() {

        parent::__construct(array(
            'name' => __('Livemesh Team Members', 'livemesh-bb-addons'),
            'description' => __('Display a list of your team members optionally in a multi-column grid.', 'livemesh-bb-addons'),
            'category' => __('Livemesh Addons', 'livemesh-bb-addons'),
            'dir' => LABB_ADDONS_DIR . 'labb-team-members/',
            'url' => LABB_ADDONS_URL . 'labb-team-members/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled' => true, // Defaults to true and can be omitted.
            'partial_refresh' => true
        ));


        $this->add_js('jquery-waypoints');
        $this->add_css('animate');

    }

    public function social_profile($team_member) {
        ?>

        <div class="labb-social-wrap">

            <div class="labb-social-list">

                <?php

                $email = $team_member->member_email;
                $facebook_url = $team_member->facebook_url;
                $twitter_url = $team_member->twitter_url;
                $linkedin_url = $team_member->linkedin_url;
                $dribbble_url = $team_member->dribbble_url;
                $pinterest_url = $team_member->pinterest_url;
                $googleplus_url = $team_member->google_plus_url;
                $instagram_url = $team_member->instagram_url;


                if ($email)
                    echo '<div class="labb-social-list-item"><a class="labb-email" href="mailto:' . $email . '" title="' . __("Send an email", 'livemesh-bb-addons') . '"><i class="labb-icon-email"></i></a></div>';
                if ($facebook_url)
                    echo '<div class="labb-social-list-item"><a class="labb-facebook" href="' . $facebook_url . '" target="_blank" title="' . __("Follow on Facebook", 'livemesh-bb-addons') . '"><i class="labb-icon-facebook"></i></a></div>';
                if ($twitter_url)
                    echo '<div class="labb-social-list-item"><a class="labb-twitter" href="' . $twitter_url . '" target="_blank" title="' . __("Subscribe to Twitter Feed", 'livemesh-bb-addons') . '"><i class="labb-icon-twitter"></i></a></div>';
                if ($linkedin_url)
                    echo '<div class="labb-social-list-item"><a class="labb-linkedin" href="' . $linkedin_url . '" target="_blank" title="' . __("View LinkedIn Profile", 'livemesh-bb-addons') . '"><i class="labb-icon-linkedin"></i></a></div>';
                if ($googleplus_url)
                    echo '<div class="labb-social-list-item"><a class="labb-googleplus" href="' . $googleplus_url . '" target="_blank" title="' . __("Follow on Google Plus", 'livemesh-bb-addons') . '"><i class="labb-icon-googleplus"></i></a></div>';
                if ($instagram_url)
                    echo '<div class="labb-social-list-item"><a class="labb-instagram" href="' . $instagram_url . '" target="_blank" title="' . __("View Instagram Feed", 'livemesh-bb-addons') . '"><i class="labb-icon-instagram"></i></a></div>';
                if ($pinterest_url)
                    echo '<div class="labb-social-list-item"><a class="labb-pinterest" href="' . $pinterest_url . '" target="_blank" title="' . __("Subscribe to Pinterest Feed", 'livemesh-bb-addons') . '"><i class="labb-icon-pinterest"></i></a></div>';
                if ($dribbble_url)
                    echo '<div class="labb-social-list-item"><a class="labb-dribbble" href="' . $dribbble_url . '" target="_blank" title="' . __("View Dribbble Portfolio", 'livemesh-bb-addons') . '"><i class="labb-icon-dribbble"></i></a></div>';

                ?>

            </div>

        </div>
        <?php
    }

}


FLBuilder::register_module('LABBTeamModule', array(
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
                                ),
                                'toggle' => array(
                                    'style1' => array(
                                        'fields' => array('per_line')
                                    ),
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
                    'title' => __('Team Members', 'livemesh-bb-addons'), // Section Title
                    'fields' =>
                        array(

                            'team_members' => array(
                                'type' => 'form',
                                'label' => __('Team Member', 'livemesh-bb-addons'),
                                'form' => 'team_members_form',
                                'preview_text' => 'member_name',
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
FLBuilder::register_settings_form('team_members_form', array(
    'title' => __('Team Member', 'fl-builder'),
    'tabs' => array(
        'general' => array(
            'title' => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Member Info',

                    'fields' => array(
                        'member_name' => array(
                            'type' => 'text',
                            'label' => __('Name', 'livemesh-bb-addons'),
                            'description' => __('Name of the team member.', 'livemesh-bb-addons'),
                        ),

                        'member_image' => array(
                            'type' => 'photo',
                            'label' => __('Team member image.', 'livemesh-bb-addons'),
                        ),

                        'member_position' => array(
                            'type' => 'text',
                            'label' => __('Position', 'livemesh-bb-addons'),
                            'description' => __('Specify the position/title of the team member.', 'livemesh-bb-addons'),
                        ),

                        'member_details' => array(
                            'type' => 'textarea',
                            'label' => __('Short details', 'livemesh-bb-addons'),
                            'description' => __('Provide a short writeup for the team member', 'livemesh-bb-addons'),
                            'rows' => 6
                        ),
                    )
                )
            )
        ),

        'social_profile' => array(
            'title' => __('Social Profile', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title' => 'Enter Social Info',

                    'fields' => array(
                        'member_email' => array(
                            'type' => 'text',
                            'label' => __('Email Address', 'livemesh-bb-addons'),
                            'description' => __('Enter the email address of the team member.', 'livemesh-bb-addons'),
                        ),

                        'facebook_url' => array(
                            'type' => 'text',
                            'label' => __('Facebook Page URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Facebook page of the team member.', 'livemesh-bb-addons'),
                        ),

                        'twitter_url' => array(
                            'type' => 'text',
                            'label' => __('Twitter Profile URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Twitter page of the team member.', 'livemesh-bb-addons'),
                        ),

                        'linkedin_url' => array(
                            'type' => 'text',
                            'label' => __('LinkedIn Page URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the LinkedIn profile of the team member.', 'livemesh-bb-addons'),
                        ),

                        'pinterest_url' => array(
                            'type' => 'text',
                            'label' => __('Pinterest Page URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Pinterest page for the team member.', 'livemesh-bb-addons'),
                        ),

                        'dribbble_url' => array(
                            'type' => 'text',
                            'label' => __('Dribbble Profile URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Dribbble profile of the team member.', 'livemesh-bb-addons'),
                        ),

                        'google_plus_url' => array(
                            'type' => 'text',
                            'label' => __('GooglePlus Page URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Google Plus page of the team member.', 'livemesh-bb-addons'),
                        ),

                        'instagram_url' => array(
                            'type' => 'text',
                            'label' => __('Instagram Page URL', 'livemesh-bb-addons'),
                            'description' => __('URL of the Instagram feed for the team member.', 'livemesh-bb-addons'),
                        ),
                    )
                )
            )
        ),
    )
));