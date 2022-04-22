$(document).ready(function(){

    $(".main-navigation .main-list > li, .extra .extra-list > li").on({
        mouseenter: function () {
            $(this).children(".sub-list").stop().slideDown(200);
            $(this).find("> a").addClass("active");
        },

        mouseleave: function () {
            $(this).children(".sub-list").stop().slideUp(200);
            $(this).find("> a").removeClass("active");
        }
    });

    $(".main-navigation .main-list > li > .sub-list > li, .extra .extra-list > li > .sub-list > li").on({
        mouseenter: function () {
            $(this).children(".sub-list").stop().fadeIn(200);
        },

        mouseleave: function () {
            $(this).children(".sub-list").stop().fadeOut(200);
        }
    });

    $(".current-menu-parent").addClass("opened");

});