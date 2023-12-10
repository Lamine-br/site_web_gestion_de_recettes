<?php
require_once("../../Controller/Controller.php");

$c = new Controller();
if (isset($_GET["id_news"])) {
    $c->afficher_page_News2($_GET["id_news"]);
}
?>