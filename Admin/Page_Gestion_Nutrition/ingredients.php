<?php
require_once("../../Controller/Controller.php");
header("Content-Type: application/json");
$c = new Controller();
$data = $c->afficher_ingredients();
print_r(json_encode($data));
?>