/**
 * Created by kevin on 14-12-2017.
 */

function onScrollInit( items ) {


    items.each( function() {
        var osElement = $(this);
        //var osTrigger = ( trigger ) ? trigger : osElement;

        osElement.waypoint(function(direction) {

            if(direction === "down"){
                osElement.removeClass('pre-animation');
            } else { // remove block for a new animation after going up
                osElement.addClass('pre-animation')
            }

        },{
            triggerOnce: true,
            offset: '90%'
        });

    });


}
function onScrollInitCounter( items ) {


    items.each( function() {
        var osElement = $(this);
        //var osTrigger = ( trigger ) ? trigger : osElement;

        osElement.waypoint(function(direction) {

            if(direction === "down"){
                if(window.trigger !== true) {
                    startCount();
                }
                window.trigger = true
            } else { // remove block for a new animation after going up

            }

        },{
            triggerOnce: true,
            offset: '90%'
        });

    });


}

function setScroll(){
    scrollTop = $(this).scrollTop();
    if(scrollTop > 74){
        $("body").addClass("header-fixed");
    } else {
        $("body").removeClass("header-fixed");
    }
    if(scrollTop > 180){
        $(".sticky-mobile").addClass("compressed");
    } else {
        $(".sticky-mobile").removeClass("compressed");
        $('.pack-header').matchHeight();
    }
    if(scrollTop > 101){
        $(".sticky-desktop").addClass("desktop-compressed");
    } else {
        $(".sticky-desktop").removeClass("desktop-compressed");
    }



    var st = scrollTop;
    if (st > lastScrollTop){
        // downscroll code
        $(".header").addClass("scroll-hidden");
    } else {
        $(".header").removeClass("scroll-hidden");
        // upscroll code
    }
    lastScrollTop = st;

}
var lastScrollTop = 0;
//sticky header
$(document).ready(function() {
    $height = 0;
    $(window).scroll(function () {
        setScroll();
    });
    setScroll();

    window.trigger = false;

    setTimeout(function(){
        $(".cover-content").removeClass("pre-animation");
        onScrollInit( $('.block, .footer-main, .image-text-holder, .bottom-block-parts-holder,.content-text-page') );
        onScrollInitCounter($('.counter'));
    }, 500);

    $(window).resize(function() {
        setTimeout(function(){
        onScrollInit( $('.block, .footer-main, .image-text-holder, .bottom-block-parts-holder,.content-text-page') );
        onScrollInitCounter($('.counter'));
        }, 500);
    });
});

