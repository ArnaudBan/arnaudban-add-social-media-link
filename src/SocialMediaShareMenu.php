<?php


namespace ABSocialMediaLink;


class SocialMediaShareMenu
{

    protected  $post_type_to_share;

    public function __construct()
    {

        $this->post_type_to_share = apply_filters( 'ABSocialMediaLink/post_type_to_share', [ 'post' ] );
    }


    /**
     * Initialise action and styles
     */
    public function init(): void
    {

        wp_register_style('LinkSocialShare-styles', plugins_url('/assets/css/styles.css', __DIR__));

        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        if( apply_filters( 'ABSocialMediaLink/auto_display_share_in_the_content', true ) ){

            add_filter('the_content', [$this, 'add_to_content']);
        }
    }

    /**
     * Add share links to content
     *
     * @param string $content
     * @return string
     */
    public function add_to_content( $content  ): string
    {
        return $content . $this->display_share_links();
    }

    /**
     * get share links
     *
     * @param string $target
     * @return string
     */
    public function display_share_links( $target = '' ): string
    {

        $share_link = '';

        if( $this->is_post_to_share() ){

            $post_id = get_the_ID();

            $socmed = new SocialMediaShareLink();

            $links_to_displayed = apply_filters( 'ABSocialMediaLink/links_to_display', [ 'facebook', 'twitter', 'linkedin' ]);

            $social_media_names = $socmed->GetSocialMediaSites_NiceNames();
            $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks([
                'url'   => get_the_permalink( $post_id ),
                'title' => get_the_title( $post_id )
            ]);

            $target_string = $target ? " target='$target'" : '';

            $share_link = '<div class="share-links">';

            $share_link .= apply_filters( 'ABSocialMediaLink/before_links', '' );
            foreach($links_to_displayed as $slug ) {
                $social_media_url = $social_media_urls[$slug];
                $nice_name = $social_media_names[$slug];
                $icon = in_array( $slug, [ 'facebook', 'twitter'] ) ? $slug . '-alt' : $slug;
                $share_link .= "<a href='{$social_media_url}' class='button share-links__link share-links__link__{$slug}'{$target_string}><svg class='icon icon-social'><use xlink:href='#{$icon}'></use></svg><span class='screen-reader-text'>{$nice_name}</span></a>";
            }
            $share_link .= apply_filters( 'ABSocialMediaLink/after_links', '' );
            $share_link .= '</div>';
        }

        return $share_link;
    }


    /**
     * Enqueue share links style
     */
    public function enqueue_scripts(): void
    {

        if( $this->is_post_to_share() ){
            wp_enqueue_style( 'LinkSocialShare-styles' );
        }
    }


    /**
     * Is the current single post to share
     *
     * @return bool
     */
    private function  is_post_to_share(): bool
    {
        return is_singular( $this->post_type_to_share );
    }

}
