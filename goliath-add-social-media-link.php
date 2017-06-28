<?php
/**
 *
 * Plugin Name: Goliath Add Social Media Link
 * Description: Add the social media link
 * Version: 1.0
 * Author: Studio Goliath
 * Author URI: https://www.studio-goliath.com
 *
 * SVG sprite from :
 * https://github.com/Automattic/social-logos
 *
 *
 */

class GoliathAddSocialMediaLink
{

    private $supported_social_media;

    public function __construct()
    {

        $this->supported_social_media = apply_filters( 'asml_supported_social_media', array(
            'amazon',
            'behance',
            'blogger-alt',
            'blogger',
            'codepen',
            'dribbble',
            'dropbox',
            'eventbrite',
            'facebook',
            'feed',
            'flickr',
            'foursquare',
            'ghost',
            'github',
            'google-alt',
            'google-plus-alt',
            'google-plus',
            'google',
            'instagram',
            'linkedin',
            'mail',
            'medium',
            'path-alt',
            'path',
            'pinterest-alt',
            'pinterest',
            'pocket',
            'polldaddy',
            'print',
            'reddit',
            'share',
            'skype',
            'spotify',
            'squarespace',
            'stumbleupon',
            'telegram',
            'tumblr-alt',
            'tumblr',
            'twitch',
            'twitter-alt',
            'twitter',
            'vimeo',
            'whatsapp',
            'wordpress',
            'xanga',
            'youtube',
        ) );

    }

    public function init(){

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        add_action( 'customize_register', array( $this, 'customize_register' ) );
    }

    public function enqueue_scripts() {

        wp_enqueue_script( 'goliath_asml_js', plugins_url( '/js/scripts.js', __FILE__ ), array(), '1.0', true);

        // localize
        wp_localize_script( 'goliath_asml_js', 'scripts_l10n', array(
            'svgSpriteUrl' => plugins_url( '/svg/social-logos.svg', __FILE__  ),
        ) );

    }



    public function customize_register( $wp_customize ) {


        foreach ( $this->supported_social_media as $social_media ){
            $wp_customize->add_setting( $social_media, array(
                'type' => 'theme_mod',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url_raw',
            ) );

            $wp_customize->add_control( $social_media, array(
                'type' => 'url',
                'section' => 'asml_section',
                'label' => $social_media,
            ) );
        }


        $wp_customize->add_section( 'asml_section', array(
            'title'         => __( 'Social Media Link', 'asml' ),
            'capability'    => 'edit_theme_options',
        ) );
    }

    /**
     * @return array
     */
    public function getSupportedSocialMedia()
    {
        return $this->supported_social_media;
    }
}


add_action( 'init', function(){

    $asml = new GoliathAddSocialMediaLink();
    $asml->init();

});



function asml_social_media_menu(){

    $asml = new GoliathAddSocialMediaLink();
    $all_supported_social_media = $asml->getSupportedSocialMedia();

    echo '<div class="social-media-link">';

    foreach ( $all_supported_social_media as $social_media ){

        $social_media_url = get_theme_mod( $social_media );

        if( $social_media_url ){
            echo "<a href='{$social_media_url}' class='social-link'><svg class='icon icon-social'><use xlink:href='#{$social_media}'></use></svg></a>";
        }

    }

    echo '</div>';

}