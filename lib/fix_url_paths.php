<?php
// TODO clean to other file
add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
function add_current_nav_class($classes, $item) {
    // Getting the current post details
    global $post;
    // Make sure we're not on a single blog post before running the code...
    if ( !is_singular( 'post' ) ) {
        // Getting the post type of the current post

        if (isset($post->ID)) {

            $post_type = get_post_type($post->ID);

            $current_post_type = get_post_type_object($post_type);

            if (isset($current_post_type) && $current_post_type->rewrite != "") {
                $current_post_type_slug = $current_post_type->rewrite['slug'];
                // Getting the URL of the menu item
                $menu_slug = strtolower(trim($item->url));
                // If the menu item URL contains the current post types slug add the current-menu-item class

                if ($current_post_type_slug != "") {

                    if (strpos($menu_slug, strval($current_post_type_slug)) !== false) {
                        $classes[] = 'current-menu-item';
                    } // as we are not on a single blog post, stop blog menu from highlighting
                    else {
                        $classes = array_diff($classes, array('current_page_parent'));
                    }

                }

            }
        }
    }
    // Return the corrected set of classes to be added to the menu item
    return $classes;
}