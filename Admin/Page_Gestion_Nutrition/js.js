$(document).ready(function () {
   
    function getdata() {
       $.get("ingredients.php", (data) => {
          $("#tbody_ingredients").empty();
 
          for (i in data) {
            element = data[i];
            let row=$("<tr></tr>");
            let first = $("<td></td>");
            first.text(`${element.Id_ingredient}`)
            let second = $(`<td> <form action='' method='post'> <a type='submit' href=''> ${element.Nom_ingredient} </a> </form> </td>`);
            let third = $(`<td> ${element.Healthy}</td>`); 
            let fourth = $(`<td> ${element.Calories} </td>`); 
            let fifth = $(`<td> ${element.Glucides} </td>`); 
            let sixth = $(`<td> ${element.Lipides} </td>`); 
            let seventh = $(`<td> ${element.Mineraux} </td>`); 
             let eighth = $(`<td> ${element.Vitamines} </td>`); 
             let ninth = $(`<td> ${element.Id_Saison} </td>`); 
             let tenth = $(`<td> ${element.Nom_saison} </td>`); 
            let eleventh = $("<td><form action='' method='post'><input type='text' name='supprimer' value='" + element.Id_ingredient + "' hidden><button type='submit' class='btn btn-danger' id='supprimer' value='" + element.Id_ingredient + "'>Supprimer</a></td>");
            row.append(first,second,third,fourth,fifth,sixth,seventh,eighth,ninth,tenth,eleventh);
            $("#tbody_ingredients").append(row);
          }
       }).then(function(){
          
       })
 
   }
   
   function getdata_avecRecherche(recherche) {
      $.get("ingredients.php", (data) => {
         $("#tbody_ingredients").empty();

         for (i in data) {
            element = data[i];
            console.log((element.Nom_ingredient).toLowerCase().includes(recherche.toLowerCase()));
            if ((element.Nom_ingredient).toLowerCase().includes(recherche.toLowerCase())) {
               let row=$("<tr></tr>");
               let first = $("<td></td>");
               first.text(`${element.Id_ingredient}`)
               let second = $(`<td> <form action='' method='post'> <a type='submit' href=''> ${element.Nom_ingredient} </a> </form> </td>`);
               let third = $(`<td> ${element.Healthy}</td>`); 
               let fourth = $(`<td> ${element.Calories} </td>`); 
               let fifth = $(`<td> ${element.Glucides} </td>`); 
               let sixth = $(`<td> ${element.Lipides} </td>`); 
               let seventh = $(`<td> ${element.Mineraux} </td>`); 
                let eighth = $(`<td> ${element.Vitamines} </td>`); 
                let ninth = $(`<td> ${element.Id_Saison} </td>`); 
                let tenth = $(`<td> ${element.Nom_saison} </td>`); 
               let eleventh = $("<td><form action='' method='post'><input type='text' name='supprimer' value='" + element.Id_ingredient + "' hidden><button type='submit' class='btn btn-danger' id='supprimer' value='" + element.Id_ingredient + "'>Supprimer</a></td>");
               row.append(first,second,third,fourth,fifth,sixth,seventh,eighth,ninth,tenth,eleventh);
               $("#tbody_ingredients").append(row);
            }
         }
      }).then(function(){
         
      })

   }
    getdata();
    
 
    $("#choix_action").change(function () {
       if ($("#choix_action").val() == "1") {
          $("#modifier").prop("hidden", true);
          $("#ajouter ").prop("hidden", false);
       } else if ($("#choix_action").val() == "2") {
          $("#ajouter").prop("hidden", true);
          $("#modifier ").prop("hidden", false);
       }
    }) 
 
   
    function getingredient($id) {
      let res;
      $.get("ingredients.php", (data) => {

         for (i in data) {
            let element = data[i];
            console.log(element["Id_ingredient"]);
            if (parseInt(element["Id_ingredient"]) == $id) {
               res=element;
            }
         }
      }).then(function () {
         console.log(res);
         $("#nom").val(res["Nom_ingredient"]);
         $("#description").val(res["Description_ingredient"]);
         $("#url_image").val(res["Image_ingredient"]);
         $("#healthy").val(res["Healthy"]);
         $("#calories").val(res["Calories"]);
         $("#glucides").val(res["Glucides"]);
         $("#lipides").val(res["Lipides"]);
         $("#mineraux").val(res["Mineraux"]);
         $("#vitamines").val(res["Vitamines"]);
         $("#saison").val(res["Id_Saison"]);
      })
   }

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

   $("#charger").click(function () {
      getingredient($("#input_id").val());
   }) 

   $("#rechercher").click(function () {
      getdata_avecRecherche($("#text").val());
   }) 
})