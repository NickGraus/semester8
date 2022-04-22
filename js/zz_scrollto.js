function scrollToElement(element) {
    if($(element).length){
    $('html, body').animate({
        scrollTop: $(element).offset().top - 150
    }, 1000);
    }
}

function scrollToElement2(element) {
    if($(element).length) {
        $('html, body').animate({
            scrollTop: $(element).offset().top - 250
        }, 1000, function () {
            $(".header").addClass("scroll-hidden");
        });
    }
}


$(document).ready(function() {

    $('#backto-top[href*="#"]').click(function (element) {

        var url = $(this).attr('href');

        if(url.indexOf(window.location.pathname) > -1 || url.charAt(0) == "#" ) {


            var target = $(this.hash);
            scrollToElement2(target);
        }

    });



});