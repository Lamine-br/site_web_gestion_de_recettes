$(document).ready(function () {
   
    function getdata(filtre_sexe,filtre_validite,tri) {
       $.get("utilisateurs.php", (data) => {
          $("#tbody_utilisateurs").empty();

          switch (tri) {
             case 1:
                data.sort(function (a, b) { return (a.Nom_utilisateur + a.Prenom_utilisateur).toLowerCase().localeCompare((b.Nom_utilisateur + b.Prenom_utilisateur).toLowerCase()) });
                console.log((data[0].Nom_utilisateur + data[0].Prenom_utilisateur).toLowerCase());
                break;
             case 2:
                data.sort(function (a, b) {return (a.DateNaissance_utilisateur).localeCompare(b.DateNaissance_utilisateur.toLowerCase())});
                break;
          }
 
          for (i in data) {
            element = data[i];
             if (filtre_sexe.includes(element.Sexe_utilisateur) && filtre_validite.includes(element.Valide_utilisateur)) {
               console.log(element);
               let row = $("<tr></tr>");
               let first = $(`<td> <a type='submit' href='../../Routeurs/Page_Profil/index.php?id=${element.Id_utilisateur}'>${element.Id_utilisateur}</a></td>`);
               let second = $(`<td>  ${element.Nom_utilisateur}  </td>`);
               let third = $(`<td> ${element.Prenom_utilisateur}</td>`); 
               let fourth = $(`<td> ${element.DateNaissance_utilisateur} </td>`); 
               let fifth = $(`<td> ${element.Sexe_utilisateur} </td>`); 
               let sixth = $(`<td> ${element.Mail_utilisateur} </td>`); 
               // let seventh = $(`<td> ${element.MotDePasse_utilisateur} </td>`); 
               let eighth = $(`<td> ${element.Valide_utilisateur} </td>`); 
               let ninth = $("<td><form action='' method='post'><input type='text' name='supprimer' value='" + element.Id_utilisateur + "' hidden><button type='submit' class='btn btn-outline-danger' id='supprimer' value='" + element.Id_utilisateur + "'>Supprimer</a></td>");
               let tenth;
               if (element.Valide_utilisateur == "0") {
                  tenth = $("<td><form action='' method='post'><input type='text' name='valider' value='" + element.Id_utilisateur + "' hidden><button type='submit' class='btn btn-success' id='valider' value='"+element.Id_utilisateur+"'>Valider</button></form></td>");
               } else {
                  tenth = $("<td><form action='' method='post'><input type='text' name='bloquer' value='" + element.Id_utilisateur + "' hidden><button type='submit' class='btn btn-danger' id='bloquer' value='"+element.Id_utilisateur+"'>Bloquer</button></form></td>");
               }
               row.append(first,second,third,fourth,fifth,sixth,eighth,tenth,ninth);
               $("#tbody_utilisateurs").append(row);
            }
          }
       }).then(function(){
          
       })
 
    }
   getdata(["M","F"],["0","1"],1);
   
   $("#appliquer").click(function () {
      let filtre_sexe = Array();
      let filtre_validite = Array();

      // Sexe
      if ($("#M").prop("checked")) {
         filtre_sexe.push("M");
      }
      if ($("#F").prop("checked")) {
         filtre_sexe.push("F");
      }
      console.log(filtre_sexe);

      // Validite
      if ($("#valide").prop("checked")) {
         filtre_validite.push("1");
      }
      if ($("#nonvalide").prop("checked")) {
         filtre_validite.push("0");
      }


      let tri = 1;
      if ($("#nom").prop("checked")) {
         tri = 1;
      }
      if ($("#datenaissance").prop("checked")) {
         tri = 2;
      }

      getdata(filtre_sexe,filtre_validite,tri);

   })
 
 })