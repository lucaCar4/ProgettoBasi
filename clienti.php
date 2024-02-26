<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "Appartamenti - Prenotazioni";
$templateParams['nome'] = 'template/creareCliente.php';
$templateParams['condomini'] = $dbh->getCondomini();
if (
    isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['codice_documento']) && isset($_POST['data_rilascio'])
    && isset($_POST['da_chi']) && isset($_POST['luogo_nascita']) && isset($_POST['provincia']) && isset($_POST['data_nascita']) && isset($_POST['comune_residenza'])
    && isset($_POST['cap']) && isset($_POST['via']) && isset($_POST['numero_civico']) && isset($_POST['mail']) && isset($_POST['numero'])
) {
    $dbh->addCliente(
        $_POST['nome'],
        $_POST['cognome'],
        intval($_POST['codice_documento']),
        $_POST['data_rilascio'],
        $_POST['da_chi'],
        $_POST['luogo_nascita'],
        $_POST['provincia'],
        $_POST['data_nascita'],
        $_POST['comune_residenza'],
        $_POST['cap'],
        $_POST['via'],
        intval($_POST['numero_civico']),
        $_POST['mail'],
        intval($_POST['numero'])
    );
}
require("template/base.php");

?>