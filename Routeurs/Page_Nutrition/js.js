$(document).ready(function () {
    for (let i in $("li")) {
        $(i).removeClass("active2");
    };

    $("li:nth-of-type(7)").addClass("active2");
})