$(document).ready(function () {
    for (let i in $("li")) {
        $(i).removeClass("active2");
    };
    let tableau = Array();
    $("li:nth-of-type(5)").addClass("active2");

})