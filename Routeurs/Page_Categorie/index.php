<?php
require_once("../../Controller/Controller.php");
$c = new Controller();
$categorie = array();
$saison = array();

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

$c->afficher_page_categorie($_GET["categorie"], $saison, $tri);
?>