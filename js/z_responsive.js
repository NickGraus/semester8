function onResize(){
    $('.hotspot .title').matchHeight();
    $('.hotspot .text').matchHeight();
    $('.hotspot').matchHeight();
}
$(document).ready(function() {

    $( window ).resize(function() {
        onResize();
    });

    onResize();

});
