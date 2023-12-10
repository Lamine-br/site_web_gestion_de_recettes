$(document).ready(function () {
    
    $("#ajouter2").click(function () {
        if (!$("#ingredients").text().includes($("#ingredient option:selected").text())) {
            if ($("#ingredient").val() != "0") {
                if (!$("#ingredients").is(":empty")){
                    $("#ingredients").text($("#ingredients").text() + " - " + $("#ingredient option:selected").val()+":"+$("#ingredient option:selected").text()+":"+$("#quantite").val()+":"+$("#unite option:selected").text());
                } else {
                    $("#ingredients").text($("#ingredients").text() +$("#ingredient option:selected").val()+":"+ $("#ingredient option:selected").text()+":"+$("#quantite").val()+":"+$("#unite option:selected").text());
                }
            }
        } else {
            let text = $("#ingredients").text();
            $("#ingredients").text($("#ingredients").text() + "    " + "  Element ajouté déja  ");
            setTimeout(function () { 
                $("#ingredients").text(text);
            },500);
        }
     })
     
     $("#ajouter3").click(function () {
        if (!$("#etapes").is(":empty")){
           $("#etapes").text($("#etapes").text() + " - " + $("#etape").val() + ":" + $("#tempspreparation").val()+":" +$("#tempscuisson").val()+":" +$("#tempsrepos").val()+":" +$("#tempstotal").val());
       } else {
           $("#etapes").text($("#etapes").text() + $("#etape").val() +":" + $("#tempspreparation").val()+":" +$("#tempscuisson").val()+":" +$("#tempsrepos").val()+":" +$("#tempstotal").val());
       }
    })
})