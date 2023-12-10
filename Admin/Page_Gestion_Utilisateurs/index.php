<?php
require_once("../../Controller/Controller.php");

$c = new Controller();

if (isset($_POST["bloquer"])) {
    $c->bloquer_utilisateur($_POST["bloquer"]);
}
if (isset($_POST["supprimer"])) {
    $c->supprimer_utilisateur($_POST["supprimer"]);
}
if (isset($_POST["valider"])) {
    $c->valider_utilisateur($_POST["valider"]);
}

$c->afficher_page_gestion_utilisateurs_admin();
?>