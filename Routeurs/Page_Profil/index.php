<?php
require_once("../../Controller/Controller.php");

$c = new Controller();

if (isset($_GET["id"])) {
    if (isset($_GET["id_recette_enlev"])) {
        $c->supprimer_favori(intval($_GET["id"]), intval($_GET["id_recette_enlev"]));
        $c->afficher_page_profil(intval($_GET["id"]));
    } else {
        if (
            isset($_POST["nom"]) && isset($_POST["description"])
            && isset($_FILES["url"]) && isset($_POST["difficulté"]) && isset($_POST["categorie"])
            && isset($_POST["ingredients"]) && isset($_POST["etapes"])
        ) {
            $target_dir = "../../Images/Recettes/";
            $target_file = $target_dir . basename($_FILES["url"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["url"]["tmp_name"], $target_file);

            $div1 = explode(" - ", $_POST["ingredients"]);
            $res1 = array();
            foreach ($div1 as $div) {
                $div2 = explode(":", $div);
                array_push($res1, $div2);
            }

            $d1 = explode(" - ", $_POST["etapes"]);
            $r1 = array();
            foreach ($d1 as $d) {
                $d2 = explode(":", $d);
                array_push($r1, $d2);
            }

            $c->ajouter_recette_ByUser($_POST["nom"], $_POST["description"], $target_file, $_POST["difficulté"], $_POST["categorie"], $_GET["id"], $res1, $r1);

        }

        $c->afficher_page_profil(intval($_GET["id"]));
    }
}
?>