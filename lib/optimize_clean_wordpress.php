<?php

// remove gutenberg styles
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'bodhi-svgs-attachment' );

    //wp_deregister_script('jquery');

    //
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 9999 );

// remove emoji
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


/**
 * Disable Yoast's Hidden love letter about using the WordPress SEO plugin.
 */
add_action( 'template_redirect', function () {

    if ( ! class_exists( 'WPSEO_Frontend' ) ) {
        return;
    }

    $instance = WPSEO_Frontend::get_instance();

    // make sure, future version of the plugin does not break our site.
    if ( ! method_exists( $instance, 'debug_mark') ) {
        return ;
    }

    // ok, let us remove the love letter.
    remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
}, 9999 );

/**
 * Disable Yoast's Hidden love letter about using the WordPress SEO plugin.
 */
add_action( 'template_redirect', function () {

    if ( ! class_exists( 'WPSEO_Frontend' ) ) {
        return;
    }

    $instance = WPSEO_Frontend::get_instance();

    // make sure, future version of the plugin does not break our site.
    if ( ! method_exists( $instance, 'debug_mark') ) {
        return ;
    }

    // ok, let us remove the love letter.
    remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
}, 9999 );


add_action( 'init', function() {

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}, PHP_INT_MAX - 1 );

// remove meta tags generator WP and WPML
global $sitepress;

remove_action( 'wp_head', 'wp_generator' ); // goes into functions.php
remove_action( 'wp_head', array( $sitepress, 'meta_generator_tag' ) );