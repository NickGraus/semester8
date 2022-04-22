<?php
/**
 * Template Name: Blokken pagina
 */
$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['blocks'] = get_field('blocks');

include("lib/slider.php");

/*
 * LATEST NEWS
 */
$context['archive_link'] = get_post_type_archive_link("post");
$context['news'] = Timber::get_posts(array(
    'numberposts' => 3,
    'offset' => 0,
    'category' => 0,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'include' => '',
    'exclude' => '',
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true,
    'taxonomy' => '',
));

/*
 * END LATEST NEWS
 */

$context['blocks'] = get_field('blocks');
if(is_array($context['blocks']) && count($context['blocks']) > 0){
    for($i=0; $i < count($context['blocks']); $i++){
        if($context['blocks'][$i]["acf_fc_layout"] == "block-grid"){
            $available_images = count($context['blocks'][$i]["galery"]);
            $placeholder_images = 9 - count($context['blocks'][$i]["galery"]);
            $temp_array = array();
            for($k=0; $k <= 8; $k++){
                if(!isset($context['blocks'][$i]["galery"][$k])){
                    $temp_array[$k] = "placeholder";
                }
            }
            $new_array = array_merge($context['blocks'][$i]["galery"], $temp_array);

            shuffle($new_array);
            $context['blocks'][$i]["galery"]  = $new_array;
        }
    }
}

Timber::render(array('blocks.twig'), $context);