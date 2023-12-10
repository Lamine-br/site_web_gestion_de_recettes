$(document).ready(function () {
   
    function getdata() {
        $.get("news_recettes.php", (data) => {
            $("#tbody_news").empty();
            let news = data[0];
            for (i in news) {
                element = news[i];
                console.log(element);
                let row = $("<tr></tr>");
                let first = $(`<td> <a type='submit' href='../../Routeurs/Page_News2/index.php?id_news=${element.Id_news}'>${element.Id_news}</a></td>`);
                let second = $(`<td>  ${element.Titre_news}  </td>`);
                let fourth; 
                if (element.Diapo_news == "0") {
                    fourth = $("<td><form action='' method='post'><input type='text' name='ajouter_news_diapo' value='" + element.Id_news + "' hidden><button type='submit' class='btn btn-success' id='ajouter_news_diapo' value='" + element.Id_news + "'>Ajouter au Diapo</a></td>");
                } else if (element.Diapo_news == "1") {
                    fourth = $("<td><form action='' method='post'><input type='text' name='enlever_news_diapo' value='" + element.Id_news + "' hidden><button type='submit' class='btn btn-danger' id='enlever_news_diapo' value='" + element.Id_news + "'>Enlever du Diapo</a></td>");
                }
                row.append(first, second, fourth);
                $("#tbody_news").append(row);
            }

            $("#tbody_recettes").empty();
            let recettes = data[1];
            for (i in recettes) {
                element = recettes[i];
                console.log(element);
                let row=$("<tr></tr>");
               let first = $("<td></td>");
               first.text(`${element.Id_recette}`)
               let second = $(`<td> <form action='../../Routeurs/Page_Recette/index.php' method='get' target='_blank'><input type='text' name='id_recette' value='` + element.Id_recette + `' hidden> <a type='submit' href='../../Routeurs/Page_Recette/index.php?id_recette=${element.Id_recette}'> ${element.Nom_recette} </a> </form> </td>`);
               let third=$(`<td><form action='../../Routeurs/Page_Profil/index.php?id=${element.Id_Utilisateur}' method=\"get\"><a type='submit' href='../../Routeurs/Page_Profil/index.php?id=${element.Id_Utilisateur}'> ${element.Id_Utilisateur} </a></form></td>`); 
               let fourth; 
                if (element.Diapo_recette == "0") {
                    fourth = $("<td><form action='' method='post'><input type='text' name='ajouter_recette_diapo' value='" + element.Id_recette + "' hidden><button type='submit' class='btn btn-success' id='ajouter_recette_diapo' value='" + element.Id_recette + "'>Ajouter au Diapo</a></td>");
                } else if (element.Diapo_recette == "1") {
                    fourth = $("<td><form action='' method='post'><input type='text' name='enlever_recette_diapo' value='" + element.Id_recette + "' hidden><button type='submit' class='btn btn-danger' id='enlever_recette_diapo' value='" + element.Id_recette + "'>Enlever du Diapo</a></td>");
                }
                row.append(first, second, fourth);
               $("#tbody_recettes").append(row);
            }
          
        }).then(function () {
          
        })
 
    }
    getdata();

})