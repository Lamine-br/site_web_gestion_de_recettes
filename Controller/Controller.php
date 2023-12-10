<?php
require_once("../../Model/Model.php");
require_once("../../View/View.php");
class Controller
{
    public function login_utilisateur($username, $password)
    {
        $model = new Model();
        return $model->login_utilisateur($username, $password);
    }

    public function login_admin($username, $password)
    {
        $model = new Model();
        return $model->login_admin($username, $password);
    }

    public function afficher_recettes()
    {
        $model = new Model();
        return $model->afficher_recettes_admin();
    }

    public function afficher_recettes_ByUser($id_utilisateur)
    {
        $model = new Model();
        return $model->afficher_recettes_ByUser($id_utilisateur);
    }
    public function afficher_etapes()
    {
        $model = new Model();
        return $model->afficher_etapes();
    }

    public function afficher_ingredientsutilises()
    {
        $model = new Model();
        return $model->afficher_ingredientssutilises();
    }

    public function ajouter_recette($nom, $description, $url, $difficulté, $categorie, $etapes, $ingredients)
    {
        $model = new Model();
        return $model->ajouter_recette($nom, $description, $url, $difficulté, $categorie, $etapes, $ingredients);
    }

    public function ajouter_recette_ByUser($nom, $description, $url, $difficulté, $categorie, $id_utilisateur, $etapes, $ingredients)
    {
        $model = new Model();
        return $model->ajouter_recette_ByUser($nom, $description, $url, $difficulté, $categorie, $id_utilisateur, $etapes, $ingredients);
    }

    public function modifier_recette($id, $nom, $description, $url, $difficulté, $categorie, $ingredients, $etapes)
    {
        $model = new Model();
        return $model->modifier_recette($id, $nom, $description, $url, $difficulté, $categorie, $ingredients, $etapes);
    }

    public function supprimer_recette($id)
    {
        $model = new Model();
        return $model->supprimer_recette($id);
    }

    public function valider_recette($id)
    {
        $model = new Model();
        return $model->valider_recette($id);
    }

    public function bloquer_recette($id)
    {
        $model = new Model();
        return $model->bloquer_recette($id);
    }

    public function afficher_recette($id)
    {
        $model = new Model();
        return $model->afficher_recette($id);
    }


    public function noter_recette($id_utilisateur, $id_recette, $note)
    {
        $model = new Model();
        return $model->noter_recette($id_utilisateur, $id_recette, $note);
    }

    public function supprimer_favori($id_utilisateur, $id_recette)
    {
        $model = new Model();
        return $model->supprimer_favori($id_utilisateur, $id_recette);
    }

    public function ajouter_favori($id_utilisateur, $id_recette)
    {
        $model = new Model();
        return $model->ajouter_favori($id_utilisateur, $id_recette);
    }

    // Ingredient

    public function ajouter_ingredient($nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison)
    {
        $model = new Model();
        return $model->ajouter_ingredient($nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison);
    }

    public function modifier_ingredient($id, $nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison)
    {
        $model = new Model();
        return $model->modifier_ingredient($id, $nom, $description, $url, $healthy, $calories, $glucides, $lipides, $mineraux, $vitamines, $saison);
    }

    public function supprimer_ingredient($id)
    {
        $model = new Model();
        return $model->supprimer_ingredient($id);
    }

    public function afficher_ingredients()
    {
        $model = new Model();
        return $model->afficher_ingredients();
    }

    // Utilisateur

    public function ajouter_utilisateur($nom, $prénom, $dateNaissance, $sexe, $email, $password)
    {
        $model = new Model();
        return $model->ajouter_utilisateur($nom, $prénom, $dateNaissance, $sexe, $email, $password);
    }

    public function supprimer_utilisateur($id)
    {
        $model = new Model();
        return $model->supprimer_utilisateur($id);
    }

    public function valider_utilisateur($id)
    {
        $model = new Model();
        return $model->valider_utilisateur($id);
    }

    public function bloquer_utilisateur($id)
    {
        $model = new Model();
        return $model->bloquer_utilisateur($id);
    }

    public function afficher_utilisateurs()
    {
        $model = new Model();
        return $model->afficher_utilisateurs();
    }

    // News
    public function afficher_news()
    {
        $model = new Model();
        return $model->afficher_news();
    }

    public function ajouter_news($nom, $description, $image, $paragraphes)
    {
        $model = new Model();
        return $model->ajouter_news($nom, $description, $image, $paragraphes);
    }

    public function supprimer_news($id)
    {
        $model = new Model();
        return $model->supprimer_news($id);
    }

    public function ajouter_recette_diapo($id)
    {
        $model = new Model();
        return $model->ajouter_recette_diapo($id);
    }

    public function enlever_recette_diapo($id)
    {
        $model = new Model();
        return $model->enlever_recette_diapo($id);
    }

    public function ajouter_news_diapo($id)
    {
        $model = new Model();
        return $model->ajouter_news_diapo($id);
    }

    public function enlever_news_diapo($id)
    {
        $model = new Model();
        return $model->enlever_news_diapo($id);
    }

    public function afficher_pourcentage()
    {
        $model = new Model();
        return $model->afficher_pourcentage();
    }

