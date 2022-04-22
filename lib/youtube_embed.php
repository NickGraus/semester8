<?php

    function bootstrap_wrap_oembed( $html ){
        $html = preg_replace( '/(width|height)="\d*"\s/', "", $html ); // Strip width and height #1
        return'<div class="embed-responsive embed-responsive-16by9">'.$html.'</div>'; // Wrap in div element and return #3 and #4
    }
    add_filter( 'embed_oembed_html','bootstrap_wrap_oembed',10,1);