<?php
require_once("../../Controller/Controller.php");

$c = new Controller();
if (isset($_GET["id_recette"])) {
    if (isset($_GET["id"])) {
        if ($_GET["id"] == " ") {
            header("Location: ../Page_Connexion/index.php");
        } else {
            if (isset($_GET["note"])) {
                $c->noter($_GET["id"], $_GET["id_recette"], $_GET["note"]);
                $c->afficher_page_recette($_GET["id_recette"]);
            } else {
                $c->ajouter_favori($_GET["id"], $_GET["id_recette"]);
                $id = intval($_GET["id_recette"]);
                $c->afficher_page_recette($id);
            }
        }
    } else {
        $id = intval($_GET["id_recette"]);
        $c->afficher_page_recette($id);
    }
} else {

}

?>