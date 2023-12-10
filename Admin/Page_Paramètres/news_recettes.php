<?php
require_once("../../Controller/Controller.php");
header("Content-Type: application/json");
$c = new Controller();
$news = $c->afficher_news();
$recettes = $c->afficher_recettes();
$data = array();
array_push($data, $news);
array_push($data, $recettes);
print_r(json_encode($data));
?>