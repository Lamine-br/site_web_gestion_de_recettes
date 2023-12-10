$(document).ready(function () {
   
   function getdata(filtre_categorie,filtre_saison,tri) {
      $.get("recettes.php", (donnees) => {
         $("#tbody_recettes").empty();
         let data = donnees[0];
         console.log("Critere ", tri);
         switch (tri) {
            case 1:
               data.sort(function (a, b) {
                  if (parseInt(a.TempsPreparation) > parseInt(b.TempsPreparation)) {
                     return 1;
                  } else if (parseInt(a.TempsPreparation) < parseInt(b.TempsPreparation)) {
                     return -1;
                  } else {
                     return 0;
                  }
               });
               break;
            case 2:
               data.sort(function (a, b) {
                  if (parseInt(a.TempsCuisson) > parseInt(b.TempsCuisson)) {
                     return 1;
                  } else if (parseInt(a.TempsCuisson) < parseInt(b.TempsCuisson)) {
                     return -1;
                  } else {
                     return 0;
                  }
               });
               break;
            case 3:
               data.sort(function (a, b) {
                  if (parseInt(a.TempsTotal) > parseInt(b.TempsTotal)) {
                     return 1;
                  } else if (parseInt(a.TempsTotal) < parseInt(b.TempsTotal)) {
                     return -1;
                  } else {
                     return 0;
                  }
               });
               break;
            case 4:
               data.sort(function (a, b) {
                  if (parseInt(a.nbcalories) > parseInt(b.nbcalories)) {
                     return 1;
                  } else if (parseInt(a.nbcalories) < parseInt(b.nbcalories)) {
                     return -1;
                  } else {
                     return 0;
                  }
               });
               break;
            case 5:
               data.sort(function (a, b) {
                  if (parseInt(a.note) > parseInt(b.note)) {
                     return 1;
                  } else if (parseInt(a.note) < parseInt(b.note)) {
                     return -1;
                  } else {
                     return 0;
                  }
               });
         }
         for (i in data) {
            element = data[i];
            if (filtre_categorie.includes(element.Id_Categorie) && filtre_saison.includes(element.Id_Saison)) {
               let row=$("<tr></tr>");
               let first = $("<td></td>");
               first.text(`${element.Id_recette}`)
               let second = $(`<td> <form action='../../Routeurs/Page_Recette/index.php' method='get'><input type='text' name='id_recette' value='` + element.Id_recette + `' hidden> <a type='submit' href='../../Routeurs/Page_Recette/index.php?id_recette=${element.Id_recette}' target='_blank'> ${element.Nom_recette} </a> </form> </td>`);
               let third=$(`<td><form action='../../Routeurs/Page_Profil/index.php?id=${element.Id_Utilisateur}' method=\"get\"><a type='submit' href='../../Routeurs/Page_Profil/index.php?id=${element.Id_Utilisateur}' target='_blank'> ${element.Id_Utilisateur} </a></form></td>`); 
               let fourth = $("<td></td>");
               fourth.text(`${element.Valide_recette}`);
               let fifth;
               if (element.Valide_recette == "0") {
                  fifth =$("<td><form action='' method='post'><input type='text' name='valider' value='" + element.Id_recette + "' hidden><button type='submit' class='btn btn-success' id='valider' value='"+element.Id_recette+"'>Valider</button></form></td>");
               } else {
                  fifth = $("<td><form action='' method='post'><input type='text' name='bloquer' value='" + element.Id_recette + "' hidden><button type='submit' class='btn btn-danger' id='bloquer' value='"+element.Id_recette+"'>Masquer</button></form></td>");
               }
               let sixth = $("<td><form action='' method='post'><input type='text' name='supprimer' value='" + element.Id_recette + "' hidden><button type='submit' class='btn btn-outline-danger' id='supprimer' value='" + element.Id_recette + "'>Supprimer</a></td>");
               let seventh = $("<td></td>");
               row.append(first,second,third,fourth,fifth,sixth,seventh);
               $("#tbody_recettes").append(row);
            }
         }
      }).then(function(){
         
      })

   }

   function getrecette($id) {
      let res;
      let res2 = Array();
      let res3 = Array();
      $.get("recettes.php", (donnees) => {
         let data = donnees[0];
         for (i in data) {
            let element = data[i];
            console.log(element["Id_recette"]);
            if (parseInt(element["Id_recette"]) == $id) {
               console.log(true);
               res=element;
            }
         }

         let ingredients = donnees[1];
         for (i in ingredients) {
            let element = ingredients[i];
            if (parseInt(element["Id_Recette"]) == $id) {
               res2.push(element);
            }
         }

         let etapes = donnees[2];
         for (i in etapes) {
            let element = etapes[i];
            if (parseInt(element["Id_Recette"]) == $id) {
               res3.push(element);
            }
         }
      }).then(function () {
         $("#nom").val(res["Nom_recette"]);
         $("#description").val(res["Description_recette"]);
         $("#url_image").val(res["Image_recette"]);
         $("#difficulté").val(res["Difficulte_recette"]);
         $("#categorie").val(res["Id_Categorie"]);
         for (i in res2) {
            if (i == 0) {
               $("#ingredients").val(res2[i]["Id_ingredient"]+":"+res2[i]["Nom_ingredient"]+":"+res2[i]["Quantite"]+":"+res2[i]["Unite"]);

            } else {
               $("#ingredients").val($("#ingredients").val()+" - "+res2[i]["Id_ingredient"]+":"+res2[i]["Nom_ingredient"]+":"+res2[i]["Quantite"]+":"+res2[i]["Unite"]);
            }
         }
         for (i in res3) {
            if (i == 0) {
               $("#etapes").val(res3[i]["Description_etape"]+":"+res3[i]["TempsPreparation"]+":"+res3[i]["TempsCuisson"]+":"+res3[i]["TempsRepos"]+":"+res3[i]["TempsTotal"]);

            } else {
               $("#etapes").val($("#etapes").val()+" - "+res3[i]["Description_etape"]+":"+res3[i]["TempsPreparation"]+":"+res3[i]["TempsCuisson"]+":"+res3[i]["TempsRepos"]+":"+res3[i]["TempsTotal"]);
            }
         }
      })
   }

   getdata(["1"],["1","2","3","4","5"]);
   
   $("#appliquer").click(function () {
      let filtre_categorie = Array();
      let filtre_saison = Array();

      // Saison
      if ($("#hiver").prop("checked")) {
         console.log("checked hiver");
         filtre_saison.push("1");
      }
      if ($("#printemps").prop("checked")) {
         console.log("checked printemps");
         filtre_saison.push("2");
      }
      if ($("#été").prop("checked")) {
         console.log("checked été");
         filtre_saison.push("3");
      }
      if ($("#automne").prop("checked")) {
         console.log("checked automne");
         filtre_saison.push("4");
      }
      if ($("#automne").prop("checked") && $("#été").prop("checked") && $("#printemps").prop("checked") && $("#hiver").prop("checked")) {
         console.log("checked Toute l'année");
         filtre_saison.push("5");
      }
      console.log(filtre_saison);

      // Categorie
      if ($("#entrees").prop("checked")) {
         console.log("checked entrees");
         filtre_categorie.push("1");
      }
      if ($("#plats").prop("checked")) {
         console.log("checked plats");
         filtre_categorie.push("2");
      }
      if ($("#desserts").prop("checked")) {
         console.log("checked desserts");
         filtre_categorie.push("3");
      }
      if ($("#boissons").prop("checked")) {
         console.log("checked boissons");
         filtre_categorie.push("4");
      }
      console.log(filtre_categorie);

      let tri = 5;
      if ($("#temps_preparation").prop("checked")) {
         tri = 1;
      }
      if ($("#temps_cuisson").prop("checked")) {
         tri = 2;
      }
      if ($("#temps_total").prop("checked")) {
         tri = 3;
      }
      if ($("#calories").prop("checked")) {
         tri = 4;
      }
      if ($("#notation").prop("checked")) {
         tri = 5;
      }

      getdata(filtre_categorie, filtre_saison,tri);

   })

   $("#choix_action").change(function () {
      if ($("#choix_action").val() == "1") {
         $("#modifier").prop("hidden", true);
         $("#ajouter ").prop("hidden", false);
         $("#input_id").prop("disabled", true);
         $("#charger").prop("disabled", true);
         $("#ingredients").prop("readonly", true);
         $("#etapes").prop("readonly", true);
      } else if ($("#choix_action").val() == "2") {
         $("#ajouter").prop("hidden", true);
         $("#modifier ").prop("hidden", false);
         $("#input_id").prop("disabled", false);
         $("#charger").prop("disabled", false);
         $("#ingredients").prop("readonly", false);
         $("#etapes").prop("readonly", false);
      }
   }) 

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

   
  $("#charger").click(function () {
     getrecette($("#input_id").val());
}) 

   
})