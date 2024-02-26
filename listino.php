<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Appartamenti - Prenotazioni";
$templateParams['nome'] = 'template/listino.php';
$templateParams['condomini'] = $dbh->getCondomini();
if (isset($_POST['id-app']) && isset($_POST['anno'])) {
    echo "noo";
    $dbh->addListino($_POST['anno'], $_POST['id-app']);
} 
if (isset($_POST['id-app']) && isset($_POST['anno-p']) && isset($_POST['prezzo']) && isset($_POST['data_inizio']) && isset($_POST['data_fine'])) {
    echo $_POST['data_inizio'];
    echo $_POST['data_fine'];
    echo $_POST['anno'];
    echo $_POST['id-app'];
    echo $_POST['prezzo'];
    $dbh->insertNewPeriod($_POST['data_inizio'], $_POST['data_fine'], $_POST['anno'], $_POST['id-app'], $_POST['prezzo']);
}
require("template/base.php");

?>