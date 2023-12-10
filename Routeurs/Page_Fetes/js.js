$(document).ready(function () {
    for (let i in $("li")) {
        $(i).removeClass("active2");
    };
    $("li:nth-of-type(6)").addClass("active2");

})