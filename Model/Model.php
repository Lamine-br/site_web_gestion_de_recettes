<?php
class Model
{

    private $servername = "localhost";
    private $dbname = "projet_tdw";
    private $username = "root";
    private $password = "";

    public function Connexion($servername, $dbname, $username, $password)
    {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            return $conn;
        } catch (PDOException $e) {
            echo ("Erreur : " . $e);
        }
    }

    private function Deconnexion(&$conn)
    {
        $conn = null;
    }

    public function requete($conn, $sql)
    {
        $res = $conn->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function login_utilisateur($username, $password)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $query = "SELECT * from utilisateur where Valide_Utilisateur=1";
        $results = $this->requete($conn, $query);
        foreach ($results as $row) {
            if ($row["Mail_utilisateur"] == $username && $row["MotDePasse_utilisateur"] == $password) {
                $nom = $row["Nom_utilisateur"] . " " . $row["Prenom_utilisateur"];
                $id = $row["Id_utilisateur"];
                $data = array();
                array_push($data, $id);
                array_push($data, $nom);
                return $data;
            }
        }
        $this->Deconnexion($conn);
        return false;
    }

    public function login_admin($username, $password)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $query = "SELECT * from admin";
        $results = $this->requete($conn, $query);
        foreach ($results as $row) {
            if ($row["Mail_admin"] == $username && $row["MotDePasse_admin"] == $password) {
                $nom = $row["Nom_admin"] . " " . $row["Prenom_admin"];
                $id = $row["Id_admin"];
                $data = array();
                array_push($data, $id);
                array_push($data, $nom);
                return $data;
            }
        }
        $this->Deconnexion($conn);
        return false;
    }

    public function ajouter_utilisateur($nom, $prénom, $dateNaissance, $sexe, $email, $password)
    {
        $sql = "INSERT INTO Utilisateur(Nom_utilisateur,Prenom_utilisateur,DateNaissance_utilisateur,Sexe_utilisateur,Mail_utilisateur,MotDePasse_utilisateur,Valide_utilisateur) VALUES (\"$nom\", \"$prénom\", \"$dateNaissance\",\"$sexe\",\"$email\",\"$password\",0)";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_utilisateur($id)
    {
        $sql = "DELETE FROM Utilisateur where Id_utilisateur =$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function valider_utilisateur($id)
    {
        $sql = "UPDATE utilisateur SET Valide_utilisateur=1 where Id_utilisateur =$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function bloquer_utilisateur($id)
    {
        $sql = "UPDATE utilisateur SET Valide_utilisateur=0 where Id_utilisateur =$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_utilisateurs()
    {
        $sql = "SELECT * FROM utilisateur";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }
    public function afficher_profil_utilisateur($id)
    {
        $sql = "SELECT * FROM utilisateur 
        join favori on utilisateur.Id_utilisateur=favori.Id_Utilisateur
        join recette on recette.Id_recette = favori.Id_Recette
        join (SELECT Id_Recette, AVG(Note) as moyenne FROM notation group by Id_Recette) as note 
            on recette.Id_recette = note.Id_Recette
        where utilisateur.Id_utilisateur=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        if (count($res) == 0) {
            $sql = "SELECT * FROM utilisateur where utilisateur.Id_utilisateur=$id";
            $res = $this->requete($conn, $sql);
        }
        $this->Deconnexion($conn);
        return $res;
    }

    public function noter_recette($id_utilisateur, $id_recette, $note)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $test = "SELECT * FROM notation where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
        $res = $this->requete($conn, $test);
        if (count($res) == 0) {
            $sql = "INSERT INTO notation(Id_Utilisateur,Id_Recette,Note) values ($id_utilisateur,$id_recette,$note)";
            $res = $this->requete($conn, $sql);
            $this->Deconnexion($conn);
            return true;
        } else {
            $sql = "UPDATE notation SET Note=$note where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
            $res = $this->requete($conn, $sql);
            $this->Deconnexion($conn);
            return false;
        }
    }

    public function supprimer_favori($id_utilisateur, $id_recette)
    {
        $sql = "DELETE FROM favori where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_favori($id_utilisateur, $id_recette)
    {
        $sql = "INSERT INTO favori (Id_Utilisateur,Id_Recette) values ($id_utilisateur, $id_recette)";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_ingredients()
    {
        $sql = "SELECT * FROM ingredient 
        join ingredientDeSaison on ingredient.Id_ingredient=ingredientDeSaison.Id_Ingredient
        join saison on saison.Id_saison = ingredientDeSaison.Id_Saison order by Nom_ingredient";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_ingredients_avecMotCle($mot)
    {
        $sql = "SELECT * FROM ingredient 
        join ingredientDeSaison on ingredient.Id_ingredient=ingredientDeSaison.Id_Ingredient 
        join saison on saison.Id_saison = ingredientDeSaison.Id_Saison
        where Nom_Ingredient LIKE '%$mot%'";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_news()
    {
        $sql = "SELECT * FROM news";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_news($nom, $description, $image, $paragraphes)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "INSERT INTO news(Titre_news,Description_news,Image_news,Diapo_news) values (\"$nom\",\"$description\",\"$image\",0)";
        $res = $this->requete($conn, $sql);

        $sql2 = "SELECT MAX(Id_news) as id from news";
        $id = ($this->requete($conn, $sql2))[0]["id"];

        $i = 0;
        foreach ($paragraphes as $paragraphe) {
            $i++;
            $this->ajouter_paragraphe($i, $id, $paragraphe[0], $paragraphe[1], $i, $paragraphe[2]);
        }

        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_news($id)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "DELETE FROM news where Id_News=$id";
        $res = $this->requete($conn, $sql);

        $this->supprimer_paragraphe($id);

        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_paragraphe($id_paragraphe, $id_news, $titre, $contenu, $pos, $image)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "INSERT INTO paragraphe(Id_paragraphe,Id_News,Titre_paragraphe,Contenu_paragraphe,Position_paragraphe,Image_paragraphe) values ($id_paragraphe,$id_news,\"$titre\",\"$contenu\",$pos,\"$image\")";
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_paragraphe($id_news)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "DELETE FROM paragraphe where Id_News=$id_news";
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }
    public function afficher_news_ById($id)
    {
        $res = array();
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);

        $sql1 = "SELECT * FROM news where Id_news=$id";
        $res1 = $this->requete($conn, $sql1);
        array_push($res, $res1[0]);

        $sql2 = "SELECT * FROM news join paragraphe on news.Id_news=paragraphe.Id_News where news.Id_news=$id order by Position_paragraphe ";
        $res2 = $this->requete($conn, $sql2);
        array_push($res, $res2);

        $this->Deconnexion($conn);
        return $res;
    }
    public function afficher_recettes_valides()
    {
        $sql = "SELECT * FROM recette where Valide_recette = 1";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_ByUser($id_utilisateur)
    {
        $sql = "SELECT * FROM recette where Id_Utilisateur = $id_utilisateur";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_admin()
    {
        $sql = "SELECT * 
        FROM recette 
        join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette 
        join (select *,max(nombre) as nb from (SELECT recette.Id_recette as id,Id_Saison,COUNT(Id_Saison) as nombre FROM recette join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette join ingredientDeSaison on ingredientutilise.Id_Ingredient = ingredientDeSaison.Id_Ingredient group by recette.Id_recette,Id_Saison order by nombre DESC) as res group by res.id) as tab on recette.Id_recette=tab.id
        join (SELECT Id_Recette, AVG(Note) as note FROM notation group by Id_Recette) as note 
            on recette.Id_recette = note.Id_Recette 
        join (SELECT etape.Id_Recette, SUM(etape.TempsPreparation) as TempsPreparation, SUM(etape.TempsCuisson) as TempsCuisson, SUM(etape.TempsRepos) as TempsRepos ,SUM(etape.TempsTotal) as TempsTotal FROM (recette join etape on recette.Id_recette=etape.Id_Recette) group by Id_recette) as temps 
            on recette.Id_recette = temps.Id_Recette 
        join (select ingredientutilise.Id_Recette, SUM(ingredientutilise.Quantite*ingredient.Calories)as nbcalories from ingredient join ingredientutilise on ingredient.Id_ingredient= ingredientutilise.Id_Ingredient group by ingredientutilise.Id_Recette) as calories
            on recette.Id_recette = calories.Id_Recette group by recette.Id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_etapes()
    {
        $sql = "SELECT * FROM etape";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_ingredientssutilises()
    {
        $sql = "SELECT * FROM ingredientUtilise join ingredient on ingredientutilise.Id_Ingredient=ingredient.Id_ingredient join recette on recette.Id_recette=ingredientutilise.Id_Recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_diapo()
    {
        $sql = "SELECT * FROM recette where Diapo_recette=1";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }
    public function afficher_news_diapo()
    {
        $sql = "SELECT * FROM news where Diapo_news=1";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_recette_diapo($id)
    {
        $sql = "UPDATE recette set Diapo_recette=1 where Id_recette=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function enlever_recette_diapo($id)
    {
        $sql = "UPDATE recette set Diapo_recette=0 where Id_recette=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }
    public function ajouter_news_diapo($id)
    {
        $sql = "UPDATE news set Diapo_news=1 where Id_news=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function enlever_news_diapo($id)
    {
        $sql = "UPDATE news set Diapo_news=0 where Id_news=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_healthy()
    {
        $proportion = $this->afficher_proportion();
        $sql = "SELECT *,AVG(ingredient.Healthy) as pourcentage
        FROM (SELECT * FROM recette where Valide_recette = 1) as tab1
        join `ingredientutilise` on tab1.Id_recette = ingredientutilise.Id_Recette
        join ingredient on ingredient.Id_ingredient = ingredientutilise.Id_Ingredient
        group by tab1.Id_recette
        having pourcentage > $proportion/100";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }


    public function afficher_recettes_selon_categorie($categorie)
    {
        $sql = "SELECT * FROM (recette natural join categorie) where Nom_categorie='$categorie' and Valide_Recette=1";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_avec_ingredients($ids)
    {
        $sql = "SELECT * FROM recette 
        join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette";
        $cond = "";
        $i = 0;
        for ($j = 1; $j < count($ids) + 1; $j++) {
            $id = $ids[$j];
            $i++;
            if ($i == 1) {
                $cond = $cond . " Id_Ingredient=" . intval($id);
            } else {
                $cond = $cond . " or Id_Ingredient=" . intval($id);
            }
        }

        $sql = $sql . " where" . $cond . " group by recette.Id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_avec_filtres($categorie, $saison, $tri)
    {
        // Faire le tri et le filtrage des recettes en faisant les requetes sql

        $sql = "SELECT * 
        FROM recette 
        join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette 
        join (select *,max(nombre) as nb from (SELECT recette.Id_recette as id,Id_Saison,COUNT(Id_Saison) as nombre FROM recette join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette join ingredientDeSaison on ingredientutilise.Id_Ingredient = ingredientDeSaison.Id_Ingredient group by recette.Id_recette,Id_Saison order by nombre DESC) as res group by res.id) as tab on recette.Id_recette=tab.id
        join (SELECT Id_Recette, AVG(Note) as note FROM notation group by Id_Recette) as note 
            on recette.Id_recette = note.Id_Recette 
        join (SELECT etape.Id_Recette, SUM(etape.TempsPreparation) as TempsPreparation, SUM(etape.TempsCuisson) as TempsCuisson, SUM(etape.TempsRepos) as TempsRepos ,SUM(etape.TempsTotal) as TempsTotal FROM (recette join etape on recette.Id_recette=etape.Id_Recette) group by Id_recette) as temps 
            on recette.Id_recette = temps.Id_Recette 
        join (select ingredientutilise.Id_Recette, SUM(ingredientutilise.Quantite*ingredient.Calories)as nbcalories from ingredient join ingredientutilise on ingredient.Id_ingredient= ingredientutilise.Id_Ingredient group by ingredientutilise.Id_Recette) as calories
            on recette.Id_recette = calories.Id_Recette";
        $i = 0;
        foreach ($categorie as $element) {
            $i++;
            switch ($element) {
                case "1":
                    if ($i == 1) {
                        $sql = $sql . " where Id_Categorie = 1";
                    } else {
                        $sql = $sql . " or Id_Categorie = 1";
                    }
                    break;
                case "2":
                    if ($i == 1) {
                        $sql = $sql . " where Id_Categorie = 2";
                    } else {
                        $sql = $sql . " or Id_Categorie = 2";
                    }
                    break;
                case "3":
                    if ($i == 1) {
                        $sql = $sql . " where Id_Categorie = 3";
                    } else {
                        $sql = $sql . " or Id_Categorie = 3";
                    }
                    break;
                case "4":
                    if ($i == 1) {
                        $sql = $sql . " where Id_Categorie = 4";
                    } else {
                        $sql = $sql . " or Id_Categorie = 4";
                    }
                    break;
            }
        }

        $i = 0;
        if (count($saison) > 0) {
            $sql = $sql . " and ( ";
        }
        foreach ($saison as $element) {
            $i++;
            switch ($element) {
                case "1":
                    $sql = $sql . " or Id_Saison = 1";
                    break;
                case "2":
                    $sql = $sql . " or Id_Saison = 2";
                    break;
                case "3":
                    $sql = $sql . " or Id_Saison = 3";
                    break;
                case "4":
                    $sql = $sql . " or Id_Saison = 4";
                    break;
            }
        }
        if (count($saison) == 4) {
            $sql = $sql . " Id_Saison = 5 )";
        } else if (count($saison) > 0) {
            $sql = $sql . " )";
        }
        $sql = $sql . " group by recette.Id_recette ";

        switch ($tri) {
            case 1:
                $sql = $sql . " order by TempsPreparation";
                break;
            case 2:
                $sql = $sql . " order by TempsCuisson";
                break;
            case 3:
                $sql = $sql . " order by TempsTotal";
                break;
            case 4:
                $sql = $sql . " order by nbcalories";
                break;
            case 5:
                $sql = $sql . " order by note DESC";
                break;
        }
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_avec_ingredients_filtres($ids, $categorie, $saison, $tri, $pourcentage)
    {
        $sql = "SELECT *,COUNT(recette.Id_recette) as nombre 
        FROM recette 
        join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette 
        join (select *,max(nombre) as nb from (SELECT recette.Id_recette as id,Id_Saison,COUNT(Id_Saison) as nombre FROM recette join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette join ingredientDeSaison on ingredientutilise.Id_Ingredient = ingredientDeSaison.Id_Ingredient group by recette.Id_recette,Id_Saison order by nombre DESC) as res group by res.id) as tab on recette.Id_recette=tab.id
        join (SELECT Id_Recette, AVG(Note) as note FROM notation group by Id_Recette) as note 
            on recette.Id_recette = note.Id_Recette 
        join (SELECT etape.Id_Recette, SUM(etape.TempsPreparation) as TempsPreparation, SUM(etape.TempsCuisson) as TempsCuisson, SUM(etape.TempsRepos) as TempsRepos ,SUM(etape.TempsTotal) as TempsTotal FROM (recette join etape on recette.Id_recette=etape.Id_Recette) group by Id_recette) as temps 
            on recette.Id_recette = temps.Id_Recette 
        join (select ingredientutilise.Id_Recette, SUM(ingredientutilise.Quantite*ingredient.Calories)as nbcalories from ingredient join ingredientutilise on ingredient.Id_ingredient= ingredientutilise.Id_Ingredient group by ingredientutilise.Id_Recette) as calories
            on recette.Id_recette = calories.Id_Recette";

        $cond = "";
        $i = 0;
        for ($j = 1; $j < count($ids) + 1; $j++) {
            $id = $ids[$j];
            $i++;
            if ($i == 1) {
                $cond = $cond . " ingredientutilise.Id_Ingredient = " . intval($id);
            } else {
                $cond = $cond . " or ingredientutilise.Id_Ingredient = " . intval($id);
            }
        }

        $sql = $sql . " where" . $cond;

        if (count($categorie) > 0) {
            $sql = $sql . " and ( ";
        }
        $i = 0;
        foreach ($categorie as $element) {
            $i++;
            switch ($element) {
                case "1":
                    $sql = $sql . " Id_Categorie = 1";
                    break;
                case "2":
                    if ($i == 1) {
                        $sql = $sql . " Id_Categorie = 2";
                    } else {
                        $sql = $sql . " or Id_Categorie = 2";
                    }
                    break;
                case "3":
                    if ($i == 1) {
                        $sql = $sql . " Id_Categorie = 3";
                    } else {
                        $sql = $sql . " or Id_Categorie = 3";
                    }
                    break;
                case "4":
                    if ($i == 1) {
                        $sql = $sql . " Id_Categorie = 4";
                    } else {
                        $sql = $sql . " or Id_Categorie = 4";
                    }
                    break;
            }
        }
        if (count($categorie) > 0) {
            $sql = $sql . ")";
        }

        $i = 0;
        if (count($saison) == 4) {
            $sql = $sql . " and ( Id_Saison = 5";
        } else if (count($saison) > 0) {
            $sql = $sql . " and ( ";
        }
        foreach ($saison as $element) {
            $i++;
            switch ($element) {
                case "1":
                    $sql = $sql . " or Id_Saison = 1";
                    break;
                case "2":
                    $sql = $sql . " or Id_Saison = 2";
                    break;
                case "3":
                    $sql = $sql . " or Id_Saison = 3";
                    break;
                case "4":
                    $sql = $sql . " or Id_Saison = 4";
                    break;
            }
        }
        if (count($saison) > 0) {
            $sql = $sql . ")";
        }
        $sql = $sql . " group by recette.Id_recette having nombre > " . intval($pourcentage / 100 * count($ids));


        switch ($tri) {
            case 1:
                $sql = $sql . " order by TempsPreparation";
                break;
            case 2:
                $sql = $sql . " order by TempsCuisson";
                break;
            case 3:
                $sql = $sql . " order by TempsTotal";
                break;
            case 4:
                $sql = $sql . " order by nbcalories";
                break;
            case 5:
                $sql = $sql . " order by note DESC ";
                break;
        }
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_selon_saisons($saison)
    {
        $sql = "SELECT * from recette join (select *,max(nombre) as nb from (SELECT recette.Id_recette as id,Id_Saison,COUNT(Id_Saison) as nombre FROM recette join ingredientutilise on recette.Id_recette = ingredientutilise.Id_Recette join ingredientDeSaison on ingredientutilise.Id_Ingredient = ingredientDeSaison.Id_Ingredient group by recette.Id_recette,Id_Saison order by nombre DESC) as res group by res.id) as tab on recette.Id_recette=tab.id";

        $i = 0;
        if (count($saison) > 0) {
            $sql = $sql . " where ( ";
        }
        if (count($saison) == 4) {
            $sql = $sql . "Id_Saison = 5";
        }


        foreach ($saison as $element) {
            $i++;
            switch ($element) {
                case "1":
                    $sql = $sql . " or Id_Saison = 1";
                    break;
                case "2":
                    $sql = $sql . " or Id_Saison = 2";
                    break;
                case "3":
                    $sql = $sql . " or Id_Saison = 3";
                    break;
                case "4":
                    $sql = $sql . " or Id_Saison = 4";
                    break;
            }
        }
        if (count($saison) > 0) {
            $sql = $sql . ")";
        } else {
            $sql = "";
        }

        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recettes_selon_fetes($fetes)
    {
        $sql = "SELECT * from recette join recettedefete on recette.Id_recette=recettedefete.Id_Recette";

        if (count($fetes) > 0) {
            $sql = $sql . " where ( ";
        }

        $i = 0;
        foreach ($fetes as $element) {
            $i++;
            switch ($element) {
                case "1":
                    if ($i == 1) {
                        $sql = $sql . " Id_Fete = 1";
                    } else {
                        $sql = $sql . " or Id_Fete = 1";
                    }
                    break;
                case "2":
                    if ($i == 1) {
                        $sql = $sql . " Id_Fete = 2";
                    } else {
                        $sql = $sql . " or Id_Fete = 2";
                    }
                    break;
                case "3":
                    if ($i == 1) {
                        $sql = $sql . " Id_Fete = 3";
                    } else {
                        $sql = $sql . " or Id_Fete = 3";
                    }
                    break;
                case "4":
                    if ($i == 1) {
                        $sql = $sql . " Id_Fete = 4";
                    } else {
                        $sql = $sql . " or Id_Fete = 4";
                    }
                    break;
                case "5":
                    if ($i == 1) {
                        $sql = $sql . " Id_Fete = 5";
                    } else {
                        $sql = $sql . " or Id_Fete = 5";
                    }
                    break;
            }
        }
        if (count($fetes) > 0) {
            $sql = $sql . ")";
        }

        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_recette($nom, $description, $url, $difficulté, $categorie, $ingredients, $etapes)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "INSERT INTO recette(Nom_recette,Description_recette,Image_recette,Difficulte_recette,Id_Categorie,Valide_recette,Id_Utilisateur,Diapo_recette) VALUES (\"$nom\",\"$description\",\"$url\",$difficulté,$categorie,0,NULL,0)";
        $res = $this->requete($conn, $sql);

        $sql2 = "SELECT MAX(Id_recette) as id from recette";
        $id = ($this->requete($conn, $sql2))[0]["id"];
        $i = 0;

        $sql3 = "INSERT INTO notation(Id_Utilisateur,Id_Recette,Note) values (0,$id,0)";
        $this->requete($conn, $sql3);

        foreach ($etapes as $etape) {
            $i++;
            $this->ajouter_etape($i, $id, $etape[0], intval($etape[1]), intval($etape[2]), intval($etape[3]), intval($etape[4]));
        }
        foreach ($ingredients as $ingredient) {
            $this->ajouter_ingredientUtilise(intval($ingredient[0]), $id, intval($ingredient[2]), $ingredient[3]);
        }
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_recette_ByUser($nom, $description, $url, $difficulté, $categorie, $id_utilisateur, $ingredients, $etapes)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "INSERT INTO recette(Nom_recette,Description_recette,Image_recette,Difficulte_recette,Id_Categorie,Valide_recette,Id_Utilisateur,Diapo_recette) VALUES (\"$nom\",\"$description\",\"$url\",$difficulté,$categorie,0,$id_utilisateur,0)";
        $res = $this->requete($conn, $sql);

        $sql2 = "SELECT MAX(Id_recette) as id from recette";
        $id = ($this->requete($conn, $sql2))[0]["id"];
        $i = 0;

        $sql3 = "INSERT INTO notation(Id_Utilisateur,Id_Recette,Note) values (0,$id,0)";
        $this->requete($conn, $sql3);

        foreach ($etapes as $etape) {
            $i++;
            $this->ajouter_etape($i, $id, $etape[0], intval($etape[1]), intval($etape[2]), intval($etape[3]), intval($etape[4]));
        }
        foreach ($ingredients as $ingredient) {
            $this->ajouter_ingredientUtilise(intval($ingredient[0]), $id, intval($ingredient[2]), $ingredient[3]);
        }
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_etape($id_etape, $id_recette, $contenu_etape, $t1, $t2, $t3, $t4)
    {
        $sql = "INSERT INTO etape(Id_etape,Id_Recette,Nom_etape,Description_etape,TempsPreparation,TempsCuisson,TempsRepos,TempsTotal) VALUES ($id_etape,$id_recette,'',\"$contenu_etape\",$t1,$t2,$t3,$t4)";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function modifier_etape($id_etape, $id_recette, $contenu_etape, $t1, $t2, $t3, $t4)
    {
        $sql = "UPDATE etape set Description_etape=$contenu_etape,TempsPreparation=$t1,TempsCuisson=$t2,TempsRepos=$t3,TempsTotal=$t4 where Id_etape=$id_etape and Id_Recette=$id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_etapes($id_recette)
    {
        $sql = "DELETE FROM etape where Id_Recette = $id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function ajouter_ingredientUtilise($id_ingredient, $id_recette, $quantite, $unite)
    {
        $sql = "INSERT INTO ingredientutilise(Id_Ingredient,Id_Recette,Quantite,Unite) VALUES ($id_ingredient,$id_recette,$quantite,\"$unite\")";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function modifier_ingredientUtilise($id_ingredient, $id_recette, $quantite, $unite)
    {
        $sql = "UPDATE ingredientutilise SET Quantite=$quantite,Unite=$unite where Id_Ingredient=$id_ingredient and Id_Recette=$id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_ingredientsUtilises($id_recette)
    {
        $sql = "DELETE FROM ingredientutilise where Id_Recette = $id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }



    public function modifier_recette($id, $nom, $description, $url, $difficulté, $categorie, $ingredients, $etapes)
    {

        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $sql = "UPDATE recette SET Nom_recette=\"$nom\",Description_recette=\"$description\",Image_recette=\"$url\",Difficulte_recette=$difficulté,Id_Categorie=$categorie,Valide_recette=0 where Id_recette=$id";
        $res = $this->requete($conn, $sql);

        $this->supprimer_etapes($id);
        $this->supprimer_ingredientsUtilises($id);

        $i = 0;
        foreach ($etapes as $etape) {
            $i++;
            $this->ajouter_etape($i, $id, $etape[0], intval($etape[1]), intval($etape[2]), intval($etape[3]), intval($etape[4]));
        }
        foreach ($ingredients as $ingredient) {
            $this->ajouter_ingredientUtilise(intval($ingredient[0]), $id, intval($ingredient[2]), $ingredient[3]);
        }
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_recette($id)
    {
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $this->supprimer_etapes($id);
        $this->supprimer_ingredientsUtilises($id);

        $sql3 = "DELETE FROM notation where Id_Recette=$id";
        $this->requete($conn, $sql3);

        $sql = "DELETE FROM recette WHERE Id_recette=$id";
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function valider_recette($id)
    {
        $sql = "UPDATE recette SET Valide_recette=1 WHERE Id_recette=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function bloquer_recette($id)
    {
        $sql = "UPDATE recette SET Valide_recette=0 WHERE Id_recette=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_recette($id)
    {
        $data = array();
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);

        // Retourner les détails de la recette comme premier élément du tabeau $data
        $sql = "SELECT * 
        FROM recette 
        join (SELECT Id_Recette, AVG(Note) as note FROM notation group by Id_Recette) as note 
            on recette.Id_recette = note.Id_Recette 
        join (SELECT etape.Id_Recette, SUM(etape.TempsPreparation) as TempsPreparation, SUM(etape.TempsCuisson) as TempsCuisson, SUM(etape.TempsRepos) as TempsRepos ,SUM(etape.TempsTotal) as TempsTotal FROM (recette join etape on recette.Id_recette=etape.Id_Recette) group by Id_recette) as temps 
            on recette.Id_recette = temps.Id_Recette 
        join (select ingredientutilise.Id_Recette, SUM(ingredientutilise.Quantite*ingredient.Calories)as nbcalories from ingredient join ingredientutilise on ingredient.Id_ingredient= ingredientutilise.Id_Ingredient group by ingredientutilise.Id_Recette) as calories
            on recette.Id_recette = calories.Id_Recette 
        WHERE recette.Id_recette=$id";
        $res = $this->requete($conn, $sql);
        array_push($data, $res[0]);

        // Retourner les ingrédients de la recette comme deuxième élément de la recette
        $sql1 = "SELECT * FROM recette join (ingredientutilise join ingredient on ingredientutilise.Id_ingredient=ingredient.Id_ingredient) on recette.Id_recette=ingredientutilise.Id_Recette WHERE recette.Id_recette=$id";
        $res1 = $this->requete($conn, $sql1);
        array_push($data, $res1);

        // Retourner les étapes de la recette comme troisième élément de la recette
        $sql2 = "SELECT * FROM recette join etape on recette.Id_recette=etape.Id_Recette WHERE recette.Id_recette=$id";
        $res2 = $this->requete($conn, $sql2);
        array_push($data, $res2);

        $this->Deconnexion($conn);
        return $data;
    }


    public function ajouter_ingredient($nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison)
    {
        $sql = "INSERT INTO ingredient(Nom_ingredient,Description_ingredient,Image_ingredient,Healthy,Calories,Glucides,Lipides,Mineraux,Vitamines) VALUES (\"$nom\",\"$description\",\"$url\",$healthy,$calories,\"$glucides\",\"$lipides\",\"$mineraux\",\"$vitamines\")";
        $sql1 = "SELECT MAX(Id_ingredient) as id from ingredient";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res1 = $this->requete($conn, $sql);
        $id = intval(($this->requete($conn, $sql1)[0])["id"]);
        $sql2 = "INSERT INTO ingredientDeSaison(Id_Saison,Id_Ingredient) values ($saison,$id)";
        $res2 = $this->requete($conn, $sql2);
        $res = array();
        array_push($res, $res1);
        array_push($res, $res2);
        $this->Deconnexion($conn);
        return $res;
    }

    public function modifier_ingredient($id, $nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison)
    {
        $sql = "UPDATE ingredient set Nom_ingredient=\"$nom\",Description_ingredient=\"$description\",Image_ingredient=\"$url\",Healthy=$healthy
        ,Calories=$calories,Glucides=\"$glucides\",Lipides=\"$lipides\",Mineraux=\"$mineraux\",Vitamines=\"$vitamines\" where Id_ingredient = $id";
        $sql2 = "UPDATE ingredientDeSaison set Id_Saison=$saison where Id_Ingredient = $id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res1 = $this->requete($conn, $sql);
        $res2 = $this->requete($conn, $sql2);
        $res = array();
        array_push($res, $res1);
        array_push($res, $res2);
        $this->Deconnexion($conn);
        return $res;
    }

    public function supprimer_ingredient($id)
    {
        $sql = "DELETE FROM ingredient WHERE Id_ingredient=$id";
        $sql1 = "DELETE FROM ingredientDeSaison WHERE Id_Ingredient=$id";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res1 = $this->requete($conn, $sql);
        $res2 = $this->requete($conn, $sql1);
        $res = array();
        array_push($res, $res1);
        array_push($res, $res2);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_pourcentage()
    {
        $sql = "SELECT * FROM parametre";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql)[0]["Valeur_parametre"];
        $this->Deconnexion($conn);
        return $res;
    }

    public function modifier_pourcentage($pourcentage)
    {
        $sql = "UPDATE parametre set Valeur_parametre=$pourcentage where Id_parametre=1";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function afficher_proportion()
    {
        $sql = "SELECT * FROM parametre";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql)[1]["Valeur_parametre"];
        $this->Deconnexion($conn);
        return $res;
    }

    public function modifier_proportion($proportion)
    {
        $sql = "UPDATE parametre set Valeur_parametre=$proportion where Id_parametre=2";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        return $res;
    }

    public function lire_note($id_utilisateur, $id_recette)
    {
        $sql = "SELECT * from notation where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        $this->Deconnexion($conn);
        if (count($res) > 0) {
            return $res[0]["Note"];
        } else {
            return false;
        }
    }

    public function noter($id_utilisateur, $id_recette, $note)
    {
        $sql = "SELECT * from notation where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
        $conn = $this->Connexion($this->servername, $this->dbname, $this->username, $this->password);
        $res = $this->requete($conn, $sql);
        if (count($res) > 0) {
            $sql1 = "UPDATE notation set Note=$note where Id_Utilisateur=$id_utilisateur and Id_Recette=$id_recette";
            $res = $this->requete($conn, $sql1);
            $this->Deconnexion($conn);
            return $res;
        } else {
            $sql1 = "INSERT INTO notation(Id_Utilisateur,Id_Recette,Note) values($id_utilisateur, $id_recette, $note)";
            $res = $this->requete($conn, $sql1);
            $this->Deconnexion($conn);
            return $res;
        }
    }
}
?>