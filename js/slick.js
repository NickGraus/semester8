$(document).ready(function(){

    var sliderTimeout = '';

    $('.slider').slick({
        autoplay: true,
        fade: true,
        arrows: true,
        dots: false,
        infinite: true
    });

    $('.image-slider').slick({
        autoplay: true,
        fade: true,
        arrows: false,
        dots: true,
        infinite: true
    });


    $('.big-image-slider').slick({
        autoplay: true,
        fade: true,
        arrows: true,
        dots: false,
        infinite: true
    });
    $('.big-image-slider-villas').slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        autoplay: true,
        fade: false,
        arrows: true,
        dots: false,
        infinite: true,
        responsive: [
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.products-slider').slick({
        autoplay: true,
        arrows: false,
        dots: true,
        infinite: true,
        accessibility: false,
        slidesToShow: 3,
        slidesToScroll: 3,
        speed: 1000
    });

});