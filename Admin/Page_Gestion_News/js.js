$(document).ready(function () {

    let paragraphes = Array();
    let paragraphe = Array();
    paragraphe.push("");
    paragraphe.push("");
    paragraphe.push("");
    paragraphes.push(paragraphe);
    let index = 0;
   
    function getdata() {
       $.get("news.php", (data) => {
          $("#tbody_news").empty();
          for (i in data) {
            element = data[i];
            console.log(element);
            let row = $("<tr></tr>");
            let first = $(`<td> <a type='submit' href='../../Routeurs/Page_News2/index.php?id_news=${element.Id_news}'>${element.Id_news}</a></td>`);
            let second = $(`<td>  ${element.Titre_news}  </td>`);
            let third = $(`<td> ${element.Description_news}</td>`); 
            let fourth = $("<td><form action='' method='post'><input type='text' name='supprimer' value='" + element.Id_news + "' hidden><button type='submit' class='btn btn-outline-danger' id='supprimer' value='" + element.Id_news + "'>Supprimer</a></td>");
            row.append(first,second,third,fourth);
            $("#tbody_news").append(row);
          }
          
       }).then(function(){
          
       })
 
    }
    getdata();
    
    $("#choix_action").change(function () {
        if ($("#choix_action").val() == "1") {
           $("#modifier").prop("hidden", true);
           $("#ajouter ").prop("hidden", false);
           $("#input_id").prop("disabled", true);
           $("#charger").prop("disabled", true);
        } else if ($("#choix_action").val() == "2") {
           $("#ajouter").prop("hidden", true);
           $("#modifier ").prop("hidden", false);
           $("#input_id").prop("disabled", false);
           $("#charger").prop("disabled", false);
        }
    }) 

    $("#titre").change(function () {
        paragraphes[index][0] = $("#titre").val();
    })
    $("#contenu").change(function () {
        paragraphes[index][1] = $("#contenu").val();
    })
    $("#url_image2").change(function () {
        paragraphes[index][2] = $("#url_image2").val();
    })
   
    $("#suivant").click(function () {
        index++;
        if (index == paragraphes.length) {
            if (paragraphes[index-1][1] == "") {
                index--;
            } else {
                $("#titre").val("");
                $("#contenu").val("");
                $("#url_image2").val("");
                let paragraphe = Array();
                paragraphe.push("");
                paragraphe.push("");
                paragraphe.push("");
                paragraphes.push(paragraphe);
            }
            
        } else {
            $("#titre").val(paragraphes[index][0]);
            $("#contenu").val(paragraphes[index][1]);
            $("#url_image2").val(paragraphes[index][2]);
        }
        console.log(paragraphes);
    }) 
    
   
    $("#precedent").click(function () {
        if (index > 0) {
            index--;
        }
        $("#titre").val(paragraphes[index][0]);
        $("#contenu").val(paragraphes[index][1]);
        $("#url_image2").val(paragraphes[index][2]);
    }) 
    
    $("#sauvegarder").click(function () {
        for (let i = 0; i < paragraphes.length; i++) {
            console.log("hey");
            if (i == 0) {
                if (paragraphes[i][1] == "") {
                    
                } else {
                    $("#paragraphes").val(paragraphes[i][0]+":::"+paragraphes[i][1]+":::"+paragraphes[i][2]);
                }
            } else {
                if (paragraphes[i][1] == "") {
                    
                } else {
                    $("#paragraphes").val($("#paragraphes").val()+" --- "+paragraphes[i][0]+":::"+paragraphes[i][1]+":::"+paragraphes[i][2]);
                }
            }
        }
     }) 
 
 })