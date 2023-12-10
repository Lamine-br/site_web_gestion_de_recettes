
$(document).ready(function () {
    for (let i in $("li")) {
        $(i).removeClass("active2");
    };
    $("li:first").addClass("active2");

    $("#carouselExampleIndicators").carousel({
        interval : 2000,
        pause :"hover"
    })
})