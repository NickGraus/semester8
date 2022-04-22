<?php
function my_acf_flexible_content_layout_name( $title, $field, $layout, $i ) {

    // remove layout title from text
    $title = "";

    if(get_sub_field('name') != ""){
        $title = get_sub_field('name');
    } else if(get_sub_field('name') != ""){
        $title = get_sub_field('name');
    }

    if($title != "") {
        $title = "<b>" . $title . "</b> - " . $layout['label'] . "";
    } else {
        $title = $layout['label'] ;
    }

    if($layout['label'] == "Menu item"){
        $title = "<span style=\"color: #aaa;\">". $title ."</span>";
    }

    // return
    return $title;

}

// name
add_filter('acf/fields/flexible_content/layout_title/name=partners', 'my_acf_flexible_content_layout_name', 10, 4);