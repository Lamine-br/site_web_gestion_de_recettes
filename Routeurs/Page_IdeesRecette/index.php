<?php
require_once("../../Controller/Controller.php");
$c = new Controller();
$categorie = array();
$saison = array();

if (isset($_POST["entrees"])) {
    array_push($categorie, $_POST["entrees"]);
}
if (isset($_POST["plats"])) {
    array_push($categorie, $_POST["plats"]);
}
if (isset($_POST["desserts"])) {
    array_push($categorie, $_POST["desserts"]);
}
if (isset($_POST["boissons"])) {
    array_push($categorie, $_POST["boissons"]);
}


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

$tri = 5;
if (isset($_POST["tri"])) {
    $tri = $_POST["tri"];
}

if (isset($_POST["ids"])) {
    $array = explode(" ", $_POST["ids"]);
    unset($array[0]);
    $c->afficher_page_IdeesRecette($array, $categorie, $saison, $tri);
} else {
    $c->afficher_page_IdeesRecette([], $categorie, $saison, $tri);
}

?>