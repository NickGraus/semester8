$(document).ready(function() {
    $(".btn.btn-sm").click(event, function(){
        if($(this).hasClass("active")) {

        }
        else {
            event.preventDefault();
            $(this).parent().parent().toggleClass("expanded");
            $(this).toggleClass("active");
            $(".main-search .form-group input").focus();
        }
    });

    $('.search-form').submit(function(event) {

        if ($(this).find('input').val() == '') {
            event.preventDefault();
        }

    });
});

