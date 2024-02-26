<?php
require_once("bootstrap.php");

$templateParams["title"] = "Appartamenti - Prenotazioni";
$templateParams['nome'] = 'template/prenotazioni.php';
$templateParams['condomini'] = $dbh->getCondomini();
require("template/base.php");

?>