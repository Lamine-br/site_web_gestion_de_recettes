<?php
require_once("../../Controller/Controller.php");
$c = new Controller();
$saison = array();

if (isset($_POST["appliquer"])) {
    if (isset($_POST["hiver"])) {
        array_push($saison, $_POST["hiver"]);
    }
    if (isset($_POST["printemps"])) {
        print_r($_POST["printemps"]);
        array_push($saison, $_POST["printemps"]);
    }
    if (isset($_POST["ete"])) {
        array_push($saison, $_POST["ete"]);
    }
    if (isset($_POST["automne"])) {
        array_push($saison, $_POST["automne"]);
    }

    if (isset($_GET["id"]) && isset($_GET["id_recette"])) {
        $c->ajouter_favori(intval($_GET["id"]), intval($_GET["id_recette"]));
    }
} else {
    $saison = ["1", "2", "3", "4"];
}

$c->afficher_page_saisons($saison);

?>