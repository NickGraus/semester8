<?php
	/*
		Template Name: Skip hoofdmenu
	*/
	if (have_posts()) {
		while (have_posts()) {
			the_post();
				$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
				if ($pagekids) {
				$firstchild = $pagekids[0];
				wp_redirect(get_permalink($firstchild->ID));
			}
		}
	}
?>