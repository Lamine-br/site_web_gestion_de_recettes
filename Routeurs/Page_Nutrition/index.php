<?php
require_once("../../Controller/Controller.php");

$c = new Controller();
if (isset($_GET["rechercher"])) {
    $c->afficher_page_nutrition($_GET["rechercher"]);
} else {
    $c->afficher_page_nutrition("");
}

?>