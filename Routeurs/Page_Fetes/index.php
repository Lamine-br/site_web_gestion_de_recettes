<?php
require_once("../../Controller/Controller.php");
$c = new Controller();
$fetes = array();

if (isset($_POST["appliquer"])) {
    if (isset($_POST["yennayer"])) {
        array_push($fetes, $_POST["yennayer"]);
    }
    if (isset($_POST["mawlid"])) {
        array_push($fetes, $_POST["mawlid"]);
    }
    if (isset($_POST["achoura"])) {
        array_push($fetes, $_POST["achoura"]);
    }
    if (isset($_POST["aidkbir"])) {
        array_push($fetes, $_POST["aidkbir"]);
    }
    if (isset($_POST["aidsghir"])) {
        array_push($fetes, $_POST["aidsghir"]);
    }
} else {
    $fetes = ["1", "2", "3", "4", "5"];
}

$c->afficher_page_fetes($fetes);

?>