$(document).ready(function() {
    var words = $(".slider-holder .title h2").text();
    var arrofwords = words.split(" ");
    var middle = arrofwords.length / 2;
    arrofwords.splice(middle, 0, "<br/><span>");
    var output = arrofwords.join(" ");
    $(".slider-holder .title h2").empty()
    $(".slider-holder .title h2").append(output+"</span>");
});