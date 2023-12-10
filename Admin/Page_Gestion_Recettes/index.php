<?php
require_once("../../Controller/Controller.php");

$c = new Controller();

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

    if ($_POST["choix"] == "1") {
        $c->ajouter_recette($_POST["nom"], $_POST["description"], $target_file, $_POST["difficulté"], $_POST["categorie"], $res1, $r1);
    } else if ($_POST["choix"] == "2") {
        if (isset($_POST["id"])) {
            $c->modifier_recette($_POST["id"], $_POST["nom"], $_POST["description"], $target_file, $_POST["difficulté"], $_POST["categorie"], $res1, $r1);
        }
    }
}
if (isset($_POST["bloquer"])) {
    $c->bloquer_recette($_POST["bloquer"]);
}
if (isset($_POST["supprimer"])) {
    $c->supprimer_recette($_POST["supprimer"]);
}
if (isset($_POST["valider"])) {
    $c->valider_recette($_POST["valider"]);
}
$c->afficher_page_gestion_recettes_admin();
?>