    public function modifier_pourcentage($pourcentage)
    {
        $model = new Model();
        return $model->modifier_pourcentage($pourcentage);
    }

    public function afficher_proportion()
    {
        $model = new Model();
        return $model->afficher_proportion();
    }

    public function modifier_proportion($proportion)
    {
        $model = new Model();
        return $model->modifier_proportion($proportion);
    }

    public function lire_note($id_utilisateur, $id_recette)
    {
        $model = new Model();
        return $model->lire_note($id_utilisateur, $id_recette);
    }

    public function noter($id_utilisateur, $id_recette, $note)
    {
        $model = new Model();
        return $model->noter($id_utilisateur, $id_recette, $note);
    }

    public function afficher_page_acceuil()
    {
        $model = new Model();
        $view = new View();
        $data1 = $model->afficher_recettes_selon_categorie("Entrees");
        $data2 = $model->afficher_recettes_selon_categorie("Plats");
        $data3 = $model->afficher_recettes_selon_categorie("Desserts");
        $data4 = $model->afficher_recettes_selon_categorie("Boissons");
        $data = array();
        array_push($data, $data1);
        array_push($data, $data2);
        array_push($data, $data3);
        array_push($data, $data4);
        $recettes_diapo = $model->afficher_recettes_diapo();
        $news_diapo = $model->afficher_news_diapo();
        $diapo = array();
        array_push($diapo, $recettes_diapo);
        array_push($diapo, $news_diapo);
        $view->afficher_page_acceuil($diapo, $data);
    }

    public function afficher_page_recette($id)
    {
        $model = new Model();
        $view = new View();
        $data = $model->afficher_recette($id);
        $view->afficher_page_recette($data);
    }

    public function afficher_page_categorie($id_categorie, $saison, $tri)
    {
        $model = new Model();
        $view = new View();
        $categorie = array();
        array_push($categorie, $id_categorie);
        $recettes = $model->afficher_recettes_avec_filtres($categorie, $saison, $tri);
        $view->afficher_page_categorie($recettes);
    }

    public function afficher_page_News()
    {
        $model = new Model();
        $view = new View();
        $news = $model->afficher_news();
        $recettes = $model->afficher_recettes_valides();
        $view->afficher_page_News($news, $recettes);
    }

    public function afficher_page_News2($id)
    {
        $model = new Model();
        $view = new View();
        $news = $model->afficher_news_ById($id);
        $view->afficher_page_News2($news);
    }

    public function afficher_page_IdeesRecette($ing, $res, $saison, $tri)
    {
        $model = new Model();
        $view = new View();
        $ingredients = $model->afficher_ingredients();
        if (count($ing) == 0) {
            $recettes = $model->afficher_recettes_avec_filtres($res, $saison, $tri);
        } else {
            $pourcentage = $this->afficher_pourcentage();
            $recettes = $model->afficher_recettes_avec_ingredients_filtres($ing, $res, $saison, $tri, $pourcentage);
        }
        $view->afficher_page_IdeesRecette($ingredients, $recettes);
    }
    public function afficher_page_healthy()
    {
        $model = new Model();
        $view = new View();
        $recettes = $model->afficher_recettes_healthy();
        $view->afficher_page_healthy($recettes);
    }
    public function afficher_page_saisons($saison)
    {
        $model = new Model();
        $view = new View();
        $recettes = $model->afficher_recettes_selon_saisons($saison);
        $view->afficher_page_saisons($recettes);
    }

    public function afficher_page_fetes($fetes)
    {
        $model = new Model();
        $view = new View();
        $recettes = $model->afficher_recettes_selon_fetes($fetes);
        $view->afficher_page_fetes($recettes);
    }

    public function afficher_page_profil($id)
    {
        $model = new Model();
        $view = new View();
        $data = $model->afficher_profil_utilisateur($id);
        $view->afficher_page_profil($data);
    }

    public function afficher_page_nutrition($mot)
    {
        $model = new Model();
        $view = new View();
        if ($mot == "") {
            $ingredients = $model->afficher_ingredients();
        } else {
            $ingredients = $model->afficher_ingredients_avecMotCle($mot);
        }
        $view->afficher_page_nutrition($ingredients);
    }

    public function afficher_page_gestion_nutrition_admin()
    {
        $view = new View();
        $view->afficher_page_gestion_nutrition_admin();
    }

    public function afficher_page_gestion_recettes_admin()
    {
        $view = new View();
        $model = new Model();
        $ingredients = $model->afficher_ingredients();
        $view->afficher_page_gestion_recettes_admin($ingredients);
    }

    public function afficher_page_gestion_utilisateurs_admin()
    {
        $view = new View();
        $view->afficher_page_gestion_utilisateurs_admin();
    }

    public function afficher_page_gestion_news_admin()
    {
        $view = new View();
        $view->afficher_page_gestion_news_admin();
    }

    public function afficher_page_principale_admin()
    {
        $view = new View();
        $view->afficher_page_principale_admin();
    }

    public function afficher_page_parametres_admin()
    {
        $view = new View();
        $view->afficher_page_parametres_admin();
    }
}
?>