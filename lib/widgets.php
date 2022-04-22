<?php

for($i=1; $i <= 4; $i++){
    register_sidebar(
        array(
            'name'          => 'Footer '. $i,
            'id'            => 'footer-'. $i,
            'description'   => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        )
    );
}
