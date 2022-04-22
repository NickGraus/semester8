$(document).ready(function() {
    $(".hotspot").on({
        mouseenter: function () {
            if ($(window).width() > 1500) {
                $(this).find(".foldout").stop().slideDown(500);
            }
        },
        mouseleave: function () {
            if ($(window).width() > 1500) {
                $(this).find(".foldout").stop().slideUp(500);
            }
        }
    });
});