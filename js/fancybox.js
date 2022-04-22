$(document).ready(function(){
    $('[data-fancybox]').fancybox({
        buttons : [
            'close'
        ],
        loop: true
    });

    $("[data-fancybox-iframe]").fancybox({
        buttons : [
            'close'
        ],
        iframe : {

            css : {
                width : '600px'
            }
        }
    });

});

