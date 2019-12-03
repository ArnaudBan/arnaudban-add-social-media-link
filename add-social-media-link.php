<?php
/**
 *
 * Plugin Name: Add Social Media Link
 * Description: Add the social media link. Set it in the customizer
 * Version: 1.0
 * Author: ArnaudBan
 * Author URI: https://arnaudban.me
 *
 * SVG sprite from :
 * https://github.com/Automattic/social-logos
 *
 *
 */

namespace ABSocialMediaLink;

if( ! class_exists( 'SocialMediaMenu' ) && file_exists( __DIR__ . '/vendor/autoload.php' ) ){
    require __DIR__ . '/vendor/autoload.php';
}

add_action( 'init', function(){

    $asml = new SocialMediaMenu();
    $asml->init();

    $shareMenu = new SocialMediaShareMenu();
    $shareMenu->init();
});


/**
 * Display social media menu
 *
 * @param string $target
 */
function social_media_menu( $target = '' ){

    $asml = new SocialMediaMenu();
    $all_supported_social_media = $asml->getSupportedSocialMedia();

    echo '<div class="social-media-link">';

    foreach ( $all_supported_social_media as $social_media ){

        $social_media_url = get_theme_mod( $social_media );

        if( $social_media_url ){
            $target_string = $target ? " target='$target'" : '';
            echo "<a href='{$social_media_url}' class='social-link'" . $target_string ."><svg class='icon icon-social'><use xlink:href='#{$social_media}'/></svg></a>";
        }

    }

    echo '</div>';

}

/**
 * get social share link
 *
 * @return string
 */
function social_media_share_links(){

    $shareMenu = new SocialMediaShareMenu();
    return $shareMenu->display_share_links();
}

