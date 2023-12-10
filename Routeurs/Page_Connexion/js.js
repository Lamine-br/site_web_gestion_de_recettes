$(document).ready(function () {
    $("#tab-login").click(function () {
        $("#tab-register").removeClass("show active");
        $(this).addClass("active");

        $("#pills-register").removeClass("show active");
        $("#pills-login").addClass("show active");
    })

    $("#tab-register").click(function () {
        $("#tab-login").removeClass("show active");
        $(this).addClass("active");

        $("#pills-login").removeClass("show active");
        $("#pills-register").addClass("show active");
    })

    $("#termes").change(function () {
        if ($(this).prop("checked") == true) {
            $("#register_button").prop("disabled",false);
        } else {
            $("#register_button").prop("disabled",true);
        }
    })

    $("#raccourci").click(function () {
        $("#tab-login").removeClass("show active");
        $("#tab-register").addClass("active");

        $("#pills-login").removeClass("show active");
        $("#pills-register").addClass("show active");
    })
})
