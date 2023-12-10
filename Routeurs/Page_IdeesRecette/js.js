$(document).ready(function () {
    for (let i in $("li")) {
        $(i).removeClass("active2");
    };
    let tableau = Array();
    $("li:nth-of-type(3)").addClass("active2");

    $("#ajouter").click(function () {
        if (!tableau.includes($("#ingredient option:selected").val())) {
            if ($("#ingredient").val() != "0") {
                if (!$("#ingredients").is(":empty")){
                    $("#ingredients").text($("#ingredients").text() + "    " + $("#ingredient option:selected").text());
                } else {
                    $("#ingredients").text($("#ingredient option:selected").text());
                }
                tableau.push($("#ingredient option:selected").val());
            }
        } else {
            let text = $("#ingredients").text();
            $("#ingredients").text($("#ingredients").text() + "    " + "  Element ajouté déja  ");
            setTimeout(function () { 
                $("#ingredients").text(text);
            },500);
        }
        $("#ids").val("");
        console.log(tableau);
        for (let i = 0; i < tableau.length; i++){
            $("#ids").val($("#ids").val()+" "+tableau[i]);
        }
        console.log($("#ids").val());
    })

    $("#rechercher").click(function () {
        $("#appliquer").click();
    })


})