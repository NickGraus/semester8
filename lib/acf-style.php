<?php

    function my_acf_admin_head() {
        ?>
        <style type="text/css">

            .acf-flexible-content .layout .acf-fc-layout-handle {
                background-color: #666;
                color: #fff;
            }

            .acf-repeater.-row > table > tbody > tr > td,
            .acf-repeater.-block > table > tbody > tr > td {
                border-top: 2px solid #666;
            }

            .acf-repeater .acf-row-handle {
                vertical-align: top !important;
                padding-top: 16px;
            }

            .acf-repeater .acf-row-handle span {
                font-size: 20px;
                font-weight: bold;
                color: #666;
            }

            .imageUpload img {
                width: 75px;
            }

            .acf-repeater .acf-row-handle .acf-icon.-minus {
                top: 30px;
            }

        </style>
        <?php
    }

    add_action('acf/input/admin_head', 'my_acf_admin_head');


    function my_acf_flexible_content_layout_title( $title, $field, $layout, $i ) {

        $add_to_title = "";

        if($layout['name'] == "text_cols"){

            if ($cols = get_sub_field('cols')) {

                $add_to_title .= ": ";

                $counter = 1;

                $aTitle = array();

                foreach($cols as $key => $val){

                    $aTitle[] .= " [". $counter ."] ". $val['title'];
                    $counter++;
                }

                $add_to_title .= implode(", ", $aTitle);

            }

        } else if($layout['name'] == "image"){



            if ($image = get_sub_field('image')) {

                $add_to_title .= ": " . $image['filename'];

            }

        } else {

            // load text sub field
            if ($add_title = get_sub_field('title')) {

                $add_to_title .= ": " . $add_title;

            }

        }


        // return
        return $title . $add_to_title;

    }

    // name
    add_filter('acf/fields/flexible_content/layout_title/name=blocks', 'my_acf_flexible_content_layout_title', 10, 4);
