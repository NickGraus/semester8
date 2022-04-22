<?php

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    });

    add_filter('template_include', function($template) {
        return get_stylesheet_directory() . '/static/no-timber.html';
    });

    return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

    function __construct() {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );
        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'init', array( $this, 'register_menus' ) );
        add_action( 'init', array( $this, 'register_widgets' ) );
        add_action('get_header', 'remove_admin_login_header');

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'ovo' ),
            'extra' => esc_html__( 'Extra', 'ovo' ),
            'footer' => esc_html__( 'Footer', 'ovo' ),
            'footer-2' => esc_html__( 'Footer-2', 'ovo' ),
        ) );

        parent::__construct();
    }

    function register_post_types() {
        require('lib/custom-types.php');
    }

    function register_taxonomies() {
        require('lib/taxonomies.php');
    }

    function register_menus() {
        require('lib/menus.php');
    }

    function register_widgets() {
        require('lib/widgets.php');
    }

    function add_to_context( $context ) {

        $context['site'] = $this;

        /*
         * Menu's
         */
        $context['menu']       = new TimberMenu("primary");
        $context['menu_extra']  = new TimberMenu("extra");
        $context['menu_footer'] = new TimberMenu("footer");
        $context['menu_footer_2'] = new TimberMenu("footer-2");
        $context['menu_footer_3'] = new TimberMenu("footer-3");

        $context['submenu_block']  = array();

        $context['submenu_block_primary']    = wp_nav_menu( array(
            'theme_location'     => 'primary',
            'sub_menu' => true,
            'echo' => false,
            'link_before' => "<i class=\"fa fa-circle\"></i>"
        ));

        $context['footer_mail'] = get_field('footer_mail', 'options');
        $context['footer_phone'] = get_field('footer_phone', 'options');
        $context['footer_address'] = get_field('footer_address', 'options');
        $context['footer_operation_hours'] = get_field('footer_operation_hours', 'options');

        $context['offers'] = get_field('offers', 'options');

        if($context['submenu_block_primary'] != "") {
            $context['submenu_block'] = $context['submenu_block_primary'];
        }

        $context["is_admin"] = is_user_logged_in();

        $has_video_slider = 0;

        /*
         * Footer widgets
         */
        for($i=1; $i <= 4; $i++) {
            $context['footer_'. $i .'_widget'] = Timber::get_widgets('footer-'. $i);
        }

        /*
         * social media share link
         */
        $share_title = urlencode(wp_title('', false));
        $share_url = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        $sm_facebook = "https://www.facebook.com/sharer/sharer.php?u=". $share_url;
        $sm_twitter = "https://twitter.com/intent/tweet?text=". $share_title ."&&url=". $share_url;
        $sm_linkedin = "https://www.linkedin.com/shareArticle?title=". $share_title ."&url=". $share_url;
        $sm_mail = "mailto:?subject=". $share_title ."&body=". $share_url;
        $social_media_share = "";
        $social_media_share .= "<a href=\"". $sm_facebook ."\" target=\"_blank\" class=\"icon open-share-popup\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a>";
        $social_media_share .= "<a href=\"". $sm_twitter ."\" target=\"_blank\" class=\"icon open-share-popup\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a>";
        $social_media_share .= "<a href=\"". $sm_linkedin ."\" target=\"_blank\" class=\"icon open-share-popup\"><i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i></a>";
        $social_media_share .= "<a href=\"". $sm_mail ."\" class=\"icon\"><i class=\"fa fa-envelope\" aria-hidden=\"true\"></i></a>";
        $context['social_media_share'] = $social_media_share;

        $social_media_menu = "";
        if(get_field('facebook_url', 'options') != ""){$social_media_menu .= "<a href=\"". get_field('facebook_url', 'options') ."\" class=\"social-bottom\" target=\"_blank\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a>";}
        if(get_field('instagram_url', 'options') != ""){$social_media_menu .= "<a href=\"". get_field('instagram_url', 'options') ."\" class=\"social-bottom\" target=\"_blank\"><i class=\"fa fa-instagram\" aria-hidden=\"true\"></i></a>";}
        if(get_field('linkedin_url', 'options') != ""){$social_media_menu .= "<a href=\"". get_field('linkedin_url', 'options') ."\" class=\"social-bottom\" target=\"_blank\"><i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i></a>";}
        if(get_field('twitter_url', 'options') != ""){$social_media_menu .= "<a href=\"". get_field('twitter_url', 'options') ."\" class=\"social-bottom\" target=\"_blank\"><i class=\"fa fa-twitter\" aria-hidden=\"true\"></i></a>";}
        if(get_field('youtube_url', 'options') != ""){$social_media_menu .= "<a href=\"". get_field('youtube_url', 'options') ."\" class=\"social-bottom\" target=\"_blank\"><i class=\"fa fa-youtube\" aria-hidden=\"true\"></i></a>";}

        $context['social_media_menu'] = $social_media_menu;

        /*
          *  LANGUAGE SWITCHER
         */
        if (function_exists('icl_object_id')) {
            $context['wpml_language_switcher'] = apply_filters('wpml_active_languages', 'skip_missing=1&order=asc');
        }

        $context["is_front_page"] = is_front_page();

        $context["slider"] = get_field('slider');

        $context['ajax'] = isset($_GET['ajax']) && $_GET['ajax'] == 1;

        return $context;

    }

    function add_to_twig( $twig ) {
        /* this is where you can add your own functions to twig */
        $twig->addExtension( new Twig_Extension_StringLoader() );
        return $twig;
    }

}

new StarterSite();

// option page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page("Thema opties");
}

// video embed action
add_action( 'run_video_embed', 'video_embed', 10, 2);


// includes
include("lib/youtube_embed.php");
include("lib/search-acf-fields.php");
include("lib/flexible_layout_title.php");
include("lib/submenu.php");
include("lib/blocks.php");
include("lib/acf-style.php");
//include("lib/fix_url_paths.php");
//include("lib/optimize_clean_wordpress.php");