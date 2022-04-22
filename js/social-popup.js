function openPopup(url, w, h){
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    return window.open(url, "shareWindow", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function openSharePopup(url){
    var w = 760;
    var h= 440;
    openPopup(url, w, h);
}

$(document).ready(function() {

    $(".open-share-popup").click(function () {
        openSharePopup($(this).attr("href"));
        return false;
    });
});
