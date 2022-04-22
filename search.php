<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();

$context['title'] = __('Search result for ', 'alif'). get_search_query();
$context['posts'] = new Timber\PostQuery(array('s' => get_search_query(), 'post_type' => array( 'post', 'page', 'product'), 'posts_per_page' => -1));

$page_list = array();
$product_list = array();
$news_list = array();

foreach($context["posts"] as $item){

    if($item->post_type == "product"){
        $product_list[] = $item;
    }
    if($item->post_type == "page"){
        $page_list[] = $item;
    }
    if($item->post_type == "post"){
        $news_list[] = $item;
    }

}

$current_date = date('Ymd');

$context["products"] = $product_list;
$context["sitemap"] = $page_list;
$context["news"] = $news_list;

$templates = array( 'search.twig');

Timber::render( $templates, $context );
