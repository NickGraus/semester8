<?php

    $has_video_slider = 0;

    if(get_field('slider-items', $context["post"]->id) != ""){
        foreach(get_field('slider-items', $context["post"]->id) as $item){
            if(isset($item["video_slide"]) && $item["video_slide"] == 1){
                $has_video_slider = 1;
            }
        }
    }
    $context["has_video_slider"] = $has_video_slider;