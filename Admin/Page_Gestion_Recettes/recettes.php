<?php
require_once("../../Controller/Controller.php");
header("Content-Type: application/json");
$c = new Controller();
$recettes = $c->afficher_recettes();
$ingredients = $c->afficher_ingredientsutilises();
$etpes = $c->afficher_etapes();
$data = array();
array_push($data, $recettes);
array_push($data, $ingredients);
array_push($data, $etpes);
print_r(json_encode($data));
?>