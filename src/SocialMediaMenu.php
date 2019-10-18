<?php


namespace ABSocialMediaLink;


class SocialMediaMenu
{

    private $supported_social_media;

    public function __construct()
    {

        $this->supported_social_media = apply_filters( 'ABSocialMediaLink/supported_social_media', array(
            'amazon',
            'behance',
            'blogger-alt',
            'blogger',
            'codepen',
            'dribbble',
            'dropbox',
            'eventbrite',
            'facebook',
            'facebook-alt',
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

    public function init(): void
    {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        add_action( 'customize_register', array( $this, 'customize_register' ) );
    }

    public function enqueue_scripts(): void
    {

        wp_enqueue_script( 'ArnaudBan_asml_js', plugins_url( 'assets/js/scripts.js', __DIR__), array(), '1.0', true);

        // localize
        wp_localize_script( 'ArnaudBan_asml_js', 'scripts_l10n', array(
            'svgSpriteUrl' => plugins_url( 'assets/svg/social-logos.svg', __DIR__),
        ) );

    }



    public function customize_register( \WP_Customize_Manager $wp_customize ): void
    {


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
    public function getSupportedSocialMedia(): array
    {
        return $this->supported_social_media;
    }

}